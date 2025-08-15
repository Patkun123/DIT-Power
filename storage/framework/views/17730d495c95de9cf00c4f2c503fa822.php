<?php $__env->startSection('title', 'User'); ?>
<?php $__env->startSection('content'); ?>
<div class="p-4 sm:p-6 space-y-10 bg-gray-50 dark:bg-gray-900 min-h-screen">

    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Top Quiz Performers -->
        <div class="bg-white 2xl:h-110 dark:bg-gray-800 p-6 rounded-xl shadow">
            <h2 class="2xl:text-xl text-md font-semibold text-gray-800 dark:text-white flex items-center justify-between">
                Leaderboard Ranking
                <button id="readProductButton" data-modal-target="leaderboardModal" data-modal-toggle="leaderboardModal" class="hover:bg-primary-500 cursor-pointer transition-all hover:-translate-y-1 rounded-full">
                    <img src="/images/crown.gif" class="w-15 h-15 relative" alt="">
                </button>

            </h2>
            <?php
    // Prepare default empty players if not enough data
    $players = [
        $topPlayers[0] ?? (object)['user' => (object)['firstname' => '---','lastname' => '---', 'office' => ''], 'best_score' => 0],
        $topPlayers[1] ?? (object)['user' => (object)['firstname' => '---','lastname' => '---', 'office' => ''], 'best_score' => 0],
        $topPlayers[2] ?? (object)['user' => (object)['firstname' => '---','lastname' => '---', 'office' => ''], 'best_score' => 0],
    ];
?>

<div class="flex flex-row items-center gap-4 2xl:mt-0 mt-10 sm:gap-0 sm:justify-around">
    <!-- 2nd Place -->
    <div class="text-center bg-gradient-to-b from-silver-500 shadow-2xl shadow-silver-500 via-silver-700 to-silver-500 h-50 w-50 2xl:h-70 2xl:mt-10 2xl:w-45 rounded-2xl">
        <div class="bg-gray-200 w-10 h-10 2xl:w-16 2xl:h-16 mt-5 rounded-full mx-auto mb-2 flex items-center justify-center">
        <?php if($players[1]->user->profileimage): ?>
            <img
                src="<?php echo e(asset('storage/' . $players[1]->user->profileimage)); ?>"
                alt="<?php echo e($players[1]->user->firstname); ?>'s Profile"
                class="w-[36px] h-[36px] 2xl:w-[55px] 2xl:h-[55px] rounded-full object-cover border border-gray-300 dark:border-gray-700"
            >
        <?php else: ?>
            <img
                src="<?php echo e(asset('images/default.png')); ?>"
                alt="Default Profile"
                class="w-[36px] h-[36px] 2xl:w-[55px] 2xl:h-[55px] rounded-full object-cover border border-gray-300 dark:border-gray-700"
            >
        <?php endif; ?>

        </div>
        <div class="font-semibold 2xl:text-md text-sm"><?php echo e($players[1]->user->firstname); ?> <span class="hidden lg:block"><?php echo e($players[1]->user->lastname); ?></span></div>
        <div class="text-[10px] 2xl:text-sm text-gray-500"><?php echo e($players[1]->user->office); ?></div>
        <div class="flex items-center justify-center mt-1">
            <div class="bg-gray-400 rounded-2xl w-auto">
                <p class="text-sm font-bold pl-2 pr-2 2xl:text-lg"><?php echo e($players[1]->best_score); ?></p>
            </div>
        </div>
        <div class="flex items-center justify-center mt-2">
            <img src="/images/rewards/silver_cup.png" class="w-10 h-10 2xl:h-20 2xl:w-20 relative" alt="">
        </div>
    </div>

    <!-- 1st Place -->
    <div class="text-center animate-bounce bg-gradient-to-b transition-all hover:-translate-y-1 shadow-lg shadow-gold-600 from-gold-500 via-gold-700 to-gold-400 h-50 w-50 2xl:h-70 2xl:mt-10 2xl:w-45 rounded-2xl">
        <div class="bg-yellow-400 w-10 h-10 2xl:w-16 2xl:h-16 mt-5 rounded-full mx-auto mb-2 flex items-center justify-center">
            <?php if($players[0]->user->profileimage): ?>
                <img
                    src="<?php echo e(asset('storage/' . $players[0]->user->profileimage)); ?>"
                    alt="<?php echo e($players[2]->user->firstname); ?>'s Profile"
                    class="w-[36px] h-[36px] 2xl:w-[55px] 2xl:h-[55px] rounded-full object-cover border border-gray-300 dark:border-gray-700"
                >
            <?php else: ?>
                <img
                    src="<?php echo e(asset('images/default.png')); ?>"
                    alt="Default Profile"
                    class="w-[36px] h-[36px] 2xl:w-[55px] 2xl:h-[55px] rounded-full object-cover border border-gray-300 dark:border-gray-700"
                >
            <?php endif; ?>


        </div>
        <div class="font-semibold 2xl:text-md text-sm"><?php echo e($players[0]->user->firstname); ?> <span class="hidden lg:block"><?php echo e($players[0]->user->lastname); ?></span></div>
        <div class="text-sm text-gray-500"><?php echo e($players[0]->user->office); ?></div>
        <div class="flex items-center justify-center mt-1">
            <div class="bg-gold-600 rounded-2xl w-auto">
                <p class="text-sm font-bold pl-2 pr-2 2xl:text-lg"><?php echo e($players[0]->best_score); ?></p>
            </div>
        </div>
        <div class="flex items-center justify-center mt-2">
            <img src="/images/rewards/gold_cup.png" class="w-10 h-10 2xl:h-20 2xl:w-20 relative" alt="">
        </div>
    </div>

    <!-- 3rd Place -->
    <div class="text-center bg-gradient-to-b shadow-2xl shadow-bronze-500 from-bronze-400 via-bronze-500 to-bronze-400 h-50 w-50 2xl:h-70 2xl:mt-10 2xl:w-45 rounded-2xl">
        <div class="bg-orange-200 w-10 h-10 2xl:w-16 2xl:h-16 mt-5 rounded-full mx-auto mb-2 flex items-center justify-center">
            <?php if($players[2]->user->profileimage): ?>
            <img
                src="<?php echo e(asset('storage/' . $players[2]->user->profileimage)); ?>"
                alt="<?php echo e($players[2]->user->firstname); ?>'s Profile"
                class="w-[36px] h-[36px] 2xl:w-[55px] 2xl:h-[55px] rounded-full object-cover border border-gray-300 dark:border-gray-700"
            >
        <?php else: ?>
            <img
                src="<?php echo e(asset('images/default.png')); ?>"
                alt="Default Profile"
                class="w-[36px] h-[36px] 2xl:w-[55px] 2xl:h-[55px] rounded-full object-cover border border-gray-300 dark:border-gray-700"
            >
<?php endif; ?>

        </div>
        <div class="font-semibold 2xl:text-md text-sm"><?php echo e($players[2]->user->firstname); ?> <span class=" hidden lg:block"><?php echo e($players[2]->user->lastname); ?></span></div>
        <div class="text-[10px] 2xl:text-sm text-gray-500"><?php echo e($players[2]->user->office); ?></div>
        <div class="flex items-center justify-center mt-1">
            <div class="bg-bronze-600 rounded-2xl w-auto">
                <p class="text-lg font-bold pl-2 pr-2"><?php echo e($players[2]->best_score); ?></p>
            </div>
        </div>
        <div class="flex items-center justify-center mt-2">
            <img src="/images/rewards/bronze_cup.png" class="w-10 h-10 2xl:h-20 2xl:w-20 relative" alt="">
        </div>
    </div>
</div>

            
        </div>

        <!-- Wellness Stats -->
        <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">Your Wellness Journey</h2>
            <div class="grid grid-cols-2 gap-4">
                <?php
                    $stats = [
                        ['label' => 'Journal Entries', 'icon' => '📝', 'count' => $journalCount],
                        ['label' => 'Relaxation Sessions', 'icon' => '🌿', 'count' => 0],
                        ['label' => 'Quiz Points', 'icon' => '💡', 'count' => $quizCount],
                        ['label' => 'Nutrition Logs', 'icon' => '🍽️', 'count' => 0],
                    ];
                ?>

                <?php $__currentLoopData = $stats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="bg-gray-100 h-40 transition-all hover:-translate-y-2 dark:bg-gray-700 p-4 rounded-lg flex items-center gap-2 2xl:gap-4">
                        <div class="text-2xl"><?php echo e($stat['icon']); ?></div>
                        <div>
                            <div class="2xl:text-xl text-lg font-semibold"><?php echo e($stat['count']); ?></div>
                            <div class="text-sm 2xl:text-md dark:text-gray-100 text-gray-500"><?php echo e($stat['label']); ?></div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>

    
<div
    x-data="{ showAll: false }"
    class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow"
>
    <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4 border-b pb-2">
        News and Upcoming Events
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <?php $visibleCount = 0; ?>
        <?php $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($article->status === 'published'): ?>
                <?php $visibleCount++; ?>
                <div
                    class="transition-all hover:-translate-y-2 rounded-lg overflow-hidden shadow-sm bg-white dark:bg-gray-900"
                    x-show="showAll || <?php echo e($visibleCount); ?> <= 2"
                    x-transition
                >
                    <img src="<?php echo e(asset('storage/' . $article->image_url)); ?>"
                        alt="<?php echo e($article->title); ?>"
                        class="w-full h-50 object-cover">

                    <div class="p-4">
                        <h3 class="font-semibold text-lg"><?php echo e($article->title); ?></h3>
                        <p class="text-sm text-gray-500"><?php echo e($article->summary); ?></p>
                        <div class="text-sm mt-2 text-gray-400">
                            <?php echo e(\Carbon\Carbon::parse($article->event_date)->format('F j, Y')); ?>

                        </div>
                        <span class="text-green-600 text-sm font-medium">
                            <?php echo e($article->category); ?>

                        </span>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <?php if($articles->where('status', 'Publish')->count() > 2): ?>
        <div class="flex justify-center mt-4">
            <button
                @click="showAll = !showAll"
                class="px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg"
            >
                <span x-show="!showAll">See More</span>
                <span x-show="showAll">See Less</span>
            </button>
        </div>
    <?php endif; ?>
</div>



    
    <div class="rounded-xl overflow-hidden shadow-lg">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15934.604498153018!2d124.84789529567742!3d6.497323265799879!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x32f7fbb52b5b1461%3A0x2e59c8ed6e547f76!2sKoronadal%20City%2C%20South%20Cotabato!5e0!3m2!1sen!2sph!4v1691488144480!5m2!1sen!2sph"
            width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy">
        </iframe>
    </div>

</div>
<?php echo $__env->make('Auth.Users.partials.leaderboards', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('auth.users.partials.app.head', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\systems\DIT-Power\DTI-Power\resources\views/Auth/Users/view/index.blade.php ENDPATH**/ ?>