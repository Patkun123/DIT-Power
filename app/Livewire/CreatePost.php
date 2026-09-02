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
    public $showModal = false;

    // Mention functionality state
    public $mentionQuery = '';
    public $showMentionSuggestions = false;
    public $mentionSuggestions = [];
    public $selectedMentionIndex = -1;
    public $currentMentionField = '';

    protected $rules = [
<<<<<<< HEAD
        'content' => 'required|string|max:1000',
        'image' => 'nullable|image|max:8192',
=======
        'content' => 'nullable|string|max:1000',
        'image' => 'nullable|image|max:8048',
>>>>>>> Rooffce
    ];

    protected $messages = [
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
<<<<<<< HEAD
            $this->showImagePreview = true;
        } catch (\Exception $e) {
            Log::error('Image validation failed', [
                'error' => $e->getMessage()
            ]);
            $this->addError('image', 'Failed to upload image: ' . $e->getMessage());
=======

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
>>>>>>> Rooffce
            $this->image = null;
            $this->showImagePreview = false;
        }
    }

    public function createPost()
    {
        try {
<<<<<<< HEAD
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

            // Reset form and close modal
            $this->reset(['content', 'image', 'showImagePreview']);
            $this->showModal = false;

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
=======
            // Custom validation: at least content or image must be provided
            if (empty(trim($this->content)) && !$this->image) {
                $this->addError('content', 'Please provide either post content or an image.');
                return;
            }

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
                    // Ensure public/posts directory exists
                    $publicPath = public_path('posts');
                    if (!file_exists($publicPath)) {
                        if (!mkdir($publicPath, 0755, true)) {
                            throw new \Exception('Failed to create posts directory. Please check permissions.');
                        }
                    }

                    // Check if directory is writable
                    if (!is_writable($publicPath)) {
                        throw new \Exception('Posts directory is not writable. Please check permissions.');
                    }

                    // Generate unique filename
                    $filename = time() . '_' . uniqid() . '.' . $this->image->getClientOriginalExtension();
                    $imagePath = 'posts/' . $filename;
                    $fullPath = $publicPath . DIRECTORY_SEPARATOR . $filename;

                    // Use Livewire's storePubliclyAs to store in storage first (more reliable)
                    // Then copy to public directory for direct access
                    $storedPath = $this->image->storePubliclyAs('posts', $filename, 'public');
                    
                    if ($storedPath) {
                        // Copy from storage to public directory
                        $storagePath = storage_path('app/public/posts/' . $filename);
                        if (file_exists($storagePath)) {
                            if (!copy($storagePath, $fullPath)) {
                                Log::warning('Could not copy from storage to public, trying direct method');
                                // Fallback to direct method
                                $this->saveImageDirectly($fullPath);
                            }
                        } else {
                            // Storage path doesn't exist, try direct method
                            $this->saveImageDirectly($fullPath);
                        }
                    } else {
                        // storePubliclyAs failed, try direct method
                        $this->saveImageDirectly($fullPath);
                    }
                } catch (\Exception $e) {
                    Log::error('Image storage failed', [
                        'error' => $e->getMessage(),
                        'file' => $this->image->getClientOriginalName(),
                        'trace' => $e->getTraceAsString(),
                    ]);
                    $this->addError('image', 'Failed to save image: ' . $e->getMessage());
                    return;
                }
            }

            $post = Post::create([
                'user_id' => Auth::id(),
                'content' => trim($this->content) ?: null,
                'image' => $imagePath,
            ]);

            // Process mentions in post content (only if content exists)
            if (!empty(trim($this->content))) {
                $this->processMentions($this->content, $post, 'post');
            }

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
>>>>>>> Rooffce
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

    private function saveImageDirectly($fullPath)
    {
        // Try multiple methods to get the file content
        $tempPath = $this->image->getRealPath();
        
        if (!$tempPath || !file_exists($tempPath)) {
            $tempPath = $this->image->getPathname();
        }
        
        if (!$tempPath || !file_exists($tempPath)) {
            $tempPath = method_exists($this->image, 'path') ? $this->image->path() : null;
        }
        
        if ($tempPath && file_exists($tempPath)) {
            if (!copy($tempPath, $fullPath)) {
                throw new \Exception('Failed to copy image to public directory.');
            }
        } else {
            // Last resort: read content directly
            $fileContent = file_get_contents($this->image->getRealPath() ?: $this->image->path());
            if ($fileContent === false || file_put_contents($fullPath, $fileContent) === false) {
                throw new \Exception('Failed to save image file.');
            }
        }
    }

    public function removeImage()
    {
        $this->image = null;
        $this->showImagePreview = false;
    }

    public function openModal()
    {
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->reset(['content', 'image', 'showImagePreview', 'mentionQuery', 'showMentionSuggestions']);
    }

    public function render()
    {
        return view('livewire.create-post');
    }
}
