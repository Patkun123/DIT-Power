<div wire:poll.1s="tick" class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
    <div class="bg-gradient-to-r from-purple-500 via-pink-600 to-red-600 dark:from-purple-600 dark:via-pink-700 dark:to-red-700 px-6 py-5">
        <div class="flex items-center space-x-3">
            <div class="p-2 bg-white/20 dark:bg-white/10 rounded-lg backdrop-blur-sm">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <h2 class="text-xl font-bold text-white">Meditation Timer</h2>
        </div>
    </div>

    <div class="p-6 flex flex-col items-center">
        {{-- Timer Display --}}
        <div class="mb-6 text-center">
            <div class="inline-flex items-center justify-center w-32 h-32 rounded-full bg-gradient-to-br from-purple-100 to-pink-100 dark:from-purple-900/30 dark:to-pink-900/30 border-4 border-purple-200 dark:border-purple-800 mb-4">
                <h1 class="text-4xl sm:text-5xl font-bold text-gray-900 dark:text-white tabular-nums">
                    {{ gmdate('i:s', (int) $this->timeRemaining) }}
                </h1>
            </div>
            @if($this->running)
            <div class="flex items-center justify-center space-x-2 text-sm text-purple-600 dark:text-purple-400">
                <div class="w-2 h-2 bg-purple-600 dark:bg-purple-400 rounded-full animate-pulse"></div>
                <span class="font-semibold">Running</span>
            </div>
            @elseif($this->timeRemaining > 0)
            <div class="text-sm text-gray-500 dark:text-gray-400 font-medium">Ready to start</div>
            @else
            <div class="text-sm text-gray-500 dark:text-gray-400 font-medium">Select a duration</div>
            @endif
        </div>

        {{-- Time Selection Buttons --}}
        <div class="grid grid-cols-2 gap-3 w-full mb-6">
            <button
                wire:click="selectTime(5)"
                class="py-3 px-4 bg-gray-100 dark:bg-gray-700 hover:bg-primary-100 dark:hover:bg-primary-900/30 text-gray-700 dark:text-gray-300 hover:text-primary-700 dark:hover:text-primary-300 font-semibold rounded-xl border-2 border-gray-200 dark:border-gray-600 hover:border-primary-300 dark:hover:border-primary-700 transition-all duration-200">
                5 min
            </button>
            <button
                wire:click="selectTime(10)"
                class="py-3 px-4 bg-gray-100 dark:bg-gray-700 hover:bg-primary-100 dark:hover:bg-primary-900/30 text-gray-700 dark:text-gray-300 hover:text-primary-700 dark:hover:text-primary-300 font-semibold rounded-xl border-2 border-gray-200 dark:border-gray-600 hover:border-primary-300 dark:hover:border-primary-700 transition-all duration-200">
                10 min
            </button>
            <button
                wire:click="selectTime(15)"
                class="py-3 px-4 bg-gray-100 dark:bg-gray-700 hover:bg-primary-100 dark:hover:bg-primary-900/30 text-gray-700 dark:text-gray-300 hover:text-primary-700 dark:hover:text-primary-300 font-semibold rounded-xl border-2 border-gray-200 dark:border-gray-600 hover:border-primary-300 dark:hover:border-primary-700 transition-all duration-200">
                15 min
            </button>
            <button
                wire:click="selectTime(20)"
                class="py-3 px-4 bg-gray-100 dark:bg-gray-700 hover:bg-primary-100 dark:hover:bg-primary-900/30 text-gray-700 dark:text-gray-300 hover:text-primary-700 dark:hover:text-primary-300 font-semibold rounded-xl border-2 border-gray-200 dark:border-gray-600 hover:border-primary-300 dark:hover:border-primary-700 transition-all duration-200">
                20 min
            </button>
        </div>

        {{-- Start / Reset Buttons --}}
        <div class="flex space-x-3 w-full">
            <button
                wire:click="start"
                onclick="document.getElementById('timer-audio').play()"
                @if($this->timeRemaining === 0) disabled @endif
                class="flex-1 py-3 px-4 bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 text-white font-semibold rounded-xl shadow-md hover:shadow-lg transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center space-x-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>Start</span>
            </button>
            <button
                wire:click="resets"
                onclick="document.getElementById('timer-audio').pause()"
                class="flex-1 py-3 px-4 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-semibold rounded-xl shadow-md hover:shadow-lg transition-all duration-200 flex items-center justify-center space-x-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                <span>Reset</span>
            </button>
        </div>
    </div>

    <audio id="timer-audio" loop>
        <source src="{{ asset('sounds/start.mp3') }}" type="audio/mpeg">
    </audio>
</div>