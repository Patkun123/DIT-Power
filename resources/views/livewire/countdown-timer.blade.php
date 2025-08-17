<div wire:poll.1s="tick" class="flex flex-col items-center  bg-gray-50 dark:bg-gray-800 transition-all hover:shadow-xl hover:-translate-y-1 shadow-primary-500  rounded-xl shadow p-6">

    <div class="flex items-center mb-5">
            <span class="text-primary-600 mr-2">🕒</span>
            <h2 class="font-bold text-lg">Meditation Timer</h2>
    </div>
    {{-- Timer Display --}}
    <h1 class="text-4xl font-bold mb-5">
        {{ gmdate('i:s', (int) $this->timeRemaining) }}
    </h1>

    {{-- Time Selection Buttons --}}
    <div class="grid grid-cols-2 gap-4 w-full mb-5">
        <button wire:click="selectTime(5)" class="bg-primary-500 hover:bg-primary-600 text-gray-800 py-2 rounded-lg">5 min</button>
        <button wire:click="selectTime(10)" class="bg-primary-500 hover:bg-primary-600 text-gray-800 py-2 rounded-lg">10 min</button>
        <button wire:click="selectTime(15)" class="bg-primary-500 hover:bg-primary-600 text-gray-800 py-2 rounded-lg">15 min</button>
        <button wire:click="selectTime(20)" class="bg-primary-500 hover:bg-primary-600 text-gray-800 py-2 rounded-lg">20 min</button>
    </div>

    {{-- Start / Reset Buttons --}}
    <div class="space-x-2">
        <button wire:click="start" onclick="document.getElementById('timer-audio').play()" class="px-4 py-2 bg-primary-500 text-gray-800 rounded">Start</button>
        <button wire:click="resets" onclick="document.getElementById('timer-audio').pause()" class="px-4 py-2 bg-red-500 text-gray-800 rounded">Reset</button>
    </div>


    <audio id="timer-audio" loop>
        <source src="{{ asset('sounds/start.mp3') }}" type="audio/mpeg">
    </audio>
</div>
{{-- Script to Play Audio on Start --}}

