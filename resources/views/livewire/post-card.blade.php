@if($deleted || !$post || !$post->user)
    {{-- Post deleted or invalid - render nothing --}}
    <div></div>
@else
<div id="post-{{ $post->id }}" class="p-4">
    <!-- Facebook-style Post Header -->
    <div class="flex items-center justify-between mb-3">
        <div class="flex items-center space-x-3">
            <img class="h-10 w-10 rounded-full object-cover cursor-pointer"
                 src="{{ $post->user->profile_image_url }}"
                 alt="{{ $post->user->firstname }} {{ $post->user->lastname }}"
                 onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($post->user->firstname . ' ' . $post->user->lastname) }}&background=random&color=fff&size=100&bold=true'">
            <div>
                <h3 class="font-semibold text-gray-900 dark:text-white hover:text-blue-600 dark:hover:text-blue-400 cursor-pointer transition-colors">
                    {{ $post->user->firstname }} {{ $post->user->lastname }}
                </h3>
                <div class="flex items-center space-x-1 text-sm text-gray-500 dark:text-gray-400">
                    <span>{{ $post->created_at->diffForHumans() }}</span>
                    <span>•</span>
                    <span>
                        @php($office = optional($post->user->staff)->office)
                        @switch($office)
                            @case('RO') Regional Office @break
                            @case('SK') Sultan Kudarat Office @break
                            @case('SP') Sarangani Province Office @break
                            @case('SC') South Cotabato Office @break
                            @case('CP') Cotabato Office @break
                            @case('GSC') General Santos City @break
                            @default {{ $office ?? 'Unknown Office' }}
                        @endswitch
                    </span>
                </div>
            </div>
        </div>

        <!-- More Options (Delete for owner/admin) -->
        <div class="relative" x-data="{ open: false }">
            <button @click="open = !open" class="p-2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-full transition-colors">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"></path>
                </svg>
            </button>
            <div x-show="open" @click.away="open = false" x-transition class="absolute right-0 mt-2 w-40 sm:w-44 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-lg overflow-hidden z-20">
                @if(auth()->check() && auth()->id() === $post->user_id)
                    <button wire:click="startEdit" class="w-full text-left px-3 py-2 text-xs hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-200">Edit post</button>
                    <button onclick="confirmDelete({{ $post->id }})" class="w-full text-left px-3 py-2 text-xs text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/30">Delete post</button>
                @else
                    <button class="w-full text-left px-3 py-2 text-xs text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/30">Report</button>
                @endif
    </div>
        </div>
    </div>

    <!-- Post Content / Edit -->
    <div class="mb-3">
        @if($isEditing)
            <div class="space-y-2">
                <textarea wire:model.defer="editContent"
                          class="w-full px-4 py-3 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg text-gray-900 dark:text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-y"
                          rows="4"
                          maxlength="1000"
                          placeholder="Update your post..."></textarea>
                <div class="flex items-center gap-2 flex-wrap">
                    <button wire:click="updatePost" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm rounded-lg transition-colors">Save</button>
                    <button wire:click="cancelEdit" class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 text-sm rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600">Cancel</button>
                </div>
            </div>
        @else
            <p class="text-gray-900 dark:text-white whitespace-pre-wrap leading-relaxed">{!! $this->parseMentions($post->content) !!}</p>
            @if($post->image)
                <div class="mt-3">
                    <img src="{{ asset('storage/' . $post->image) }}"
                         alt="Post image"
                         class="w-full max-h-96 object-cover rounded-lg cursor-pointer hover:opacity-95 transition-opacity">
                </div>
            @endif
        @endif
    </div>
    <!-- Engagement Stats -->
    <div class="flex items-center justify-between py-2 text-sm text-gray-500 dark:text-gray-400">
        <div class="flex items-center space-x-4">
            @if($post->likes_count > 0)
                <div class="flex items-center space-x-1">
                    <div class="flex -space-x-1">
                        <div class="w-5 h-5 bg-blue-500 rounded-full flex items-center justify-center">
                            <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                    <span>{{ $post->likes_count }} {{ $post->likes_count == 1 ? 'like' : 'likes' }}</span>
                </div>
            @endif

            @if($post->comments_count > 0)
                <button wire:click="toggleComments" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                    {{ $post->comments_count }} {{ $post->comments_count == 1 ? 'comment' : 'comments' }}
                </button>
            @endif
        </div>
    </div>
    <!-- Action Buttons -->
    <div class="flex items-center border-t border-gray-200 dark:border-gray-700 pt-3">
        <div class="flex items-center justify-around w-full">
            <!-- Like Button -->
            <button wire:click="toggleLike"
                    class="flex items-center justify-center space-x-2 px-4 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors flex-1">
                <svg class="w-5 h-5 {{ $post->isLikedBy(auth()->user()) ? 'text-blue-600 fill-current' : 'text-gray-500' }}"
                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg>
                <span class="text-sm font-medium {{ $post->isLikedBy(auth()->user()) ? 'text-blue-600' : 'text-gray-500 dark:text-gray-400' }}">
                    Like
                </span>
            </button>

            <!-- Comment Button -->
            <button wire:click="toggleComments"
                    class="flex items-center justify-center space-x-2 px-4 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors flex-1">
                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                </svg>
                <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Comment</span>
            </button>
        </div>
    </div>

    <!-- Comments Section -->
    @if($showComments)
        <div class="mt-4 border-t border-gray-200 dark:border-gray-700 pt-4">
            <!-- Add Comment Form -->
            <div class="mb-4">
                <form wire:submit.prevent="addComment">
                    <div class="flex space-x-3">
                        <img class="h-8 w-8 rounded-full object-cover"
                             src="{{ auth()->user()->profile_image_url }}"
                             alt="{{ auth()->user()->firstname }} {{ auth()->user()->lastname }}"
                             onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->firstname . ' ' . auth()->user()->lastname) }}&background=random&color=fff&size=100&bold=true'">
                        <div class="flex-1 relative">
                            <textarea wire:model="newComment"
                                      wire:keyup="searchUsers($event.target.value, 'comment')"
                                      wire:keydown.escape="hideMentionSuggestions"
                                      placeholder="Write a comment... (use @ to mention someone)"
                                      class="w-full px-4 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-full text-gray-900 dark:text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none transition-all duration-200"
                                      rows="1"
                                      style="min-height: 36px; max-height: 100px;"
                                      oninput="this.style.height = 'auto'; this.style.height = this.scrollHeight + 'px';"></textarea>

                            <!-- Mention Suggestions Dropdown -->
                            @if($showMentionSuggestions && $currentMentionField === 'comment')
                                <div class="mention-suggestions absolute z-50 w-full mt-1 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 rounded-lg shadow-lg max-h-48 overflow-y-auto">
                                    @foreach($mentionSuggestions as $index => $user)
                                        <button type="button"
                                                wire:click="selectMention({{ $user->id }}, 'comment')"
                                                class="mention-suggestion-item w-full px-4 py-2 text-left hover:bg-gray-100 dark:hover:bg-gray-700 flex items-center space-x-3 {{ $selectedMentionIndex === $index ? 'bg-blue-50 dark:bg-blue-900' : '' }}">
                                            <img class="h-8 w-8 rounded-full object-cover"
                                                 src="{{ $user->profile_image_url }}"
                                                 alt="{{ $user->firstname }} {{ $user->lastname }}"
                                                 onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($user->firstname . ' ' . $user->lastname) }}&background=random&color=fff&size=100&bold=true'">
                                            <div>
                                                <p class="font-medium text-gray-900 dark:text-white">{{ $user->firstname }} {{ $user->lastname }}</p>
                                                <p class="text-sm text-gray-500 dark:text-gray-400">{{ $user->staff->position ?? 'Employee' }}</p>
                                            </div>
                                        </button>
                                    @endforeach
                                </div>
                            @endif

                            @error('newComment')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 text-sm rounded-lg transition-all duration-200 hover:shadow-md transform hover:scale-105 font-medium"
                                wire:loading.attr="disabled">
                            <span wire:loading.remove wire:target="addComment">Comment</span>
                            <span wire:loading wire:target="addComment" class="flex items-center space-x-2">
                                <svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                <span>Posting...</span>
                            </span>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Comments List -->
            <div class="space-y-3">
                @foreach($post->comments as $comment)
                    <div id="comment-{{ $comment->id }}" class="flex space-x-3">
                        <img class="h-8 w-8 rounded-full object-cover cursor-pointer"
                             src="{{ $comment->user->profile_image_url }}"
                             alt="{{ $comment->user->firstname }} {{ $comment->user->lastname }}"
                             onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($comment->user->firstname . ' ' . $comment->user->lastname) }}&background=random&color=fff&size=100&bold=true'">
                        <div class="flex-1">
                            <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-3">
                                <div class="flex items-center justify-between mb-1">
                                    <h4 class="font-semibold text-gray-900 dark:text-white text-sm hover:text-blue-600 dark:hover:text-blue-400 cursor-pointer transition-colors">
                                        {{ $comment->user->firstname }} {{ $comment->user->lastname }}
                                    </h4>
                                    <span class="text-xs text-gray-500 dark:text-gray-400">
                                        {{ $comment->created_at->diffForHumans() }}
                                    </span>
                                </div>
                                <p class="text-gray-900 dark:text-white text-sm leading-relaxed">{!! $this->parseMentions($comment->content) !!}</p>

                                <!-- Comment Actions -->
                                <div class="flex items-center space-x-4 mt-2 text-xs">
                                    <button wire:click="toggleCommentLike({{ $comment->id }})"
                                            class="flex items-center space-x-1 text-gray-500 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                                        <svg class="w-3 h-3 {{ $comment->isLikedBy(auth()->user()) ? 'text-blue-600 fill-current' : '' }}"
                                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                        </svg>
                                        <span>{{ $comment->likes_count }}</span>
                                    </button>

                                    <button wire:click="startReply({{ $comment->id }}, {{ $comment->user_id }})"
                                            class="text-gray-500 hover:text-blue-600 dark:hover:text-blue-400 transition-colors"
                                            title="Reply to {{ $comment->user->firstname }} {{ $comment->user->lastname }}">
                                        Reply to {{ $comment->user->firstname }}
                                    </button>
                                </div>
                            </div>

                            <!-- Replies Section - Always show if there are replies or if toggled -->
                            @if(isset($showReplies[$comment->id]) && $showReplies[$comment->id] || $comment->replies->where('parent_reply_id', null)->count() > 0)
                                <div class="mt-3 space-y-2">
                                    <!-- Add Reply Form -->
                                    <form wire:submit.prevent="addReply({{ $comment->id }})">
                                        <div class="flex space-x-2">
                                            <img class="h-6 w-6 rounded-full object-cover"
                                                 src="{{ auth()->user()->profile_image_url }}"
                                                 alt="{{ auth()->user()->firstname }} {{ auth()->user()->lastname }}"
                                                 onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->firstname . ' ' . auth()->user()->lastname) }}&background=random&color=fff&size=100&bold=true'">
                                            <div class="flex-1 relative">
                                                <textarea wire:model="newReply.{{ $comment->id }}"
                                                          wire:keyup="searchUsers($event.target.value, 'reply_{{ $comment->id }}')"
                                                          wire:keydown.escape="hideMentionSuggestions"
                                                          placeholder="Write a reply... (use @ to mention someone)"
                                                          class="w-full px-3 py-1 text-sm bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-full text-gray-900 dark:text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none transition-all duration-200"
                                                          rows="1"
                                                          style="min-height: 28px; max-height: 80px;"
                                                          oninput="this.style.height = 'auto'; this.style.height = this.scrollHeight + 'px';"></textarea>

                                                <!-- Mention Suggestions Dropdown -->
                                                @if($showMentionSuggestions && $currentMentionField === 'reply_' . $comment->id)
                                                    <div class="mention-suggestions absolute z-50 w-full mt-1 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 rounded-lg shadow-lg max-h-48 overflow-y-auto">
                                                        @foreach($mentionSuggestions as $index => $user)
                                                            <button type="button"
                                                                    wire:click="selectMention({{ $user->id }}, 'reply_{{ $comment->id }}')"
                                                                    class="mention-suggestion-item w-full px-3 py-2 text-left hover:bg-gray-100 dark:hover:bg-gray-700 flex items-center space-x-2 {{ $selectedMentionIndex === $index ? 'bg-blue-50 dark:bg-blue-900' : '' }}">
                                                                <img class="h-6 w-6 rounded-full object-cover"
                                                                     src="{{ $user->profile_image_url }}"
                                                                     alt="{{ $user->firstname }} {{ $user->lastname }}"
                                                                     onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($user->firstname . ' ' . $user->lastname) }}&background=random&color=fff&size=100&bold=true'">
                                                                <div>
                                                                    <p class="font-medium text-gray-900 dark:text-white text-sm">{{ $user->firstname }} {{ $user->lastname }}</p>
                                                                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ $user->staff->position ?? 'Employee' }}</p>
                                                                </div>
                                                            </button>
                                                        @endforeach
                                                    </div>
                                                @endif

                                                @error("newReply.{$comment->id}")
                                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <button type="submit"
                                                    class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 text-xs rounded-lg transition-all duration-200 hover:shadow-md transform hover:scale-105 font-medium"
                                                    wire:loading.attr="disabled">
                                                <span wire:loading.remove wire:target="addReply({{ $comment->id }})">Reply</span>
                                                <span wire:loading wire:target="addReply({{ $comment->id }})" class="flex items-center space-x-1">
                                                    <svg class="w-3 h-3 animate-spin" fill="none" viewBox="0 0 24 24">
                                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                    </svg>
                                                    <span>Posting...</span>
                                                </span>
                                            </button>
                                        </div>
                                    </form>

                                    <!-- Replies List -->
                                    @foreach($comment->replies->where('parent_reply_id', null) as $reply)
                                        <div id="reply-{{ $reply->id }}" class="flex space-x-2 ml-6">
                                            <img class="h-6 w-6 rounded-full object-cover cursor-pointer"
                                                 src="{{ $reply->user->profile_image_url }}"
                                                 alt="{{ $reply->user->firstname }} {{ $reply->user->lastname }}"
                                                 onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($reply->user->firstname . ' ' . $reply->user->lastname) }}&background=random&color=fff&size=100&bold=true'">
                                            <div class="flex-1">
                                                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-2">
                                                    <div class="flex items-center justify-between mb-1">
                                                        <h5 class="font-medium text-gray-900 dark:text-white text-xs hover:text-blue-600 dark:hover:text-blue-400 cursor-pointer transition-colors">
                                                            {{ $reply->user->firstname }} {{ $reply->user->lastname }}
                                                        </h5>
                                                        <span class="text-xs text-gray-500 dark:text-gray-400">
                                                            {{ $reply->created_at->diffForHumans() }}
                                                        </span>
                                                    </div>
                                                    <p class="text-gray-900 dark:text-white text-xs leading-relaxed">{!! $this->parseMentions($reply->content) !!}</p>

                                                    <!-- Reply Actions -->
                                                    <div class="flex items-center space-x-3 mt-2 text-xs">
                                                        <button wire:click="startNestedReply({{ $reply->id }}, {{ $reply->user_id }})"
                                                                class="text-gray-500 hover:text-blue-600 dark:hover:text-blue-400 transition-colors"
                                                                title="Reply to {{ $reply->user->firstname }} {{ $reply->user->lastname }}">
                                                            Reply to {{ $reply->user->firstname }}
                                                        </button>
                                                    </div>
                                                </div>

                                                <!-- Nested Replies Section - Always show if there are nested replies or if toggled -->
                                                @if(isset($showNestedReplies[$reply->id]) && $showNestedReplies[$reply->id] || $reply->childReplies->count() > 0)
                                                    <div class="mt-2 space-y-2">
                                                        <!-- Add Nested Reply Form -->
                                                        <form wire:submit.prevent="addNestedReply({{ $reply->id }})">
                                                            <div class="flex space-x-2">
                                                                <img class="h-5 w-5 rounded-full object-cover"
                                                                     src="{{ auth()->user()->profile_image_url }}"
                                                                     alt="{{ auth()->user()->firstname }} {{ auth()->user()->lastname }}"
                                                                     onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->firstname . ' ' . auth()->user()->lastname) }}&background=random&color=fff&size=100&bold=true'">
                                                                <div class="flex-1 relative">
                                                                    <textarea wire:model="newNestedReply.{{ $reply->id }}"
                                                                              wire:keyup="searchUsers($event.target.value, 'nested_reply_{{ $reply->id }}')"
                                                                              wire:keydown.escape="hideMentionSuggestions"
                                                                              placeholder="Write a reply... (use @ to mention someone)"
                                                                              class="w-full px-2 py-1 text-xs bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-full text-gray-900 dark:text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none transition-all duration-200"
                                                                              rows="1"
                                                                              style="min-height: 24px; max-height: 60px;"
                                                                              oninput="this.style.height = 'auto'; this.style.height = this.scrollHeight + 'px';"></textarea>

                                                                    <!-- Mention Suggestions Dropdown -->
                                                                    @if($showMentionSuggestions && $currentMentionField === 'nested_reply_' . $reply->id)
                                                                        <div class="mention-suggestions absolute z-50 w-full mt-1 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 rounded-lg shadow-lg max-h-48 overflow-y-auto">
                                                                            @foreach($mentionSuggestions as $index => $user)
                                                                                <button type="button"
                                                                                        wire:click="selectMention({{ $user->id }}, 'nested_reply_{{ $reply->id }}')"
                                                                                        class="mention-suggestion-item w-full px-2 py-1 text-left hover:bg-gray-100 dark:hover:bg-gray-700 flex items-center space-x-2 {{ $selectedMentionIndex === $index ? 'bg-blue-50 dark:bg-blue-900' : '' }}">
                                                                                    <img class="h-5 w-5 rounded-full object-cover"
                                                                                         src="{{ $user->profile_image_url }}"
                                                                                         alt="{{ $user->firstname }} {{ $user->lastname }}"
                                                                                         onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($user->firstname . ' ' . $user->lastname) }}&background=random&color=fff&size=100&bold=true'">
                                                                                    <div>
                                                                                        <p class="font-medium text-gray-900 dark:text-white text-xs">{{ $user->firstname }} {{ $user->lastname }}</p>
                                                                                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ $user->staff->position ?? 'Employee' }}</p>
                                                                                    </div>
                                                                                </button>
                                                                            @endforeach
                                                                        </div>
                                                                    @endif

                                                                    @error("newNestedReply.{$reply->id}")
                                                                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                                                    @enderror
                                                                </div>
                                                                <button type="submit"
                                                                        class="bg-blue-600 hover:bg-blue-700 text-white px-2 py-1 text-xs rounded-lg transition-all duration-200 hover:shadow-md transform hover:scale-105 font-medium"
                                                                        wire:loading.attr="disabled">
                                                                    <span wire:loading.remove wire:target="addNestedReply({{ $reply->id }})">Reply</span>
                                                                    <span wire:loading wire:target="addNestedReply({{ $reply->id }})" class="flex items-center space-x-1">
                                                                        <svg class="w-2 h-2 animate-spin" fill="none" viewBox="0 0 24 24">
                                                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                                        </svg>
                                                                        <span>Posting...</span>
                                                                    </span>
                                                                </button>
                                                            </div>
                                                        </form>

                                                        <!-- Nested Replies List -->
                                                        @foreach($reply->childReplies as $nestedReply)
                                                            <div id="reply-{{ $nestedReply->id }}" class="flex space-x-2 ml-8">
                                                                <img class="h-5 w-5 rounded-full object-cover cursor-pointer"
                                                                     src="{{ $nestedReply->user->profile_image_url }}"
                                                                     alt="{{ $nestedReply->user->firstname }} {{ $nestedReply->user->lastname }}"
                                                                     onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($nestedReply->user->firstname . ' ' . $nestedReply->user->lastname) }}&background=random&color=fff&size=100&bold=true'">
                                                                <div class="flex-1">
                                                                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-2">
                                                                        <div class="flex items-center justify-between mb-1">
                                                                            <h6 class="font-medium text-gray-900 dark:text-white text-xs hover:text-blue-600 dark:hover:text-blue-400 cursor-pointer transition-colors">
                                                                                {{ $nestedReply->user->firstname }} {{ $nestedReply->user->lastname }}
                                                                            </h6>
                                                                            <span class="text-xs text-gray-500 dark:text-gray-400">
                                                                                {{ $nestedReply->created_at->diffForHumans() }}
                                                                            </span>
                                                                        </div>
                                                                        <p class="text-gray-900 dark:text-white text-xs leading-relaxed">{!! $this->parseMentions($nestedReply->content) !!}</p>
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
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endif

@push('scripts')
<script>
    // Scroll to anchor functionality
    function scrollToAnchor() {
        if (!window.location.hash) return;

        const hash = window.location.hash;
        let tries = 0;

        function attemptScroll() {
            const target = document.querySelector(hash);
            if (target) {
                target.scrollIntoView({ behavior: "smooth", block: "center" });
                target.classList.add("ring-2", "ring-yellow-400", "bg-yellow-50");

                // remove highlight after 2s
                setTimeout(() => {
                    target.classList.remove("ring-2", "ring-yellow-400", "bg-yellow-50");
                }, 2000);
            } else if (tries < 20) {
                // try again until Livewire finishes rendering
                tries++;
                setTimeout(attemptScroll, 300);
            }
        }

        attemptScroll();
    }

    document.addEventListener("DOMContentLoaded", scrollToAnchor);
    document.addEventListener("livewire:update", scrollToAnchor);
    document.addEventListener("livewire:navigated", scrollToAnchor);

    // Delete confirmation with SweetAlert2
    function confirmDelete(postId) {
        Swal.fire({
            title: 'Delete Post?',
            text: "This action cannot be undone. All comments and likes will be deleted.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel',
            reverseButtons: true,
            focusCancel: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Call Livewire method to delete
                Livewire.find(document.querySelector(`#post-${postId}`).closest('[wire\\:id]').getAttribute('wire:id'))
                    .call('deletePost');
            }
        });
    }

    // Listen for delete success event
    document.addEventListener('livewire:init', () => {
        Livewire.on('deleteSuccess', (event) => {
            Swal.fire({
                title: 'Deleted!',
                text: event.message || 'Post has been deleted successfully.',
                icon: 'success',
                confirmButtonColor: '#3b82f6',
                timer: 3000,
                timerProgressBar: true
            });
        });

        Livewire.on('deleteError', (event) => {
            Swal.fire({
                title: 'Error!',
                text: event.message || 'Failed to delete post.',
                icon: 'error',
                confirmButtonColor: '#3b82f6'
            });
        });
    });
</script>

@endpush

