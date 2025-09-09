<?php

namespace App\Events;

use App\Models\Post;
use App\Models\User;
use App\Services\SocialNotificationService;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PostLiked implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $post;
    public $user;
    public $liker;

    /**
     * Create a new event instance.
     */
    public function __construct(Post $post, User $liker)
    {
        $this->post = $post;
        $this->user = $post->user;
        $this->liker = $liker;
        
        // Create database notification
        $notificationService = new SocialNotificationService();
        $notificationService->createPostLikedNotification($post, $liker);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('notifications.' . $this->user->id),
        ];
    }

    public function broadcastAs(): string
    {
        return 'post.liked';
    }

    public function broadcastWith(): array
    {
        return [
            'post_id' => $this->post->id,
            'liker_name' => $this->liker->firstname . ' ' . $this->liker->lastname,
            'liker_id' => $this->liker->id,
            'message' => $this->liker->firstname . ' ' . $this->liker->lastname . ' liked your post',
            'type' => 'post_liked',
            'created_at' => now()->toISOString(),
        ];
    }
}