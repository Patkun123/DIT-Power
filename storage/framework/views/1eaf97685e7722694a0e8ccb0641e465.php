<?php $__env->startSection('title', 'Tools'); ?>
<?php $__env->startSection('content'); ?>
<div class="bg-gray-50 dark:bg-gray-900 min-h-screen flex flex-col items-center py-10">
    <h1 class="text-4xl font-bold dark:text-gray-50 text-gray-900 mb-2">Physical Wellness Tools</h1>
    <div class="w-50 h-1 bg-primary-500 rounded mb-8"></div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl w-full px-4">

        <!-- BMI Calculator -->
        <div class="bg-white dark:bg-gray-800 rounded-xl transition-all hover:shadow-xl hover:-translate-y-1 shadow-primary-500 shadow p-6">
            <div class="flex items-center mb-4">
                 &nbsp;
                <h2 class="font-bold text-lg">BMI Calculator</h2>
            </div>
            <form method="POST" action="<?php echo e(route('calculate.bmi')); ?>">
                <?php echo csrf_field(); ?>
                <div class="mb-4">
                    <label class="block text-gray-600 dark:text-gray-200 mb-2">Weight (kg)</label>
                    <input type="number" name="weight" class="w-full rounded-lg shadow-sm dark:bg-gray-900 border-gray-700 focus:ring-primary-500 focus:border-primary-500">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-600 dark:text-gray-200 mb-2">Height (cm)</label>
                    <input type="number" name="height" class="w-full rounded-lg shadow-sm dark:bg-gray-900 border-gray-700 focus:ring-primary-500 focus:border-primary-500">
                </div>
                <button type="submit" class="w-full bg-primary-500 hover:bg-primary-600 text-white py-3 rounded-lg font-semibold">Calculate BMI</button>
            </form>
            <?php if(session('bmi')): ?>
                <div class="mt-4 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg text-gray-700 dark:text-gray-200 text-center">
                    <strong><?php echo e(session('bmi')); ?></strong> - <?php echo e(session('status')); ?>

                </div>
            <?php endif; ?>
        </div>

        <!-- Meditation Timer -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6 flex flex-col items-center">
            <div class="flex items-center mb-4">
                <span class="text-green-600 mr-2">🕒</span>
                <h2 class="font-bold text-lg">Meditation Timer</h2>
            </div>
            <div id="timerDisplay" class="text-4xl font-mono mb-6 dark:text-white">00:00</div>
            <div class="grid grid-cols-2 gap-4 w-full mb-4">
                <button type="button" onclick="setTimer(5)" class="bg-green-500 hover:bg-green-600 text-white py-2 rounded-lg">5 min</button>
                <button type="button" onclick="setTimer(10)" class="bg-green-500 hover:bg-green-600 text-white py-2 rounded-lg">10 min</button>
                <button type="button" onclick="setTimer(15)" class="bg-green-500 hover:bg-green-600 text-white py-2 rounded-lg">15 min</button>
                <button type="button" onclick="stopTimer()" class="bg-green-500 hover:bg-green-600 text-white py-2 rounded-lg">Stop</button>
            </div>
            <button type="button" onclick="startTimer()" class="w-full bg-green-500 hover:bg-green-600 text-white py-2 rounded-lg">Start</button>
        </div>

        <!-- Quick Notes -->
        <div class="bg-white dark:bg-gray-800 transition-all hover:shadow-xl hover:-translate-y-1 shadow-primary-500 rounded-xl shadow p-6">
            <div class="flex items-center mb-4">
                <span class="text-primary-600 mr-2">🗒️</span>
                <h2 class="font-bold text-lg">Quick Notes</h2>
            </div>
            <div class="p-3 bg-gray-50 dark:bg-gray-900 rounded-lg flex justify-between items-center mb-4">
                <span class="text-gray-700 dark:text-gray-200">Sample note</span>
                <div class="flex space-x-2">
                    <button class="text-gray-500 hover:text-primary-500">✏️</button>
                    <button class="text-gray-500 hover:text-red-500">🗑️</button>
                </div>
            </div>
            <button class="w-full bg-primary-500 hover:bg-primary-600 text-white py-3 rounded-lg font-semibold">Add Note</button>
        </div>

    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
let timerInterval;
let timeLeft = 0;

function setTimer(minutes) {
    clearInterval(timerInterval); // stop previous timer
    timeLeft = minutes * 60;     // convert minutes to seconds
    updateTimerDisplay();
}

function startTimer() {
    clearInterval(timerInterval);
    if (timeLeft <= 0) return; // nothing to start

    timerInterval = setInterval(() => {
        if (timeLeft <= 0) {
            clearInterval(timerInterval);
            alert("Time's up! 🧘‍♂️"); // optional alert when finished
        } else {
            timeLeft--;
            updateTimerDisplay();
        }
    }, 1000);
}

function stopTimer() {
    clearInterval(timerInterval);
    timeLeft = 0;
    updateTimerDisplay();
}

function updateTimerDisplay() {
    let minutes = Math.floor(timeLeft / 60);
    let seconds = timeLeft % 60;
    document.getElementById('timerDisplay').textContent =
        String(minutes).padStart(2, '0') + ':' + String(seconds).padStart(2, '0');
}

// Initialize display to 00:00 on page load
updateTimerDisplay();
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('auth.users.partials.app.head', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\systems\DIT-Power\DTI-Power\resources\views/auth/users/view/physicaltools.blade.php ENDPATH**/ ?>