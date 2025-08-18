<div class="p-6 space-y-6 bg-gray-50 dark:bg-gray-900 min-h-screen">
    <!-- Summary -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow text-center">
            <h2 class="font-semibold">Total Income</h2>
            <p class="text-green-600 text-xl font-bold">₱{{ number_format($totalIncome, 2) }}</p>
        </div>
        <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow text-center">
            <h2 class="font-semibold">Total Expenses</h2>
            <p class="text-red-600 text-xl font-bold">₱{{ number_format($totalExpenses, 2) }}</p>
        </div>
        <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow text-center">
            <h2 class="font-semibold">Net Balance</h2>
            <p class="text-indigo-600 text-xl font-bold">₱{{ number_format($netBalance, 2) }}</p>
        </div>
    </div>

    <!-- Forms -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Add Income -->
        <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow">
            <h2 class="font-semibold mb-2">Add Income</h2>
            <input type="number" wire:model="incomeAmount" class="w-full mb-2 dark:bg-gray-900 input input-bordered" placeholder="Amount">
            <button wire:click="addIncome" class="w-full bg-green-500 hover:bg-green-600 text-white py-2 rounded">
                Add Income
            </button>
        </div>

        <!-- Add Expense -->
        <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow">
            <h2 class="font-semibold mb-2">Add Expense</h2>
            <input type="number" wire:model="expenseAmount" class="w-full mb-2 dark:bg-gray-900 input input-bordered" placeholder="Amount">
            <select wire:model="expenseCategory" class="w-full dark:bg-gray-900 mb-2 input input-bordered">
                <option>Food</option>
                <option>Transport</option>
                <option>Utilities</option>
            </select>
            <button wire:click="addExpense" class="w-full bg-green-500 dark:bg-gray-900 hover:bg-green-600 text-white py-2 rounded">
                Add Expense
            </button>
        </div>

        <!-- Set Budget -->
        <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow">
            <h2 class="font-semibold mb-2">Set Budget</h2>
            <select wire:model="budgetCategory" class="w-full dark:bg-gray-900 mb-2 input input-bordered">
                <option>Food</option>
                <option>Transport</option>
                <option>Utilities</option>
            </select>
            <input type="number" wire:model="monthlyBudget" class="w-full mb-2 dark:bg-gray-900 input input-bordered" placeholder="Monthly Budget">
            <button wire:click="setBudget" class="w-full bg-green-500 hover:bg-green-600 text-white py-2 rounded">
                Set Budget
            </button>
        </div>
    </div>

    <!-- Bottom Section -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Expense Breakdown -->
        <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow">
            <h2 class="font-semibold">Expense Breakdown</h2>
            <div class="text-gray-500 text-sm mt-2">[Chart Placeholder]</div>
        </div>

        <!-- Budget vs Actual -->
        <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow">
            <h2 class="font-semibold">Budget vs Actual</h2>
            <div class="text-gray-500 text-sm mt-2">[Chart Placeholder]</div>
        </div>

        <!-- Financial Goals -->
        <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow">
            <h2 class="font-semibold mb-2">Financial Goals</h2>
            <input type="text" wire:model="goalName" class="w-full mb-2 input dark:bg-gray-800 input-bordered" placeholder="Goal Name">
            <input type="number" wire:model="goalAmount" class="w-full mb-2 input input-bordered dark:bg-gray-800" placeholder="Target Amount">
            <input type="date" wire:model="goalDate" class="w-full mb-2 input dark:bg-gray-800  input-bordered">
            <button wire:click="addGoal" class="w-full bg-green-500 hover:bg-green-600 text-white py-2 rounded">
                Add Goal
            </button>
        </div>
    </div>

    @if (session()->has('message'))
        <div class="mt-4 p-3 bg-green-100 text-green-700 rounded">
            {{ session('message') }}
        </div>
    @endif
</div>
