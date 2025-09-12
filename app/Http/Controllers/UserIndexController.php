<?php

namespace App\Http\Controllers;

use App\Models\Feedbacks;
use App\Models\news_article;
use App\Models\QuizAttempt;
use App\Models\User;
use App\Services\ActivityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class UserIndexController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        // Use a Carbon date for queries and a formatted string for display
        $todayDate = Carbon::today();
        $today = Carbon::now()->format('F d, Y');

        // Overall leaderboard (all time)
        $topPlayers = QuizAttempt::select('user_id')
            ->selectRaw('SUM(score) as best_score')
            ->with('user')
            ->whereNotNull('set')
            ->whereIn('set', ['1', '2', '3'])
            ->groupBy('user_id')
            ->orderByDesc('best_score')
            ->limit(3)
            ->get();

        // Daily leaderboard for today
        $dailyTopPlayers = QuizAttempt::select('user_id', 'score', 'correct', 'set')
            ->with('user:id,firstname,lastname,profileimage')
            ->whereNotNull('set')
            ->whereIn('set', ['1', '2', '3'])
            ->whereDate('created_at', $todayDate)
            ->orderBy('score', 'desc')
            ->orderBy('correct', 'desc')
            ->limit(10)
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
            ->take(3)
            ->values();

        // Daily stats for the current user
        $userDailyStats = [
            'today_score' => $user->quizAttempts()
                ->whereNotNull('set')
                ->whereIn('set', ['1', '2', '3'])
                ->whereDate('created_at', $todayDate)
                ->max('score') ?? 0,
            'today_attempts' => $user->quizAttempts()
                ->whereNotNull('set')
                ->whereIn('set', ['1', '2', '3'])
                ->whereDate('created_at', $todayDate)
                ->count(),
            'today_correct' => $user->quizAttempts()
                ->whereNotNull('set')
                ->whereIn('set', ['1', '2', '3'])
                ->whereDate('created_at', $todayDate)
                ->max('correct') ?? 0,
        ];

        $quizCount = $user->quizAttempts()->sum('score');
        $journalCount = $user->journals()->count();
        $articles = news_article::where('status', 'Published')->latest()->get();
        
        return view('Auth.Users.view.index', compact(
            'articles',
            'journalCount',
            'topPlayers',
            'quizCount',
            'dailyTopPlayers',
            'userDailyStats',
            'today'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    $validated = $request->validate([
        'rating' => 'required|integer|min:1|max:5',
        'message' => 'nullable|string|max:1000',
    ]);

    $validated['email'] = auth()->user()->email;

    Feedbacks::create($validated);

    // Log feedback activity
    ActivityService::logFeedbackSent(
        auth()->id(),
        $validated['rating'],
        $validated['email']
    );

    return redirect()->back()->with('success', 'Thank you for your feedback!');
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
