<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\Mention;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Events\PostCreated;
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
        'image' => 'nullable|image|max:8192',
    ];

    protected $messages = [
        'content.required' => 'Post content is required.',
        'content.max' => 'Post content cannot exceed 1000 characters.',
        'image.image' => 'File must be an image.',
        'image.max' => 'Image size cannot exceed 8MB.',
    ];

    public function hydrate()
    {
        // Verify image is still valid after component rehydration
        if ($this->image && !$this->image->isValid()) {
            $this->image = null;
            $this->showImagePreview = false;
        }
    }

    public function updatedImage()
    {
        try {
            $this->validateOnly('image');
            $this->showImagePreview = true;
        } catch (\Exception $e) {
            Log::error('Image validation failed', [
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
                'has_image' => !is_null($this->image)
            ]);

            $this->validate();

            $imagePath = null;
            if ($this->image) {
                Log::info('Attempting to store image', [
                    'original_name' => $this->image->getClientOriginalName(),
                    'size' => $this->image->getSize(),
                    'mime' => $this->image->getMimeType()
                ]);

                $imagePath = $this->image->store('posts', 'public');

                // Verify the file was actually stored
                if (!Storage::disk('public')->exists($imagePath)) {
                    throw new \Exception('Image storage verification failed');
                }

                Log::info('Image stored successfully', ['path' => $imagePath]);
            }

            // Sanitize content
            $sanitizedContent = strip_tags($this->content);

            $post = Post::create([
                'user_id' => Auth::id(),
                'content' => $sanitizedContent,
                'image' => $imagePath,
            ]);

            Log::info('Post created successfully', ['post_id' => $post->id]);

            // Process mentions in post content
            $this->processMentions($sanitizedContent, $post, 'post');

            // Broadcast event for real-time updates
            broadcast(new PostCreated($post))->toOthers();

            // Dispatch Livewire event
            $this->dispatch('postCreated');

            // Reset form
            $this->reset(['content', 'image', 'showImagePreview']);

            session()->flash('message', 'Post created successfully!');

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::warning('Validation failed', ['errors' => $e->errors()]);
            throw $e; // Re-throw to show validation errors

        } catch (\Exception $e) {
            Log::error('Post creation failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            // Clean up uploaded image if post creation failed
            if (isset($imagePath) && $imagePath) {
                Storage::disk('public')->delete($imagePath);
            }

            session()->flash('error', 'Failed to create post. Please try again.');
            $this->addError('general', 'An error occurred: ' . $e->getMessage());
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

        $this->mentionSuggestions = \App\Models\User::with('staff') // Eager load to prevent N+1
            ->where('id', '!=', Auth::id())
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
        if (!$user) return;

        $mentionText = "@{$user->firstname} {$user->lastname}";

        if ($field === 'post') {
            // Replace the last @mention query with the selected user
            $pos = strrpos($this->content, '@');
            if ($pos !== false) {
                $before = substr($this->content, 0, $pos);
                $this->content = $before . $mentionText . ' ';
            }
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
        // Extract mentions from content - matches @Firstname Lastname format
        preg_match_all('/@([A-Za-z]+\s+[A-Za-z]+)/', $content, $matches);
        if (empty($matches[1])) {
            return;
        }

        $processedUsers = []; // Prevent duplicate mentions

        foreach ($matches[1] as $mention) {
            $user = \App\Models\User::whereRaw(
                \App\Models\User::getFullNameConcatSql() . " = ?",
                [trim($mention)]
            )->first();

            if ($user && $user->id !== Auth::id() && !in_array($user->id, $processedUsers)) {
                $processedUsers[] = $user->id;

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
