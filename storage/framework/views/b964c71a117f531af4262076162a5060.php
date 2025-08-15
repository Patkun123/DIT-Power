<div id="leaderboardModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
<!-- Modal content -->
    <div class="relative bg-white rounded-lg w-150 shadow dark:bg-gray-700 sm:p-5">
        <!-- Modal header -->
        <div class="flex justify-between mb-4 rounded-t sm:mb-5">
            <div class="text-lg text-gray-900 md:text-xl dark:text-white">
                <h3 class="font-semibold">
                    Leaderboards
                </h3>
                <p class="font text-sm underline">
                    Top 10
                </p>
            </div>
            <div>
                <button type="button" class="text-gray-400 cursor-pointer bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 inline-flex dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="leaderboardModal">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
        </div>

        <!-- Scrollable table -->
        <div class="max-h-80 overflow-y-auto rounded-lg border border-gray-200 dark:border-gray-600">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-900 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-gray-200">
                            Ranking
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Total Score
                        </th>
                    </tr>
                </thead>
                <tbody>
                <?php if($topPlayers->isEmpty()): ?>
                    <tr>
                        <td colspan="3" class="px-6 py-4 text-center text-gray-500">
                            No record in leaderboard
                        </td>
                    </tr>
                <?php else: ?>
                    <?php $__currentLoopData = $topPlayers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $player): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="border-b border-gray-200 dark:border-gray-600">
                            <td class="px-4 2xl:px-6  py-4 relative bg-gray-50 dark:bg-gray-800">
                                <?php if($index === 0): ?>
                                    <img src="/images/rewards/gold_medal.png" class="w-4 h-5 2xl:w-4 2xl:h-6 inline-block mr-2" alt="Gold Medal">
                                <?php elseif($index === 1): ?>
                                    <img src="/images/rewards/silver_medal.png" class="w-4 h-5 2xl:w-4 2xl:h-6 inline-block mr-2" alt="Gold Medal">
                                <?php elseif($index === 2): ?>
                                    <img src="/images/rewards/bronze_medal.png" class="w-4 h-5 2xl:w-4 2xl:h-6 inline-block mr-2" alt="Gold Medal">
                                <?php endif; ?>
                                 TOP <?php echo e($index + 1); ?>

                            </td>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                                <?php echo e($player->user->firstname ?? 'Unknown'); ?> <?php echo e($player->user->lastname ?? ''); ?>

                            </th>
                            <td class="px-6 py-4 bg-gray-50 dark:bg-gray-800">
                                <?php echo e($player->best_score); ?>

                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>

                </tbody>

            </table>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\systems\DIT-Power\DTI-Power\resources\views/Auth/Users/partials/leaderboards.blade.php ENDPATH**/ ?>