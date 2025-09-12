<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class SocialFeedTest extends Component
{
    use WithPagination;

    public $perPage = 10;

    protected $listeners = [
        'postCreated' => '$refresh',
        'postLiked' => '$refresh',
        'commentCreated' => '$refresh',
        'replyCreated' => '$refresh',
    ];

    public function loadMore()
    {
        $this->perPage += 10;
    }

    public function render()
    {
        $posts = Post::with(['user', 'comments.user', 'comments.replies.user', 'likes.user'])
            ->withCount(['comments', 'likes'])
            ->latest()
            ->paginate($this->perPage);

        return view('livewire.social-feed-test', [
            'posts' => $posts
        ]);
    }
}