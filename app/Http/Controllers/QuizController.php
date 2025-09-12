<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\QuizAttempt;
use App\Models\QuizQuestion;
use App\Models\QuizChoice;
use App\Models\QuizAttemptAnswer;
use App\Services\ActivityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class QuizController extends Controller
{
    /**
     * Display a listing of available quizzes for users
     */
    public function index()
    {
        // Get active quizzes
        $activeQuizzes = Quiz::active()
            ->withCount('questions')
            ->orderBy('start_date', 'asc')
            ->get();

        // Get upcoming quizzes
        $upcomingQuizzes = Quiz::upcoming()
            ->withCount('questions')
            ->orderBy('start_date', 'asc')
            ->get();

        // Get user's quiz attempts
        $userAttempts = QuizAttempt::where('user_id', Auth::id())
            ->with('quiz')
            ->latest()
            ->get();

        // Overall leaderboard (all time)
        $topPlayers = QuizAttempt::select('user_id')
            ->selectRaw('SUM(score) as best_score')
            ->with('user')
            ->whereNotNull('quiz_id')
            ->groupBy('user_id')
            ->orderByDesc('best_score')
            ->limit(10)
            ->get();

        return view('Auth.Users.view.quiz', compact(
            'activeQuizzes', 
            'upcomingQuizzes', 
            'userAttempts', 
            'topPlayers'
        ));
    }

    /**
     * Show a specific quiz for users
     */
    public function show(Quiz $quiz)
    {
        // Check if quiz is active
        if (!$quiz->isActive()) {
            return redirect()->route('quiz')->with('error', 'This quiz is not currently active.');
        }

        // Get questions with choices
        $questions = $quiz->questions()->with('choices')->get();
        
        if ($questions->isEmpty()) {
            return redirect()->route('quiz')->with('error', 'This quiz has no questions yet.');
        }

        return view('Auth.Users.view.quiz-take', compact('quiz', 'questions'));
    }

    /**
     * Submit quiz answers
     */
    public function submit(Request $request, Quiz $quiz)
    {
        // Check if quiz is active
        if (!$quiz->isActive()) {
            return redirect()->route('quiz')->with('error', 'This quiz is no longer active.');
        }

        // Check if user already attempted this quiz
        $existingAttempt = QuizAttempt::where('user_id', Auth::id())
            ->where('quiz_id', $quiz->id)
            ->first();

        if ($existingAttempt) {
            return redirect()->route('quiz')->with('error', 'You have already taken this quiz.');
        }

        $validated = $request->validate([
            'answers' => 'required|array',
            'answers.*' => 'required|string|in:A,B,C,D',
        ]);

        // Get questions with correct answers
        $questions = $quiz->questions()->with('choices')->get();
        
        $score = 0;
        $correct = 0;
        $totalQuestions = $questions->count();

        // Create quiz attempt
        $attempt = QuizAttempt::create([
            'user_id' => Auth::id(),
            'quiz_id' => $quiz->id,
            'score' => 0,
            'correct' => 0,
            'set' => '1', // Default set for compatibility
        ]);

        // Process answers
        foreach ($questions as $question) {
            $userAnswer = $validated['answers'][$question->id] ?? null;
            
            // Create attempt answer record
            QuizAttemptAnswer::create([
                'attempt_id' => $attempt->id,
                'question_id' => $question->id,
                'answer' => $userAnswer,
            ]);

            // Check if answer is correct
            if ($userAnswer === $question->answer) {
                $correct++;
                $score++;
            }
        }

        // Update attempt with final score
        $attempt->update([
            'score' => $score,
            'correct' => $correct,
        ]);

        // Log activity
        ActivityService::logQuizTaken(
            Auth::id(),
            $score,
            $correct,
            $quiz->quiz_title
        );

        return redirect()->route('quiz.result', $attempt)
            ->with('success', 'Quiz submitted successfully!');
    }

    /**
     * Show quiz result
     */
    public function result(QuizAttempt $attempt)
    {
        // Ensure the attempt belongs to the current user
        if ($attempt->user_id !== Auth::id()) {
            abort(403);
        }

        $attempt->load(['quiz', 'answers.question.choices']);
        
        return view('Auth.Users.view.quiz-result', compact('attempt'));
    }

    /**
     * Show quiz history for user
     */
    public function history()
    {
        $attempts = QuizAttempt::where('user_id', Auth::id())
            ->with('quiz')
            ->latest()
            ->paginate(10);

        return view('Auth.Users.view.quiz-history', compact('attempts'));
    }
}
