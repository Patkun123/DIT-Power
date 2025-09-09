<?php

namespace App\Events;

use App\Models\Reply;
use App\Models\User;
use App\Services\SocialNotificationService;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ReplyCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $reply;
    public $commentOwner;
    public $replier;

    /**
     * Create a new event instance.
     */
    public function __construct(Reply $reply)
    {
        $this->reply = $reply;
        $this->commentOwner = $reply->comment->user;
        $this->replier = $reply->user;
        
        // Create database notification
        $notificationService = new SocialNotificationService();
        $notificationService->createReplyCreatedNotification($reply);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        // Only notify the comment owner if they're not the one replying
        if ($this->commentOwner->id !== $this->replier->id) {
            return [
                new PrivateChannel('notifications.' . $this->commentOwner->id),
            ];
        }
        
        return [];
    }

    public function broadcastAs(): string
    {
        return 'reply.created';
    }

    public function broadcastWith(): array
    {
        return [
            'reply_id' => $this->reply->id,
            'comment_id' => $this->reply->comment_id,
            'post_id' => $this->reply->comment->post_id,
            'replier_name' => $this->replier->firstname . ' ' . $this->replier->lastname,
            'replier_id' => $this->replier->id,
            'message' => $this->replier->firstname . ' ' . $this->replier->lastname . ' replied to your comment',
            'type' => 'reply_created',
            'created_at' => now()->toISOString(),
        ];
    }
}