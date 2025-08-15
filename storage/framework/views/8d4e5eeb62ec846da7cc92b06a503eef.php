<?php $__env->startSection('title', 'Quiz'); ?>
<?php $__env->startSection('content'); ?>

<?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('quiz.index');

$__html = app('livewire')->mount($__name, $__params, 'lw-2376592679-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
<?php echo $__env->make('Auth.Users.partials.leaderboards', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('auth.users.partials.app.head', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\systems\DIT-Power\DTI-Power\resources\views/Auth/Users/view/quiz.blade.php ENDPATH**/ ?>