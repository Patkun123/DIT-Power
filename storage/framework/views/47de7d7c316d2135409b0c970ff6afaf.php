<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <title>Laravel</title>

        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">
        <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.46.0/dist/apexcharts.min.js"></script>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
        <?php echo app('flux')->fluxAppearance(); ?>

        <?php app('livewire')->forceAssetInjection(); ?>
<?php echo app('flux')->scripts(); ?>

                <style>
            html, body {
                max-width: 100%;
                overflow-x: hidden;
                scroll-behavior: smooth;
            }
        </style>
    </head>
    <body>
        <?php echo $__env->make('auth.users.partials.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
       <?php echo $__env->yieldContent('content'); ?>
    </body>
</html>
<?php /**PATH C:\xampp\htdocs\systems\DIT-Power\DTI-Power\resources\views/auth/users/partials/app/head.blade.php ENDPATH**/ ?>