<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Broadcasting\PrivateChannel;

class RealtimeTestNotification extends Notification implements ShouldBroadcast
{
    use Queueable;

    protected array $payload;

    public function __construct(array $payload = [])
    {
        $this->payload = $payload ?: [
            'title' => 'New Notification',
            'message' => 'This is a realtime test notification.',
            'type' => 'test',
        ];
    }

    public function via(object $notifiable): array
    {
        return ['broadcast', 'database'];
    }

    public function toArray(object $notifiable): array
    {
        return $this->payload;
    }

    public function toBroadcast(object $notifiable): BroadcastMessage
    {
        return new BroadcastMessage($this->payload);
    }

    public function broadcastOn(): array
    {
        // Default Laravel private user channel
        return [new PrivateChannel('App.Models.User.' . auth()->id())];
    }
}


