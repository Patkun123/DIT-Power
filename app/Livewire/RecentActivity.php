<?php

namespace App\Livewire;

use App\Models\ActivityLog;
use App\Services\ActivityService;
use Livewire\Component;

class RecentActivity extends Component
{
    public $activities = [];
    public $stats = [];
    public $isLoading = true;
    public $filter = 'all'; // all, today, week, month
    public $activityType = 'all'; // all, quiz_taken, user_added, etc.

    public function mount()
    {
        $this->loadActivities();
        $this->loadStats();
    }

    public function loadActivities()
    {
        $this->isLoading = true;
        
        $query = ActivityLog::with('user')
            ->orderBy('created_at', 'desc')
            ->limit(20);

        // Apply date filter
        switch ($this->filter) {
            case 'today':
                $query->whereDate('created_at', today());
                break;
            case 'week':
                $query->where('created_at', '>=', now()->startOfWeek());
                break;
            case 'month':
                $query->where('created_at', '>=', now()->startOfMonth());
                break;
        }

        // Apply activity type filter
        if ($this->activityType !== 'all') {
            $query->where('activity_type', $this->activityType);
        }

        $this->activities = $query->get();
        $this->isLoading = false;
    }

    public function loadStats()
    {
        $this->stats = ActivityService::getActivityStats();
    }

    public function updatedFilter()
    {
        $this->loadActivities();
    }

    public function updatedActivityType()
    {
        $this->loadActivities();
    }

    public function refresh()
    {
        $this->loadActivities();
        $this->loadStats();
        $this->dispatch('activities-refreshed');
    }

    public function render()
    {
        return view('livewire.recent-activity');
    }
}
