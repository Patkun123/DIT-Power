<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Message;
use App\Services\ChatNotificationService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class Chat extends Component
{
    public $messageText;

    // Mentions state
    public $mentionQuery = '';
    public $showMentionSuggestions = false;
    public $mentionSuggestions = [];
    public $selectedMentionIndex = -1;
    public $currentMentionField = '';

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

        // Send notifications to other users + mention notifications
        $chatNotificationService = new ChatNotificationService();
        $chatNotificationService->sendChatNotification($this->messageText, Auth::id());

        // Detect mentions and notify mentioned users - improved regex
        try {
            preg_match_all('/@([A-Za-z][A-Za-z\s\-\']{1,50})/', $this->messageText, $matches);
            if (!empty($matches[1])) {
                foreach ($matches[1] as $mention) {
                    $mention = trim($mention);
                    if (empty($mention)) continue;

                    $user = \App\Models\User::whereRaw("firstname || ' ' || lastname = ?", [$mention])->first();
                    if ($user && $user->id !== Auth::id()) {
                        $chatNotificationService->sendChatMentionNotification($this->messageText, Auth::id(), $user->id);
                    }
                }
            }
        } catch (\Exception $e) {
            // Log the error but don't break the main functionality
            Log::error('Error processing chat mentions: ' . $e->getMessage(), [
                'message' => $this->messageText,
                'user_id' => Auth::id(),
            ]);
        }

        // Emit event to refresh notification bell
        $this->dispatch('chat-message-sent');

        $this->messageText = '';
        $this->hideMentionSuggestions();
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

    // === Mentions ===
    public function searchUsers($rawInput, $field)
    {
        try {
            $mentionQuery = $this->extractMentionQuery((string) $rawInput);
            if ($mentionQuery === null) {
                $this->showMentionSuggestions = false;
                $this->mentionQuery = '';
                $this->selectedMentionIndex = -1;
                return;
            }

            $this->mentionQuery = $mentionQuery; // can be empty right after '@'
            $this->currentMentionField = $field;
            $this->selectedMentionIndex = -1;

            // Limit query length to prevent performance issues
            if (strlen($mentionQuery) > 50) {
                $this->showMentionSuggestions = false;
                return;
            }

            $this->mentionSuggestions = \App\Models\User::where('id', '!=', Auth::id())
                ->when($mentionQuery !== '', function ($q) use ($mentionQuery) {
                    $q->where(function ($q2) use ($mentionQuery) {
                        $q2->where('firstname', 'like', "%{$mentionQuery}%")
                            ->orWhere('lastname', 'like', "%{$mentionQuery}%")
                            ->orWhereRaw("firstname || ' ' || lastname LIKE ?", ["%{$mentionQuery}%"]);
                    });
                })
                ->limit(5)
                ->get();

            $this->showMentionSuggestions = $this->mentionSuggestions->count() > 0;
            if (!$this->showMentionSuggestions) {
                $this->selectedMentionIndex = -1;
            } else if ($this->selectedMentionIndex >= $this->mentionSuggestions->count()) {
                $this->selectedMentionIndex = 0;
            }
        } catch (\Exception $e) {
            // Log the error and hide suggestions
            Log::error('Error searching users for mentions: ' . $e->getMessage(), [
                'input' => $rawInput,
                'field' => $field,
                'user_id' => Auth::id(),
            ]);
            $this->showMentionSuggestions = false;
            $this->selectedMentionIndex = -1;
        }
    }

    private function extractMentionQuery(string $input): ?string
    {
        $pos = strrpos($input, '@');
        if ($pos === false) {
            return null;
        }
        $after = substr($input, $pos + 1);
        if ($after === '') {
            return '';
        }
        if (preg_match('/^([A-Za-z][A-Za-z\s\-\']{0,49})/', $after, $m)) {
            return trim($m[1]);
        }
        return null;
    }

    public function selectMention($userId, $field)
    {
        $user = \App\Models\User::find($userId);
        if (!$user) return;

        $mentionText = "@{$user->firstname} {$user->lastname}";

        if ($field === 'chat') {
            $this->messageText = $this->replaceLastMention($this->messageText, '@' . ($this->mentionQuery ?: ''), $mentionText);
        }

        $this->showMentionSuggestions = false;
        $this->mentionQuery = '';
        $this->selectedMentionIndex = -1;
    }

    private function replaceLastMention($text, $pattern, $replacement)
    {
        $pos = strrpos($text, '@');
        if ($pos === false) {
            return $text;
        }

        // Find the end of the current mention (next space, punctuation, or end of string)
        $endPos = $pos + 1;
        while ($endPos < strlen($text) && preg_match('/[A-Za-z\s\-\']/', $text[$endPos])) {
            $endPos++;
        }

        return substr($text, 0, $pos) . $replacement . substr($text, $endPos);
    }

    public function hideMentionSuggestions()
    {
        $this->showMentionSuggestions = false;
        $this->mentionQuery = '';
        $this->selectedMentionIndex = -1;
    }

    public function moveMentionSelection($direction)
    {
        if (!$this->showMentionSuggestions || $this->mentionSuggestions->isEmpty()) {
            return;
        }
        $count = $this->mentionSuggestions->count();
        if ($this->selectedMentionIndex === -1) {
            $this->selectedMentionIndex = 0;
            return;
        }
        if ($direction === 'down') {
            $this->selectedMentionIndex = ($this->selectedMentionIndex + 1) % $count;
        } else {
            $this->selectedMentionIndex = ($this->selectedMentionIndex - 1 + $count) % $count;
        }
    }

    public function selectCurrentMention()
    {
        if (!$this->showMentionSuggestions || $this->mentionSuggestions->isEmpty()) {
            return;
        }
        $index = $this->selectedMentionIndex === -1 ? 0 : $this->selectedMentionIndex;
        $user = $this->mentionSuggestions[$index] ?? null;
        if ($user) {
            $this->selectMention($user->id, 'chat');
        }
    }

    public function parseMentions($content)
    {
        return preg_replace_callback('/@([A-Za-z][A-Za-z\s\-\']{1,50})/', function ($matches) {
            $mention = $matches[1];
            $user = \App\Models\User::whereRaw("firstname || ' ' || lastname = ?", [$mention])->first();
            if ($user) {
                $isMe = (int) $user->id === (int) Auth::id();
                $classes = $isMe
                    ? 'mention-highlight bg-blue-100 dark:bg-blue-900/40 text-blue-700 dark:text-blue-300 font-semibold rounded px-1'
                    : 'mention-highlight text-blue-600 dark:text-blue-400 font-medium hover:underline';
                return '<span class="' . $classes . '">@' . e($mention) . '</span>';
            }
            return e($matches[0]);
        }, $content);
    }
}
