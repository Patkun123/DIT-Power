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
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class PostCard extends Component
{
    public Post $post;
    public bool $deleted = false;
    public bool $isEditing = false;
    public string $editContent = '';
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
        $content = $this->newNestedReply[$topLevelParentId] ?? $this->newNestedReply[$replyId];
        $this->processMentions($content, $reply, 'nested_reply');

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
        try {
            $mentionQuery = $this->extractMentionQuery((string) $rawInput);
            if ($mentionQuery === null) {
                $this->showMentionSuggestions = false;
                $this->mentionQuery = '';
                return;
            }

            $this->mentionQuery = $mentionQuery; // can be empty string right after '@'
            $this->currentMentionField = $field;
            $this->selectedMentionIndex = -1;

            // Limit query length to prevent performance issues
            if (strlen($mentionQuery) > 50) {
                $this->showMentionSuggestions = false;
                return;
            }

            $this->mentionSuggestions = User::where('id', '!=', Auth::id())
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
        } catch (\Exception $e) {
            // Log the error and hide suggestions
            Log::error('Error searching users for mentions: ' . $e->getMessage(), [
                'input' => $rawInput,
                'field' => $field,
                'user_id' => Auth::id(),
            ]);
            $this->showMentionSuggestions = false;
        }
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
        if (preg_match('/^([A-Za-z][A-Za-z\s\-\']{0,49})/', $after, $m)) {
            return trim($m[1]);
        }
        return null;
    }

    public function selectMention($userId, $field)
    {
        $user = User::find($userId);
        if (!$user) return;

        $mentionText = "@{$user->firstname} {$user->lastname}";

        // Find the last @ symbol and replace everything after it with the full mention
        $replacePattern = '@' . ($this->mentionQuery ?: '');

        // Update the appropriate field
        if ($field === 'comment') {
            $this->newComment = $this->replaceLastMention($this->newComment, $replacePattern, $mentionText);
        } elseif (str_starts_with($field, 'reply_')) {
            $commentId = str_replace('reply_', '', $field);
            $this->newReply[$commentId] = $this->replaceLastMention($this->newReply[$commentId], $replacePattern, $mentionText);
        } elseif (str_starts_with($field, 'nested_reply_')) {
            $replyId = str_replace('nested_reply_', '', $field);
            $this->newNestedReply[$replyId] = $this->replaceLastMention($this->newNestedReply[$replyId], $replacePattern, $mentionText);
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

    private function processMentions($content, $model, $type)
    {
        try {
            // Extract mentions from content using regex - improved to handle names with special characters
            preg_match_all('/@([A-Za-z][A-Za-z\s\-\']{1,50})/', $content, $matches);

            if (!empty($matches[1])) {
                foreach ($matches[1] as $mention) {
                    $mention = trim($mention);
                    if (empty($mention)) continue;

                    $user = User::whereRaw("firstname || ' ' || lastname = ?", [$mention])->first();

                    if ($user && $user->id !== Auth::id()) {
                        // Check if mention already exists to avoid duplicates
                        $existingMention = Mention::where([
                            'user_id' => $user->id,
                            'mentioned_by' => Auth::id(),
                            'mentionable_type' => $type,
                            'mentionable_id' => $model->id,
                        ])->first();

                        if (!$existingMention) {
                            // Create mention record
                            Mention::create([
                                'user_id' => $user->id,
                                'mentioned_by' => Auth::id(),
                                'mentionable_type' => $type,
                                'mentionable_id' => $model->id,
                                'post_id' => $this->post->id,
                                'content' => $content,
                            ]);
                        }

                        // Create notification for mentioned user (always create notification)
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
        } catch (\Exception $e) {
            // Log the error but don't break the main functionality
            Log::error('Error processing mentions: ' . $e->getMessage(), [
                'content' => $content,
                'type' => $type,
                'model_id' => $model->id ?? null,
                'user_id' => Auth::id(),
            ]);
        }
    }

    public function parseMentions($content)
    {
        // Parse mentions and convert them to clickable links with styling - improved regex
        return preg_replace_callback('/@([A-Za-z][A-Za-z\s\-\']{1,50})/', function ($matches) {
            $mention = $matches[1];
            $user = User::whereRaw("firstname || ' ' || lastname = ?", [$mention])->first();

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
            return; // silently ignore
        }

        // Delete post image if exists
        if (!empty($this->post->image)) {
            Storage::disk('public')->delete($this->post->image);
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
    }

    public function startEdit(): void
    {
        $user = Auth::user();
        if (!$user || ($user->id !== $this->post->user_id)) {
            return;
        }
        $this->editContent = $this->post->content ?? '';
        $this->isEditing = true;
    }

    public function cancelEdit(): void
    {
        $this->isEditing = false;
        $this->editContent = '';
    }

    public function updatePost(): void
    {
        $user = Auth::user();
        if (!$user || ($user->id !== $this->post->user_id)) {
            return;
        }

        $this->validate([
            'editContent' => 'required|string|max:1000',
        ]);

        // Update content
        $this->post->content = $this->editContent;
        $this->post->save();

        // Refresh mentions: remove existing and re-create from updated content
        \App\Models\Mention::where('post_id', $this->post->id)->where('mentionable_type', 'post')->delete();
        $this->processMentions($this->editContent, $this->post, 'post');

        $this->isEditing = false;
        $this->dispatch('postUpdated', id: $this->post->id);
    }
}
