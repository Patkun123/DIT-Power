<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Reply;

class SocialNotificationService
{
    public function createPostLikedNotification(Post $post, User $liker)
    {
        if ($post->user_id !== $liker->id) {
            Notification::create([
                'user_id' => $post->user_id,
                'type' => 'post_liked',
                'title' => 'Post Liked',
                'message' => $liker->firstname . ' ' . $liker->lastname . ' liked your post',
                'data' => [
                    'post_id' => $post->id,
                    'liker_id' => $liker->id,
                    'liker_name' => $liker->firstname . ' ' . $liker->lastname,
                    'url'        => route('social.show', $post->id),
                ],
            ]);
        }
    }

    public function createCommentLikedNotification(Comment $comment, User $liker)
    {
        if ($comment->user_id !== $liker->id) {
            Notification::create([
                'user_id' => $comment->user_id,
                'type' => 'comment_liked',
                'title' => 'Comment Liked',
                'message' => $liker->firstname . ' ' . $liker->lastname . ' liked your comment',
                'data' => [
                    'comment_id' => $comment->id,
                    'post_id' => $comment->post_id,
                    'liker_id' => $liker->id,
                    'liker_name' => $liker->firstname . ' ' . $liker->lastname,
                    'url'        => route('social.show', $comment->post_id) . '#comment-' . $comment->id,
                ],
            ]);
        }
    }

    public function createCommentCreatedNotification(Comment $comment)
    {
        if ($comment->post->user_id !== $comment->user_id) {
            Notification::create([
                'user_id' => $comment->post->user_id,
                'type' => 'comment_created',
                'title' => 'New Comment',
                'message' => $comment->user->firstname . ' ' . $comment->user->lastname . ' commented on your post',
                'data' => [
                    'comment_id' => $comment->id,
                    'post_id' => $comment->post_id,
                    'commenter_id' => $comment->user_id,
                    'commenter_name' => $comment->user->firstname . ' ' . $comment->user->lastname,
                    'url' => route('social.show', $comment->post_id) . '#comment-' . $comment->id, // ✅ scroll to comment
                ],
            ]);
        }
    }

    public function createReplyCreatedNotification(Reply $reply)
    {
        if ($reply->comment->user_id !== $reply->user_id) {
            Notification::create([
                'user_id' => $reply->comment->user_id,
                'type' => 'reply_created',
                'title' => 'New Reply',
                'message' => $reply->user->firstname . ' ' . $reply->user->lastname . ' replied to your comment',
                'data' => [
                    'reply_id' => $reply->id,
                    'comment_id' => $reply->comment_id,
                    'post_id' => $reply->comment->post_id,
                    'replier_id' => $reply->user_id,
                    'replier_name' => $reply->user->firstname . ' ' . $reply->user->lastname,
                    'url' => route('social.show', $reply->comment->post_id) . '#reply-' . $reply->id, // ✅ scroll to reply
                ],
            ]);
        }
    }
}
