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
            // Overall leaderboard (current active quiz only) - exclude null sets (mini games)
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
        // Get the current active quiz
        $activeQuiz = \App\Models\Quiz::where('status', 'active')
            ->where('start_date', '<=', Carbon::now())
            ->where('end_date', '>=', Carbon::now())
            ->first();

        if (!$activeQuiz) {
            // If no active quiz, return empty collection
            return collect();
        }

        // Get overall leaderboard for the current active quiz only
        return QuizAttempt::select('user_id', 'score', 'correct', 'set')
            ->with('user:id,firstname,lastname,profileimage')
            ->where('quiz_id', $activeQuiz->id)
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
