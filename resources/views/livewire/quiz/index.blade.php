<?php

use function Livewire\Volt\{state};
use App\Models\QuizQuestion;
use Carbon\Carbon;

$set = null;
$determineSet = function () {
    $now = Carbon::now('Asia/Manila');

    // Quiz time slots (matching the notification service)
    if ($now->between($now->copy()->setTime(9,30), $now->copy()->setTime(10,30))) {
        return 1; // Set 1: 9:30am–10:30am
    } elseif ($now->between($now->copy()->setTime(12,0), $now->copy()->setTime(13,0))) {
        return 2; // Set 2: 12:00pm–1:00pm
    } elseif ($now->between($now->copy()->setTime(15,0), $now->copy()->setTime(16,0))) {
        return 3; // Set 3: 3:00pm–4:00pm
    }

    return null;
};

$set = $determineSet();

state([
    'set' => $set,
    'questions' => $set
        ? QuizQuestion::where('set', $set)->with(['choices'])->inRandomOrder()->take(15)->get()
        : collect(),
    'answers' => [],
    'phase' => $set ? 'start' : 'start',
    'index' => 0,
    'attempt' => auth()->user()->quizAttempts->first(),
    'time' => 0,
    'bestScore' => optional(
        auth()->user()->quizAttempts()
            ->orderBy('score', 'desc')
            ->first()
    )->score ?? 0,
    'isSubmitted' => false
]);

$saveAnswers = function () {
    if ($this->isSubmitted) {
        return; // Prevent multiple submissions
    }
    $this->isSubmitted = true;

    $attempt = auth()->user()->quizAttempts()->create([
        'set' => $this->set
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

    if ($totalScore > $this->bestScore) {
        $this->bestScore = $totalScore;
    }

    $this->attempt = $attempt;
    $this->phase = 'result';
};
$startQuiz = function () {
    $now = Carbon::now('Asia/Manila');

    // Define quiz slots (matching notification service)
    $slots = collect([
        Carbon::today('Asia/Manila')->setTime(9, 30),  // Set 1: 9:30 AM
        Carbon::today('Asia/Manila')->setTime(12, 0),  // Set 2: 12:00 PM
        Carbon::today('Asia/Manila')->setTime(15, 0),  // Set 3: 3:00 PM
    ]);

    // Match set to time
    if ($now->between($slots[0], $slots[0]->copy()->addHour())) {
        $this->set = 1;
    } elseif ($now->between($slots[1], $slots[1]->copy()->addHour())) {
        $this->set = 2;
    } elseif ($now->between($slots[2], $slots[2]->copy()->addHour())) {
        $this->set = 3;
    } else {
        session()->flash('error', 'Not in quiz time. Try 9:30 AM, 12:00 PM, or 3:00 PM.');
        return;
    }

    // Load questions for this set
    $this->questions = QuizQuestion::where('set', $this->set)
        ->with('choices')
        ->inRandomOrder()
        ->take(15)
        ->get();

    if ($this->questions->isEmpty()) {
        session()->flash('error', 'No questions available for this set.');
        return;
    }

    // Find next available slot
    $findNextSlot = function ($time) use ($slots) {
        foreach ($slots as $slot) {
            if ($time->lt($slot)) {
                return $slot;
            }
        }
        // If none left today, first slot tomorrow
        return $slots->first()->copy()->addDay();
    };

    // Prevent multiple attempts
    $lastAttempt = auth()->user()->quizAttempts()->latest('created_at')->first();
    if ($lastAttempt) {
        $lastTime = Carbon::parse($lastAttempt->created_at)->timezone('Asia/Manila');
        $nextSlot = $findNextSlot($lastTime);

        if ($now->lt($nextSlot)) {
            $this->attempt = $lastAttempt;
            $this->phase = 'alreadyTaken';
            session()->flash(
                'error',
                'You have already taken the quiz. Next available slot: ' . $nextSlot->format('F j, Y g:i A')
            );
            return;
        }
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
            <h2 class="text-xl font-bold text-gray-800 dark:text-white">Health Trivia Quiz</h2>
            <p class="text-gray-500 dark:text-gray-400 mt-1">
                A fun and educational quiz about health and wellness.
            </p>

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
                    <p class="text-gray-800 dark:text-white text-sm font-semibold">15</p>
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
                @if(session('error')) disabled @endif
                class="mt-6 w-full bg-primary-500 hover:bg-primary-600 text-white font-medium py-3 rounded-full disabled:opacity-50"
            >
                Start
            </button>

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
                <h2 class="text-xl font-bold text-gray-800 dark:text-white">Results</h2>

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


        @elseif($phase === 'alreadyTaken')
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow p-8 max-w-md w-full text-center">
                <h2 class="text-xl font-bold text-gray-800 dark:text-white mb-4">
                    You have already taken this quiz
                </h2>

                <p class="text-gray-500 dark:text-gray-400 mb-6">
                    Next available slot: {{ $attempt ? $attempt->created_at->timezone('Asia/Manila')->addHours(3)->format('F j, Y g:i A') : '' }}
                </p>

                <!-- Show last score -->
                <div class="bg-primary-100 h-28 w-28 mx-auto flex flex-col justify-center rounded-full mb-4">
                    <div class="text-primary-700 font-black text-2xl">
                        {{ $attempt->score }}
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex gap-3 justify-center">
                    <a href="{{ route('index') }}"
                    class="px-4 py-2 bg-primary-300 hover:bg-primary-500 text-white rounded-full transition">
                        Home
                    </a>
                    <button wire:click="$set('phase','result')"
                    class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-full transition">
                        View Result
                    </button>
                </div>
            </div>

        @endif


</div>
