<div class="p-6 space-y-6 bg-gray-50 dark:bg-gray-900 min-h-screen">
    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-gradient-to-br from-green-500 to-green-600 dark:from-green-600 dark:to-green-700 p-6 rounded-2xl shadow-lg text-white">
            <h2 class="text-sm font-medium opacity-90 mb-2">Total Income</h2>
            <p class="text-3xl font-bold">₱{{ number_format($totalIncome, 2) }}</p>
            <p class="text-xs opacity-75 mt-1">This Month</p>
        </div>
        <div class="bg-gradient-to-br from-red-500 to-red-600 dark:from-red-600 dark:to-red-700 p-6 rounded-2xl shadow-lg text-white">
            <h2 class="text-sm font-medium opacity-90 mb-2">Total Expenses</h2>
            <p class="text-3xl font-bold">₱{{ number_format($totalExpenses, 2) }}</p>
            <p class="text-xs opacity-75 mt-1">This Month</p>
        </div>
        <div class="bg-gradient-to-br from-indigo-500 to-indigo-600 dark:from-indigo-600 dark:to-indigo-700 p-6 rounded-2xl shadow-lg text-white">
            <h2 class="text-sm font-medium opacity-90 mb-2">Net Balance</h2>
            <p class="text-3xl font-bold">₱{{ number_format($netBalance, 2) }}</p>
            <p class="text-xs opacity-75 mt-1">{{ $netBalance >= 0 ? 'Positive' : 'Negative' }}</p>
        </div>
    </div>

    <!-- Forms -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Add Income -->
        <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700">
            <h2 class="text-xl font-bold mb-4 text-gray-900 dark:text-white">Add Income</h2>
            <div class="space-y-3">
                <input type="number" step="0.01" wire:model="incomeAmount" class="w-full px-4 py-3 border-2 border-gray-200 dark:border-gray-700 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-200 dark:focus:ring-primary-900 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 transition-all duration-200 focus:outline-none" placeholder="Amount (₱)">
                <input type="text" wire:model="incomeSource" class="w-full px-4 py-3 border-2 border-gray-200 dark:border-gray-700 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-200 dark:focus:ring-primary-900 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 transition-all duration-200 focus:outline-none" placeholder="Source (e.g., Salary, Freelance)">
                <textarea wire:model="incomeDescription" rows="2" class="w-full px-4 py-3 border-2 border-gray-200 dark:border-gray-700 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-200 dark:focus:ring-primary-900 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 transition-all duration-200 focus:outline-none resize-none" placeholder="Description (optional)"></textarea>
                <button wire:click="addIncome" class="w-full py-3 px-4 bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-semibold rounded-xl shadow-md hover:shadow-lg transition-all duration-200">
                    Add Income
                </button>
            </div>
        </div>

        <!-- Add Expense -->
        <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700">
            <h2 class="text-xl font-bold mb-4 text-gray-900 dark:text-white">Add Expense</h2>
            <div class="space-y-3">
                <input type="number" step="0.01" wire:model="expenseAmount" class="w-full px-4 py-3 border-2 border-gray-200 dark:border-gray-700 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-200 dark:focus:ring-primary-900 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 transition-all duration-200 focus:outline-none" placeholder="Amount (₱)">
                <select wire:model="expenseCategory" class="w-full px-4 py-3 border-2 border-gray-200 dark:border-gray-700 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-200 dark:focus:ring-primary-900 bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-all duration-200 focus:outline-none">
                    <option value="">Select Category</option>
                    <option value="Food">Food</option>
                    <option value="Transport">Transport</option>
                    <option value="Utilities">Utilities</option>
                    <option value="Entertainment">Entertainment</option>
                    <option value="Shopping">Shopping</option>
                    <option value="Healthcare">Healthcare</option>
                    <option value="Education">Education</option>
                    <option value="Other">Other</option>
                </select>
                <textarea wire:model="expenseDescription" rows="2" class="w-full px-4 py-3 border-2 border-gray-200 dark:border-gray-700 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-200 dark:focus:ring-primary-900 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 transition-all duration-200 focus:outline-none resize-none" placeholder="Description (optional)"></textarea>
                <button wire:click="addExpense" class="w-full py-3 px-4 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-semibold rounded-xl shadow-md hover:shadow-lg transition-all duration-200">
                    Add Expense
                </button>
            </div>
        </div>

        <!-- Set Budget -->
        <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700">
            <h2 class="text-xl font-bold mb-4 text-gray-900 dark:text-white">Set Budget</h2>
            <div class="space-y-3">
                <select wire:model="budgetCategory" class="w-full px-4 py-3 border-2 border-gray-200 dark:border-gray-700 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-200 dark:focus:ring-primary-900 bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-all duration-200 focus:outline-none">
                    <option value="">Select Category</option>
                    <option value="Food">Food</option>
                    <option value="Transport">Transport</option>
                    <option value="Utilities">Utilities</option>
                    <option value="Entertainment">Entertainment</option>
                    <option value="Shopping">Shopping</option>
                    <option value="Healthcare">Healthcare</option>
                    <option value="Education">Education</option>
                </select>
                <input type="number" step="0.01" wire:model="monthlyBudget" class="w-full px-4 py-3 border-2 border-gray-200 dark:border-gray-700 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-200 dark:focus:ring-primary-900 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 transition-all duration-200 focus:outline-none" placeholder="Monthly Budget (₱)">
                <button wire:click="setBudget" class="w-full py-3 px-4 bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 text-white font-semibold rounded-xl shadow-md hover:shadow-lg transition-all duration-200">
                    Set Budget
                </button>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Expense Breakdown Chart -->
        <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700">
            <h2 class="text-xl font-bold mb-4 text-gray-900 dark:text-white">Expense Breakdown by Category</h2>
            <div class="h-64 flex items-center justify-center">
                <canvas id="expenseChart" width="400" height="200"></canvas>
            </div>
        </div>

        <!-- Budget vs Actual Chart -->
        <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700">
            <h2 class="text-xl font-bold mb-4 text-gray-900 dark:text-white">Budget vs Actual</h2>
            <div class="h-64 flex items-center justify-center">
                <canvas id="budgetChart" width="400" height="200"></canvas>
            </div>
        </div>
    </div>

    <!-- Financial Goals -->
    <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700">
        <h2 class="text-xl font-bold mb-4 text-gray-900 dark:text-white">Financial Goals</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Add Goal Form -->
            <div class="space-y-3">
                <input type="text" wire:model="goalName" class="w-full px-4 py-3 border-2 border-gray-200 dark:border-gray-700 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-200 dark:focus:ring-primary-900 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 transition-all duration-200 focus:outline-none" placeholder="Goal Name">
                <input type="number" step="0.01" wire:model="goalAmount" class="w-full px-4 py-3 border-2 border-gray-200 dark:border-gray-700 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-200 dark:focus:ring-primary-900 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 transition-all duration-200 focus:outline-none" placeholder="Target Amount (₱)">
                <input type="date" wire:model="goalDate" class="w-full px-4 py-3 border-2 border-gray-200 dark:border-gray-700 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-200 dark:focus:ring-primary-900 bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-all duration-200 focus:outline-none">
                <textarea wire:model="goalDescription" rows="2" class="w-full px-4 py-3 border-2 border-gray-200 dark:border-gray-700 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-200 dark:focus:ring-primary-900 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 transition-all duration-200 focus:outline-none resize-none" placeholder="Description (optional)"></textarea>
                <button wire:click="addGoal" class="w-full py-3 px-4 bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 text-white font-semibold rounded-xl shadow-md hover:shadow-lg transition-all duration-200">
                    Add Goal
                </button>
            </div>

            <!-- Goals List -->
            <div class="space-y-3 max-h-96 overflow-y-auto">
                @forelse($goals as $goal)
                <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-xl border border-gray-200 dark:border-gray-600">
                    <div class="flex items-start justify-between mb-2">
                        <div class="flex-1">
                            <h3 class="font-semibold text-gray-900 dark:text-white mb-1">{{ $goal->goal_name }}</h3>
                            @if($goal->description)
                            <p class="text-xs text-gray-600 dark:text-gray-400 mb-2">{{ $goal->description }}</p>
                            @endif
                        </div>
                        <div class="flex items-center space-x-2">
                            @if($goal->status === 'active')
                            <button wire:click="completeGoal({{ $goal->id }})" class="text-green-600 dark:text-green-400 hover:text-green-700" title="Mark as Complete">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </button>
                            @endif
                            <button wire:click="deleteGoal({{ $goal->id }})" class="text-red-600 dark:text-red-400 hover:text-red-700" title="Delete Goal" onclick="return confirm('Are you sure you want to delete this goal?')">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                    
                    @if($editingGoalId === $goal->id)
                    <!-- Edit Progress Form -->
                    <div class="mb-3 p-3 bg-white dark:bg-gray-800 rounded-lg border border-primary-300 dark:border-primary-700">
                        <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-2">Update Progress (₱)</label>
                        <div class="flex space-x-2">
                            <input type="number" step="0.01" wire:model="goalProgressAmount" class="flex-1 px-3 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-lg focus:border-primary-500 focus:ring-1 focus:ring-primary-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                            <button wire:click="updateGoalProgress({{ $goal->id }})" class="px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white text-sm rounded-lg transition-colors">
                                Save
                            </button>
                            <button wire:click="cancelEditGoal" class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white text-sm rounded-lg transition-colors">
                                Cancel
                            </button>
                        </div>
                    </div>
                    @endif
                    
                    <div class="mb-2">
                        <div class="flex justify-between text-sm text-gray-600 dark:text-gray-400 mb-1">
                            <span>₱{{ number_format((float)$goal->current_amount, 2) }} / ₱{{ number_format((float)$goal->target_amount, 2) }}</span>
                            <span class="font-semibold">{{ number_format((float)$goal->progress_percentage, 1) }}%</span>
                        </div>
                        <div class="w-full bg-gray-200 dark:bg-gray-600 rounded-full h-3 mb-2">
                            @php
                                $progress = min(100, max(0, (float)$goal->progress_percentage));
                                $colorClass = $progress >= 100 ? 'from-green-500 to-green-600' : ($progress >= 75 ? 'from-yellow-500 to-yellow-600' : 'from-purple-500 to-purple-600');
                            @endphp
                            <div class="bg-gradient-to-r {{ $colorClass }} h-3 rounded-full transition-all duration-300" style="width: {{ $progress }}%"></div>
                        </div>
                        @if($goal->status === 'active' && $editingGoalId !== $goal->id)
                        <button wire:click="editGoal({{ $goal->id }})" class="text-xs text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300">
                            Update Progress
                        </button>
                        @endif
                    </div>
                    
                    <div class="flex items-center justify-between text-xs text-gray-500 dark:text-gray-400">
                        <span>Target: {{ \Carbon\Carbon::parse($goal->target_date)->format('M d, Y') }}</span>
                        @if($goal->status === 'completed')
                        <span class="px-2 py-1 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 rounded-full font-medium">Completed</span>
                        @else
                        @php
                            $daysLeft = \Carbon\Carbon::parse($goal->target_date)->diffInDays(\Carbon\Carbon::today(), false);
                        @endphp
                        @if($daysLeft < 0)
                        <span class="text-red-600 dark:text-red-400">Overdue by {{ abs($daysLeft) }} days</span>
                        @else
                        <span>{{ $daysLeft }} days left</span>
                        @endif
                        @endif
                    </div>
                </div>
                @empty
                <div class="text-center py-12">
                    <svg class="w-16 h-16 mx-auto text-gray-400 dark:text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                    </svg>
                    <p class="text-gray-500 dark:text-gray-400">No active goals yet. Add one to get started!</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    @if (session()->has('message'))
        <div class="fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 animate-fade-in">
            {{ session('message') }}
        </div>
    @endif
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Expense Breakdown Chart (Pie Chart)
        const expenseCtx = document.getElementById('expenseChart');
        if (expenseCtx) {
            const expenseData = @json($expenseByCategory);
            const labels = expenseData.map(item => item.category);
            const amounts = expenseData.map(item => parseFloat(item.total));

            new Chart(expenseCtx, {
                type: 'doughnut',
                data: {
                    labels: labels.length > 0 ? labels : ['No Data'],
                    datasets: [{
                        data: amounts.length > 0 ? amounts : [1],
                        backgroundColor: [
                            '#EF4444', '#F59E0B', '#10B981', '#3B82F6',
                            '#8B5CF6', '#EC4899', '#14B8A6', '#F97316'
                        ],
                        borderWidth: 2,
                        borderColor: '#ffffff'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 15,
                                usePointStyle: true
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return context.label + ': ₱' + context.parsed.toFixed(2);
                                }
                            }
                        }
                    }
                }
            });
        }

        // Budget vs Actual Chart (Bar Chart)
        const budgetCtx = document.getElementById('budgetChart');
        if (budgetCtx) {
            const budgetData = @json($budgetVsActual);
            const categories = budgetData.map(item => item.category);
            const budgets = budgetData.map(item => parseFloat(item.budget));
            const actuals = budgetData.map(item => parseFloat(item.actual));

            new Chart(budgetCtx, {
                type: 'bar',
                data: {
                    labels: categories.length > 0 ? categories : ['No Data'],
                    datasets: [
                        {
                            label: 'Budget',
                            data: budgets.length > 0 ? budgets : [0],
                            backgroundColor: 'rgba(59, 130, 246, 0.6)',
                            borderColor: 'rgba(59, 130, 246, 1)',
                            borderWidth: 2
                        },
                        {
                            label: 'Actual',
                            data: actuals.length > 0 ? actuals : [0],
                            backgroundColor: 'rgba(239, 68, 68, 0.6)',
                            borderColor: 'rgba(239, 68, 68, 1)',
                            borderWidth: 2
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return context.dataset.label + ': ₱' + context.parsed.y.toFixed(2);
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return '₱' + value.toFixed(2);
                                }
                            }
                        }
                    }
                }
            });
        }
    });
</script>
@endpush
