<div class="max-w-6xl mx-auto px-2 sm:px-4 lg:px-8 py-4 lg:py-6">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-4 lg:gap-6">

        <!-- Left Sidebar - Hidden on mobile, visible on desktop -->
        <div class="hidden lg:block lg:col-span-3 space-y-4">
            <!-- User Profile Card -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-4">
                <div class="flex items-center space-x-3">
                    <img class="h-12 w-12 rounded-full object-cover"
                         src="{{ auth()->user()->profile_image_url }}"
                         alt="{{ auth()->user()->firstname }}">
                    <div>
                        <h3 class="font-semibold text-gray-900 dark:text-white">{{ auth()->user()->firstname }} {{ auth()->user()->lastname }}</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ auth()->user()->staff->position ?? 'Employee' }}</p>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-4">
                <h4 class="font-semibold text-gray-900 dark:text-white mb-3">Quick Actions</h4>
                <div class="space-y-2">
                    <button class="w-full flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 text-left">
                        <div class="w-8 h-8 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"></path>
                            </svg>
                        </div>
                        <span class="text-gray-700 dark:text-gray-300">Find Friends</span>
                    </button>
                    <button class="w-full flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 text-left">
                        <div class="w-8 h-8 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-green-600 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2H4zm2 6a2 2 0 114 0 2 2 0 01-4 0zm8 0a2 2 0 114 0 2 2 0 01-4 0z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <span class="text-gray-700 dark:text-gray-300">Groups</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Main Feed -->
        <div class="lg:col-span-6 space-y-4">
            <!-- Create Post Component -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm">
                @livewire('create-post')
            </div>

            <!-- Posts Feed -->
            <div class="space-y-4">
                @forelse($posts as $post)
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm">
                        @livewire('post-card', ['post' => $post], key($post->id))
                    </div>
                @empty
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 sm:p-8 text-center">
                        <div class="text-gray-400 dark:text-gray-600 mb-4">
                            <svg class="mx-auto h-12 w-12 sm:h-16 sm:w-16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                            </svg>
                        </div>
                        <h3 class="text-base sm:text-lg font-medium text-gray-900 dark:text-white mb-2">No posts yet</h3>
                        <p class="text-sm sm:text-base text-gray-600 dark:text-gray-400">Be the first to share something with your colleagues!</p>
                    </div>
                @endforelse
            </div>

            <!-- Load More Button -->
            @if($posts->hasMorePages())
                <div class="text-center">
                    <button wire:click="loadMore"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 sm:px-6 rounded-lg transition duration-200 disabled:opacity-50"
                            wire:loading.attr="disabled">
                        <span wire:loading.remove>Load More Posts</span>
                        <span wire:loading>Loading...</span>
                    </button>
                </div>
            @endif
        </div>

        <!-- Right Sidebar - Hidden on mobile, visible on desktop -->
        <div class="hidden lg:block lg:col-span-3 space-y-4">
            <!-- Trending Topics -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-4">
                <h4 class="font-semibold text-gray-900 dark:text-white mb-3">Trending</h4>
                <div class="space-y-2">
                    <div class="flex items-center justify-between p-2 hover:bg-gray-50 dark:hover:bg-gray-700 rounded-lg cursor-pointer">
                        <span class="text-sm text-gray-700 dark:text-gray-300">#Wellness</span>
                        <span class="text-xs text-gray-500 dark:text-gray-400">12 posts</span>
                    </div>
                    <div class="flex items-center justify-between p-2 hover:bg-gray-50 dark:hover:bg-gray-700 rounded-lg cursor-pointer">
                        <span class="text-sm text-gray-700 dark:text-gray-300">#TeamBuilding</span>
                        <span class="text-xs text-gray-500 dark:text-gray-400">8 posts</span>
                    </div>
                    <div class="flex items-center justify-between p-2 hover:bg-gray-50 dark:hover:bg-gray-700 rounded-lg cursor-pointer">
                        <span class="text-sm text-gray-700 dark:text-gray-300">#WorkLife</span>
                        <span class="text-xs text-gray-500 dark:text-gray-400">15 posts</span>
                    </div>
                </div>
            </div>

            <!-- Online Friends -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-4">
                <h4 class="font-semibold text-gray-900 dark:text-white mb-3">Online Now</h4>
                <div class="space-y-2">
                    <div class="flex items-center space-x-3 p-2 hover:bg-gray-50 dark:hover:bg-gray-700 rounded-lg cursor-pointer">
                        <div class="relative">
                            <img class="h-8 w-8 rounded-full object-cover" src="{{ asset('images/default.png') }}" alt="User">
                            <div class="absolute -bottom-1 -right-1 w-3 h-3 bg-green-500 rounded-full border-2 border-white dark:border-gray-800"></div>
                        </div>
                        <span class="text-sm text-gray-700 dark:text-gray-300">John Doe</span>
                    </div>
                    <div class="flex items-center space-x-3 p-2 hover:bg-gray-50 dark:hover:bg-gray-700 rounded-lg cursor-pointer">
                        <div class="relative">
                            <img class="h-8 w-8 rounded-full object-cover" src="{{ asset('images/default.png') }}" alt="User">
                            <div class="absolute -bottom-1 -right-1 w-3 h-3 bg-green-500 rounded-full border-2 border-white dark:border-gray-800"></div>
                        </div>
                        <span class="text-sm text-gray-700 dark:text-gray-300">Jane Smith</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>