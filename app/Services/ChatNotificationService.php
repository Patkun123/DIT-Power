<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Events\NotificationSent;

class ChatNotificationService
{
    public function sendChatNotification($message, $senderId)
    {
        $sender = User::find($senderId);
        
        if (!$sender) {
            return 0;
        }

        $title = "New Chat Message";
        $messageContent = "{$sender->firstname} {$sender->lastname} sent a message in the social tools chat";
        
        // Get all users except the sender
        $users = User::where('role', 'user')
                    ->where('id', '!=', $senderId)
                    ->get();
        
        $notificationCount = 0;
        
        foreach ($users as $user) {
            $notification = Notification::create([
                'user_id' => $user->id,
                'type' => 'chat_message',
                'title' => $title,
                'message' => $messageContent,
                'data' => [
                    'sender_id' => $senderId,
                    'sender_name' => "{$sender->firstname} {$sender->lastname}",
                    'message_preview' => substr($message, 0, 50) . (strlen($message) > 50 ? '...' : ''),
                    'action_url' => route('social.tools'),
                    'timestamp' => now()->toISOString()
                ]
            ]);
            event(new NotificationSent($notification));
            
            $notificationCount++;
        }
        
        return $notificationCount;
    }
    
    public function sendChatNotificationToSpecificUser($message, $senderId, $recipientId)
    {
        $sender = User::find($senderId);
        
        if (!$sender || $senderId === $recipientId) {
            return false;
        }

        $title = "New Chat Message";
        $messageContent = "{$sender->firstname} {$sender->lastname} sent a message in the social tools chat";
        
        $notification = Notification::create([
            'user_id' => $recipientId,
            'type' => 'chat_message',
            'title' => $title,
            'message' => $messageContent,
            'data' => [
                'sender_id' => $senderId,
                'sender_name' => "{$sender->firstname} {$sender->lastname}",
                'message_preview' => substr($message, 0, 50) . (strlen($message) > 50 ? '...' : ''),
                'action_url' => route('social.tools'),
                'timestamp' => now()->toISOString()
            ]
        ]);
        event(new NotificationSent($notification));
        
        return true;
    }
}
