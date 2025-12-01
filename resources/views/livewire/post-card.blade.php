<div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 mb-6">
    <!-- Post Header -->
    <div class="flex items-center justify-between mb-4">
        <div class="flex items-center space-x-3">
            <div class="relative profile-picture-container">
                <img class="h-12 w-12 rounded-full object-cover social-profile-pic profile-picture cursor-pointer"
                     src="{{ $post->user->profile_image_url }}"
                     alt="{{ $post->user->firstname }} {{ $post->user->lastname }}"
                     onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($post->user->firstname . ' ' . $post->user->lastname) }}&background=random&color=fff&size=100&bold=true'">
                <div class="online-indicator bg-green-500"></div>
            </div>
        <div>
                <h3 class="font-semibold text-gray-900 dark:text-white hover:text-blue-600 dark:hover:text-blue-400
                          transition-colors duration-200 cursor-pointer">
                    {{ $post->user->firstname }} {{ $post->user->lastname }}
                    @if($post->user->staff)
                        <span class="text-sm text-gray-500">
                            (
                            @switch($post->user->staff->office)
                                @case('RO')
                                    Regional Office
                                    @break
                                @case('SK')
                                    Sultan Kudarat Office
                                    @break
                                @case('SP')
                                    Sarangani Province Office
                                    @break
                                @case('SC')
                                    South Cotabato Office
                                    @break
                                @case('CP')
                                    Cotabato Office
                                    @break
                                @case('GSC')
                                    General Santos City
                                    @break
                                @default
                                    {{ $post->user->staff->office }}
                            @endswitch
                            )
                        </span>
                    @endif
                </h3>
                <span class="text-sm text-gray-500">{{ $post->user->staff->position ?? "none" }} </span>
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    {{ $post->created_at->diffForHumans() }}
                </p>
            </div>
        </div>
        <div class="flex items-center space-x-2">
            <button class="p-2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors duration-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                </svg>
            </button>
        </div>
    </div>

    <!-- Post Content -->
    <div class="mb-4">
        <p class="text-gray-900 dark:text-white whitespace-pre-wrap">{{ $post->content }}</p>

        @if($post->image)
            <div class="mt-4">
                <img src="{{ asset('storage/' . $post->image) }}"
                     alt="Post image"
                     class="max-w-full h-auto rounded-lg">
            </div>
        @endif
    </div>

    <!-- Post Actions -->
    <div class="flex items-center justify-between border-t dark:border-gray-700 pt-4">
        <div class="flex items-center space-x-6">
            <!-- Like Button -->
            <button wire:click="toggleLike"
                    class="flex items-center space-x-2 text-gray-500 hover:text-red-500 transition duration-200">
                <svg class="w-5 h-5 {{ $post->isLikedBy(auth()->user()) ? 'text-red-500 fill-current' : '' }}"
                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg>
                <span class="text-sm">{{ $post->likes_count }}</span>
            </button>

            <!-- Comment Button -->
            <button wire:click="toggleComments"
                    class="flex items-center space-x-2 text-gray-500 hover:text-blue-500 transition duration-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                </svg>
                <span class="text-sm">{{ $post->comments_count }}</span>
            </button>
        </div>
    </div>

    <!-- Comments Section -->
    @if($showComments)
        <div class="mt-6 border-t dark:border-gray-700 pt-4">
            <!-- Add Comment Form -->
            <div class="mb-4">
                <form wire:submit.prevent="addComment">
                    <div class="flex space-x-3">
                        <div class="relative profile-picture-container">
                            <img class="h-10 w-10 rounded-full object-cover comment-profile-pic profile-picture"
                                 src="{{ auth()->user()->profile_image_url }}"
                                 alt="{{ auth()->user()->firstname }} {{ auth()->user()->lastname }}"
                                 onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->firstname . ' ' . auth()->user()->lastname) }}&background=random&color=fff&size=100&bold=true'">
                            <div class="online-indicator bg-blue-500 w-3 h-3"></div>
                        </div>
                        <div class="flex-1">
                            <textarea wire:model="newComment"
                                      placeholder="Write a comment..."
                                      class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white resize-none transition-all duration-200"
                                      rows="2"></textarea>
                            @error('newComment')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl transition-all duration-200
                                       hover:shadow-lg transform hover:scale-105 font-medium">
                            Comment
                        </button>
                    </div>
                </form>
            </div>

            <!-- Comments List -->
            <div class="space-y-4">
                @foreach($post->comments as $comment)
                    <div class="flex space-x-3">
                        <div class="relative profile-picture-container">
                            <img class="h-10 w-10 rounded-full object-cover comment-profile-pic profile-picture cursor-pointer"
                                 src="{{ $comment->user->profile_image_url }}"
                                 alt="{{ $comment->user->firstname }} {{ $comment->user->lastname }}"
                                 onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($comment->user->firstname . ' ' . $comment->user->lastname) }}&background=random&color=fff&size=100&bold=true'">
                            <div class="online-indicator bg-green-500 w-3 h-3"></div>
                        </div>
                        <div class="flex-1">
                            <div class="bg-gray-100 dark:bg-gray-700 rounded-xl p-4 hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors duration-200">
                                <div class="flex items-center justify-between mb-2">
                                    <div class="flex items-center space-x-2">
                                        <h4 class="font-semibold text-gray-900 dark:text-white text-sm hover:text-blue-600 dark:hover:text-blue-400 cursor-pointer transition-colors duration-200">
                                            {{ $comment->user->firstname }} {{ $comment->user->lastname }}
                                            @if($comment->user->staff)
                                                <span class="text-sm text-gray-500">
                                                (
                                                @switch($comment->user->staff->office)
                                                    @case('RO')
                                                        Regional Office
                                                        @break
                                                    @case('SK')
                                                        Sultan Kudarat Office
                                                        @break
                                                    @case('SP')
                                                        Sarangani Province Office
                                                        @break
                                                    @case('SC')
                                                        South Cotabato Office
                                                        @break
                                                    @case('CP')
                                                        Cotabato Office
                                                        @break
                                                    @case('GSC')
                                                        General Santos City
                                                        @break
                                                    @default
                                                        {{ $comment->user->staff->office }}
                                                @endswitch
                                                )
                                            </span>
                                            @endif
                                        </h4>
                                        <span class="text-sm text-gray-500">{{ $comment->user->staff->position ?? "none" }} </span>
                                        <span class="text-xs text-gray-500 dark:text-gray-400">
                                            {{ $comment->created_at->diffForHumans() }}
                                        </span>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <button wire:click="toggleCommentLike({{ $comment->id }})"
                                                class="flex items-center space-x-1 text-gray-400 hover:text-red-500 transition duration-200
                                                       hover:bg-red-50 dark:hover:bg-red-900/20 px-2 py-1 rounded-lg">
                                            <svg class="w-4 h-4 {{ $comment->isLikedBy(auth()->user()) ? 'text-red-500 fill-current' : '' }}"
                                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                            </svg>
                                            <span class="text-xs font-medium">{{ $comment->likes_count }}</span>
                                        </button>
                                    </div>
                                </div>
                                <p class="text-gray-900 dark:text-white text-sm leading-relaxed">{{ $comment->content }}</p>
                            </div>

                            <!-- Reply Button -->
                            <div class="mt-2">
                                <button wire:click="toggleReplies({{ $comment->id }})"
                                        class="text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400">
                                    {{ $comment->replies_count }} {{ $comment->replies_count == 1 ? 'reply' : 'replies' }}
                                </button>
                            </div>

                            <!-- Replies Section -->
                            @if(isset($showReplies[$comment->id]) && $showReplies[$comment->id])
                                <div class="mt-3 space-y-3">
                                    <!-- Add Reply Form -->
                                    <form wire:submit.prevent="addReply({{ $comment->id }})">
                                        <div class="flex space-x-2">
                                            <div class="relative profile-picture-container">
                                                <img class="h-8 w-8 rounded-full object-cover reply-profile-pic profile-picture"
                                                     src="{{ auth()->user()->profile_image_url }}"
                                                     alt="{{ auth()->user()->firstname }} {{ auth()->user()->lastname }}"
                                                     onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->firstname . ' ' . auth()->user()->lastname) }}&background=random&color=fff&size=100&bold=true'">
                                                <div class="online-indicator bg-blue-500 w-2.5 h-2.5"></div>
                                            </div>
                                            <div class="flex-1">
                                                <textarea wire:model="newReply.{{ $comment->id }}"
                                                          placeholder="Write a reply..."
                                                          class="w-full px-3 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-lg
                                                                 focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700
                                                                 dark:text-white resize-none transition-all duration-200"
                                                          rows="1"></textarea>
                                                @error("newReply.{$comment->id}")
                                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <button type="submit"
                                                    class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 text-sm rounded-lg
                                                           transition-all duration-200 hover:shadow-md transform hover:scale-105 font-medium">
                                                Reply
                                            </button>
                                        </div>
                                    </form>

                                    <!-- Replies List -->
                                    @foreach($comment->replies as $reply)
                                        <div class="flex space-x-2 ml-6">
                                            <div class="relative profile-picture-container">
                                                <img class="h-8 w-8 rounded-full object-cover reply-profile-pic profile-picture cursor-pointer"
                                                     src="{{ $reply->user->profile_image_url }}"
                                                     alt="{{ $reply->user->firstname }} {{ $reply->user->lastname }}"
                                                     onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($reply->user->firstname . ' ' . $reply->user->lastname) }}&background=random&color=fff&size=100&bold=true'">
                                                <div class="online-indicator bg-purple-500 w-2.5 h-2.5"></div>
                                            </div>
                                            <div class="flex-1">
                                                <div class="bg-gray-50 dark:bg-gray-600 rounded-lg p-3 hover:bg-gray-100 dark:hover:bg-gray-500 transition-colors duration-200">
                                                    <div class="flex items-center justify-between mb-1">
                                                        <h5 class="font-medium text-gray-900 dark:text-white text-xs hover:text-blue-600 dark:hover:text-blue-400 cursor-pointer transition-colors duration-200">
                                                            {{ $reply->user->firstname }} {{ $reply->user->lastname }}
                                                        </h5>
                                                        <span class="text-xs text-gray-500 dark:text-gray-400">
                                                            {{ $reply->created_at->diffForHumans() }}
                                                        </span>
                                                    </div>
                                                    <p class="text-gray-900 dark:text-white text-xs leading-relaxed">{{ $reply->content }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
