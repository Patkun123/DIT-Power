<?php

namespace App\Livewire;

use App\Models\QuizAttempt;
use App\Models\User;
use App\Services\DailyWinnerService;
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
    
    // Previous winners data
    public $previousWinners = [];
    public $allTimeChampions = [];
    public $winnerStats = [];

    public function mount()
    {
        $this->today = Carbon::now()->format('Y-m-d');
        $this->loadLeaderboards();
        $this->loadPreviousWinners();
    }

    public function loadLeaderboards()
    {
        $this->isLoading = true;

        try {
            // Overall leaderboard (today only) - exclude null sets (mini games)
            $this->overallLeaderboard = $this->getCurrentQuizOverallLeaderboard();

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

    private function getCurrentQuizOverallLeaderboard()
    {
        // Today's overall leaderboard - aggregate all attempts from today
        return QuizAttempt::select('user_id')
            ->selectRaw('SUM(score) as total_score')
            ->selectRaw('SUM(correct) as total_correct')
            ->selectRaw('COUNT(*) as attempts_count')
            ->whereNotNull('set')
            ->whereIn('set', ['1', '2', '3'])
            ->whereDate('created_at', $this->today)
            ->groupBy('user_id')
            ->orderByDesc('total_score')
            ->orderByDesc('total_correct')
            ->limit(5)
            ->with('user:id,firstname,lastname,profileimage')
            ->get()
            ->map(function ($entry) {
                $entry->average_score = $entry->attempts_count > 0
                    ? round($entry->total_score / $entry->attempts_count, 2)
                    : 0;

                return [
                    'user' => $entry->user,
                    'total_score' => $entry->total_score,
                    'total_correct' => $entry->total_correct,
                    'attempts_count' => $entry->attempts_count,
                    'average_score' => $entry->average_score,
                ];
            });
    }

    private function getDailyLeaderboard($set)
    {
        return QuizAttempt::select('user_id', 'score', 'correct', 'set')
            ->with('user:id,firstname,lastname,profileimage')
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

    public function loadPreviousWinners()
    {
        try {
            $dailyWinnerService = app(DailyWinnerService::class);
            
            // Load recent winners (last 7 days)
            $this->previousWinners = $dailyWinnerService->getRecentWinners(7);
            
            // Load all-time champions
            $this->allTimeChampions = $dailyWinnerService->getAllTimeChampions();
            
            // Load winner statistics
            $this->winnerStats = $dailyWinnerService->getWinnerStats();
            
        } catch (\Exception $e) {
            // Handle error gracefully
            $this->previousWinners = [];
            $this->allTimeChampions = [];
            $this->winnerStats = [];
        }
    }

    public function refreshLeaderboards()
    {
        $this->loadLeaderboards();
        $this->loadPreviousWinners();
        session()->flash('message', 'Leaderboards refreshed successfully!');
    }

    public function render()
    {
        return view('livewire.leaderboards');
    }
}
