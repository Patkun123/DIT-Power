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

class CommentCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $comment;
    public $postOwner;
    public $commenter;

    /**
     * Create a new event instance.
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
        $this->postOwner = $comment->post->user;
        $this->commenter = $comment->user;
        
        // Create database notification
        $notificationService = new SocialNotificationService();
        $notificationService->createCommentCreatedNotification($comment);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        // Only notify the post owner if they're not the one commenting
        if ($this->postOwner->id !== $this->commenter->id) {
            return [
                new PrivateChannel('notifications.' . $this->postOwner->id),
            ];
        }
        
        return [];
    }

    public function broadcastAs(): string
    {
        return 'comment.created';
    }

    public function broadcastWith(): array
    {
        return [
            'comment_id' => $this->comment->id,
            'post_id' => $this->comment->post_id,
            'commenter_name' => $this->commenter->firstname . ' ' . $this->commenter->lastname,
            'commenter_id' => $this->commenter->id,
            'message' => $this->commenter->firstname . ' ' . $this->commenter->lastname . ' commented on your post',
            'type' => 'comment_created',
            'created_at' => now()->toISOString(),
        ];
    }
}