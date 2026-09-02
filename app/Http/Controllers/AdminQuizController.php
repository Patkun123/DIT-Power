<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\QuizSet;
use App\Models\QuizQuestion;
use App\Models\QuizChoice;
use App\Services\ActivityService;
use App\Services\QuizNotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AdminQuizController extends Controller
{
    protected $quizNotificationService;

    public function __construct(QuizNotificationService $quizNotificationService)
    {
        $this->quizNotificationService = $quizNotificationService;
    }

    /**
     * Display a listing of quizzes
     */
    public function index()
    {
        $quizzes = Quiz::withCount('questions')
            ->orderBy('start_date', 'desc')
            ->get();

        return view('auth.admin.view.managequiz', compact('quizzes'));
    }

    /**
     * Show the form for creating a new quiz
     */
    public function create()
    {
        return view('auth.admin.view.quiz-create');
    }

    /**
     * Store a newly created quiz
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'quiz_title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date|after:now',
            'end_date' => 'required|date|after:start_date',
        ]);

        // Set default status based on start date
        $now = \Carbon\Carbon::now('Asia/Manila');
        // Convert the input dates to UTC for storage
        $validated['start_date'] = \Carbon\Carbon::parse($validated['start_date']);
        $validated['end_date'] = \Carbon\Carbon::parse($validated['end_date']);
        $validated['status'] = $validated['start_date'] <= $now->utc() ? 'active' : 'scheduled';

        $quiz = Quiz::create($validated);

        // Log activity
        ActivityService::logQuizCreated(
            Auth::id(),
            $quiz->quiz_title
        );

        // Send notification for new quiz
        $this->quizNotificationService->notifyNewQuizCreated($quiz);

        return redirect()->route('managequiz')
            ->with('success', 'Quiz created successfully!');
    }

    /**
     * Display the specified quiz
     */
    public function show(Quiz $quiz)
    {
        $quiz->load(['questions.choices']);

        return view('auth.admin.view.quiz-show', compact('quiz'));
    }

    /**
     * Show the form for editing the specified quiz
     */
    public function edit(Quiz $quiz)
    {
        return view('auth.admin.view.quiz-edit', compact('quiz'));
    }

    /**
     * Update the specified quiz
     */
    public function update(Request $request, Quiz $quiz)
    {
        $validated = $request->validate([
            'quiz_title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        // Convert the input dates to UTC for storage
        $validated['start_date'] = \Carbon\Carbon::parse($validated['start_date']);
        $validated['end_date'] = \Carbon\Carbon::parse($validated['end_date']);

        $quiz->update($validated);

        // Log activity
        ActivityService::logQuizUpdated(
            Auth::id(),
            $quiz->quiz_title
        );

        return redirect()->route('managequiz')
            ->with('success', 'Quiz updated successfully!');
    }

    /**
     * Remove the specified quiz
     */
    public function destroy(Quiz $quiz)
    {
        $quizTitle = $quiz->quiz_title;
        $quiz->delete();

        // Log activity
        ActivityService::logQuizDeleted(
            Auth::id(),
            $quizTitle
        );

        return redirect()->route('managequiz')
            ->with('success', 'Quiz deleted successfully!');
    }

    /**
     * Show questions for a specific quiz
     */
    public function questions(Quiz $quiz)
    {
        $questions = $quiz->questions()->with('choices')->get();

        return view('auth.admin.view.quiz-questions', compact('quiz', 'questions'));
    }

    /**
     * Show the form for creating a new question for a quiz
     */
    public function createQuestion(Quiz $quiz)
    {
        return view('auth.admin.view.question-create', compact('quiz'));
    }

    /**
     * Store a newly created question
     */
    public function storeQuestion(Request $request, Quiz $quiz)
    {
        $validated = $request->validate([
            'content' => 'required|string',
            'answer' => 'required|string|in:A,B,C,D',
            'set' => 'nullable|string',
            'choices' => 'required|array|min:4|max:4',
            'choices.A' => 'required|string',
            'choices.B' => 'required|string',
            'choices.C' => 'required|string',
            'choices.D' => 'required|string',
        ]);

        // Create the question
        $question = QuizQuestion::create([
            'quiz_id' => $quiz->id,
            'content' => $validated['content'],
            'answer' => $validated['answer'],
            'set' => $validated['set'] ?? '1',
        ]);

        // Create the choices
        foreach ($validated['choices'] as $letter => $content) {
            QuizChoice::create([
                'question_id' => $question->id,
                'letter' => $letter,
                'content' => $content,
            ]);
        }

        // Log activity
        ActivityService::logQuestionCreated(
            Auth::id(),
            $question->content,
            $quiz->quiz_title
        );

        return redirect()->route('admin.quizzes.questions', $quiz)
            ->with('success', 'Question added successfully!');
    }

    /**
     * Show the form for editing a question
     */
    public function editQuestion(Quiz $quiz, QuizQuestion $question)
    {
        $question->load('choices');

        return view('auth.admin.view.question-edit', compact('quiz', 'question'));
    }

    /**
     * Update the specified question
     */
    public function updateQuestion(Request $request, Quiz $quiz, QuizQuestion $question)
    {
        $validated = $request->validate([
            'content' => 'required|string',
            'answer' => 'required|string|in:A,B,C,D',
            'set' => 'nullable|string',
            'choices' => 'required|array|min:4|max:4',
            'choices.A' => 'required|string',
            'choices.B' => 'required|string',
            'choices.C' => 'required|string',
            'choices.D' => 'required|string',
        ]);

        // Update the question
        $question->update([
            'content' => $validated['content'],
            'answer' => $validated['answer'],
            'set' => $validated['set'] ?? '1',
        ]);

        // Update the choices
        foreach ($validated['choices'] as $letter => $content) {
            QuizChoice::updateOrCreate(
                ['question_id' => $question->id, 'letter' => $letter],
                ['content' => $content]
            );
        }

        // Log activity
        ActivityService::logQuestionUpdated(
            Auth::id(),
            $question->content,
            $quiz->quiz_title
        );

        return redirect()->route('admin.quizzes.questions', $quiz)
            ->with('success', 'Question updated successfully!');
    }

    /**
     * Remove the specified question
     */
    public function destroyQuestion(Quiz $quiz, QuizQuestion $question)
    {
        $questionContent = $question->content;
        $question->delete();

        // Log activity
        ActivityService::logQuestionDeleted(
            Auth::id(),
            $questionContent,
            $quiz->quiz_title
        );

        return redirect()->route('admin.quizzes.questions', $quiz)
            ->with('success', 'Question deleted successfully!');
    }

    /**
     * Get quiz statistics
     */
    public function statistics(Quiz $quiz, Request $request)
    {
        $stats = [
            'total_attempts' => $quiz->attempts()->count(),
            'unique_users' => $quiz->attempts()->distinct('user_id')->count(),
            'average_score' => $quiz->attempts()->avg('score') ?? 0,
            'total_questions' => $quiz->questions()->count(),
        ];

        $sortBy = $request->get('sort', 'latest');

        $recentAttemptsQuery = $quiz->attempts()->with('user');

        switch ($sortBy) {
            case 'highest':
                $recentAttempts = $recentAttemptsQuery
                    ->orderBy('score', 'desc')
                    ->orderBy('created_at', 'desc')
                    ->limit(10)
                    ->get();
                break;
            case 'overall_highest':
                // Get the best attempt per user for this quiz, sorted by best score
                $bestAttemptsPerUser = $quiz->attempts()
                    ->selectRaw('user_id, MAX(score) as best_score')
                    ->groupBy('user_id')
                    ->orderBy('best_score', 'desc')
                    ->limit(10)
                    ->get();

                // Get the actual attempt records for these users with their best scores
                $userIds = $bestAttemptsPerUser->pluck('user_id');
                $bestScores = $bestAttemptsPerUser->pluck('best_score', 'user_id');

                $recentAttempts = $quiz->attempts()
                    ->with('user')
                    ->whereIn('user_id', $userIds)
                    ->get()
                    ->groupBy('user_id')
                    ->map(function ($attempts) use ($bestScores) {
                        // Get the attempt with the best score for this user
                        $bestScore = $bestScores[$attempts->first()->user_id];
                        return $attempts->where('score', $bestScore)->sortByDesc('created_at')->first();
                    })
                    ->sortByDesc(function ($attempt) use ($bestScores) {
                        return $bestScores[$attempt->user_id];
                    })
                    ->take(10)
                    ->values();
                break;
            case 'latest':
            default:
                $recentAttempts = $recentAttemptsQuery
                    ->latest()
                    ->limit(10)
                    ->get();
                break;
        }

        return view('auth.admin.view.quiz-statistics', compact('quiz', 'stats', 'recentAttempts', 'sortBy'));
    }

    /**
     * Show quiz sets management
     */
    public function sets(Quiz $quiz)
    {
        $sets = $quiz->sets()->orderBy('set_number')->get();
        return view('auth.admin.view.quiz-sets', compact('quiz', 'sets'));
    }

    /**
     * Show form to create a new quiz set
     */
    public function createSet(Quiz $quiz)
    {
        return view('auth.admin.view.quiz-set-create', compact('quiz'));
    }

    /**
     * Store a new quiz set
     */
    public function storeSet(Request $request, Quiz $quiz)
    {
        $validated = $request->validate([
            'set_name' => 'required|string|max:255',
            'set_number' => 'required|integer|min:1',
            'start_time' => 'required|date|after:now',
            'end_time' => 'required|date|after:start_time',
            'description' => 'nullable|string',
        ]);

        // Store times as entered (no timezone conversion)
        $validated['start_time'] = Carbon::parse($validated['start_time']);
        $validated['end_time'] = Carbon::parse($validated['end_time']);
        $validated['quiz_id'] = $quiz->id;

        // Set default status
        $now = Carbon::now();
        $validated['status'] = $validated['start_time'] <= $now ? 'active' : 'scheduled';

        $set = QuizSet::create($validated);

        // Log activity
        ActivityService::logQuizSetCreated(
            Auth::id(),
            $set->set_name,
            $quiz->quiz_title
        );

        return redirect()->route('admin.quizzes.sets', $quiz)
            ->with('success', 'Quiz set created successfully!');
    }

    /**
     * Show form to edit a quiz set
     */
    public function editSet(Quiz $quiz, QuizSet $set)
    {
        return view('auth.admin.view.quiz-set-edit', compact('quiz', 'set'));
    }

    /**
     * Update a quiz set
     */
    public function updateSet(Request $request, Quiz $quiz, QuizSet $set)
    {
        $validated = $request->validate([
            'set_name' => 'required|string|max:255',
            'set_number' => 'required|integer|min:1',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'description' => 'nullable|string',
        ]);

        // Store times as entered (no timezone conversion)
        $validated['start_time'] = Carbon::parse($validated['start_time']);
        $validated['end_time'] = Carbon::parse($validated['end_time']);

        // Recompute status based on current time and provided window
        $now = Carbon::now();
        if ($validated['end_time']->lt($now)) {
            $validated['status'] = 'ended';
        } elseif ($validated['start_time']->lte($now) && $validated['end_time']->gte($now)) {
            $validated['status'] = 'active';
        } else {
            $validated['status'] = 'scheduled';
        }

        $set->update($validated);

        // Log activity
        ActivityService::logQuizSetUpdated(
            Auth::id(),
            $set->set_name,
            $quiz->quiz_title
        );

        return redirect()->route('admin.quizzes.sets', $quiz)
            ->with('success', 'Quiz set updated successfully!');
    }

    /**
     * Delete a quiz set
     */
    public function destroySet(Quiz $quiz, QuizSet $set)
    {
        $setName = $set->set_name;
        $set->delete();

        // Log activity
        ActivityService::logQuizSetDeleted(
            Auth::id(),
            $setName,
            $quiz->quiz_title
        );

        return redirect()->route('admin.quizzes.sets', $quiz)
            ->with('success', 'Quiz set deleted successfully!');
    }
}
