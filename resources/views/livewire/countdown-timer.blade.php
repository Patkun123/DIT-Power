<div x-data="meditationTimer()" class="flex flex-col items-center bg-gradient-to-br from-lime-50 to-green-50 dark:from-lime-900/20 dark:to-green-900/20 transition-all hover:shadow-xl hover:-translate-y-1 shadow-lime-500 rounded-xl shadow-lg p-6 border border-lime-200 dark:border-lime-800">

    <div class="flex items-center mb-5">
        <div class="w-10 h-10 bg-lime-500 rounded-full flex items-center justify-center mr-3">
            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
        <h2 class="font-bold text-lg text-gray-900 dark:text-white">Meditation Timer</h2>
    </div>

    {{-- Timer Display --}}
    <div class="mb-6">
        <div class="relative">
            <div class="w-32 h-32 mx-auto rounded-full border-8 border-lime-200 dark:border-lime-800 flex items-center justify-center"
                :class="{'border-lime-500': running, 'animate-pulse': running}">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white" x-text="formatTime(timeRemaining)"></h1>
            </div>
            <div x-show="running" class="absolute inset-0 rounded-full border-8 border-lime-500 animate-spin"
                style="animation-duration: 60s; animation-timing-function: linear;"></div>
        </div>
    </div>

    {{-- Time Selection Buttons --}}
    <div class="grid grid-cols-2 gap-3 w-full mb-6">
        <button @click="selectTime(5)"
            :class="selectedTime === 5 ? 'bg-lime-600 text-white' : 'bg-lime-100 text-lime-700 hover:bg-lime-200 dark:bg-lime-900/30 dark:text-lime-300'"
            class="py-2 px-3 rounded-lg font-medium transition-all duration-200 text-sm">
            5 min
        </button>
        <button @click="selectTime(10)"
            :class="selectedTime === 10 ? 'bg-lime-600 text-white' : 'bg-lime-100 text-lime-700 hover:bg-lime-200 dark:bg-lime-900/30 dark:text-lime-300'"
            class="py-2 px-3 rounded-lg font-medium transition-all duration-200 text-sm">
            10 min
        </button>
        <button @click="selectTime(15)"
            :class="selectedTime === 15 ? 'bg-lime-600 text-white' : 'bg-lime-100 text-lime-700 hover:bg-lime-200 dark:bg-lime-900/30 dark:text-lime-300'"
            class="py-2 px-3 rounded-lg font-medium transition-all duration-200 text-sm">
            15 min
        </button>
        <button @click="selectTime(20)"
            :class="selectedTime === 20 ? 'bg-lime-600 text-white' : 'bg-lime-100 text-lime-700 hover:bg-lime-200 dark:bg-lime-900/30 dark:text-lime-300'"
            class="py-2 px-3 rounded-lg font-medium transition-all duration-200 text-sm">
            20 min
        </button>
    </div>

    {{-- Start / Reset Buttons --}}
    <div class="flex gap-3 w-full">
        <button @click="startTimer"
            :disabled="timeRemaining === 0"
            :class="timeRemaining === 0 ? 'bg-gray-300 text-gray-500 cursor-not-allowed' : 'bg-lime-600 hover:bg-lime-700 text-white'"
            class="flex-1 py-3 px-4 rounded-lg font-semibold transition-all duration-200 flex items-center justify-center gap-2">
            <svg x-show="!running" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1m4 0h1m-6 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <svg x-show="running" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 9v6m4-6v6m7-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span x-text="running ? 'Pause' : 'Start'"></span>
        </button>
        <button @click="resetTimer"
            class="px-4 py-3 bg-red-500 hover:bg-red-600 text-white rounded-lg font-semibold transition-all duration-200 flex items-center justify-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
            </svg>
            Reset
        </button>
    </div>

    {{-- Progress Bar --}}
    <div x-show="selectedTime > 0" class="w-full mt-4">
        <div class="w-full bg-lime-200 dark:bg-lime-800 rounded-full h-2">
            <div class="bg-lime-500 h-2 rounded-full transition-all duration-1000 ease-linear"
                :style="`width: ${progressPercentage}%`"></div>
        </div>
        <p class="text-xs text-gray-600 dark:text-gray-400 mt-2 text-center">
            <span x-text="Math.round(progressPercentage)"></span>% Complete
        </p>
    </div>

    {{-- Completion Message --}}
    <div x-show="completed"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform scale-95"
        x-transition:enter-end="opacity-100 transform scale-100"
        class="mt-4 p-4 bg-green-100 dark:bg-green-900/30 border border-green-200 dark:border-green-800 rounded-lg text-center">
        <div class="flex items-center justify-center gap-2 text-green-800 dark:text-green-200">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            <span class="font-semibold">Meditation Complete!</span>
        </div>
        <p class="text-sm text-green-700 dark:text-green-300 mt-1">Great job taking time for yourself.</p>
    </div>

    <audio id="timer-audio" loop>
        <source src="{{ asset('sounds/start.mp3') }}" type="audio/mpeg">
    </audio>
</div>

<script>
    function meditationTimer() {
        return {
            timeRemaining: 0,
            selectedTime: 0,
            running: false,
            completed: false,
            interval: null,

            get progressPercentage() {
                if (this.selectedTime === 0) return 0;
                return ((this.selectedTime * 60 - this.timeRemaining) / (this.selectedTime * 60)) * 100;
            },

            selectTime(minutes) {
                this.timeRemaining = minutes * 60;
                this.selectedTime = minutes;
                this.running = false;
                this.completed = false;
                this.stopAudio();
                if (this.interval) {
                    clearInterval(this.interval);
                }
            },

            startTimer() {
                if (this.timeRemaining === 0) return;

                this.running = !this.running;
                this.completed = false;

                if (this.running) {
                    this.playAudio();
                    this.interval = setInterval(() => {
                        if (this.timeRemaining > 0) {
                            this.timeRemaining--;
                        } else {
                            this.completeTimer();
                        }
                    }, 1000);
                } else {
                    this.pauseTimer();
                }
            },

            resetTimer() {
                this.running = false;
                this.completed = false;
                this.timeRemaining = 0;
                this.selectedTime = 0;
                this.stopAudio();
                if (this.interval) {
                    clearInterval(this.interval);
                }
            },

            pauseTimer() {
                this.running = false;
                this.stopAudio();
                if (this.interval) {
                    clearInterval(this.interval);
                }
            },

            completeTimer() {
                this.running = false;
                this.completed = true;
                this.stopAudio();
                if (this.interval) {
                    clearInterval(this.interval);
                }
                // Play completion sound
                this.playCompletionSound();
            },

            formatTime(seconds) {
                const minutes = Math.floor(seconds / 60);
                const remainingSeconds = seconds % 60;
                return `${minutes.toString().padStart(2, '0')}:${remainingSeconds.toString().padStart(2, '0')}`;
            },

            playAudio() {
                const audio = document.getElementById('timer-audio');
                if (audio) {
                    audio.play().catch(e => console.log('Audio play failed:', e));
                }
            },

            stopAudio() {
                const audio = document.getElementById('timer-audio');
                if (audio) {
                    audio.pause();
                    audio.currentTime = 0;
                }
            },

            playCompletionSound() {
                // Create a simple completion sound
                const audioContext = new(window.AudioContext || window.webkitAudioContext)();
                const oscillator = audioContext.createOscillator();
                const gainNode = audioContext.createGain();

                oscillator.connect(gainNode);
                gainNode.connect(audioContext.destination);

                oscillator.frequency.setValueAtTime(800, audioContext.currentTime);
                oscillator.frequency.setValueAtTime(1000, audioContext.currentTime + 0.1);
                oscillator.frequency.setValueAtTime(1200, audioContext.currentTime + 0.2);

                gainNode.gain.setValueAtTime(0.3, audioContext.currentTime);
                gainNode.gain.exponentialRampToValueAtTime(0.01, audioContext.currentTime + 0.5);

                oscillator.start(audioContext.currentTime);
                oscillator.stop(audioContext.currentTime + 0.5);
            }
        }
    }
</script>