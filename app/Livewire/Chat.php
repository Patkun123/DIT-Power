<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Message;
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

