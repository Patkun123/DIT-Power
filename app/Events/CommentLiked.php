<?php

namespace App\Events;

use App\Models\Comment;
use App\Models\User;
use App\Services\SocialNotificationService;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CommentLiked implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $comment;
    public $user;
    public $liker;

    /**
     * Create a new event instance.
     */
    public function __construct(Comment $comment, User $liker)
    {
        $this->comment = $comment;
        $this->user = $comment->user;
        $this->liker = $liker;
        
        // Create database notification
        $notificationService = new SocialNotificationService();
        $notificationService->createCommentLikedNotification($comment, $liker);
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
        return 'comment.liked';
    }

    public function broadcastWith(): array
    {
        return [
            'comment_id' => $this->comment->id,
            'post_id' => $this->comment->post_id,
            'liker_name' => $this->liker->firstname . ' ' . $this->liker->lastname,
            'liker_id' => $this->liker->id,
            'message' => $this->liker->firstname . ' ' . $this->liker->lastname . ' liked your comment',
            'type' => 'comment_liked',
            'created_at' => now()->toISOString(),
        ];
    }
}