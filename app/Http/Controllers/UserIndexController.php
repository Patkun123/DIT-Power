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

        // Overall leaderboard (all time) - Top 3 for podium display
        $topPlayers = QuizAttempt::select('user_id')
            ->selectRaw('SUM(score) as best_score')
            ->with('user')
            ->whereNotNull('set')
            ->whereIn('set', ['1', '2', '3'])
            ->groupBy('user_id')
            ->orderByDesc('best_score')
            ->limit(3)
            ->get();

        // Overall leaderboard (all time) - Extended for daily report section
        $overallTopPlayers = QuizAttempt::select('user_id')
            ->selectRaw('SUM(score) as total_score')
            ->selectRaw('SUM(correct) as total_correct')
            ->selectRaw('COUNT(*) as attempts_count')
            ->with('user:id,firstname,lastname,profileimage')
            ->whereNotNull('set')
            ->whereIn('set', ['1', '2', '3'])
            ->groupBy('user_id')
            ->orderByDesc('total_score')
            ->orderByDesc('total_correct')
            ->limit(10)
            ->get()
            ->map(function ($entry) {
                return [
                    'user' => $entry->user,
                    'best_score' => $entry->total_score,
                    'best_correct' => $entry->total_correct,
                    'attempts_count' => $entry->attempts_count,
                ];
            })
            ->take(5)
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
        $articles = news_article::where('status', 'published')->latest()->get();

        return view('auth.users.view.index', compact(
            'articles',
            'journalCount',
            'topPlayers',
            'quizCount',
            'overallTopPlayers',
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
