<?php

namespace App\Http\Controllers;

use App\Models\Feedbacks;
use App\Models\news_article;
use App\Models\QuizAttempt;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserIndexController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        $topPlayers = QuizAttempt::select('user_id')
            ->selectRaw('SUM(score) as best_score')
            ->with('user') // Assuming relationship to User model
            ->groupBy('user_id')
            ->orderByDesc('best_score')
            ->get();

        $quizCount = $user->quizAttempts()->sum('score');
        $journalCount = $user
        ->journals()
        ->count();
        $articles = news_article::where('status', 'Published')
        ->latest()
        ->get();
        return view('Auth.Users.view.index', compact('articles','journalCount','topPlayers'
        ,'quizCount'
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

        // Attach email from authenticated user
        $validated['email'] = auth()->user()->email;

        Feedbacks::create($validated);

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
