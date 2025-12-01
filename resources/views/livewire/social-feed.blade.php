<div>
    <div class="max-w-7xl mx-auto px-2 sm:px-4 lg:px-6 pt-0 pb-4">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-4 lg:gap-6">
            
            {{-- Left Sidebar - Facebook Style --}}
            <aside class="hidden lg:block lg:col-span-3 space-y-4">
                {{-- User Profile Card --}}
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm overflow-hidden">
                    <a href="{{ route('settings.profile') }}" class="block p-4 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                        <div class="flex items-center space-x-3">
                            <img class="h-12 w-12 rounded-full object-cover border-2 border-gray-200 dark:border-gray-600"
                                 src="{{ auth()->user()->profile_image_url }}"
                                 alt="{{ auth()->user()->firstname }}">
                            <div>
                                <h3 class="font-semibold text-gray-900 dark:text-white">{{ auth()->user()->firstname }} {{ auth()->user()->lastname }}</h3>
                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ auth()->user()->staff->position ?? 'Employee' }}</p>
                            </div>
                        </div>
                    </a>
                </div>

                {{-- Shortcuts --}}
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm overflow-hidden">
                    <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700">
                        <h4 class="font-semibold text-gray-900 dark:text-white text-sm">Shortcuts</h4>
                    </div>
                    <div class="p-2">
                        <a href="{{ route('index') }}" 
                           class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                            <div class="w-9 h-9 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                                </svg>
                            </div>
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Home</span>
                        </a>
                        <a href="{{ route('journal') }}" 
                           class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                            <div class="w-9 h-9 bg-green-100 dark:bg-green-900 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                                    <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Journal</span>
                        </a>
                        <a href="{{ route('quiz') }}" 
                           class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                            <div class="w-9 h-9 bg-purple-100 dark:bg-purple-900 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            </div>
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Quiz</span>
                        </a>
                        <a href="{{ route('policies') }}" 
                           class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                            <div class="w-9 h-9 bg-yellow-100 dark:bg-yellow-900 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-yellow-600 dark:text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Policies</span>
                        </a>
                    </div>
                </div>
            </aside>

            {{-- Main Feed - Facebook Style --}}
            <main class="lg:col-span-6 space-y-4">
                {{-- Create Post Component --}}
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                    @livewire('create-post')
                </div>

                {{-- Posts Feed --}}
                <div class="space-y-4">
                    @forelse($posts as $post)
                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                            @livewire('post-card', ['post' => $post], key($post->id))
                        </div>
                    @empty
                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-12 text-center">
                            <div class="text-gray-400 dark:text-gray-600 mb-4">
                                <svg class="mx-auto h-16 w-16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">No posts yet</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Be the first to share something with your colleagues!</p>
                        </div>
                    @endforelse
                </div>

                {{-- Load More Button --}}
                @if($posts->hasMorePages())
                    <div class="text-center py-4">
                        <button wire:click="loadMore"
                                class="bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 font-medium py-2 px-6 rounded-lg transition-colors disabled:opacity-50"
                                wire:loading.attr="disabled">
                            <span wire:loading.remove>Load More Posts</span>
                            <span wire:loading class="flex items-center justify-center space-x-2">
                                <svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                <span>Loading...</span>
                            </span>
                        </button>
                    </div>
                @endif
            </main>

            {{-- Right Sidebar - Facebook Style --}}
            <aside class="hidden lg:block lg:col-span-3 space-y-4">
                {{-- Sponsored (Optional) --}}
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-4">
                    <h4 class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-3">Sponsored</h4>
                    <div class="space-y-3">
                        <div class="text-xs text-gray-400 dark:text-gray-500 italic">No sponsored content</div>
                    </div>
                </div>

                {{-- Contacts/Online Friends --}}
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-4">
                    <div class="flex items-center justify-between mb-3">
                        <h4 class="text-sm font-semibold text-gray-900 dark:text-white">Contacts</h4>
                        <div class="flex items-center space-x-1">
                            <button class="p-1 rounded hover:bg-gray-100 dark:hover:bg-gray-700">
                                <svg class="w-4 h-4 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z"/>
                                </svg>
                            </button>
                            <button class="p-1 rounded hover:bg-gray-100 dark:hover:bg-gray-700">
                                <svg class="w-4 h-4 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="space-y-2 max-h-96 overflow-y-auto">
                        @php
                            $onlineUsers = \App\Models\User::where('id', '!=', auth()->id())->limit(10)->get();
                        @endphp
                        @forelse($onlineUsers as $user)
                            <div class="flex items-center space-x-2 p-2 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer transition-colors">
                                <div class="relative">
                                    <img class="h-9 w-9 rounded-full object-cover"
                                         src="{{ $user->profile_image_url }}"
                                         alt="{{ $user->firstname }}">
                                    <div class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 border-2 border-white dark:border-gray-800 rounded-full"></div>
                                </div>
                                <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $user->firstname }} {{ $user->lastname }}</span>
                            </div>
                        @empty
                            <p class="text-xs text-gray-500 dark:text-gray-400 text-center py-2">No contacts available</p>
                        @endforelse
                    </div>
                </div>
            </aside>
        </div>
    </div>
</div>
