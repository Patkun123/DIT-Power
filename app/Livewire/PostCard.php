<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\Comment;
use App\Models\Reply;
use App\Models\User;
use App\Models\Mention;
use App\Events\PostLiked;
use App\Events\CommentLiked;
use App\Events\CommentCreated;
use App\Events\ReplyCreated;
use App\Services\ImageScanService;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class PostCard extends Component
{
    use WithFileUploads;

    public Post $post;
    public bool $deleted = false;
    public bool $isEditing = false;
    public string $editContent = '';
    public $editImage;
    public $showEditImagePreview = false;
    public $newComment = '';
    public $newReply = [];
    public $newNestedReply = [];
    public $showComments = false;
    public $showReplies = [];
    public $showNestedReplies = [];

    // Mention functionality
    public $mentionQuery = '';
    public $showMentionSuggestions = false;
    public $mentionSuggestions = [];
    public $selectedMentionIndex = -1;
    public $currentMentionField = '';
    public $mentionStartPosition = 0;

    protected $listeners = [
        'commentCreated' => '$refresh',
        'replyCreated' => '$refresh',
    ];

    public function mount(Post $post)
    {
        $this->post = $post;

        // Auto-show replies for comments that have replies (Facebook-style)
        foreach ($this->post->comments as $comment) {
            if ($comment->replies->where('parent_reply_id', null)->count() > 0) {
                $this->showReplies[$comment->id] = true;

                // Auto-show nested replies for replies that have nested replies
                foreach ($comment->replies->where('parent_reply_id', null) as $reply) {
                    if ($reply->childReplies->count() > 0) {
                        $this->showNestedReplies[$reply->id] = true;
                    }
                }
            }
        }
    }

    public function toggleLike()
    {
        if ($this->post->isLikedBy(Auth::user())) {
            $this->post->unlike(Auth::user());
        } else {
            $this->post->like(Auth::user());

            // Dispatch event for real-time notification
            if ($this->post->user_id !== Auth::id()) {
                event(new PostLiked($this->post, Auth::user()));
            }
        }

        $this->dispatch('postLiked');
    }

    public function addComment()
    {
        $this->validate([
            'newComment' => 'required|string|max:500',
        ]);

        $comment = Comment::create([
            'post_id' => $this->post->id,
            'user_id' => Auth::id(),
            'content' => $this->newComment,
        ]);

        $this->post->incrementCommentsCount();

        // Process mentions in comment
        $this->processMentions($this->newComment, $comment, 'comment');

        // Dispatch event for real-time notification
        event(new CommentCreated($comment));

        $this->newComment = '';
        $this->showComments = true;

        $this->dispatch('commentCreated');
    }

    public function addReply($commentId)
    {
        $this->validate([
            "newReply.{$commentId}" => 'required|string|max:500',
        ]);

        $reply = Reply::create([
            'comment_id' => $commentId,
            'user_id' => Auth::id(),
            'content' => $this->newReply[$commentId],
        ]);

        $comment = Comment::find($commentId);
        $comment->incrementRepliesCount();

        // Process mentions in reply
        $this->processMentions($this->newReply[$commentId], $reply, 'reply');

        // Dispatch event for real-time notification
        event(new ReplyCreated($reply));

        $this->newReply[$commentId] = '';
        $this->showReplies[$commentId] = true;

        $this->dispatch('replyCreated');
    }

    public function toggleCommentLike($commentId)
    {
        $comment = Comment::find($commentId);

        if ($comment->isLikedBy(Auth::user())) {
            $comment->unlike(Auth::user());
        } else {
            $comment->like(Auth::user());

            // Dispatch event for real-time notification
            if ($comment->user_id !== Auth::id()) {
                event(new CommentLiked($comment, Auth::user()));
            }
        }

        $this->dispatch('commentCreated');
    }

    public function addNestedReply($replyId)
    {
        $this->validate([
            "newNestedReply.{$replyId}" => 'required|string|max:500',
        ]);

        $parentReply = Reply::find($replyId);
        // Ensure we don't create deeper nesting levels: always attach to the top-level reply
        $topLevelParentId = $parentReply->parent_reply_id ? $parentReply->parent_reply_id : $parentReply->id;
        $topLevelParent = $parentReply->parent_reply_id ? Reply::find($parentReply->parent_reply_id) : $parentReply;

        $reply = Reply::create([
            'comment_id' => $parentReply->comment_id,
            'parent_reply_id' => $topLevelParentId,
            'user_id' => Auth::id(),
            'content' => $this->newNestedReply[$topLevelParentId] ?? $this->newNestedReply[$replyId],
        ]);

        $topLevelParent->incrementRepliesCount();

        // Process mentions in nested reply
        $this->processMentions($this->newNestedReply[$replyId], $reply, 'nested_reply');

        // Dispatch event for real-time notification
        event(new ReplyCreated($reply));

        $this->newNestedReply[$topLevelParentId] = '';
        $this->showNestedReplies[$topLevelParentId] = true;

        $this->dispatch('replyCreated');
    }

    public function toggleNestedReplies($replyId)
    {
        $this->showNestedReplies[$replyId] = !($this->showNestedReplies[$replyId] ?? false);

        // Auto-populate nested reply with mention if showing nested replies
        if ($this->showNestedReplies[$replyId]) {
            $reply = Reply::find($replyId);
            if ($reply && $reply->user_id !== Auth::id()) {
                $this->newNestedReply[$replyId] = "@{$reply->user->firstname} {$reply->user->lastname} ";
            }
        }
    }

    public function toggleReplies($commentId)
    {
        $this->showReplies[$commentId] = !($this->showReplies[$commentId] ?? false);

        // Auto-populate reply with mention if showing replies
        if ($this->showReplies[$commentId]) {
            $comment = Comment::find($commentId);
            if ($comment && $comment->user_id !== Auth::id()) {
                $this->newReply[$commentId] = "@{$comment->user->firstname} {$comment->user->lastname} ";
            }
        }
    }

    public function toggleComments()
    {
        $this->showComments = !$this->showComments;
    }

    public function startReply($commentId, $userId = null)
    {
        $this->showReplies[$commentId] = true;

        // Auto-populate with mention if user ID is provided
        if ($userId) {
            $user = User::find($userId);
            if ($user && $user->id !== Auth::id()) {
                $this->newReply[$commentId] = "@{$user->firstname} {$user->lastname} ";
            }
        } else {
            // Fallback to comment author
            $comment = Comment::find($commentId);
            if ($comment && $comment->user_id !== Auth::id()) {
                $this->newReply[$commentId] = "@{$comment->user->firstname} {$comment->user->lastname} ";
            }
        }

        // Emit event for JavaScript focus
        $this->dispatch('replyStarted');
    }

    public function startNestedReply($replyId, $userId = null)
    {
        $reply = Reply::find($replyId);
        if (!$reply) {
            return;
        }

        // Target the top-level reply container
        $topLevelParentId = $reply->parent_reply_id ? $reply->parent_reply_id : $reply->id;
        $this->showNestedReplies[$topLevelParentId] = true;

        // Auto-populate with mention of the intended user in the top-level nested input
        $targetUserId = $userId ?: $reply->user_id;
        $user = User::find($targetUserId);
        if ($user && $user->id !== Auth::id()) {
            $this->newNestedReply[$topLevelParentId] = "@{$user->firstname} {$user->lastname} ";
        }

        // Emit event for JavaScript focus
        $this->dispatch('nestedReplyStarted');
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

        $this->mentionQuery = $mentionQuery; // can be empty string right after '@'
        $this->currentMentionField = $field;
        $this->selectedMentionIndex = -1;

        $this->mentionSuggestions = User::where('id', '!=', Auth::id())
            ->when($mentionQuery !== '', function ($q) use ($mentionQuery) {
                $q->where(function ($q2) use ($mentionQuery) {
                    $q2->where('firstname', 'like', "%{$mentionQuery}%")
                        ->orWhere('lastname', 'like', "%{$mentionQuery}%")
                        ->orWhereRaw(User::getFullNameConcatSql() . " LIKE ?", ["%{$mentionQuery}%"]);
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
        // Stop at newline or punctuation; allow letters and spaces for first+last name
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
        $user = User::find($userId);
        if (!$user) return;

        $mentionText = "@{$user->firstname} {$user->lastname}";

        // Update the appropriate field
        if ($field === 'comment') {
            $this->newComment = str_replace("@{$this->mentionQuery}", $mentionText, $this->newComment);
        } elseif (str_starts_with($field, 'reply_')) {
            $commentId = str_replace('reply_', '', $field);
            $this->newReply[$commentId] = str_replace("@{$this->mentionQuery}", $mentionText, $this->newReply[$commentId]);
        } elseif (str_starts_with($field, 'nested_reply_')) {
            $replyId = str_replace('nested_reply_', '', $field);
            $this->newNestedReply[$replyId] = str_replace("@{$this->mentionQuery}", $mentionText, $this->newNestedReply[$replyId]);
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

    private function processMentions($content, $model, $type)
    {
        // Extract mentions from content using regex
        preg_match_all('/@(\w+\s+\w+)/', $content, $matches);

        if (!empty($matches[1])) {
            foreach ($matches[1] as $mention) {
                $user = User::whereRaw(User::getFullNameConcatSql() . " = ?", [$mention])->first();

                if ($user && $user->id !== Auth::id()) {
                    // Create mention record
                    Mention::create([
                        'user_id' => $user->id,
                        'mentioned_by' => Auth::id(),
                        'mentionable_type' => $type,
                        'mentionable_id' => $model->id,
                        'post_id' => $this->post->id,
                        'content' => $content,
                    ]);

                    // Create notification for mentioned user
                    \App\Models\Notification::create([
                        'user_id' => $user->id,
                        'type' => 'mention',
                        'title' => 'You were mentioned',
                        'message' => Auth::user()->firstname . ' ' . Auth::user()->lastname . ' mentioned you in a ' . $type,
                        'data' => [
                            'mentioned_by' => Auth::id(),
                            'mentioned_by_name' => Auth::user()->firstname . ' ' . Auth::user()->lastname,
                            'post_id' => $this->post->id,
                            'mention_type' => $type,
                            'mention_id' => $model->id,
                        ],
                    ]);
                }
            }
        }
    }

    public function parseMentions($content)
    {
        // Parse mentions and convert them to clickable links with styling
        return preg_replace_callback('/@(\w+\s+\w+)/', function ($matches) {
            $mention = $matches[1];
            $user = User::whereRaw(User::getFullNameConcatSql() . " = ?", [$mention])->first();

            if ($user) {
                return '<span class="mention-highlight text-blue-600 dark:text-blue-400 font-medium cursor-pointer hover:underline" title="' . $user->firstname . ' ' . $user->lastname . '">@' . $mention . '</span>';
            }

            return $matches[0]; // Return original if user not found
        }, htmlspecialchars($content));
    }

    public function render()
    {
        if ($this->deleted) {
            // Return an empty view when deleted so the parent list can collapse spacing
            return view('livewire.post-card');
        }

        $this->post->load(['user', 'comments.user', 'comments.replies.user', 'comments.replies.childReplies.user', 'likes.user']);

        return view('livewire.post-card');
    }

    public function deletePost(): void
    {
        // Authorization: owner or admin only
        $user = Auth::user();
        if (!$user || ($user->id !== $this->post->user_id)) {
            $this->dispatch('deleteError', message: 'You are not authorized to delete this post.');
            return;
        }

        try {
            // Delete post image if exists
            if (!empty($this->post->image)) {
                $imagePath = public_path($this->post->image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            // Cleanup related data (mentions, likes, comments, replies)
            \App\Models\Mention::where('post_id', $this->post->id)->delete();

            // Delete likes on post
            if (method_exists($this->post, 'likes')) {
                $this->post->likes()->delete();
            }

            // Delete comments, their likes and replies
            $this->post->comments()->each(function ($comment) {
                if (method_exists($comment, 'likes')) {
                    $comment->likes()->delete();
                }
                // Delete replies and nested replies
                $comment->replies()->each(function ($reply) {
                    // Delete child replies
                    if (method_exists($reply, 'childReplies')) {
                        $reply->childReplies()->delete();
                    }
                });
                $comment->replies()->delete();
                $comment->delete();
            });

            // Finally delete the post
            $postId = $this->post->id;
            $this->post->delete();

            $this->deleted = true;
            $this->dispatch('postDeleted', id: $postId);
            $this->dispatch('deleteSuccess', message: 'Post deleted successfully!');
        } catch (\Exception $e) {
            $this->dispatch('deleteError', message: 'Failed to delete post. Please try again.');
        }
    }

    public function startEdit(): void
    {
        $user = Auth::user();
        if (!$user || ($user->id !== $this->post->user_id)) {
            return;
        }
        $this->editContent = $this->post->content ?? '';
        $this->editImage = null;
        $this->showEditImagePreview = false;
        $this->isEditing = true;
    }

    public function cancelEdit(): void
    {
        $this->isEditing = false;
        $this->editContent = '';
        $this->editImage = null;
        $this->showEditImagePreview = false;
    }

    public function updatedEditImage()
    {
        try {
            $this->validateOnly('editImage', [
                'editImage' => 'nullable|image|max:8048',
            ]);
            
            // Scan the image for security threats
            if ($this->editImage) {
                try {
                    $scanService = new ImageScanService();
                    $scanResult = $scanService->scanImage($this->editImage);
                    
                    if (!$scanResult['success']) {
                        Log::warning('Image scan failed during edit', [
                            'error' => $scanResult['message'],
                            'file' => $this->editImage->getClientOriginalName(),
                        ]);
                        $this->addError('editImage', $scanResult['message']);
                        $this->editImage = null;
                        $this->showEditImagePreview = false;
                        return;
                    }
                } catch (\Exception $e) {
                    Log::error('Image scanning exception during edit', [
                        'error' => $e->getMessage(),
                        'trace' => $e->getTraceAsString(),
                    ]);
                    $this->addError('editImage', 'Image validation encountered an error. Please try again.');
                    $this->editImage = null;
                    $this->showEditImagePreview = false;
                    return;
                }
            }
            
            $this->showEditImagePreview = true;
        } catch (\Exception $e) {
            Log::error('Image upload validation failed during edit', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            $this->addError('editImage', 'Failed to process image. Please try again.');
            $this->editImage = null;
            $this->showEditImagePreview = false;
        }
    }

    public function removeEditImage(): void
    {
        // If there's a new image being uploaded, remove it
        if ($this->editImage) {
            $this->editImage = null;
            $this->showEditImagePreview = false;
        } else {
            // If there's an existing image, mark it for deletion
            $this->post->image = null;
            $this->post->save();
        }
    }

    public function updatePost(): void
    {
        $user = Auth::user();
        if (!$user || ($user->id !== $this->post->user_id)) {
            return;
        }

        $this->validate([
            'editContent' => 'required|string|max:1000',
            'editImage' => 'nullable|image|max:8048',
        ]);

        // Handle image upload if new image is provided
        if ($this->editImage) {
            try {
                // Delete old image if exists
                if (!empty($this->post->image)) {
                    $oldImagePath = public_path($this->post->image);
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }

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
                $filename = time() . '_' . uniqid() . '.' . $this->editImage->getClientOriginalExtension();
                $imagePath = 'posts/' . $filename;
                $fullPath = $publicPath . DIRECTORY_SEPARATOR . $filename;
                
                // For Livewire uploads, get the real path and copy the file
                $tempPath = $this->editImage->getRealPath();
                if (!$tempPath || !file_exists($tempPath)) {
                    throw new \Exception('Temporary file not found. Please try uploading again.');
                }
                
                if (!copy($tempPath, $fullPath)) {
                    throw new \Exception('Failed to copy image to public directory. Please check permissions.');
                }
                
                // Update post image
                $this->post->image = $imagePath;
            } catch (\Exception $e) {
                Log::error('Image storage failed during post update', [
                    'error' => $e->getMessage(),
                    'file' => $this->editImage->getClientOriginalName(),
                    'trace' => $e->getTraceAsString(),
                ]);
                $this->addError('editImage', 'Failed to save image. Please check storage permissions.');
                return;
            }
        }
        
        // Handle image removal if image was set to null
        $originalImage = $this->post->getOriginal('image');
        if (empty($this->post->image) && !empty($originalImage) && !$this->editImage) {
            // Delete the old image file
            $oldImagePath = public_path($originalImage);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }

        // Update content
        $this->post->content = $this->editContent;
        $this->post->save();

        // Refresh mentions: remove existing and re-create from updated content
        \App\Models\Mention::where('post_id', $this->post->id)->where('mentionable_type', 'post')->delete();
        $this->processMentions($this->editContent, $this->post, 'post');

        $this->isEditing = false;
        $this->editImage = null;
        $this->showEditImagePreview = false;
        $this->dispatch('postUpdated', id: $this->post->id);
    }
}
