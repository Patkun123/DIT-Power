<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\Comment;
use App\Models\Reply;
use App\Events\PostLiked;
use App\Events\CommentLiked;
use App\Events\CommentCreated;
use App\Events\ReplyCreated;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class PostCard extends Component
{
    public Post $post;
    public $newComment = '';
    public $newReply = [];
    public $showComments = false;
    public $showReplies = [];

    protected $listeners = [
        'commentCreated' => '$refresh',
        'replyCreated' => '$refresh',
    ];

    public function mount(Post $post)
    {
        $this->post = $post;
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

    public function toggleReplies($commentId)
    {
        $this->showReplies[$commentId] = !($this->showReplies[$commentId] ?? false);
    }

    public function toggleComments()
    {
        $this->showComments = !$this->showComments;
    }

    public function render()
    {
        $this->post->load(['user', 'comments.user', 'comments.replies.user', 'likes.user']);
        
        return view('livewire.post-card');
    }
}