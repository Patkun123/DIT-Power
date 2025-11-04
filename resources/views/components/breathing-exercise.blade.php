<div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-8 border border-gray-100 dark:border-gray-700"
    x-data="breathingExercise()">
    <div class="text-center mb-8">
        <div class="flex items-center justify-center w-16 h-16 bg-gradient-to-r from-purple-400 to-pink-500 rounded-full mb-4 mx-auto">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
            </svg>
        </div>
        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Guided Breathing Exercise</h3>
        <p class="text-gray-600 dark:text-gray-300">Follow the breathing pattern to reduce stress and promote relaxation.</p>
    </div>

    <!-- Breathing Circle -->
    <div class="flex justify-center mb-8">
        <div class="relative">
            <div class="w-64 h-64 rounded-full border-4 border-gray-200 dark:border-gray-600 flex items-center justify-center transition-all duration-1000"
                :class="isActive ? `bg-gradient-to-r ${getPhaseColor()}` : 'bg-gray-100 dark:bg-gray-700'">
                <div class="text-center">
                    <div class="text-2xl font-bold text-white mb-2" x-text="getPhaseText()"></div>
                    <div class="text-white/80 text-sm" x-show="isActive" x-text="`Cycle ${cycle + 1}`"></div>
                    <div class="text-gray-500 dark:text-gray-400 text-sm" x-show="!isActive">Ready to begin</div>
                </div>
            </div>

            <!-- Progress Ring -->
            <svg x-show="isActive" class="absolute inset-0 w-64 h-64 transform -rotate-90" viewBox="0 0 100 100">
                <circle cx="50" cy="50" r="45" stroke="rgba(255,255,255,0.3)" stroke-width="2" fill="none" />
                <circle cx="50" cy="50" r="45" stroke="white" stroke-width="2" fill="none"
                    :stroke-dasharray="2 * Math.PI * 45"
                    :stroke-dashoffset="2 * Math.PI * 45 * (1 - progress / 100)"
                    class="transition-all duration-1000" />
            </svg>
        </div>
    </div>

    <!-- Controls -->
    <div class="text-center">
        <button x-show="!isActive"
            @click="startExercise()"
            class="bg-gradient-to-r from-purple-500 to-pink-600 text-white py-3 px-8 rounded-lg hover:from-purple-600 hover:to-pink-700 transition-all duration-300 font-medium">
            Start Breathing Exercise
        </button>
        <button x-show="isActive"
            @click="stopExercise()"
            class="bg-gradient-to-r from-gray-500 to-gray-600 text-white py-3 px-8 rounded-lg hover:from-gray-600 hover:to-gray-700 transition-all duration-300 font-medium">
            Stop Exercise
        </button>
    </div>

    <!-- Instructions -->
    <div class="mt-8 grid grid-cols-2 md:grid-cols-4 gap-4 text-center">
        <div class="p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
            <div class="text-2xl font-bold text-blue-600 dark:text-blue-400">4s</div>
            <div class="text-sm text-blue-800 dark:text-blue-200">Inhale</div>
        </div>
        <div class="p-4 bg-green-50 dark:bg-green-900/20 rounded-lg">
            <div class="text-2xl font-bold text-green-600 dark:text-green-400">4s</div>
            <div class="text-sm text-green-800 dark:text-green-200">Hold</div>
        </div>
        <div class="p-4 bg-purple-50 dark:bg-purple-900/20 rounded-lg">
            <div class="text-2xl font-bold text-purple-600 dark:text-purple-400">6s</div>
            <div class="text-sm text-purple-800 dark:text-purple-200">Exhale</div>
        </div>
        <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
            <div class="text-2xl font-bold text-gray-600 dark:text-gray-400">2s</div>
            <div class="text-sm text-gray-800 dark:text-gray-200">Pause</div>
        </div>
    </div>

    <!-- Tips -->
    <div class="mt-6 p-4 bg-purple-50 dark:bg-purple-900/20 rounded-lg">
        <h4 class="font-medium text-purple-900 dark:text-purple-200 mb-2">💡 Tips for Success</h4>
        <ul class="text-sm text-purple-800 dark:text-purple-300 space-y-1">
            <li>• Find a comfortable position</li>
            <li>• Close your eyes if it helps you focus</li>
            <li>• Don't force your breathing - let it flow naturally</li>
            <li>• Practice regularly for best results</li>
        </ul>
    </div>
</div>

<script>
    function breathingExercise() {
        return {
            isActive: false,
            currentPhase: 'inhale',
            cycle: 0,
            totalCycles: 0,
            inhaleTime: 4,
            holdTime: 4,
            exhaleTime: 6,
            pauseTime: 2,
            currentTime: 0,
            progress: 0,
            interval: null,

            startExercise() {
                this.isActive = true;
                this.currentPhase = 'inhale';
                this.cycle = 0;
                this.totalCycles = 0;
                this.currentTime = 0;
                this.progress = 0;

                this.interval = setInterval(() => {
                    this.tick();
                }, 1000);
            },

            stopExercise() {
                this.isActive = false;
                this.currentPhase = 'inhale';
                this.cycle = 0;
                this.currentTime = 0;
                this.progress = 0;

                if (this.interval) {
                    clearInterval(this.interval);
                    this.interval = null;
                }
            },

            tick() {
                if (!this.isActive) return;

                this.currentTime++;

                const phaseTime = this.getPhaseTime();
                this.progress = (this.currentTime / phaseTime) * 100;

                if (this.currentTime >= phaseTime) {
                    this.nextPhase();
                }
            },

            getPhaseTime() {
                switch (this.currentPhase) {
                    case 'inhale':
                        return this.inhaleTime;
                    case 'hold':
                        return this.holdTime;
                    case 'exhale':
                        return this.exhaleTime;
                    case 'pause':
                        return this.pauseTime;
                    default:
                        return 4;
                }
            },

            nextPhase() {
                this.currentTime = 0;
                this.progress = 0;

                switch (this.currentPhase) {
                    case 'inhale':
                        this.currentPhase = 'hold';
                        break;
                    case 'hold':
                        this.currentPhase = 'exhale';
                        break;
                    case 'exhale':
                        this.currentPhase = 'pause';
                        break;
                    case 'pause':
                        this.currentPhase = 'inhale';
                        this.cycle++;
                        this.totalCycles++;
                        break;
                }
            },

            getPhaseText() {
                switch (this.currentPhase) {
                    case 'inhale':
                        return 'Breathe In';
                    case 'hold':
                        return 'Hold';
                    case 'exhale':
                        return 'Breathe Out';
                    case 'pause':
                        return 'Pause';
                    default:
                        return 'Ready';
                }
            },

            getPhaseColor() {
                switch (this.currentPhase) {
                    case 'inhale':
                        return 'from-blue-400 to-blue-600';
                    case 'hold':
                        return 'from-green-400 to-green-600';
                    case 'exhale':
                        return 'from-purple-400 to-purple-600';
                    case 'pause':
                        return 'from-gray-400 to-gray-600';
                    default:
                        return 'from-gray-400 to-gray-600';
                }
            }
        }
    }
</script>



