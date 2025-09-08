<?php

namespace App\Livewire;

use App\Models\QuizAttempt;
use App\Models\User;
use Livewire\Component;
use Carbon\Carbon;

class Leaderboards extends Component
{
    public $overallLeaderboard = [];
    public $set1Leaderboard = [];
    public $set2Leaderboard = [];
    public $set3Leaderboard = [];
    public $today = '';
    public $isLoading = false;

    public function mount()
    {
        $this->today = Carbon::now()->format('Y-m-d');
        $this->loadLeaderboards();
    }

    public function loadLeaderboards()
    {
        $this->isLoading = true;

        try {
            // Overall leaderboard (all time) - exclude null sets (mini games)
            $this->overallLeaderboard = QuizAttempt::select('user_id', 'score', 'correct', 'set')
                ->with('user:id,firstname,lastname')
                ->whereNotNull('set')
                ->whereIn('set', ['1', '2', '3'])
                ->orderBy('score', 'desc')
                ->orderBy('correct', 'desc')
                ->limit(10)
                ->get()
                ->groupBy('user_id')
                ->map(function ($attempts) {
                    $user = $attempts->first()->user;
                    $totalScore = $attempts->sum('score');
                    $totalCorrect = $attempts->sum('correct');
                    $attemptsCount = $attempts->count();
                    
                    return [
                        'user' => $user,
                        'total_score' => $totalScore,
                        'total_correct' => $totalCorrect,
                        'attempts_count' => $attemptsCount,
                        'average_score' => $attemptsCount > 0 ? round($totalScore / $attemptsCount, 2) : 0
                    ];
                })
                ->sortByDesc('total_score')
                ->take(5)
                ->values();

            // Daily leaderboards for each set (excluding mini games)
            $this->set1Leaderboard = $this->getDailyLeaderboard('1');
            $this->set2Leaderboard = $this->getDailyLeaderboard('2');
            $this->set3Leaderboard = $this->getDailyLeaderboard('3');

        } catch (\Exception $e) {
            // Log error or handle gracefully
            session()->flash('error', 'Failed to load leaderboards. Please try again.');
        } finally {
            $this->isLoading = false;
        }
    }

    private function getDailyLeaderboard($set)
    {
        return QuizAttempt::select('user_id', 'score', 'correct', 'set')
            ->with('user:id,firstname,lastname')
            ->where('set', $set)
            ->whereDate('created_at', $this->today)
            ->orderBy('score', 'desc')
            ->orderBy('correct', 'desc')
            ->limit(5)
            ->get()
            ->groupBy('user_id')
            ->map(function ($attempts) {
                $user = $attempts->first()->user;
                $bestScore = $attempts->max('score');
                $bestCorrect = $attempts->max('correct');
                $attemptsCount = $attempts->count();
                
                return [
                    'user' => $user,
                    'best_score' => $bestScore,
                    'best_correct' => $bestCorrect,
                    'attempts_count' => $attemptsCount
                ];
            })
            ->sortByDesc('best_score')
            ->take(5)
            ->values();
    }

    public function refreshLeaderboards()
    {
        $this->loadLeaderboards();
        session()->flash('message', 'Leaderboards refreshed successfully!');
    }

    public function render()
    {
        return view('livewire.leaderboards');
    }
}
