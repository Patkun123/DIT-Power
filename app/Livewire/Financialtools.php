<?php

namespace App\Livewire;

use Livewire\Component;

class FinancialTools extends Component
{
    public $totalIncome = 0;
    public $totalExpenses = 0;
    public $netBalance = 0;

    public $incomeAmount;
    public $expenseAmount;
    public $expenseCategory;
    public $budgetCategory;
    public $monthlyBudget;
    public $goalName;
    public $goalAmount;
    public $goalDate;

    public function addIncome()
    {
        $this->totalIncome += $this->incomeAmount;
        $this->netBalance = $this->totalIncome - $this->totalExpenses;
        $this->incomeAmount = null;
        session()->flash('message', 'Income added successfully!');
    }

    public function addExpense()
    {
        $this->totalExpenses += $this->expenseAmount;
        $this->netBalance = $this->totalIncome - $this->totalExpenses;
        $this->expenseAmount = null;
        session()->flash('message', 'Expense added successfully!');
    }

    public function setBudget()
    {
        session()->flash('message', "Budget set for {$this->budgetCategory}!");
    }

    public function addGoal()
    {
        session()->flash('message', "Goal '{$this->goalName}' added!");
        $this->reset(['goalName', 'goalAmount', 'goalDate']);
    }

    public function render()
    {
        return view('livewire.financialtools');
    }
}
