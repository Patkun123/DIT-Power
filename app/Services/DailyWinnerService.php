<?php

namespace App\Services;

use App\Models\DailyWinner;
use App\Models\QuizAttempt;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DailyWinnerService
{
    /**
     * Calculate and store daily winners for a specific date
     */
    public function calculateDailyWinners($date = null): array
    {
        $date = $date ? Carbon::parse($date) : Carbon::yesterday();
        $dateString = $date->format('Y-m-d');
        
        $winners = [];
        
        try {
            DB::beginTransaction();
            
            // Calculate overall winner (that day's cumulative scores only)
            $overallWinner = $this->calculateOverallWinner($dateString);
            if ($overallWinner) {
                $winners['overall'] = $overallWinner;
            }
            
            // Calculate set-specific winners for the day
            for ($set = 1; $set <= 3; $set++) {
                $setWinner = $this->calculateSetWinner($set, $dateString);
                if ($setWinner) {
                    $winners["set_{$set}"] = $setWinner;
                }
            }
            
            DB::commit();
            
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        
        return $winners;
    }
    
    /**
     * Calculate overall winner (based on that day's cumulative scores only)
     */
    private function calculateOverallWinner($date): ?DailyWinner
    {
        // Get the user with highest cumulative score for that specific day
        $topUser = QuizAttempt::select('user_id')
            ->selectRaw('SUM(score) as total_score')
            ->selectRaw('SUM(correct) as total_correct')
            ->selectRaw('COUNT(*) as attempts_count')
            ->with('user:id,firstname,lastname')
            ->whereNotNull('set')
            ->whereIn('set', ['1', '2', '3'])
            ->whereDate('created_at', $date)
            ->groupBy('user_id')
            ->orderByDesc('total_score')
            ->orderByDesc('total_correct')
            ->first();
            
        if (!$topUser) {
            return null;
        }
        
        // Store or update the overall winner
        return DailyWinner::updateOrCreate(
            [
                'winner_type' => 'overall',
                'winner_date' => $date,
            ],
            [
                'user_id' => $topUser->user_id,
                'score' => $topUser->total_score,
                'correct_answers' => $topUser->total_correct,
                'attempts_count' => $topUser->attempts_count,
                'set_number' => null,
            ]
        );
    }
    
    /**
     * Calculate winner for a specific set on a specific date
     */
    private function calculateSetWinner($setNumber, $date): ?DailyWinner
    {
        // Get the user with highest score for this set on this date
        $topUser = QuizAttempt::select('user_id')
            ->selectRaw('MAX(score) as best_score')
            ->selectRaw('MAX(correct) as best_correct')
            ->selectRaw('COUNT(*) as attempts_count')
            ->with('user:id,firstname,lastname')
            ->where('set', $setNumber)
            ->whereDate('created_at', $date)
            ->groupBy('user_id')
            ->orderByDesc('best_score')
            ->orderByDesc('best_correct')
            ->first();
            
        if (!$topUser) {
            return null;
        }
        
        // Store or update the set winner
        return DailyWinner::updateOrCreate(
            [
                'winner_type' => "set_{$setNumber}",
                'winner_date' => $date,
            ],
            [
                'user_id' => $topUser->user_id,
                'score' => $topUser->best_score,
                'correct_answers' => $topUser->best_correct,
                'attempts_count' => $topUser->attempts_count,
                'set_number' => $setNumber,
            ]
        );
    }
    
    /**
     * Get recent winners for display
     */
    public function getRecentWinners($days = 7): array
    {
        $winners = DailyWinner::with('user:id,firstname,lastname,profileimage')
            ->recent($days)
            ->orderByDesc('winner_date')
            ->orderBy('winner_type')
            ->get()
            ->groupBy('winner_type');
            
        return [
            'overall' => $winners->get('overall', collect()),
            'set_1' => $winners->get('set_1', collect()),
            'set_2' => $winners->get('set_2', collect()),
            'set_3' => $winners->get('set_3', collect()),
        ];
    }
    
    /**
     * Get winners for a specific date
     */
    public function getWinnersForDate($date): array
    {
        $winners = DailyWinner::with('user:id,firstname,lastname,profileimage')
            ->forDate($date)
            ->get()
            ->keyBy('winner_type');
            
        return [
            'overall' => $winners->get('overall'),
            'set_1' => $winners->get('set_1'),
            'set_2' => $winners->get('set_2'),
            'set_3' => $winners->get('set_3'),
        ];
    }
    
    /**
     * Get all-time champions (users who won most frequently)
     */
    public function getAllTimeChampions(): \Illuminate\Database\Eloquent\Collection
    {
        $champions = DailyWinner::select('user_id')
            ->selectRaw('COUNT(*) as win_count')
            ->selectRaw('SUM(score) as total_score')
            ->with('user:id,firstname,lastname,profileimage')
            ->groupBy('user_id')
            ->orderByDesc('win_count')
            ->orderByDesc('total_score')
            ->limit(10)
            ->get();
            
        return $champions;
    }
    
    /**
     * Get winner statistics
     */
    public function getWinnerStats(): array
    {
        $totalWinners = DailyWinner::count();
        $uniqueWinners = DailyWinner::distinct('user_id')->count();
        $totalDays = DailyWinner::distinct('winner_date')->count();
        
        $mostWins = DailyWinner::select('user_id')
            ->selectRaw('COUNT(*) as win_count')
            ->with('user:id,firstname,lastname')
            ->groupBy('user_id')
            ->orderByDesc('win_count')
            ->first();
            
        return [
            'total_winners' => $totalWinners,
            'unique_winners' => $uniqueWinners,
            'total_days' => $totalDays,
            'most_wins' => $mostWins,
        ];
    }
}
