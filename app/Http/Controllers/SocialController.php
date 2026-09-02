<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Reply;
use App\Models\Message;
use App\Models\Mention;
use App\Models\User;
use App\Events\PostCreated;
use App\Events\PostLiked;
use App\Events\CommentCreated;
use App\Events\CommentLiked;
use App\Events\ReplyCreated;
use App\Services\ChatNotificationService;
use App\Services\ImageScanService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SocialController extends Controller
{
    public function index()
    {
        return view('auth.users.view.social');
    }

    public function show(Post $post)
    {
        return view('Auth.users.view.social', compact('post'));
    }

    // ========== POST METHODS ==========
    
    public function storePost(Request $request)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:1000',
            'image' => 'nullable|image|max:8048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            
            // Scan the image for security threats
            $scanService = new ImageScanService();
            $scanResult = $scanService->scanImage($imageFile);
            
            if (!$scanResult['success']) {
                return back()->withErrors(['image' => $scanResult['message']])->withInput();
            }
            
            // Ensure public/posts directory exists
            $publicPath = public_path('posts');
            if (!file_exists($publicPath)) {
                mkdir($publicPath, 0755, true);
            }
            
            // Generate unique filename
            $filename = time() . '_' . uniqid() . '.' . $imageFile->getClientOriginalExtension();
            $imagePath = 'posts/' . $filename;
            
            // Move file to public/posts directory
            $imageFile->move($publicPath, $filename);
        }

        $post = Post::create([
            'user_id' => Auth::id(),
            'content' => $validated['content'],
            'image' => $imagePath,
        ]);

        $this->processMentions($validated['content'], $post, 'post');
        event(new PostCreated($post));

        return redirect()->route('social.tools')->with('success', 'Post created successfully!');
    }

    public function updatePost(Request $request, Post $post)
    {
        if (Auth::id() !== $post->user_id) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $post->update(['content' => $validated['content']]);

        Mention::where('post_id', $post->id)->where('mentionable_type', 'post')->delete();
        $this->processMentions($validated['content'], $post, 'post');

        return back()->with('success', 'Post updated successfully!');
    }

    public function deletePost(Post $post)
    {
        if (!$this->userCanManagePost($post)) {
            abort(403, 'Unauthorized action.');
        }

        if (!empty($post->image)) {
            $imagePath = public_path($post->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        Mention::where('post_id', $post->id)->delete();
        $post->likes()->delete();
        
        $post->comments()->each(function ($comment) {
            $comment->likes()->delete();
            $comment->replies()->each(function ($reply) {
                $reply->childReplies()->delete();
            });
            $comment->replies()->delete();
            $comment->delete();
        });

        $post->delete();

        return redirect()->route('social.tools')->with('success', 'Post deleted successfully!');
    }

    public function toggleLike(Request $request, Post $post)
    {
        $user = Auth::user();
        
        if ($post->isLikedBy($user)) {
            $post->unlike($user);
            $message = 'Post unliked';
        } else {
            $post->like($user);
            if ($post->user_id !== Auth::id()) {
                event(new PostLiked($post, $user));
            }
            $message = 'Post liked';
        }

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => $message,
                'likes_count' => $post->fresh()->likes_count,
            ]);
        }

        return back()->with('success', $message);
    }

    // ========== COMMENT METHODS ==========
    
    public function storeComment(Request $request, Post $post)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:500',
        ]);

        $comment = Comment::create([
            'post_id' => $post->id,
            'user_id' => Auth::id(),
            'content' => $validated['content'],
        ]);

        $post->incrementCommentsCount();
        $this->processMentions($validated['content'], $comment, 'comment', $post->id);
        event(new CommentCreated($comment));

        return back()->with('success', 'Comment added successfully!');
    }

    public function deleteComment(Comment $comment)
    {
        if (Auth::id() !== $comment->user_id) {
            abort(403, 'Unauthorized action.');
        }

        $post = $comment->post;
        
        $comment->likes()->delete();
        $comment->replies()->each(function ($reply) {
            $reply->childReplies()->delete();
        });
        $comment->replies()->delete();
        $comment->delete();
        
        $post->decrementCommentsCount();

        return back()->with('success', 'Comment deleted successfully!');
    }

    public function toggleCommentLike(Request $request, Comment $comment)
    {
        $user = Auth::user();
        
        if ($comment->isLikedBy($user)) {
            $comment->unlike($user);
            $message = 'Comment unliked';
        } else {
            $comment->like($user);
            if ($comment->user_id !== Auth::id()) {
                event(new CommentLiked($comment, $user));
            }
            $message = 'Comment liked';
        }

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => $message,
                'likes_count' => $comment->fresh()->likes_count,
            ]);
        }

        return back()->with('success', $message);
    }

    // ========== REPLY METHODS ==========
    
    public function storeReply(Request $request, Comment $comment)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:500',
            'parent_reply_id' => 'nullable|exists:replies,id',
        ]);

        $reply = Reply::create([
            'comment_id' => $comment->id,
            'user_id' => Auth::id(),
            'content' => $validated['content'],
            'parent_reply_id' => $validated['parent_reply_id'] ?? null,
        ]);

        $comment->incrementRepliesCount();
        $this->processMentions($validated['content'], $reply, 'reply', $comment->post_id);
        event(new ReplyCreated($reply));

        return back()->with('success', 'Reply added successfully!');
    }

    public function deleteReply(Reply $reply)
    {
        if (Auth::id() !== $reply->user_id) {
            abort(403, 'Unauthorized action.');
        }

        $comment = $reply->comment;
        
        $reply->childReplies()->delete();
        $reply->delete();
        
        $comment->decrementRepliesCount();

        return back()->with('success', 'Reply deleted successfully!');
    }

    public function toggleReplyLike(Request $request, Reply $reply)
    {
        $user = Auth::user();
        
        if ($reply->isLikedBy($user)) {
            $reply->unlike($user);
            $message = 'Reply unliked';
        } else {
            $reply->like($user);
            $message = 'Reply liked';
        }

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => $message,
                'likes_count' => $reply->fresh()->likes_count,
            ]);
        }

        return back()->with('success', $message);
    }

    // ========== CHAT METHODS ==========
    
    public function sendMessage(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string|max:500',
        ]);

        $message = Message::create([
            'user_id' => Auth::id(),
            'message' => $validated['message'],
        ]);

        $chatNotificationService = new ChatNotificationService();
        $chatNotificationService->sendChatNotification($validated['message'], Auth::id());

        preg_match_all('/@(\w+\s+\w+)/', $validated['message'], $matches);
        if (!empty($matches[1])) {
            foreach ($matches[1] as $mention) {
                $user = User::whereRaw(User::getFullNameConcatSql() . " = ?", [$mention])->first();
                if ($user && $user->id !== Auth::id()) {
                    $chatNotificationService->sendChatMentionNotification($validated['message'], Auth::id(), $user->id);
                }
            }
        }

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Message sent successfully!',
                'data' => $message->load('user'),
            ]);
        }

        return back()->with('success', 'Message sent successfully!');
    }

    public function deleteMessage(Message $message)
    {
        if (Auth::id() !== $message->user_id) {
            abort(403, 'Unauthorized action.');
        }

        $message->delete();

        return back()->with('success', 'Message deleted successfully!');
    }

    // ========== MENTION METHODS ==========
    
    public function getMentions()
    {
        $mentions = Mention::where('user_id', Auth::id())
            ->with(['post', 'mentionedBy'])
            ->latest()
            ->paginate(20);

        return response()->json($mentions);
    }

    // ========== HELPER METHODS ==========
    
    private function processMentions($content, $model, $type, $postId = null)
    {
        preg_match_all('/@(\w+\s+\w+)/', $content, $matches);

        if (!empty($matches[1])) {
            foreach ($matches[1] as $mention) {
                $user = User::whereRaw(User::getFullNameConcatSql() . " = ?", [$mention])->first();

                if ($user && $user->id !== Auth::id()) {
                    $mentionPostId = $postId ?? ($model instanceof Post ? $model->id : ($model->post_id ?? null));
                    
                    Mention::create([
                        'user_id' => $user->id,
                        'mentioned_by' => Auth::id(),
                        'mentionable_type' => $type,
                        'mentionable_id' => $model->id,
                        'post_id' => $mentionPostId,
                        'content' => $content,
                    ]);

                    \App\Models\Notification::create([
                        'user_id' => $user->id,
                        'type' => 'mention',
                        'title' => 'You were mentioned',
                        'message' => Auth::user()->firstname . ' ' . Auth::user()->lastname . ' mentioned you in a ' . $type,
                        'data' => [
                            'mentioned_by' => Auth::id(),
                            'mentioned_by_name' => Auth::user()->firstname . ' ' . Auth::user()->lastname,
                            'post_id' => $mentionPostId,
                            'mention_type' => $type,
                            'mention_id' => $model->id,
                        ],
                    ]);
                }
            }
        }
    }

    private function userCanManagePost(Post $post): bool
    {
        $user = Auth::user();

        if (!$user) {
            return false;
        }

        return $user->id === $post->user_id || $user->role === 'admin';
    }
}
