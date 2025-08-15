<?php $__env->startSection('title', 'dashboard'); ?>
<?php echo $__env->make('auth.admin.partials.layouts.side', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php echo $__env->make('auth.admin.partials.layouts.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->startSection('content'); ?>
<div class="h-70 md:h-80 w-full bg-gradient-to-l from-primary-400 via-primary-600 to-lime-700">
    <div class="container mx-auto flex items-start justify-start h-full px-2 md:px-70">
        <div class="flex flex-col mt-40 md:mt-40">
            <h1 class="text-2xl md:text-4xl text-white">Welcome, <b><?php echo e(auth()->user()->lastname); ?></b></h1>
            <span class="text-white text-sm md:text-base mt-2">Manage your wellness platform with ease</span>
        </div>
    </div>
</div>

    <main class="p-4 md:ml-64 h-auto pt-5 bg-gray-200 dark:bg-gray-900">
      <div class="grid grid-cols-1 sm:grid-cols-2 transition-all hover:-translate-y-2 hover:shadow-emerald-500  shadow-md dark:bg-gray-800 border-2 dark:border-gray-800 bg-white p-3 rounded-xl lg:grid-cols-4 gap-4 mb-4">
        <div class="bg-gray-300 rounded-lg transition-all hover:-translate-y-2 hover:shadow-emerald-500 shadow-md dark:border-gray-600 h-32 md:h-35 flex items-center justify-center space-x-4 p-4">
            <?php if (isset($component)) { $__componentOriginalc04b147acd0e65cc1a77f86fb0e81580 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc04b147acd0e65cc1a77f86fb0e81580 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::button.index','data' => ['icon' => 'user-group','class' => 'shadow-xl shadow-gray-500 hover:bg-gray-200 hover:dark:bg-gray-700']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['icon' => 'user-group','class' => 'shadow-xl shadow-gray-500 hover:bg-gray-200 hover:dark:bg-gray-700']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc04b147acd0e65cc1a77f86fb0e81580)): ?>
<?php $attributes = $__attributesOriginalc04b147acd0e65cc1a77f86fb0e81580; ?>
<?php unset($__attributesOriginalc04b147acd0e65cc1a77f86fb0e81580); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc04b147acd0e65cc1a77f86fb0e81580)): ?>
<?php $component = $__componentOriginalc04b147acd0e65cc1a77f86fb0e81580; ?>
<?php unset($__componentOriginalc04b147acd0e65cc1a77f86fb0e81580); ?>
<?php endif; ?>
            <div>
                <h2 class="text-gray-950 dark:text-white text-lg font-semibold">Total Users</h2>
                <span class="text-gray-950 dark:text-gray-950 text-xl font-bold"><?php echo e($totalUsers ?? 0); ?></span>
            </div>
        </div>
        <div class="bg-gray-300 rounded-lg transition-all hover:-translate-y-2 hover:shadow-emerald-500  shadow-md border-gray-300 dark:border-gray-600 h-32 md:h-35 items-center flex justify-center">
            <?php if (isset($component)) { $__componentOriginalc04b147acd0e65cc1a77f86fb0e81580 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc04b147acd0e65cc1a77f86fb0e81580 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::button.index','data' => ['icon' => 'clipboard','class' => 'shadow-xl shadow-gray-500 hover:bg-gray-200 hover:dark:bg-gray-700']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['icon' => 'clipboard','class' => 'shadow-xl shadow-gray-500 hover:bg-gray-200 hover:dark:bg-gray-700']); ?>
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc04b147acd0e65cc1a77f86fb0e81580)): ?>
<?php $attributes = $__attributesOriginalc04b147acd0e65cc1a77f86fb0e81580; ?>
<?php unset($__attributesOriginalc04b147acd0e65cc1a77f86fb0e81580); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc04b147acd0e65cc1a77f86fb0e81580)): ?>
<?php $component = $__componentOriginalc04b147acd0e65cc1a77f86fb0e81580; ?>
<?php unset($__componentOriginalc04b147acd0e65cc1a77f86fb0e81580); ?>
<?php endif; ?>
        </div>
        <div class="bg-gray-300 rounded-lg transition-all hover:-translate-y-2 hover:shadow-emerald-500  shadow-md border-gray-300 dark:border-gray-600 h-32 md:h-35 items-center flex justify-center">
            <?php if (isset($component)) { $__componentOriginalc04b147acd0e65cc1a77f86fb0e81580 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc04b147acd0e65cc1a77f86fb0e81580 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::button.index','data' => ['icon' => 'megaphone','class' => 'shadow-xl shadow-gray-500 hover:bg-gray-200 hover:dark:bg-gray-700']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['icon' => 'megaphone','class' => 'shadow-xl shadow-gray-500 hover:bg-gray-200 hover:dark:bg-gray-700']); ?>
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc04b147acd0e65cc1a77f86fb0e81580)): ?>
<?php $attributes = $__attributesOriginalc04b147acd0e65cc1a77f86fb0e81580; ?>
<?php unset($__attributesOriginalc04b147acd0e65cc1a77f86fb0e81580); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc04b147acd0e65cc1a77f86fb0e81580)): ?>
<?php $component = $__componentOriginalc04b147acd0e65cc1a77f86fb0e81580; ?>
<?php unset($__componentOriginalc04b147acd0e65cc1a77f86fb0e81580); ?>
<?php endif; ?>
        </div>
        <div class="bg-gray-300 rounded-lg transition-all hover:-translate-y-2 hover:shadow-emerald-500  shadow-md border-gray-300 dark:border-gray-600 h-32 md:h-35 items-center flex justify-center">
            <?php if (isset($component)) { $__componentOriginalc04b147acd0e65cc1a77f86fb0e81580 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc04b147acd0e65cc1a77f86fb0e81580 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::button.index','data' => ['icon' => 'newspaper','class' => 'shadow-xl shadow-gray-500 hover:bg-gray-200 hover:dark:bg-gray-700']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['icon' => 'newspaper','class' => 'shadow-xl shadow-gray-500 hover:bg-gray-200 hover:dark:bg-gray-700']); ?>
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc04b147acd0e65cc1a77f86fb0e81580)): ?>
<?php $attributes = $__attributesOriginalc04b147acd0e65cc1a77f86fb0e81580; ?>
<?php unset($__attributesOriginalc04b147acd0e65cc1a77f86fb0e81580); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc04b147acd0e65cc1a77f86fb0e81580)): ?>
<?php $component = $__componentOriginalc04b147acd0e65cc1a77f86fb0e81580; ?>
<?php unset($__componentOriginalc04b147acd0e65cc1a77f86fb0e81580); ?>
<?php endif; ?>
        </div>
      </div>
      <div class="grid grid-cols-2 gap-4 mb-4 ">
        <div class=" p-4 md:p-6 bg-white dark:bg-gray-800 rounded-lg transition-all hover:-translate-y-2 hover:shadow-emerald-500  shadow-md dark:shadow-gray-700  h-100 md:h-auto">
            <?php echo $__env->make('auth.admin.partials.layouts.app.graph', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
        <div class=" p-10 md:p-4 bg-white dark:bg-gray-800 rounded-lg transition-all hover:-translate-y-2 hover:shadow-emerald-500  shadow-md dark:shadow-gray-700  h-auto md:h-auto">
            <?php echo $__env->make('auth.admin.partials.layouts.app.bargraph', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
      </div>
      
      
    </main>
  </div>

  <script>
    if (document.getElementById("area-chart") && typeof ApexCharts !== 'undefined') {
    const options = {
        chart: { height: "73%", maxWidth: "100%", type: "area", fontFamily: "Inter, sans-serif", dropShadow: { enabled: false }, toolbar: { show: false } },
        series: [{
            name: "New users",
            data: <?php echo json_encode($weeklyData, 15, 512) ?>,
            color: "#1A56DB",
        }],
        xaxis: {
            categories: <?php echo json_encode($weeklyLabels, 15, 512) ?>,
            labels: { show: false },
            axisBorder: { show: false },
            axisTicks: { show: false },
        },
        fill: {
            type: "gradient",
            gradient: {
                opacityFrom: 0.55,
                opacityTo: 0,
                shade: "#1C64F2",
                gradientToColors: ["#1C64F2"],
            },
        },
        stroke: { width: 6 },
        grid: { show: false, strokeDashArray: 4, padding: { left: 2, right: 2, top: 0 } },
        dataLabels: { enabled: false },
        tooltip: { enabled: true, x: { show: false } },
        yaxis: { show: false },
    };

    const chart = new ApexCharts(document.getElementById("area-chart"), options);
    chart.render();
}

  </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('auth.admin.partials.layouts.app.head', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\systems\DIT-Power\DTI-Power\resources\views/auth/admin/view/dashboard.blade.php ENDPATH**/ ?>