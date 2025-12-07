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

<div class="flex justify-center items-center h-[calc(100vh-5rem)] shadow shadow-gray-950 bg-gray-100 dark:bg-gray-900">
    @if ($phase === 'start')
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow p-8 max-w-md w-full text-center">
            <h2 class="text-xl font-bold text-gray-800 dark:text-white">Word Scramble</h2>
            <p class="text-gray-500 dark:text-gray-400 mt-1">Unscramble the letters to form a health-related word.</p>

            <div class="grid grid-cols-3 gap-3 mt-6">
                <div class="bg-white dark:bg-gray-700 shadow rounded-lg p-3 flex flex-col items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary-500 mb-1" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0a9 9 0 0118 0z"/></svg>
                    <p class="text-gray-800 dark:text-white text-sm font-semibold">No timer</p>
                    <span class="text-gray-500 dark:text-gray-400 text-xs">relax and play</span>
                </div>
                <div class="bg-white dark:bg-gray-700 shadow rounded-lg p-3 flex flex-col items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary-500 mb-1" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                    <p class="text-gray-800 dark:text-white text-sm font-semibold">1</p>
                    <span class="text-gray-500 dark:text-gray-400 text-xs">word per round</span>
                </div>
                <div class="bg-white dark:bg-gray-700 shadow rounded-lg p-3 flex flex-col items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary-500 mb-1" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.98a1 1 0 00.95.69h4.184c.969 0 1.371 1.24.588 1.81l-3.39 2.462a1 1 0 00-.364 1.118l1.287 3.98c.3.921-.755 1.688-1.538 1.118l-3.39-2.462a1 1 0 00-1.175 0l-3.39 2.462c-.783.57-1.838-.197-1.538-1.118l1.287-3.98a1 1 0 00-.364-1.118L2.02 9.407c-.783-.57-.38-1.81.588-1.81h4.184a1 1 0 00.95-.69l1.286-3.98z"/></svg>
                    <p class="text-gray-800 dark:text-white text-sm font-semibold">10</p>
                    <span class="text-gray-500 dark:text-gray-400 text-xs">points per solve</span>
                </div>
            </div>

            <button wire:click="startGame" class="mt-6 w-full bg-primary-500 hover:bg-primary-600 text-white font-medium py-3 rounded-full">Start</button>
        </div>
    @elseif ($phase === 'play')
        <div class="select-none bg-white dark:bg-gray-800 rounded-2xl shadow p-8 max-w-3xl w-full text-center">
            <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-2">Arrange the letters</h2>

            <div class="flex justify-center gap-2 flex-wrap mb-6">
                @foreach ($letters as $i => $ch)
                    <button wire:click="pickLetter('{{ $ch }}')" class="px-4 py-3 rounded-xl border-2 bg-white dark:bg-gray-700 hover:border-primary-500 text-lg font-bold text-gray-800 dark:text-white">
                        {{ $ch }}
                    </button>
                @endforeach
            </div>

            <div class="min-h-16 p-4 rounded-xl bg-gray-50 dark:bg-gray-700 text-2xl tracking-wide font-bold text-gray-800 dark:text-white">
                {{ $current }}
            </div>

            <div class="flex justify-center gap-3 mt-6">
                <button wire:click="resetPick" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 dark:bg-gray-600 dark:hover:bg-gray-500 rounded-full">Shuffle</button>
            </div>
        </div>
    @elseif ($phase === 'result')
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow p-8 max-w-md w-full text-center">
            <div class="flex justify-center mb-4">
                <div class="bg-primary-100 h-28 w-28 mx-auto flex flex-col justify-center rounded-full mb-4">
                    <div class="text-primary-700 font-black text-2xl">+10</div>
                </div>

            </div>
            <h2 class="text-xl font-bold text-gray-800 dark:text-white mb-1">Great job!</h2>
            <p class="text-gray-500 dark:text-gray-400">Word: <span class="font-semibold">{{ $target }}</span></p>

            <div class="flex gap-3 justify-center mt-4">
                <button wire:click="nextRound" class="px-4 py-2 bg-primary-500 hover:bg-primary-600 text-white rounded-full transition">Next</button>
                <a href="{{ route('index') }}" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 dark:bg-gray-600 dark:hover:bg-gray-500 rounded-full">Home</a>
            </div>
        </div>
    @endif
</div>



