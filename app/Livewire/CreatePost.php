<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\Mention;
use App\Events\PostCreated;
use App\Services\ImageScanService;
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
        'image' => 'nullable|image|max:8048',
    ];

    protected $messages = [
        'content.required' => 'Post content is required.',
        'content.max' => 'Post content cannot exceed 1000 characters.',
        'image.image' => 'File must be an image.',
        'image.max' => 'Image size cannot exceed 2MB.',
    ];

    public function updatedImage()
    {
        try {
            $this->validateOnly('image');
            
            // Scan the image for security threats
            if ($this->image) {
                try {
                    $scanService = new ImageScanService();
                    $scanResult = $scanService->scanImage($this->image);
                    
                    if (!$scanResult['success']) {
                        Log::warning('Image scan failed during upload', [
                            'error' => $scanResult['message'],
                            'file' => $this->image->getClientOriginalName(),
                        ]);
                        $this->addError('image', $scanResult['message']);
                        $this->image = null;
                        $this->showImagePreview = false;
                        return;
                    }
                } catch (\Exception $e) {
                    Log::error('Image scanning exception', [
                        'error' => $e->getMessage(),
                        'trace' => $e->getTraceAsString(),
                    ]);
                    // In case of scanning errors, allow upload but log the issue
                    // You can change this to block uploads if needed
                    $this->addError('image', 'Image validation encountered an error. Please try again.');
                    $this->image = null;
                    $this->showImagePreview = false;
                    return;
                }
            }
            
            $this->showImagePreview = true;
        } catch (\Exception $e) {
            Log::error('Image upload validation failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            $this->addError('image', 'Failed to process image. Please try again.');
            $this->image = null;
            $this->showImagePreview = false;
        }
    }

    public function createPost()
    {
        try {
            $this->validate();

            // Scan image before storing
            $imagePath = null;
            if ($this->image) {
                try {
                    $scanService = new ImageScanService();
                    $scanResult = $scanService->scanImage($this->image);
                    
                    if (!$scanResult['success']) {
                        Log::warning('Image scan failed during post creation', [
                            'error' => $scanResult['message'],
                            'file' => $this->image->getClientOriginalName(),
                        ]);
                        $this->addError('image', $scanResult['message']);
                        return;
                    }
                } catch (\Exception $e) {
                    Log::error('Image scanning exception during post creation', [
                        'error' => $e->getMessage(),
                        'trace' => $e->getTraceAsString(),
                    ]);
                    $this->addError('image', 'Image validation encountered an error. Please try again.');
                    return;
                }
                
                try {
                    $imagePath = $this->image->store('posts', 'public');
                    if (!$imagePath) {
                        throw new \Exception('Failed to store image');
                    }
                } catch (\Exception $e) {
                    Log::error('Image storage failed', [
                        'error' => $e->getMessage(),
                        'file' => $this->image->getClientOriginalName(),
                        'trace' => $e->getTraceAsString(),
                    ]);
                    $this->addError('image', 'Failed to save image. Please check storage permissions.');
                    return;
                }
            }

            $post = Post::create([
                'user_id' => Auth::id(),
                'content' => $this->content,
                'image' => $imagePath,
            ]);

            // Process mentions in post content
            $this->processMentions($this->content, $post, 'post');

            // Dispatch event for real-time updates
            $this->dispatch('postCreated');

            // Reset form
            $this->reset(['content', 'image', 'showImagePreview']);

            session()->flash('message', 'Post created successfully!');
        } catch (\Exception $e) {
            Log::error('Post creation failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            $this->addError('content', 'Failed to create post. Please try again.');
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
        if (!$user) return;

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
