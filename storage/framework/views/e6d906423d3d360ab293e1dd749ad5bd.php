<div>
    <?php
        $moods = [
            ['emoji' => '😊', 'value' => 'happy'],
            ['emoji' => '😌', 'value' => 'calm'],
            ['emoji' => '😟', 'value' => 'sad'],
            ['emoji' => '😠', 'value' => 'angry'],
            ['emoji' => '😰', 'value' => 'anxious'],
        ];
    ?>

    <!-- hidden input so mood is included in form submission -->
    <input type="hidden" name="feeling" value="<?php echo e($selectedMood); ?>">

    <div class="flex items-center space-x-2.5 sm:space-x-6">
        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $moods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mood): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <button
                type="button"
                wire:click="selectMood('<?php echo e($mood['value']); ?>')"
                class="text-3xl p-3 rounded-full transition
                       <?php if($selectedMood === $mood['value']): ?> bg-gray-200 dark:bg-gray-700 <?php endif; ?>
                       hover:bg-gray-100 dark:hover:bg-gray-600"
            >
                <?php echo e($mood['emoji']); ?>

            </button>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\systems\DIT-Power\DTI-Power\resources\views/livewire/mood-selector.blade.php ENDPATH**/ ?>