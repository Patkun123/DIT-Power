<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Message;
use App\Services\ChatNotificationService;
use Illuminate\Support\Facades\Auth;

class Chat extends Component
{
    public $messageText;

    protected $rules = [
        'messageText' => 'required|string|max:500',
    ];

    public function sendMessage()
    {
        $this->validate();

        Message::create([
            'user_id' => Auth::id(),
            'message' => $this->messageText,
        ]);

        // Send notifications to other users
        $chatNotificationService = new ChatNotificationService();
        $chatNotificationService->sendChatNotification($this->messageText, Auth::id());

        // Emit event to refresh notification bell
        $this->dispatch('chat-message-sent');

        $this->messageText = '';
    }

    public function getMessagesProperty()
    {
        return Message::with('user')
            ->latest()
            ->take(20)
            ->get()
            ->reverse();
    }

    public function render()
    {
        return view('livewire.chat');
    }
}

