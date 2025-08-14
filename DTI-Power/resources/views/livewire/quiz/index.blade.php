<?php

use function Livewire\Volt\{state};
use App\Models\QuizQuestion;
use Carbon\Carbon;

// Determine quiz availability
$allowedSlots = ['09:00', '12:00', '16:30']; // allowed start times
$now = Carbon::now();
$canTakeQuiz = false;
$nextAvailableTime = null;

foreach ($allowedSlots as $slot) {
    $start = Carbon::createFromTimeString($slot, 'Asia/Manila');
    $end = (clone $start)->addHour();
    if ($now->greaterThanOrEqualTo($start) && $now->lessThanOrEqualTo($end)) {
        $canTakeQuiz = true;
        break;
    }
    if ($now->lt($start) && $nextAvailableTime === null) {
        $nextAvailableTime = $start;
    }
}

if (!$canTakeQuiz && $nextAvailableTime === null) {
    $nextAvailableTime = Carbon::tomorrow('Asia/Manila')->setTimeFromTimeString($allowedSlots[0]);
}

state([
    'questions' => QuizQuestion::with(['choices'])->inRandomOrder()->take(5)->get(),
    'answers' => [],
    'phase' => 'start',
    'index' => 0,
    'attempt' => auth()->user()->quizAttempts->first(),
    'time' => 45,
    'bestScore' => auth()->user()->quizAttempts()
        ->orderBy('score', 'desc')
        ->first()->score,
    'canTakeQuiz' => $canTakeQuiz,
    'nextAvailableTime' => $nextAvailableTime
]);

$startQuiz = function () {
    if (!$this->canTakeQuiz) {
        $this->phase = 'closed';
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
    $this->answers[$this->index] = ['id' => $id, 'letter' => $letter, 'remaining' => $seconds];
    if ($this->index >= count($this->questions) - 1) {
        $this->saveAnswers();
        return;
    }
    $this->index++;
};

$saveAnswers = function () {
    $attempt = auth()->user()->quizAttempts()->create();
    $totalScore = 0;
    $correctCount = 0;
    $timeTaken = 0;

    foreach($this->questions as $key => $question) {
        $isCorrect = $question->correctAnswer()->id === ($this->answers[$key]['id'] ?? null);
        $score = !is_null($this->answers[$key]) ? ($this->answers[$key]['remaining'] * 10 + ($isCorrect ? 150 : 0)) : 0;
        $timeTaken += !is_null($this->answers[$key]) ? 15 - $this->answers[$key]['remaining'] : 15;

        $attempt->answers()->create([
            'question_id' => $question->id,
            'choice_id' => $this->answers[$key]['id'] ?? null,
            'score' => $score,
            'correct' => $isCorrect,
        ]);

        $totalScore += $score;
        if ($isCorrect) $correctCount++;
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

?>

<div class="flex justify-center items-center h-[calc(100vh-5rem)] bg-gray-100 dark:bg-gray-900">
    {{-- Start Quiz State --}}
    @if ($phase === 'start')
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow p-8 max-w-md w-full text-center">
            <div class="flex justify-center mb-4">
                <div class="bg-green-100 p-3 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6 text-green-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2l4-4m5 2a9 9 0 11-18 0a9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
            <h2 class="text-xl font-bold text-gray-800 dark:text-white">Health Trivia Quiz</h2>
            <p class="text-gray-500 dark:text-gray-400 mt-1">
                A fun and educational quiz about health and wellness.
            </p>

            {{-- Info Boxes --}}
            <div class="grid grid-cols-3 gap-3 mt-6">
                <div class="bg-white dark:bg-gray-700 shadow rounded-lg p-3 flex flex-col items-center">
                    <p class="text-gray-800 dark:text-white text-sm font-semibold">15s</p>
                    <span class="text-gray-500 dark:text-gray-400 text-xs">per question</span>
                </div>
                <div class="bg-white dark:bg-gray-700 shadow rounded-lg p-3 flex flex-col items-center">
                    <p class="text-gray-800 dark:text-white text-sm font-semibold">5</p>
                    <span class="text-gray-500 dark:text-gray-400 text-xs">questions</span>
                </div>
                <div class="bg-white dark:bg-gray-700 shadow rounded-lg p-3 flex flex-col items-center">
                    <p class="text-gray-800 dark:text-white text-sm font-semibold">1500</p>
                    <span class="text-gray-500 dark:text-gray-400 text-xs">total points</span>
                </div>
            </div>

            {{-- Availability Button or Message --}}
            @if ($canTakeQuiz)
                <button wire:click='startQuiz' class="mt-6 w-full bg-green-500 hover:bg-green-600 text-white font-medium py-3 rounded-full">
                    Start Assessment
                </button>
            @else
                <div class="mt-6 p-4 bg-red-100 text-red-600 rounded-lg">
                    Quiz is closed.<br>
                    Next available time: {{ $nextAvailableTime->format('g:i A') }}
                </div>
            @endif
        </div>
    @elseif ($phase === 'closed')
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow p-8 max-w-md w-full text-center">
            <h2 class="text-xl font-bold text-gray-800 dark:text-white">Quiz Closed</h2>
            <p class="text-gray-500 dark:text-gray-400 mt-1">
                Next available time: {{ $nextAvailableTime->format('g:i A') }}
            </p>
        </div>
    @elseif ($phase === 'quiz')
        {{-- existing quiz view --}}
    @elseif ($phase === 'result')
        {{-- existing result view --}}
    @endif
</div>
