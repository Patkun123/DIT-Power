<div class="max-w-md mx-auto p-4 border rounded-lg">
    <form wire:submit.prevent="calculate">
        <div class="mb-3">
            <label class="block mb-1 font-medium">Unit</label>
            <select wire:model="unit" class="w-full p-2 border rounded">
                <option value="metric">Metric (kg, cm)</option>
                <option value="imperial">Imperial (lb, in)</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="block mb-1">
                Weight (<?php echo e(($unit ?? 'metric') === 'metric' ? 'kg' : 'lb'); ?>)
            </label>
            <input type="number" step="any" wire:model.lazy="weight" class="w-full p-2 border rounded" />
            <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['weight'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-600 text-sm"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
        </div>

        <div class="mb-3">
            <label class="block mb-1">
                Height (<?php echo e(($unit ?? 'metric') === 'metric' ? 'cm' : 'in'); ?>)
            </label>
            <input type="number" step="any" wire:model.lazy="height" class="w-full p-2 border rounded" />
            <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['height'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-600 text-sm"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
        </div>

        <div class="flex gap-2">
            <button type="submit" class="px-4 py-2 rounded shadow">Calculate</button>
            <button type="button" wire:click="resetForm" class="px-4 py-2 rounded border">Reset</button>
        </div>
    </form>

<!--[if BLOCK]><![endif]--><?php if(!is_null($bmi)): ?>
    <div class="mt-4 p-3 bg-gray-50 rounded">
        <div class="text-lg font-semibold">Your BMI: <?php echo e($bmi); ?></div>
        <div class="text-sm text-gray-700">Category: <?php echo e($category); ?></div>
    </div>
<?php endif; ?><!--[if ENDBLOCK]><![endif]-->

</div><?php /**PATH C:\xampp\htdocs\systems\DIT-Power\resources\views\livewire/bmi-calculator.blade.php ENDPATH**/ ?>