<?php

use function Livewire\Volt\{state};
use Carbon\Carbon;
use App\Models\ScrambleAttempt;
use App\Models\ScrambleRound;
use App\Models\ScrambleWord;

state([
    'phase' => 'start',         // start | play | result
    'letters' => [],            // current letter pool
    'target' => '',             // target word
    'current' => '',            // user-assembled word
    'time' => 0,                // total time taken
    'score' => 0,               // session score
    'attemptId' => null,        // current attempt id
]);

// Words are now sourced strictly from the database via ScrambleWord

$shuffleWord = function (string $word) {
    $letters = mb_str_split($word);
    shuffle($letters);
    // Ensure not identical to original if possible
    if (strtoupper(implode('', $letters)) === strtoupper($word)) {
        shuffle($letters);
    }
    return $letters;
};

$getRandomWord = function () {
    $word = ScrambleWord::query()->where('active', true)->inRandomOrder()->value('word');
    return $word ? strtoupper($word) : null;
};

$startGame = function () use ($shuffleWord, $getRandomWord) {
    $this->phase = 'play';
    $this->score = 0;
    $this->time = 0;
    // create a new attempt for the user
    $attempt = ScrambleAttempt::create([
        'user_id' => auth()->id(),
        'score' => 0,
        'rounds' => 0,
        'time' => 0,
    ]);
    $this->attemptId = $attempt->id;

    $word = $getRandomWord();
    if (!$word) {
        session()->flash('error', 'No scramble words available. Please add words first.');
        $this->phase = 'start';
        return;
    }

    $this->target = $word;
    $this->letters = $shuffleWord($this->target);
    $this->current = '';
};

$pickLetter = function (string $letter) {
    // remove one instance from letters and append to current
    foreach ($this->letters as $i => $l) {
        if ($l === $letter) {
            unset($this->letters[$i]);
            $this->letters = array_values($this->letters);
            $this->current .= $letter;
            break;
        }
    }

    if (strtoupper($this->current) === strtoupper($this->target)) {
        // solved: persist round and update attempt totals
        if ($this->attemptId) {
            ScrambleRound::create([
                'scramble_attempt_id' => $this->attemptId,
                'target' => $this->target,
                'guess' => $this->current,
                'solved' => true,
                'time' => 0,
                'score' => 10,
            ]);

            // update attempt totals
            /** @var ScrambleAttempt $attempt */
            $attempt = ScrambleAttempt::find($this->attemptId);
            if ($attempt) {
                $attempt->increment('score', 10);
                $attempt->increment('rounds', 1);
            }
        }

        $this->score += 10;
        $this->phase = 'result';
    }
};

$resetPick = function () use ($shuffleWord) {
    $this->current = '';
    $this->letters = $shuffleWord($this->target);
};

$nextRound = function () use ($shuffleWord, $getRandomWord) {
    $word = $getRandomWord();
    if (!$word) {
        session()->flash('error', 'No scramble words available. Please add words first.');
        $this->phase = 'start';
        return;
    }

    $this->target = $word;
    $this->letters = $shuffleWord($this->target);
    $this->current = '';
    $this->phase = 'play';
};

?>

<div class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 flex items-center justify-center p-4">
    @if ($phase === 'start')
    <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-2xl p-8 max-w-2xl w-full text-center border border-gray-200 dark:border-gray-700">
        <!-- Header -->
        <div class="mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full mb-4">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                </svg>
            </div>
            <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-3">Word Scramble</h1>
            <p class="text-lg text-gray-600 dark:text-gray-300">Unscramble the letters to form wellness-related words and earn points!</p>
        </div>

        <!-- Game Features -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-gradient-to-br from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 rounded-2xl p-6 border border-green-200 dark:border-green-800">
                <div class="w-12 h-12 bg-green-100 dark:bg-green-900 rounded-xl flex items-center justify-center mx-auto mb-3">
                    <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0a9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-1">No Pressure</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400">Take your time and enjoy the challenge</p>
            </div>

            <div class="bg-gradient-to-br from-blue-50 to-cyan-50 dark:from-blue-900/20 dark:to-cyan-900/20 rounded-2xl p-6 border border-blue-200 dark:border-blue-800">
                <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900 rounded-xl flex items-center justify-center mx-auto mb-3">
                    <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-1">One Word</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400">Focus on one word at a time</p>
            </div>

            <div class="bg-gradient-to-br from-purple-50 to-pink-50 dark:from-purple-900/20 dark:to-pink-900/20 rounded-2xl p-6 border border-purple-200 dark:border-purple-800">
                <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900 rounded-xl flex items-center justify-center mx-auto mb-3">
                    <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.98a1 1 0 00.95.69h4.184c.969 0 1.371 1.24.588 1.81l-3.39 2.462a1 1 0 00-.364 1.118l1.287 3.98c.3.921-.755 1.688-1.538 1.118l-3.39-2.462a1 1 0 00-1.175 0l-3.39 2.462c-.783.57-1.838-.197-1.538-1.118l1.287-3.98a1 1 0 00-.364-1.118L2.02 9.407c-.783-.57-.38-1.81.588-1.81h4.184a1 1 0 00.95-.69l1.286-3.98z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-1">Earn Points</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400">10 points for each word solved</p>
            </div>
        </div>

        <!-- Start Button -->
        <button wire:click="startGame" class="w-full bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-bold py-4 px-8 rounded-2xl text-lg transition-all duration-300 transform hover:scale-105 shadow-lg">
            <span class="flex items-center justify-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1m4 0h1m-6 4h1m4 0h1m-6-8h8a2 2 0 012 2v8a2 2 0 01-2 2H8a2 2 0 01-2-2v-8a2 2 0 012-2z"></path>
                </svg>
                Start Playing
            </span>
        </button>
    </div>
    @elseif ($phase === 'play')
    <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-2xl p-8 max-w-4xl w-full border border-gray-200 dark:border-gray-700">
        <!-- Header -->
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Arrange the Letters</h2>
            <p class="text-gray-600 dark:text-gray-300">Click the letters in the correct order to form the word</p>
        </div>

        <!-- Letter Pool -->
        <div class="flex justify-center gap-3 flex-wrap mb-8">
            @foreach ($letters as $i => $ch)
            <button
                wire:click="pickLetter('{{ $ch }}')"
                class="w-16 h-16 bg-gradient-to-br from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white text-2xl font-bold rounded-2xl shadow-lg hover:shadow-xl transform hover:scale-110 transition-all duration-200 border-2 border-transparent hover:border-white/20">
                {{ $ch }}
            </button>
            @endforeach
        </div>

        <!-- Current Word Display -->
        <div class="mb-8">
            <div class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-600 rounded-2xl p-6 min-h-20 flex items-center justify-center">
                <div class="text-3xl font-bold text-gray-900 dark:text-white tracking-widest">
                    @if($current)
                    {{ $current }}
                    @else
                    <span class="text-gray-400 dark:text-gray-500">Click letters to form the word</span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-center gap-4">
            <button
                wire:click="resetPick"
                class="px-6 py-3 bg-gray-200 hover:bg-gray-300 dark:bg-gray-600 dark:hover:bg-gray-500 text-gray-700 dark:text-gray-300 rounded-xl font-medium transition-all duration-200 transform hover:scale-105">
                <span class="flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                    </svg>
                    Shuffle Letters
                </span>
            </button>
        </div>
    </div>
    @elseif ($phase === 'result')
    <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-2xl p-8 max-w-2xl w-full text-center border border-gray-200 dark:border-gray-700">
        <!-- Success Animation -->
        <div class="mb-8">
            <div class="inline-flex items-center justify-center w-24 h-24 bg-gradient-to-r from-green-400 to-emerald-500 rounded-full mb-4 animate-bounce">
                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <h2 class="text-4xl font-bold text-gray-900 dark:text-white mb-2">Excellent!</h2>
            <p class="text-xl text-gray-600 dark:text-gray-300 mb-4">You solved the word:</p>
            <div class="inline-block bg-gradient-to-r from-blue-500 to-purple-600 text-white px-6 py-3 rounded-xl text-2xl font-bold">
                {{ $target }}
            </div>
        </div>

        <!-- Points Earned -->
        <div class="bg-gradient-to-r from-yellow-50 to-orange-50 dark:from-yellow-900/20 dark:to-orange-900/20 rounded-2xl p-6 mb-8 border border-yellow-200 dark:border-yellow-800">
            <div class="text-3xl font-bold text-yellow-600 dark:text-yellow-400 mb-2">+10 Points</div>
            <p class="text-gray-600 dark:text-gray-300">Great job! Keep it up!</p>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <button
                wire:click="nextRound"
                class="px-8 py-4 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-bold rounded-2xl transition-all duration-300 transform hover:scale-105 shadow-lg">
                <span class="flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                    Next Word
                </span>
            </button>
            <a
                href="{{ route('index') }}"
                class="px-8 py-4 bg-gray-200 hover:bg-gray-300 dark:bg-gray-600 dark:hover:bg-gray-500 text-gray-700 dark:text-gray-300 font-medium rounded-2xl transition-all duration-300 transform hover:scale-105">
                <span class="flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    Back to Home
                </span>
            </a>
        </div>
    </div>
    @endif
</div>