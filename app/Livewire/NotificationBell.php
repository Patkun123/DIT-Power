<?php

namespace App\Livewire;

use App\Models\Notification;
use Livewire\Component;
use Carbon\Carbon;

class NotificationBell extends Component
{
    public $notifications = [];
    public $unreadCount = 0;
    public $showDropdown = false;

    public function mount()
    {
        $this->loadNotifications();
    }

    public function loadNotifications()
    {
        if (auth()->check()) {
            $this->notifications = auth()->user()
                ->notifications()
                ->latest()
                ->limit(10)
                ->get();
            
            $this->unreadCount = auth()->user()
                ->unreadNotifications()
                ->count();
        }
    }

    public function toggleDropdown()
    {
        $this->showDropdown = !$this->showDropdown;
    }

    public function markAsRead($notificationId)
    {
        $notification = Notification::find($notificationId);
        if ($notification && $notification->user_id === auth()->id()) {
            $notification->markAsRead();
            $this->loadNotifications();
        }
    }

    public function markAllAsRead()
    {
        auth()->user()
            ->unreadNotifications()
            ->update(['read_at' => now()]);
        
        $this->loadNotifications();
    }

    public function getListeners()
    {
        return [
            'echo:quiz-notifications,QuizStarted' => 'loadNotifications',
        ];
    }

    public function render()
    {
        return view('livewire.notification-bell');
    }
}
