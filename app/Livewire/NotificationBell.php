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
    public function markAsReadAndRedirect($notificationId)
{
    $notification = Notification::find($notificationId);

    if (! $notification || $notification->user_id !== auth()->id()) {
        return;
    }

    $notification->markAsRead();
    $this->loadNotifications();
    $this->showDropdown = false;

    $url = '/'; // fallback

    switch ($notification->type) {
        case 'comment_created':
        case 'reply_created':
            $postId = data_get($notification->data, 'post_id');
            $commentId = data_get($notification->data, 'comment_id');
            $url = route('social.show', $postId) . '#comment-' . $commentId;
            break;

        case 'post_liked':
            $postId = data_get($notification->data, 'post_id');
            $url = route('social.show', $postId);
            break;

        case 'chat_message':
            $chatId = data_get($notification->data, 'chat_id');
            $url = route('social.tools', $chatId);
            break;

        default:
            $url = '/notifications'; // or some safe page
    }

    return redirect()->to($url);
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
        $userId = auth()->id();
        return [
            'echo:quiz-notifications,QuizStarted' => 'loadNotifications',
            'echo:quiz-notifications,QuizActivated' => 'loadNotifications',
            'echo:quiz-notifications,QuizEnded' => 'loadNotifications',
            'echo:quiz-notifications,QuizReminder' => 'loadNotifications',
            'chat-message-sent' => 'loadNotifications',
            "echo-private:notifications.{$userId},notification.sent" => 'loadNotifications',
            "echo-private:notifications.{$userId},post.liked" => 'loadNotifications',
            "echo-private:notifications.{$userId},comment.liked" => 'loadNotifications',
            "echo-private:notifications.{$userId},comment.created" => 'loadNotifications',
            "echo-private:notifications.{$userId},reply.created" => 'loadNotifications',
            "echo-private:notifications.{$userId},mention.created" => 'loadNotifications',
        ];
    }

    public function render()
    {
        return view('livewire.notification-bell');
    }
}
