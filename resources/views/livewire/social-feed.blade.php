<div class="max-w-4xl mx-auto p-6">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Social Feed</h1>
        <p class="text-gray-600 dark:text-gray-400">Share your thoughts and connect with colleagues</p>
    </div>

    <!-- Create Post Component -->
    <div class="mb-6">
        @livewire('create-post')
    </div>

    <!-- Posts Feed -->
    <div class="space-y-6">
        @forelse($posts as $post)
            @livewire('post-card', ['post' => $post], key($post->id))
        @empty
            <div class="text-center py-12">
                <div class="text-gray-400 dark:text-gray-600 mb-4">
                    <svg class="mx-auto h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">No posts yet</h3>
                <p class="text-gray-600 dark:text-gray-400">Be the first to share something with your colleagues!</p>
            </div>
        @endforelse
    </div>

    <!-- Load More Button -->
    @if($posts->hasMorePages())
        <div class="text-center mt-8">
            <button wire:click="loadMore" 
                    class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition duration-200">
                Load More Posts
            </button>
        </div>
    @endif
</div>