<?php

use App\Models\QuizQuestion;
use Carbon\Carbon;

?>

<div class="flex justify-center items-center h-[calc(100vh-5rem)] bg-gray-100 dark:bg-gray-900">
    
    <!--[if BLOCK]><![endif]--><?php if($phase === 'start'): ?>
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow p-8 max-w-md w-full text-center">
            <!--[if BLOCK]><![endif]--><?php if(session('error')): ?>
                <div class="bg-red-100 text-red-700 p-2 rounded mb-3">
                    <?php echo e(session('error')); ?>

                </div>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            <!-- Icon -->
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
                        class="h-6 w-6 text-green-500 mb-1" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0a9 9 0 0118 0z" />
                    </svg>
                    <p class="text-gray-800 dark:text-white text-sm font-semibold">15s</p>
                    <span class="text-gray-500 dark:text-gray-400 text-xs">per question</span>
                </div>

                <!-- Questions -->
                <div class="bg-white dark:bg-gray-700 shadow rounded-lg p-3 flex flex-col items-center">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6 text-green-500 mb-1" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                    </svg>
                    <p class="text-gray-800 dark:text-white text-sm font-semibold">5</p>
                    <span class="text-gray-500 dark:text-gray-400 text-xs">questions</span>
                </div>

                <!-- Points -->
                <div class="bg-white dark:bg-gray-700 shadow rounded-lg p-3 flex flex-col items-center">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6 text-green-500 mb-1" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.98a1 1 0 00.95.69h4.184c.969 0 1.371 1.24.588 1.81l-3.39 2.462a1 1 0 00-.364 1.118l1.287 3.98c.3.921-.755 1.688-1.538 1.118l-3.39-2.462a1 1 0 00-1.175 0l-3.39 2.462c-.783.57-1.838-.197-1.538-1.118l1.287-3.98a1 1 0 00-.364-1.118L2.02 9.407c-.783-.57-.38-1.81.588-1.81h4.184a1 1 0 00.95-.69l1.286-3.98z" />
                    </svg>
                </div>
            </div>

            <!-- Button -->
            <button
                wire:click='startQuiz'
                <?php if(session('error')): ?> disabled <?php endif; ?>
                class="mt-6 w-full bg-green-500 hover:bg-green-600 text-white font-medium py-3 rounded-full disabled:opacity-50"
            >
                Start Assessment
            </button>

        </div>
    <?php elseif($phase === 'quiz'): ?>
        <div x-data="{
            seconds: 15,
            selectAnswer(id, letter) {
                $wire.selectAnswer(id, letter, this.seconds);
                this.seconds = 15;
            }
        }" x-init="$nextTick(() => {
            setInterval(() => {
                if (seconds <= 0) {
                    $wire.skipQuestion();
                    seconds = 15;
                } else {
                    seconds--;
                }
            }, 1000)
        })" class="select-none bg-white dark:bg-gray-800 rounded-2xl shadow p-8 max-w-4xl w-full text-center">

            <!-- Timer -->
            <div class="flex justify-end mb-4">
                <div class="bg-green-100 h-14 w-14 flex flex-col justify-center rounded-full">
                    <div x-text="seconds" class="text-green-500 font-bold text-2xl"></div>
                </div>
            </div>

            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <!--[if BLOCK]><![endif]--><?php if($loop->index == $this->index): ?>
                    <div class="">
                        <!-- Title -->
                        <h2 class="text-xl font-bold text-gray-800 dark:text-white mb-20">
                            <?php echo e($question->content); ?>

                        </h2>
                        <!-- Choices -->
                        <div class="grid grid-cols-2 gap-3 mt-6">
                            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $question->choices()->inRandomOrder()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $choice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div x-on:click="selectAnswer(<?php echo e($choice->id); ?>, '<?php echo e($choice->letter); ?>')" class="bg-white dark:bg-gray-700 shadow rounded-lg p-3 flex items-center border-2 border-transparent hover:border-green-500 transition cursor-pointer">
                                    <p class="flex-1 text-gray-800 dark:text-white text-lg font-semibold"><?php echo e($choice->content); ?></p>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                        </div>
                    </div>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->

            <!-- Button -->
            
        </div>
    <?php elseif($phase === 'result'): ?>
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow p-8 max-w-md w-full text-center">

            <!-- Icon -->
            <div class="flex justify-center mb-4">
                <div class="bg-green-100 h-32 w-32 flex flex-col justify-center rounded-full">
                    <div class="text-green-700 font-black text-3xl"><?php echo e($attempt->score); ?></div>
                    
                    <div class="text-green-500 font-bold">of 100</div>
                </div>
            </div>

            <!-- Title -->
            <h2 class="text-xl font-bold text-gray-800 dark:text-white">Results</h2>
            <p class="text-gray-500 dark:text-gray-400 mt-1">
                Refresh to try again.
            </p>

                <button data-modal-target="leaderboardModal" data-modal-toggle="leaderboardModal" class="mt-4 mb-2 inline-block bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-full">
                    View Leaderboard
                </button>

            <!-- Info boxes -->
            <div class="grid grid-cols-3 gap-3 mt-6">

                <!-- Questions -->
                <div class="bg-white dark:bg-gray-700 shadow rounded-lg p-3 flex flex-col items-center">
                    
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6 text-green-500 mb-1" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2l4-4m5 2a9 9 0 11-18 0a9 9 0 0118 0z" />
                    </svg>
                    <p class="text-gray-800 dark:text-white text-sm font-semibold"><?php echo e($attempt->correct); ?></p>
                    <span class="text-gray-500 dark:text-gray-400 text-xs">correct of 5</span>
                </div>

                <!-- Time -->
                <div class="bg-white dark:bg-gray-700 shadow rounded-lg p-3 flex flex-col items-center">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6 text-green-500 mb-1" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0a9 9 0 0118 0z" />
                    </svg>
                    <p class="text-gray-800 dark:text-white text-sm font-semibold"><?php echo e(floor($this->time / 60)); ?>m <?php echo e($this->time % 60); ?>s</p>
                    <span class="text-gray-500 dark:text-gray-400 text-xs">time taken</span>
                </div>

                <!-- Points -->
                <div class="bg-white dark:bg-gray-700 shadow rounded-lg p-3 flex flex-col items-center">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6 text-green-500 mb-1" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.98a1 1 0 00.95.69h4.184c.969 0 1.371 1.24.588 1.81l-3.39 2.462a1 1 0 00-.364 1.118l1.287 3.98c.3.921-.755 1.688-1.538 1.118l-3.39-2.462a1 1 0 00-1.175 0l-3.39 2.462c-.783.57-1.838-.197-1.538-1.118l1.287-3.98a1 1 0 00-.364-1.118L2.02 9.407c-.783-.57-.38-1.81.588-1.81h4.184a1 1 0 00.95-.69l1.286-3.98z" />
                    </svg>
                    <p class="text-gray-800 dark:text-white text-sm font-semibold"><?php echo e($bestScore); ?></p>
                    <span class="text-gray-500 dark:text-gray-400 text-xs">best score</span>
                </div>
            </div>

            
        </div>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

</div><?php /**PATH C:\xampp\htdocs\systems\DIT-Power\DTI-Power\resources\views\livewire/quiz/index.blade.php ENDPATH**/ ?>