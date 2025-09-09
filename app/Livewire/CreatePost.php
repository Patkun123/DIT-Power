<?php

namespace App\Livewire;

use App\Models\Post;
use App\Events\PostCreated;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CreatePost extends Component
{
    use WithFileUploads;

    public $content = '';
    public $image;
    public $showImagePreview = false;

    protected $rules = [
        'content' => 'required|string|max:1000',
        'image' => 'nullable|image|max:2048',
    ];

    protected $messages = [
        'content.required' => 'Post content is required.',
        'content.max' => 'Post content cannot exceed 1000 characters.',
        'image.image' => 'File must be an image.',
        'image.max' => 'Image size cannot exceed 2MB.',
    ];

    public function updatedImage()
    {
        $this->validateOnly('image');
        $this->showImagePreview = true;
    }

    public function createPost()
    {
        $this->validate();

        $imagePath = null;
        if ($this->image) {
            $imagePath = $this->image->store('posts', 'public');
        }

        $post = Post::create([
            'user_id' => Auth::id(),
            'content' => $this->content,
            'image' => $imagePath,
        ]);

        // Dispatch event for real-time updates
        $this->dispatch('postCreated');
        
        // Reset form
        $this->reset(['content', 'image', 'showImagePreview']);

        session()->flash('message', 'Post created successfully!');
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