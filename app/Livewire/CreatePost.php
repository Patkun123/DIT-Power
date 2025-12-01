<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\Mention;
use App\Events\PostCreated;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class CreatePost extends Component
{
    use WithFileUploads;

    public $content = '';
    public $image;
    public $showImagePreview = false;

    // Mention functionality state
    public $mentionQuery = '';
    public $showMentionSuggestions = false;
    public $mentionSuggestions = [];
    public $selectedMentionIndex = -1;
    public $currentMentionField = '';

    protected $rules = [
        'content' => 'required|string|max:1000',
        'image' => 'nullable|image|max:8192', // 8MB
    ];

    protected $messages = [
        'content.required' => 'Post content is required.',
        'content.max' => 'Post content cannot exceed 1000 characters.',
        'image.image' => 'File must be an image.',
        'image.max' => 'Image size cannot exceed 8MB.',
    ];

    public function updatedImage()
    {
        try {
            $this->validateOnly('image');
            $this->showImagePreview = true;

            Log::info('Image uploaded successfully', [
                'user_id' => Auth::id(),
                'size' => $this->image->getSize(),
                'mime' => $this->image->getMimeType()
            ]);
        } catch (\Exception $e) {
            Log::error('Image validation failed', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage()
            ]);

            $this->addError('image', 'Failed to upload image: ' . $e->getMessage());
            $this->image = null;
            $this->showImagePreview = false;
        }
    }

    public function createPost()
    {
        try {
            Log::info('Starting post creation', [
                'user_id' => Auth::id(),
                'has_image' => !is_null($this->image),
                'content_length' => strlen($this->content)
            ]);

            // Validate input
            $this->validate();

            $imagePath = null;

            // Handle image upload
            if ($this->image) {
                Log::info('Attempting to store image', [
                    'user_id' => Auth::id(),
                    'original_name' => $this->image->getClientOriginalName(),
                    'size' => $this->image->getSize(),
                    'mime' => $this->image->getMimeType()
                ]);

                try {
                    $imagePath = $this->image->store('posts', 'public');

                    Log::info('Image stored successfully', [
                        'user_id' => Auth::id(),
                        'path' => $imagePath
                    ]);
                } catch (\Exception $e) {
                    Log::error('Image storage failed', [
                        'user_id' => Auth::id(),
                        'error' => $e->getMessage(),
                        'trace' => $e->getTraceAsString()
                    ]);

                    throw new \Exception('Failed to store image: ' . $e->getMessage());
                }
            }

            // Create post
            $post = Post::create([
                'user_id' => Auth::id(),
                'content' => $this->content,
                'image' => $imagePath,
            ]);

            Log::info('Post created successfully', [
                'user_id' => Auth::id(),
                'post_id' => $post->id
            ]);

            // Process mentions in post content
            $this->processMentions($this->content, $post, 'post');

            // Dispatch event for real-time updates
            $this->dispatch('postCreated');

            // Reset form
            $this->reset(['content', 'image', 'showImagePreview']);

            session()->flash('message', 'Post created successfully!');

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::warning('Post validation failed', [
                'user_id' => Auth::id(),
                'errors' => $e->errors()
            ]);

            // Re-throw to show validation errors
            throw $e;

        } catch (\Exception $e) {
            Log::error('Post creation failed', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            session()->flash('error', 'Failed to create post. Please try again.');
            $this->addError('general', $e->getMessage());
        }
    }

    // Mention functionality methods
    public function searchUsers($rawInput, $field)
    {
        $mentionQuery = $this->extractMentionQuery((string) $rawInput);

        if ($mentionQuery === null) {
            $this->showMentionSuggestions = false;
            $this->mentionQuery = '';
            return;
        }

        $this->mentionQuery = $mentionQuery;
        $this->currentMentionField = $field;
        $this->selectedMentionIndex = -1;

        $this->mentionSuggestions = \App\Models\User::where('id', '!=', Auth::id())
            ->when($mentionQuery !== '', function ($q) use ($mentionQuery) {
                $q->where(function ($q2) use ($mentionQuery) {
                    $q2->where('firstname', 'like', "%{$mentionQuery}%")
                        ->orWhere('lastname', 'like', "%{$mentionQuery}%")
                        ->orWhereRaw(\App\Models\User::getFullNameConcatSql() . " LIKE ?", ["%{$mentionQuery}%"]);
                });
            })
            ->limit(5)
            ->get();

        $this->showMentionSuggestions = $this->mentionSuggestions->count() > 0;
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

        if (preg_match('/^([A-Za-z\s]{0,50})/', $after, $m)) {
            return trim($m[1]);
        }

        return null;
    }

    public function selectMention($userId, $field)
    {
        $user = \App\Models\User::find($userId);

        if (!$user) {
            return;
        }

        $mentionText = "@{$user->firstname} {$user->lastname}";

        if ($field === 'post') {
            $this->content = str_replace("@{$this->mentionQuery}", $mentionText, $this->content);
        }

        $this->showMentionSuggestions = false;
        $this->mentionQuery = '';
        $this->selectedMentionIndex = -1;
    }

    public function hideMentionSuggestions()
    {
        $this->showMentionSuggestions = false;
        $this->mentionQuery = '';
        $this->selectedMentionIndex = -1;
    }

    private function processMentions($content, Post $post, string $type)
    {
        // Extract mentions from content using regex (First Last)
        preg_match_all('/@(\w+\s+\w+)/', $content, $matches);

        if (empty($matches[1])) {
            return;
        }

        foreach ($matches[1] as $mention) {
            $user = \App\Models\User::whereRaw(\App\Models\User::getFullNameConcatSql() . " = ?", [$mention])->first();

            if ($user && $user->id !== Auth::id()) {
                // Create mention record
                Mention::create([
                    'user_id' => $user->id,
                    'mentioned_by' => Auth::id(),
                    'mentionable_type' => $type,
                    'mentionable_id' => $post->id,
                    'post_id' => $post->id,
                    'content' => $content,
                ]);

                // Create notification for mentioned user
                \App\Models\Notification::create([
                    'user_id' => $user->id,
                    'type' => 'mention',
                    'title' => 'You were mentioned',
                    'message' => Auth::user()->firstname . ' ' . Auth::user()->lastname . ' mentioned you in a post',
                    'data' => [
                        'mentioned_by' => Auth::id(),
                        'mentioned_by_name' => Auth::user()->firstname . ' ' . Auth::user()->lastname,
                        'post_id' => $post->id,
                        'mention_type' => $type,
                        'mention_id' => $post->id,
                    ],
                ]);
            }
        }
    }

    public function removeImage()
    {
        $this->image = null;
        $this->showImagePreview = false;
    }

    public function render()
    {
        return view('livewire.create-post');
    }
}
