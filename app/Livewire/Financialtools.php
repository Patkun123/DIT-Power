<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\FinancialIncome;
use App\Models\FinancialExpense;
use App\Models\FinancialBudget;
use App\Models\FinancialGoal;
use Carbon\Carbon;

class FinancialTools extends Component
{
    public $totalIncome = 0;
    public $totalExpenses = 0;
    public $netBalance = 0;

    public $incomeAmount;
    public $incomeSource;
    public $incomeDescription;
    public $expenseAmount;
    public $expenseCategory;
    public $expenseDescription;
    public $budgetCategory;
    public $monthlyBudget;
    public $goalName;
    public $goalAmount;
    public $goalDate;
    public $goalDescription;

    public $incomes = [];
    public $expenses = [];
    public $budgets = [];
    public $goals = [];

    public function mount()
    {
        if (Auth::check()) {
            $this->loadData();
        }
    }

    public function loadData()
    {
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        // Load current month data
        $this->totalIncome = FinancialIncome::where('user_id', Auth::id())
            ->whereYear('income_date', $currentYear)
            ->whereMonth('income_date', $currentMonth)
            ->sum('amount');

        $this->totalExpenses = FinancialExpense::where('user_id', Auth::id())
            ->whereYear('expense_date', $currentYear)
            ->whereMonth('expense_date', $currentMonth)
            ->sum('amount');

        $this->netBalance = $this->totalIncome - $this->totalExpenses;

        // Load recent entries
        $this->incomes = FinancialIncome::where('user_id', Auth::id())
            ->latest()
            ->take(10)
            ->get();

        $this->expenses = FinancialExpense::where('user_id', Auth::id())
            ->latest()
            ->take(10)
            ->get();

        // Load current month budgets
        $this->budgets = FinancialBudget::where('user_id', Auth::id())
            ->where('year', $currentYear)
            ->where('month', $currentMonth)
            ->get();

        // Load active goals
        $this->goals = FinancialGoal::where('user_id', Auth::id())
            ->where('status', 'active')
            ->latest()
            ->get();
    }

    public function addIncome()
    {
        $this->validate([
            'incomeAmount' => 'required|numeric|min:0.01',
        ]);

        FinancialIncome::create([
            'user_id' => Auth::id(),
            'amount' => $this->incomeAmount,
            'source' => $this->incomeSource ?? 'Other',
            'description' => $this->incomeDescription,
            'income_date' => Carbon::today(),
        ]);

        $this->reset(['incomeAmount', 'incomeSource', 'incomeDescription']);
        $this->loadData();
        session()->flash('message', 'Income added successfully!');
    }

    public function addExpense()
    {
        $this->validate([
            'expenseAmount' => 'required|numeric|min:0.01',
            'expenseCategory' => 'required|string',
        ]);

        FinancialExpense::create([
            'user_id' => Auth::id(),
            'amount' => $this->expenseAmount,
            'category' => $this->expenseCategory,
            'description' => $this->expenseDescription,
            'expense_date' => Carbon::today(),
        ]);

        $this->reset(['expenseAmount', 'expenseCategory', 'expenseDescription']);
        $this->loadData();
        session()->flash('message', 'Expense added successfully!');
    }

    public function setBudget()
    {
        $this->validate([
            'budgetCategory' => 'required|string',
            'monthlyBudget' => 'required|numeric|min:0.01',
        ]);

        FinancialBudget::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'category' => $this->budgetCategory,
                'year' => Carbon::now()->year,
                'month' => Carbon::now()->month,
            ],
            [
                'monthly_budget' => $this->monthlyBudget,
            ]
        );

        $this->reset(['budgetCategory', 'monthlyBudget']);
        $this->loadData();
        session()->flash('message', "Budget set for {$this->budgetCategory}!");
    }

    public function addGoal()
    {
        $this->validate([
            'goalName' => 'required|string|max:255',
            'goalAmount' => 'required|numeric|min:0.01',
            'goalDate' => 'required|date|after_or_equal:today',
        ]);

        FinancialGoal::create([
            'user_id' => Auth::id(),
            'goal_name' => $this->goalName,
            'target_amount' => $this->goalAmount,
            'current_amount' => 0,
            'target_date' => $this->goalDate,
            'description' => $this->goalDescription,
            'status' => 'active',
        ]);

        $this->reset(['goalName', 'goalAmount', 'goalDate', 'goalDescription']);
        $this->loadData();
        session()->flash('message', "Goal added successfully!");
    }

    public $editingGoalId = null;
    public $goalProgressAmount = 0;

    public function editGoal($id)
    {
        $goal = FinancialGoal::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $this->editingGoalId = $id;
        $this->goalProgressAmount = $goal->current_amount;
    }

    public function updateGoalProgress($id)
    {
        $this->validate([
            'goalProgressAmount' => 'required|numeric|min:0',
        ]);

        $goal = FinancialGoal::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $goal->current_amount = $this->goalProgressAmount;

        // Auto-complete goal if current amount >= target
        if ($goal->current_amount >= $goal->target_amount) {
            $goal->status = 'completed';
            $goal->current_amount = $goal->target_amount; // Cap at target
        }

        $goal->save();

        $this->reset(['editingGoalId', 'goalProgressAmount']);
        $this->loadData();
        session()->flash('message', 'Goal progress updated successfully!');
    }

    public function cancelEditGoal()
    {
        $this->reset(['editingGoalId', 'goalProgressAmount']);
    }

    public function deleteIncome($id)
    {
        FinancialIncome::where('id', $id)
            ->where('user_id', Auth::id())
            ->delete();

        $this->loadData();
        session()->flash('message', 'Income deleted successfully!');
    }

    public function deleteExpense($id)
    {
        FinancialExpense::where('id', $id)
            ->where('user_id', Auth::id())
            ->delete();

        $this->loadData();
        session()->flash('message', 'Expense deleted successfully!');
    }

    public function deleteGoal($id)
    {
        FinancialGoal::where('id', $id)
            ->where('user_id', Auth::id())
            ->delete();

        $this->loadData();
        session()->flash('message', 'Goal deleted successfully!');
    }

    public function completeGoal($id)
    {
        $goal = FinancialGoal::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $goal->status = 'completed';
        $goal->current_amount = $goal->target_amount;
        $goal->save();

        $this->loadData();
        session()->flash('message', 'Goal marked as completed!');
    }

    public function getExpenseByCategory()
    {
        return FinancialExpense::where('user_id', Auth::id())
            ->whereYear('expense_date', Carbon::now()->year)
            ->whereMonth('expense_date', Carbon::now()->month)
            ->selectRaw('category, SUM(amount) as total')
            ->groupBy('category')
            ->get();
    }

    public function getBudgetVsActual()
    {
        $budgets = FinancialBudget::where('user_id', Auth::id())
            ->where('year', Carbon::now()->year)
            ->where('month', Carbon::now()->month)
            ->get();

        $result = [];
        foreach ($budgets as $budget) {
            $actual = FinancialExpense::where('user_id', Auth::id())
                ->where('category', $budget->category)
                ->whereYear('expense_date', Carbon::now()->year)
                ->whereMonth('expense_date', Carbon::now()->month)
                ->sum('amount');

            $result[] = [
                'category' => $budget->category,
                'budget' => $budget->monthly_budget,
                'actual' => $actual,
            ];
        }

        return $result;
    }

    public function render()
    {
        return view('livewire.financialtools', [
            'expenseByCategory' => $this->getExpenseByCategory(),
            'budgetVsActual' => $this->getBudgetVsActual(),
        ]);
    }
}
