<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">

        <script src="<?php echo e(asset('include/flowbite.js')); ?>"></script>
        <script src="<?php echo e(asset('include/apexcharts.js')); ?>"></script>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
        <?php echo app('flux')->fluxAppearance(); ?>

        <?php app('livewire')->forceAssetInjection(); ?>
<?php echo app('flux')->scripts(); ?>

    </head>
    <Body>
        <?php echo $__env->make('sweetalert2::index', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php echo $__env->yieldContent('content'); ?>
        <?php echo $__env->make('Auth.Admin.partials.modals.user-add', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('admin.question-add');

$__html = app('livewire')->mount($__name, $__params, 'lw-1226980177-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>




    </Body>

</html>
<?php /**PATH C:\xampp\htdocs\systems\DIT-Power\DTI-Power\resources\views/auth/admin/partials/layouts/app/head.blade.php ENDPATH**/ ?>