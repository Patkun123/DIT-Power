<?php

use function Livewire\Volt\{state};
use App\Models\Quiz;
use App\Models\QuizQuestion;
use Carbon\Carbon;
use App\Models\QuizSet;

// Get available quizzes
$activeQuizzes = Quiz::active()->withCount('questions')->get();
$upcomingQuizzes = Quiz::upcoming()->withCount('questions')->get();
$userAttempts = auth()->user()->quizAttempts()->with('quiz')->latest()->get();
$latestAttempt = auth()->user()->quizAttempts()->with('quiz')->latest()->first();

// Get available quiz sets
$activeSet = QuizSet::active()->first(); // one active set
$latestAttemptForSet = $activeSet
    ? auth()->user()->quizAttempts()
        ->where('set', $activeSet->set_number)
        ->with('quiz')
        ->latest()
        ->first()
    : null;
$upcomingSet = QuizSet::upcoming()->first();

// Check if user has any available quizzes to take
$availableQuiz = null;
$nextQuiz = null;
$errorMessage = null;
$takenAttemptForActiveSet = null;

if ($activeQuizzes->isNotEmpty()) {
    // Consider attempts only for the current active set so the same quiz can be taken again in a new set
    $takenQuizIds = $activeSet
        ? $userAttempts->where('set', $activeSet->set_number)->pluck('quiz_id')->toArray()
        : $userAttempts->pluck('quiz_id')->toArray();
    $availableQuiz = $activeQuizzes->whereNotIn('id', $takenQuizIds)->first();

    // Slot Check: if no active set
    if (!$activeSet) {
        $errorMessage = "No active quiz slot available right now. Please wait for the next schedule.";
        $availableQuiz = null;
    }
    // If user already took all quizzes in this set
    elseif (!$availableQuiz) {
        $errorMessage = "You have already taken all quizzes in the current slot (Set {$activeSet->set_number}).";
    }
    // If there is an available quiz but the user already took THIS quiz in the current set (edge case when data reloads)
    elseif ($availableQuiz && $activeSet) {
        $takenAttemptForActiveSet = $userAttempts
            ->where('quiz_id', $availableQuiz->id)
            ->firstWhere('set', $activeSet->set_number);

        if ($takenAttemptForActiveSet) {
            $errorMessage = "You already took this quiz in the current slot (Set {$activeSet->set_number}).";
            $availableQuiz = null;
        }
    }
} else {
    if ($upcomingQuizzes->isNotEmpty()) {
        $nextQuiz = $upcomingQuizzes->first();
        $errorMessage = "No quizzes are currently available. Next quiz: " .
            $nextQuiz->quiz_title . " starting on " .
            $nextQuiz->start_date->setTimezone('Asia/Manila')->format('M d, Y H:i') .
            " (Philippines time)";
    } else {
        $errorMessage = "No quizzes are currently available or scheduled.";
    }
}


state([
    'activeQuizzes' => $activeQuizzes,
    'upcomingQuizzes' => $upcomingQuizzes,
    'availableQuiz' => $availableQuiz,
    'nextQuiz' => $nextQuiz,
    'errorMessage' => $errorMessage,
    'currentSet' => optional($activeSet)->set_number,
    'takenAttemptScore' => optional($takenAttemptForActiveSet)->score,
    'questions' => collect(),
    'answers' => [],
    'phase' => 'start',
    'index' => 0,
    'attempt' => null,
    'time' => 0,
    'bestScore' => optional(
        auth()->user()->quizAttempts()
            ->orderBy('score', 'desc')
            ->first()
    )->score ?? 0,
    'latestAttemptScore' => optional($latestAttempt)->score,
    'latestAttemptQuizTitle' => optional(optional($latestAttempt)->quiz)->quiz_title,
    'latestAttemptScoreSet' => optional($latestAttemptForSet)->score,
    'latestAttemptQuizTitleSet' => optional(optional($latestAttemptForSet)->quiz)->quiz_title,
    'isSubmitted' => false
]);

$saveAnswers = function () {
    if ($this->isSubmitted) {
        return; // Prevent multiple submissions
    }
    $this->isSubmitted = true;

    $attempt = auth()->user()->quizAttempts()->create([
        'quiz_id' => $this->availableQuiz->id,
        // Save the real active set number if present, fallback to 1 for compatibility
        'set' => $this->currentSet ?? 1
    ]);
    $totalScore = 0;
    $correctCount = 0;
    $timeTaken = 0;

    foreach ($this->questions as $key => $question) {
        $isCorrect = $question->correctAnswer()->id === ($this->answers[$key]['id'] ?? null);
        $score = 0;
        if (!is_null($this->answers[$key])) {
            if ($isCorrect) {
                $score = 10 + (($this->answers[$key]['remaining'] >= 5) ? 2 : 0);
            }
        }

        $timeTaken += !is_null($this->answers[$key])
            ? 20 - $this->answers[$key]['remaining']
            : 20;

        $attempt->answers()->create([
            'question_id' => $question->id,
            'choice_id' => $this->answers[$key]['id'] ?? null,
            'score' => $score,
            'correct' => $isCorrect,
        ]);

        $totalScore += $score;
        if ($isCorrect) {
            $correctCount++;
        }
    }

    $this->time = $timeTaken;

    $attempt->update([
        'score' => $totalScore,
        'correct' => $correctCount,
    ]);

    // Log quiz activity
    \App\Services\ActivityService::logQuizTaken(
        auth()->id(),
        $totalScore,
        $correctCount,
        $this->availableQuiz->quiz_title
    );

    if ($totalScore > $this->bestScore) {
        $this->bestScore = $totalScore;
    }

    $this->attempt = $attempt;
    $this->phase = 'result';
};
$startQuiz = function () {
    if (!$this->availableQuiz) {
        session()->flash('error', $this->errorMessage);
        return;
    }

    // Load questions for this quiz filtered by current set
    $this->questions = $this->availableQuiz->questions()
        ->where('set', $this->currentSet ?? 1) // Filter by current set
        ->with('choices')
        ->inRandomOrder()
        ->take(15)
        ->get();

    if ($this->questions->isEmpty()) {
        session()->flash('error', 'No questions available for this quiz in the current set.');
        return;
    }

    $this->phase = 'quiz';
};





$skipQuestion = function () {
    if ($this->index >= count($this->questions) - 1) {
        $this->phase = 'result';
        return;
    }

    $this->answers[$this->index] = null;
    $this->index++;
};

$selectAnswer = function (int $id, string $letter, int $seconds) {
    // Stop if already answered
    if (isset($this->answers[$this->index])) {
        return;
    }

    $this->answers[$this->index] = [
        'id' => $id,
        'letter' => $letter,
        'remaining' => $seconds
    ];

    if ($this->index >= count($this->questions) - 1) {
        $this->saveAnswers();
        return;
    }

    $this->index++;
};




?>

<div class="flex justify-center items-center h-[calc(100vh-5rem)] shadow shadow-gray-950 bg-gray-100 dark:bg-gray-900">
    {{-- Start Quiz State --}}
    @if ($phase === 'start')
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow p-8 max-w-md w-full text-center">
            @if (session('error'))
                <div class="bg-red-100 text-red-700 p-2 rounded mb-3">
                    {{ session('error') }}
                </div>
            @endif

            @if ($availableQuiz)
            <!-- Icon -->
            <div class="flex justify-center mb-4">
                <div class="bg-primary-100 p-3 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6 text-primary-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2l4-4m5 2a9 9 0 11-18 0a9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>

            <!-- Title -->
                <h2 class="text-xl font-bold text-gray-800 dark:text-white">{{ $availableQuiz->quiz_title }}</h2>
                @if($availableQuiz->description)
                    <p class="text-gray-500 dark:text-gray-400 mt-1">{{ $availableQuiz->description }}</p>
                @endif

                <!-- Quiz Info -->
                <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4 mt-4">
                    <div class="text-sm text-blue-800 dark:text-blue-200">
                        <div class="flex justify-between items-center mb-2">
                            <span class="font-medium">Available Until:</span>
                            <span>{{ $availableQuiz->end_date->setTimezone('Asia/Manila')->format('M d, Y H:i') }} (Philippines time)</span>
                        </div>
                        <div class="flex justify-between items-center mt-1">
                            <span class="font-medium">Questions:</span>
                            <span>{{ \App\Models\QuizQuestion::where('quiz_id', $availableQuiz->id)->where('set', $currentSet ?? 1)->count() }}</span>
                        </div>
                    </div>
                </div>

            <!-- Info boxes -->
            <div class="grid grid-cols-3 gap-3 mt-6">
                <!-- Time -->
                <div class="bg-white dark:bg-gray-700 shadow rounded-lg p-3 flex flex-col items-center">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6 text-primary-500 mb-1" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0a9 9 0 0118 0z" />
                    </svg>
                    <p class="text-gray-800 dark:text-white text-sm font-semibold">20s</p>
                    <span class="text-gray-500 dark:text-gray-400 text-xs">per question</span>
                </div>

                <!-- Questions -->
                <div class="bg-white dark:bg-gray-700 shadow rounded-lg p-3 flex flex-col items-center">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6 text-primary-500 mb-1" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                    </svg>
                        <p class="text-gray-800 dark:text-white text-sm font-semibold">{{ min($availableQuiz->questions_count, 15) }}</p>
                    <span class="text-gray-500 dark:text-gray-400 text-xs">questions</span>
                </div>

                <!-- Points -->
                <div class="bg-white dark:bg-gray-700 shadow rounded-lg p-3 flex flex-col items-center">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6 text-primary-500 mb-1" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.98a1 1 0 00.95.69h4.184c.969 0 1.371 1.24.588 1.81l-3.39 2.462a1 1 0 00-.364 1.118l1.287 3.98c.3.921-.755 1.688-1.538 1.118l-3.39-2.462a1 1 0 00-1.175 0l-3.39 2.462c-.783.57-1.838-.197-1.538-1.118l1.287-3.98a1 1 0 00-.364-1.118L2.02 9.407c-.783-.57-.38-1.81.588-1.81h4.184a1 1 0 00.95-.69l1.286-3.98z" />
                    </svg>
                    <p class="text-gray-800 dark:text-white text-sm font-semibold">10</p>
                    <span class="text-gray-500 dark:text-gray-400 text-xs">points per Correct</span>
                </div>
            </div>

            <!-- Button -->
            <button
                wire:click='startQuiz'
                    class="mt-6 w-full bg-primary-500 hover:bg-primary-600 text-white font-medium py-3 rounded-full"
            >
                    Start Quiz
            </button>
            @else
                <!-- No Quiz Available State -->
                <div class="flex justify-center mb-4">
                    <div class="bg-yellow-100 p-3 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-6 w-6 text-yellow-500" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0a9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>

                <!-- Title / Message -->
                <h2 class="text-xl font-bold text-gray-800 dark:text-white">No Quiz Available</h2>
                @if($latestAttemptScoreSet)
                    <p class="text-gray-500 dark:text-gray-400 mt-1">
                        Your last score for Set {{ $currentSet ?? '-' }}:
                        <span class="font-semibold text-gray-800 dark:text-white">{{ $latestAttemptScoreSet }}</span>
                        @if($latestAttemptQuizTitleSet)
                            on "{{ $latestAttemptQuizTitleSet }}"
                        @endif
                    </p>
                @elseif($latestAttemptScore)
                    <p class="text-gray-500 dark:text-gray-400 mt-1">
                        Your last score: <span class="font-semibold text-gray-800 dark:text-white">{{ $latestAttemptScore }}</span>
                        @if($latestAttemptQuizTitle)
                            on "{{ $latestAttemptQuizTitle }}"
                        @endif
                    </p>
                @else
                    <p class="text-gray-500 dark:text-gray-400 mt-1">{{ $errorMessage }}</p>
                @endif

                @if($nextQuiz)
                    <!-- Next Quiz Info -->
                    <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg p-4 mt-4">
                        <div class="text-sm text-yellow-800 dark:text-yellow-200">
                            <div class="font-medium mb-2">Next Quiz:</div>
                            <div class="flex justify-between items-center mb-1">
                                <span>Title:</span>
                                <span>{{ $nextQuiz->quiz_title }}</span>
                            </div>
                            <div class="flex justify-between items-center mb-1">
                                <span>Starts:</span>
                                <span>{{ $nextQuiz->start_date->setTimezone('Asia/Manila')->format('M d, Y H:i') }} (Philippines time)</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span>Questions:</span>
                                <span>{{ $nextQuiz->questions_count }}</span>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Button -->
                <a href="{{ route('index') }}"
                    class="mt-6 w-full bg-gray-500 hover:bg-gray-600 text-white font-medium py-3 rounded-full inline-block text-center">
                    Back to Home
                </a>
            @endif
        </div>
    @elseif ($phase === 'quiz')
        <div x-data="{
            seconds: 20,
            selected: null,
            isCorrect: false,
            selectAnswer(id, letter) {
                $wire.selectAnswer(id, letter, this.seconds);
                this.seconds = 20;
            }
        }"
        x-init="$nextTick(() => {
            setInterval(() => {
                if (seconds <= 0) {
                    $wire.skipQuestion();
                    seconds = 20;
                } else {
                    seconds--;
                }
            }, 1000)
        })"
        class="select-none bg-white dark:bg-gray-800 rounded-2xl shadow p-8 max-w-4xl w-full text-center">

            <!-- Timer -->
            <div class="flex justify-end mb-4">
                <div class="bg-primary-100 h-14 w-14 flex flex-col justify-center rounded-full">
                    <div x-text="seconds" class="text-primary-500 font-bold text-2xl"></div>
                </div>
            </div>

            @foreach ($questions as $question)
                @if($loop->index == $this->index)
                    <div
                        x-data="{
                            selected: null,
                            selectChoice(choiceId) {
                                if (this.selected) return; // prevent multiple clicks
                                this.selected = choiceId;

                                let correctId = {{ $question->correctAnswer()->id }};
                                $wire.selectAnswer(choiceId, '', seconds);

                                // auto move after 1s
                                setTimeout(() => { seconds = 20; }, 1000);
                            }
                        }"
                        class="space-y-8"
                    >
                        <!-- Question -->
                        <h2 class="text-2xl font-bold text-gray-800 dark:text-white text-center leading-relaxed">
                            {{ $question->content }}
                        </h2>

                        <!-- Choices -->
                        <div class="grid grid-cols-2 gap-4">
                            @foreach($question->choices()->inRandomOrder()->get() as $choice)
                                <button
                                    x-on:click="selectChoice({{ $choice->id }})"
                                    :class="{
                                        'bg-primary-500 text-white border-primary-600': selected === {{ $choice->id }} && {{ $choice->id }} === {{ $question->correctAnswer()->id }},
                                        'bg-red-500 text-white border-red-600': selected === {{ $choice->id }} && {{ $choice->id }} !== {{ $question->correctAnswer()->id }},
                                        'bg-white dark:bg-gray-700 hover:border-primary-500': selected !== {{ $choice->id }},
                                    }"
                                    class="w-full shadow rounded-xl p-4 border-2 transition font-semibold text-lg cursor-pointer text-gray-800 dark:text-white"
                                >
                                    {{ $choice->content }}
                                </button>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach
            <!-- Button -->
            {{-- <button class="mt-6 w-full bg-primary-500 hover:bg-primary-600 text-white font-medium py-3 rounded-full">
                Next
            </button> --}}
        </div>
        {{-- RESULT PHASE --}}
        @elseif($phase === 'result')
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow p-8 max-w-md w-full text-center">

                <!-- Icon -->
                <div class="flex justify-center mb-4">
                    <div class="bg-primary-100 h-32 w-32 flex flex-col justify-center rounded-full">
                        <div class="text-primary-700 font-black text-3xl">{{ $attempt->score }}</div>
                    </div>
                </div>

                <!-- Title -->
                <h2 class="text-xl font-bold text-gray-800 dark:text-white">Quiz Results</h2>
                <p class="text-sm text-gray-500 dark:text-gray-400">{{ $availableQuiz->quiz_title }}</p>

                <!-- Buttons -->
                <div class="flex gap-3 justify-center mt-4">
                    <a href="{{ route('index') }}"
                    class="px-4 py-2 bg-primary-300 hover:bg-primary-500 text-white rounded-full transition">
                        Home
                    </a>
                    <button wire:click="$set('phase', 'review')"
                    class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-full transition">
                        View Answers
                    </button>
                </div>

                <!-- Info boxes -->
                <div class="grid grid-cols-3 gap-3 mt-6">
                    <!-- Correct -->
                    <div class="bg-white dark:bg-gray-700 shadow rounded-lg p-3 flex flex-col items-center">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-6 w-6 text-primary-500 mb-1" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2l4-4m5 2a9 9 0 11-18 0a9 9 0 0118 0z" />
                        </svg>
                        <p class="text-gray-800 dark:text-white text-sm font-semibold">{{ $attempt->correct }}</p>
                        <span class="text-gray-500 dark:text-gray-400 text-xs">Correct</span>
                    </div>

                    <!-- Time -->
                    <div class="bg-white dark:bg-gray-700 shadow rounded-lg p-3 flex flex-col items-center">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-6 w-6 text-primary-500 mb-1" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0a9 9 0 0118 0z" />
                        </svg>
                        <p class="text-gray-800 dark:text-white text-sm font-semibold">{{ floor($this->time / 60) }}m {{ $this->time % 60 }}s</p>
                        <span class="text-gray-500 dark:text-gray-400 text-xs">time taken</span>
                    </div>

                    <!-- Best Score -->
                    <div class="bg-white dark:bg-gray-700 shadow rounded-lg p-3 flex flex-col items-center">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-6 w-6 text-primary-500 mb-1" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.98a1 1 0 00.95.69h4.184c.969 0 1.371 1.24.588 1.81l-3.39 2.462a1 1 0 00-.364 1.118l1.287 3.98c.3.921-.755 1.688-1.538 1.118l-3.39-2.462a1 1 0 00-1.175 0l-3.39 2.462c-.783.57-1.838-.197-1.538-1.118l1.287-3.98a1 1 0 00-.364-1.118L2.02 9.407c-.783-.57-.38-1.81.588-1.81h4.184a1 1 0 00.95-.69l1.286-3.98z" />
                        </svg>
                        <p class="text-gray-800 dark:text-white text-sm font-semibold">{{ $bestScore }}</p>
                        <span class="text-gray-500 dark:text-gray-400 text-xs">best score</span>
                    </div>
                </div>
            </div>

        {{-- REVIEW PHASE --}}
    @elseif($phase === 'review')
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow p-8 max-w-3xl w-full h-[80vh] flex flex-col">
            <!-- Header -->
            <h2 class="text-xl font-bold text-gray-800 dark:text-white mb-4">Answer Review</h2>

            <!-- Scrollable DATA -->
            <div class="flex-1 overflow-y-auto pr-2 space-y-6">
                @foreach($attempt->answers as $attemptAnswer)
                    @php
                        $question = $attemptAnswer->question;   // QuizQuestion
                        $userChoiceId = $attemptAnswer->choice_id;
                    @endphp

                    <div class="p-4 rounded-lg border border-gray-300 bg-gray-50 dark:bg-gray-700">

                        <!-- Question -->
                        <p class="font-semibold mb-2">{{ $loop->iteration }}. {{ $question->content }}</p>

                        <!-- Choices -->
                        <ul class="space-y-1 mb-3">
                            @foreach($question->choices as $choice)
                                <li class="@if($choice->id === $userChoiceId) text-blue-600 font-bold @endif">
                                    {{ $choice->letter }}. {{ $choice->content }}
                                </li>
                            @endforeach
                        </ul>

                        <!-- Explanation -->
                        @if(filled($question->explanation))
                            <div class="mt-2 p-3 bg-gray-100 dark:bg-gray-600 rounded-lg text-sm text-gray-700 dark:text-gray-300">
                                <span class="font-semibold">Explanation:</span> {{ $question->explanation }}
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>

            <!-- Footer -->
            <div class="pt-4 border-t mt-4 flex justify-between">
                <button wire:click="$set('phase','result')"
                    class="px-6 py-2 bg-primary-500 hover:bg-primary-600 text-white rounded-full">
                    Back to Results
                </button>

                <!-- New Button -->
                @if ($set == 3)
                    <button wire:click="$set('phase','overview')"
                        class="px-6 py-2 bg-secondary-500 hover:bg-secondary-600 text-white rounded-full">
                        View All Questions (Set 1 - Set 3)
                    </button>
                @endif

            </div>
        </div>
        @elseif($phase === 'overview')
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow p-8 max-w-5xl w-full h-[80vh] flex flex-col">
        <!-- Header -->
        <h2 class="text-xl font-bold text-gray-800 dark:text-white mb-4">
            All Questions & Answers (Set 1 - Set 3)
        </h2>

        <!-- Scrollable content -->
        <div class="flex-1 overflow-y-auto pr-2 space-y-6">
            @php
                $allQuestions = \App\Models\QuizQuestion::whereIn('set', [1, 2, 3])
                    ->with(['choices'])
                    ->orderBy('set')
                    ->get();

                // map QuizAttemptAnswer by question_id
                $userAnswers = $attempt->answers->keyBy('question_id');
            @endphp

            @foreach($allQuestions as $question)
                @php
                    /** @var \App\Models\QuizAttemptAnswer|null $attemptAnswer */
                    $attemptAnswer = $userAnswers[$question->id] ?? null;
                    $userChoice = $attemptAnswer?->choice; // QuizChoice model
                    $correctChoice = $question->correctAnswer();
                @endphp

                <div class="p-4 rounded-lg border border-gray-300 bg-gray-50 dark:bg-gray-700">
                    <!-- Question -->
                    <p class="font-semibold mb-2">
                        <span class="text-primary-600">[Set {{ $question->set }}]</span>
                        {{ $question->content }}
                    </p>

                    <!-- Choices -->
                    <ul class="space-y-1 mb-3">
                        @foreach($question->choices as $choice)
                            <li
                                class="
                                    @if($choice->id === $correctChoice->id) text-primary-600 font-bold @endif
                                    @if($userChoice && $choice->id === $userChoice->id && $userChoice->id !== $correctChoice->id) text-red-600 font-semibold @endif
                                "
                            >
                                {{ $choice->letter }}. {{ $choice->content }}

                                {{-- Markers --}}
                                @if($choice->id === $correctChoice->id)
                                    <span class="ml-2 text-xs bg-primary-100 text-primary-600 px-2 py-0.5 rounded">Correct</span>
                                @endif
                                @if($userChoice && $choice->id === $userChoice->id && $userChoice->id !== $correctChoice->id)
                                    <span class="ml-2 text-xs bg-red-100 text-red-600 px-2 py-0.5 rounded">Your Answer</span>
                                @endif
                                @if($userChoice && $choice->id === $userChoice->id && $userChoice->id === $correctChoice->id)
                                    <span class="ml-2 text-xs bg-blue-100 text-blue-600 px-2 py-0.5 rounded">You Answered Correctly</span>
                                @endif
                            </li>
                        @endforeach
                    </ul>

                    <!-- If user skipped -->
                    @if(!$userChoice)
                        <p class="text-sm text-yellow-600 italic">Not Answered</p>
                    @endif

                    <!-- Explanation -->
                    @if(filled($question->explanation))
                        <div class="mt-2 p-3 bg-gray-100 dark:bg-gray-600 rounded-lg text-sm text-gray-700 dark:text-gray-300">
                            <span class="font-semibold">Explanation:</span> {{ $question->explanation }}
                        </div>
                    @endif
                </div>
            @endforeach
        </div>

        <!-- Footer -->
        <div class="pt-4 border-t mt-4 flex justify-between">
            <button wire:click="$set('phase','review')"
                class="px-6 py-2 bg-primary-500 hover:bg-primary-600 text-white rounded-full">
                Back to Review
            </button>
            <a href="{{ route('index') }}"
                class="px-6 py-2 bg-secondary-500 hover:bg-secondary-600 text-white rounded-full">
                Home
            </a>
        </div>
    </div>



        @endif


</div>
