<?php

use function Livewire\Volt\{state};
use App\Models\QuizQuestion;
use Carbon\Carbon;

$set = null;
$determineSet = function () {
    $now = Carbon::now('Asia/Manila');

    if ($now->between($now->copy()->setTime(1,0), $now->copy()->setTime(10,10))) {
        return 1; // Set 1: 9am–10am
    } elseif ($now->between($now->copy()->setTime(12,0), $now->copy()->setTime(12,45))) {
        return 2; // Set 2: 12nn–1pm
    } elseif ($now->between($now->copy()->setTime(15,0), $now->copy()->setTime(15,30))) {
        return 3; // Set 3: 3pm–4pm
    }

    return null; // Not quiz time
};

$set = $determineSet();

state([
    'set' => $set,
    'questions' => $set
        ? QuizQuestion::where('set', $set)->with(['choices'])->inRandomOrder()->take(15)->get()
        : collect(),
    'answers' => [],
    'phase' => $set ? 'start' : 'start', // stays "start" but shows error if null
    'index' => 0,
    'attempt' => auth()->user()->quizAttempts->first(),
    'time' => 45,
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

    $attempt = auth()->user()->quizAttempts()->create();
    $totalScore = 0;
    $correctCount = 0;
    $timeTaken = 0;

    foreach ($this->questions as $key => $question) {
        $isCorrect = $question->correctAnswer()->id === ($this->answers[$key]['id'] ?? null);
        $score = !is_null($this->answers[$key])
            ? ($this->answers[$key]['remaining'] * 10 + ($isCorrect ? 150 : 0))
            : 0;

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

// $startQuiz = function () {
//     $now = Carbon::now('Asia/Manila');

//     // Slots in the day
//     $allowedTimes = ['09:00', '12:00', '14:00'];
//     $slots = collect($allowedTimes)->map(function ($time) {
//         return Carbon::today('Asia/Manila')->setTimeFromTimeString($time);
//     });

//     // Find next slot after a given time
//     $findNextSlot = function ($time) use ($slots) {
//         foreach ($slots as $slot) {
//             if ($time->lt($slot)) {
//                 return $slot;
//             }
//         }
//         // If none left today, first slot tomorrow
//         return $slots->first()->addDay();
//     };

//     // Last attempt
//     $lastAttempt = auth()->user()->quizAttempts()->latest('created_at')->first();

//     if ($lastAttempt) {
//         $lastTime = Carbon::parse($lastAttempt->created_at)->timezone('Asia/Manila');
//         $nextSlot = $findNextSlot($lastTime);

//         if ($now->lt($nextSlot)) {
//             session()->flash(
//                 'error',
//                 'You have already taken the quiz. Next available slot: ' . $nextSlot->format('F j, Y g:i A')
//             );
//             return;
//         }
//     }

//     // Check if current time is inside a slot
//     $inSlot = false;
//     foreach ($slots as $slot) {
//         $end = (clone $slot)->addHour();
//         if ($now->between($slot, $end)) {
//             $inSlot = true;
//             break;
//         }
//     }

//     if (!$inSlot) {
//         session()->flash('error', 'Not in quiz time.');
//         return;
//     }

//     // Start quiz
//     $this->phase = 'quiz';
// };


$startQuiz = function () {
    $now = Carbon::now('Asia/Manila');

    // Define quiz slots
    $slots = collect([
        Carbon::today('Asia/Manila')->setTime(10, 10),  // 9:50 AM
        Carbon::today('Asia/Manila')->setTime(12, 45), // 12:45 PM
        Carbon::today('Asia/Manila')->setTime(15, 30),  // 4:05 PM
    ]);

    // Match set to time
    if ($now->between($slots[0], $slots[0]->copy()->addHour())) {
        $this->set = 1;
    } elseif ($now->between($slots[1], $slots[1]->copy()->addHour())) {
        $this->set = 2;
    } elseif ($now->between($slots[2], $slots[2]->copy()->addHour())) {
        $this->set = 3;
    } else {
        session()->flash('error', 'Not in quiz time. Try 10:10 AM, 12:45 PM, or 3:30 PM.');
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


$saveAnswers = function () {
    $attempt = auth()->user()->quizAttempts()->create();
    $totalScore = 0;
    $correctCount = 0;

    $timeTaken = 0;

foreach($this->questions as $key => $question) {
    $isCorrect = $question->correctAnswer()->id === ($this->answers[$key]['id'] ?? null);

    if (!is_null($this->answers[$key])) {
        // Base points for correct answer
        $score = $isCorrect ? 10 : 0;

        // Bonus: +2 points only if correct AND remaining >= 18 seconds
        if ($isCorrect && $this->answers[$key]['remaining'] >= 15) {
            $score += 2;
        }
    } else {
        $score = 0;
    }

    // Ignore timeTaken
    $timeTaken = 0;

    // Save answer
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
                    <p class="text-gray-800 dark:text-white text-sm font-semibold">10</p>
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
            selectAnswer(id, letter) {
                $wire.selectAnswer(id, letter, this.seconds);
                this.seconds = 20;
            }
        }" x-init="$nextTick(() => {
            setInterval(() => {
                if (seconds <= 0) {
                    $wire.skipQuestion();
                    seconds = 20;
                } else {
                    seconds--;
                }
            }, 1000)
        })" class="select-none bg-white dark:bg-gray-800 rounded-2xl shadow p-8 max-w-4xl w-full text-center">

            <!-- Timer -->
            <div class="flex justify-end mb-4">
                <div class="bg-primary-100 h-14 w-14 flex flex-col justify-center rounded-full">
                    <div x-text="seconds" class="text-primary-500 font-bold text-2xl"></div>
                </div>
            </div>

            @foreach ($questions as $question)
                @if($loop->index == $this->index)
                    <div class="">
                        <!-- Title -->
                        <h2 class="text-xl font-bold text-gray-800 dark:text-white mb-20">
                            {{ $question->content }}
                        </h2>
                        <!-- Choices -->
                        <div class="grid grid-cols-2 gap-3 mt-6">
                            @foreach($question->choices()->inRandomOrder()->get() as $choice)
                                <div x-on:click="selectAnswer({{ $choice->id }}, '{{ $choice->letter }}')" class="bg-white dark:bg-gray-700 shadow rounded-lg p-3 flex items-center border-2 border-transparent hover:border-primary-500 transition cursor-pointer">
                                    <p class="flex-1 text-gray-800 dark:text-white text-lg font-semibold">{{ $choice->content }}</p>
                                </div>
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
    @elseif($phase === 'result')
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow p-8 max-w-md w-full text-center">

            <!-- Icon -->
            <div class="flex justify-center mb-4">
                <div class="bg-primary-100 h-32 w-32 flex flex-col justify-center rounded-full">
                    <div class="text-primary-700 font-black text-3xl">{{ $attempt->score }}</div>
                    {{-- <hr class="border-primary-500 bold mx-4 border-1"> --}}
                </div>
            </div>

            <!-- Title -->
            <h2 class="text-xl font-bold text-gray-800 dark:text-white">Results</h2>
                 <a href="{{route('index')}}" class="bg-primary-300 hover:bg-primary-500 cursor-pointer transition-all hover:-translate-y-1 rounded-full">
                    Home
                </a>
            <!-- Info boxes -->
            <div class="grid grid-cols-3 gap-3 mt-6">

                <!-- Questions -->
                <div class="bg-white dark:bg-gray-700 shadow rounded-lg p-3 flex flex-col items-center">
                    {{-- <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6 text-primary-500 mb-1" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                    </svg> --}}
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6 text-primary-500 mb-1" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2l4-4m5 2a9 9 0 11-18 0a9 9 0 0118 0z" />
                    </svg>
                    <p class="text-gray-800 dark:text-white text-sm font-semibold">{{ $attempt->correct }}</p>
                    <span class="text-gray-500 dark:text-gray-400 text-xs">Secrets</span>
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

                <!-- Points -->
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
    @endif

</div>
