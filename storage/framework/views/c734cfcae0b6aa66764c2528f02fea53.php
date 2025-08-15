<?php $__env->startSection('title', 'Managequiz'); ?>
<?php echo $__env->make('auth.admin.partials.layouts.side', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php echo $__env->make('auth.admin.partials.layouts.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->startSection('content'); ?>
<div class="h-70 md:h-80 w-full bg-gradient-to-l from-primary-400 via-primary-600 to-lime-700">
    <div class="container mx-auto flex items-start justify-start h-full px-2 md:px-70">
        <div class="flex flex-col mt-40 md:mt-40">
            <h1 class="text-2xl md:text-4xl text-white"><?php echo e(auth()->user()->lastname); ?>, <b>Quiz Management</b></h1>
            <span class="text-white text-sm md:text-base mt-2">Manage health quiz with ease</span>
        </div>
    </div>
</div>
 <main class="p-4 md:ml-64 h-auto pt-4">
    <div class="grid grid-cols-1 sm:grid-cols-2 transition-all hover:-translate-y-2 hover:shadow-emerald-500  shadow-md dark:bg-gray-800 border-2 dark:border-gray-800 bg-white p-3 rounded-xl lg:grid-cols-4 gap-4 mb-4">
        <div class="bg-gray-300 rounded-lg transition-all hover:-translate-y-2 hover:shadow-emerald-500  shadow-md dark:border-gray-600 h-32 md:h-35 items-center flex justify-center">
        </div>
        <div class="bg-gray-300 rounded-lg transition-all hover:-translate-y-2 hover:shadow-emerald-500  shadow-md dark:border-gray-600 h-32 md:h-35 items-center flex justify-center">
        </div>
        <div class="bg-gray-300 rounded-lg transition-all hover:-translate-y-2 hover:shadow-emerald-500  shadow-md dark:border-gray-600 h-32 md:h-35 items-center flex justify-center">
        </div>
        <div class="bg-gray-300 rounded-lg transition-all hover:-translate-y-2 hover:shadow-emerald-500  shadow-md dark:border-gray-600 h-32 md:h-35 items-center flex justify-center">
        </div>
      </div>
      <div class="bg-white dark:bg-gray-800 relative sm:rounded-lg overflow-hidden rounded-lg transition-all hover:-translate-y-2 hover:shadow-emerald-500  shadow-md border-gray-300 dark:border-gray-600 h-[calc(42vh+1rem)] mb-4">
        <?php echo $__env->make('auth.admin.partials.layouts.app.tables.question-list', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
      </div>
    </main>
 
<?php $__env->stopSection(); ?>


<?php echo $__env->make('auth.admin.partials.layouts.app.head', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\systems\DIT-Power\DTI-Power\resources\views/Auth/Admin/view/managequiz.blade.php ENDPATH**/ ?>