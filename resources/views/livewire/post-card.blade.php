<div>
@php
    $canManagePost = auth()->check() && (auth()->id() === $post->user_id || auth()->user()->role === 'admin');
@endphp
@if(!$deleted)
<div class="p-4">
    {{-- Post Header --}}
    <div class="flex items-start justify-between mb-3">
        <div class="flex items-start space-x-3 flex-1">
            <a href="{{ route('settings.profile') }}" class="flex-shrink-0">
                <img class="h-10 w-10 rounded-full object-cover border-2 border-gray-200 dark:border-gray-600 cursor-pointer hover:opacity-90 transition-opacity"
                     src="{{ $post->user->profile_image_url }}"
                     alt="{{ $post->user->firstname }} {{ $post->user->lastname }}"
                     onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($post->user->firstname . ' ' . $post->user->lastname) }}&background=random&color=fff&size=100&bold=true'">
            </a>
            <div class="flex-1 min-w-0">
                <div class="flex items-center space-x-1 flex-wrap">
                    <a href="{{ route('settings.profile') }}" class="font-semibold text-gray-900 dark:text-white hover:underline text-sm">
                        {{ $post->user->firstname }} {{ $post->user->lastname }}
                    </a>
                    @if($post->user->staff)
                        <span class="text-xs text-gray-500 dark:text-gray-400">·</span>
                        <span class="text-xs text-gray-500 dark:text-gray-400">
                            @switch($post->user->staff->office)
                                @case('RO') Regional Office @break
                                @case('SK') Sultan Kudarat Office @break
                                @case('SP') Sarangani Province Office @break
                                @case('SC') South Cotabato Office @break
                                @case('CP') Cotabato Office @break
                                @case('GSC') General Santos City @break
                                @default {{ $post->user->staff->office }}
                            @endswitch
                        </span>
                    @endif
                </div>
                <div class="flex items-center space-x-1 text-xs text-gray-500 dark:text-gray-400">
                    <span>{{ $post->created_at->diffForHumans() }}</span>
                    <span>·</span>
                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM4.332 8.027a6.012 6.012 0 011.912-2.706C6.512 5.73 6.974 6 7.5 6A1.5 1.5 0 019 7.5V8a2 2 0 004 0 2 2 0 011.523-1.943A5.977 5.977 0 0116 10c0 .34-.028.675-.083 1H15a2 2 0 00-2 2v.878A2.996 2.996 0 0110 16a2.996 2.996 0 01-3-2.122V13a2 2 0 00-2-2H4.083C4.028 10.675 4 10.34 4 10c0-.747.1-1.468.332-2.027z" clip-rule="evenodd"/>
                    </svg>
                    <span>Public</span>
                </div>
            </div>
        </div>
        @if($canManagePost)
            <div class="relative" x-data="{
                open: false,
                showDeleteModal: false,
                openDeleteModal() {
                    this.showDeleteModal = true;
                    this.open = false;
                },
                closeDeleteModal() {
                    this.showDeleteModal = false;
                },
                confirmDelete() {
                    $wire.deletePost();
                    this.showDeleteModal = false;
                }
            }">
                <button @click="open = !open" 
                        class="p-1.5 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors text-gray-500 dark:text-gray-400">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"/>
                    </svg>
                </button>
                <div x-show="open" 
                     @click.away="open = false"
                     x-transition
                     class="absolute right-0 mt-1 w-48 bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700 py-1 z-50">
                    <button wire:click="startEdit" 
                            @click="open = false"
                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                        Edit Post
                    </button>
                    <button type="button"
                            @click="openDeleteModal()"
                            class="block w-full text-left px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-gray-100 dark:hover:bg-gray-700 disabled:opacity-60">
                        Delete Post
                    </button>
                </div>

                {{-- Delete Confirmation Modal --}}
                <div x-cloak
                     x-show="showDeleteModal"
                     x-transition.opacity
                     class="fixed inset-0 z-50 flex items-center justify-center px-4">
                    <div class="absolute inset-0 bg-black bg-opacity-40" @click="closeDeleteModal()"></div>
                    <div x-show="showDeleteModal"
                         x-transition.scale
                         class="relative w-full max-w-sm bg-white dark:bg-gray-800 rounded-lg shadow-xl border border-gray-200 dark:border-gray-700 p-6 space-y-4">
                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0 w-10 h-10 rounded-full bg-red-100 dark:bg-red-900/40 flex items-center justify-center">
                                <svg class="w-5 h-5 text-red-600 dark:text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 005.656 0M9 10h.01M15 10h.01M7 21h10a2 2 0 002-2V7.414a2 2 0 00-.586-1.414l-3.414-3.414A2 2 0 0013.586 2H7a2 2 0 00-2 2v15a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Delete post?</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-300">This action cannot be undone. The post and all related comments will be permanently removed.</p>
                            </div>
                        </div>
                        <div class="flex items-center justify-end space-x-3">
                            <button type="button"
                                    @click="closeDeleteModal()"
                                    class="px-4 py-2 text-sm font-medium text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                                Cancel
                            </button>
                            <button type="button"
                                    @click="confirmDelete()"
                                    wire:loading.attr="disabled"
                                    wire:target="deletePost"
                                    class="px-4 py-2 text-sm font-semibold text-white bg-red-600 hover:bg-red-700 rounded-lg disabled:opacity-60">
                                Delete
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    {{-- Edit Mode --}}
    @if($isEditing)
        <div class="mb-3">
            <textarea wire:model="editContent"
                      class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none"
                      rows="3"></textarea>
            <div class="flex items-center justify-end space-x-2 mt-2">
                <button wire:click="cancelEdit"
                        class="px-4 py-1.5 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors">
                    Cancel
                </button>
                <button wire:click="updatePost"
                        class="px-4 py-1.5 text-sm font-medium bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">
                    Save
                </button>
            </div>
        </div>
    @endif

    {{-- Post Content --}}
    <div class="mb-3">
        <p class="text-gray-900 dark:text-white whitespace-pre-wrap text-sm leading-relaxed">{!! $this->parseMentions($post->content) !!}</p>

        @if($post->image)
            <div class="mt-3 rounded-lg overflow-hidden">
                <img src="{{ asset('storage/' . $post->image) }}"
                     alt="Post image"
                     class="w-full h-auto max-h-[500px] object-contain bg-gray-50 dark:bg-gray-900">
            </div>
        @endif
    </div>

    {{-- Post Stats --}}
    @if($post->likes_count > 0 || $post->comments_count > 0)
        <div class="flex items-center justify-between py-2 border-t border-gray-200 dark:border-gray-700 text-xs text-gray-500 dark:text-gray-400">
            <div class="flex items-center space-x-1">
                @if($post->likes_count > 0)
                    <div class="flex items-center space-x-1">
                        <div class="w-4 h-4 bg-blue-600 rounded-full flex items-center justify-center">
                            <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.834a1 1 0 001.707.707l3.546-3.547a1 1 0 00.293-.707V8.5a1 1 0 00-1.707-.707L7.293 9.793a1 1 0 00-.293.707zM15.293 8.293a1 1 0 011.414 0l1.5 1.5a1 1 0 010 1.414l-1.5 1.5a1 1 0 01-1.414-1.414l.793-.793-.793-.793a1 1 0 010-1.414z"/>
                            </svg>
                        </div>
                        <span>{{ $post->likes_count }}</span>
                    </div>
                @endif
            </div>
            @if($post->comments_count > 0)
                <span>{{ $post->comments_count }} {{ $post->comments_count == 1 ? 'comment' : 'comments' }}</span>
            @endif
        </div>
    @endif

    {{-- Post Actions (Facebook Style) --}}
    <div class="flex items-center border-t border-gray-200 dark:border-gray-700 pt-1 mt-1">
        <button wire:click="toggleLike"
                class="flex-1 flex items-center justify-center space-x-2 py-2 px-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors group">
            <svg class="w-5 h-5 {{ $post->isLikedBy(auth()->user()) ? 'text-blue-600 dark:text-blue-400 fill-current' : 'text-gray-500 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-400' }}"
                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"/>
            </svg>
            <span class="text-sm font-medium {{ $post->isLikedBy(auth()->user()) ? 'text-blue-600 dark:text-blue-400' : 'text-gray-600 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-400' }}">Like</span>
        </button>

        <button wire:click="toggleComments"
                class="flex-1 flex items-center justify-center space-x-2 py-2 px-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors group">
            <svg class="w-5 h-5 text-gray-500 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-400"
                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
            </svg>
            <span class="text-sm font-medium text-gray-600 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-400">Comment</span>
        </button>
    </div>

    {{-- Comments Section --}}
    @if($showComments)
        <div class="mt-3 pt-3 border-t border-gray-200 dark:border-gray-700">
            {{-- Add Comment Form --}}
            <div class="mb-3">
                <form wire:submit.prevent="addComment">
                    <div class="flex items-start space-x-2">
                        <img class="h-8 w-8 rounded-full object-cover border-2 border-gray-200 dark:border-gray-600 flex-shrink-0"
                             src="{{ auth()->user()->profile_image_url }}"
                             alt="{{ auth()->user()->firstname }} {{ auth()->user()->lastname }}"
                             onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->firstname . ' ' . auth()->user()->lastname) }}&background=random&color=fff&size=100&bold=true'">
                        <div class="flex-1 relative">
                            <div class="bg-gray-100 dark:bg-gray-700 rounded-2xl px-3 py-2 focus-within:ring-2 focus-within:ring-blue-500 transition-all">
                                <textarea wire:model="newComment"
                                          wire:keyup="searchUsers($event.target.value, 'comment')"
                                          wire:keydown.escape="hideMentionSuggestions"
                                          placeholder="Write a comment..."
                                          class="w-full bg-transparent border-0 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none resize-none text-sm"
                                          rows="1"
                                          style="min-height: 20px; max-height: 100px;"
                                          oninput="this.style.height = 'auto'; this.style.height = this.scrollHeight + 'px';"></textarea>
                            </div>
                            
                            {{-- Mention Suggestions --}}
                            @if($showMentionSuggestions && $currentMentionField === 'comment')
                                <div class="absolute left-0 right-0 top-full mt-2 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 rounded-lg shadow-xl max-h-56 overflow-y-auto z-10">
                                    @foreach($mentionSuggestions as $index => $user)
                                        <button type="button"
                                                wire:click="selectMention({{ $user->id }}, 'comment')"
                                                class="w-full px-3 py-2 text-left hover:bg-gray-100 dark:hover:bg-gray-700 flex items-center gap-3 {{ $selectedMentionIndex === $index ? 'bg-blue-50 dark:bg-blue-900/60' : '' }}">
                                            <img class="h-8 w-8 rounded-full object-cover"
                                                 src="{{ $user->profile_image_url }}"
                                                 alt="{{ $user->firstname }} {{ $user->lastname }}">
                                            <div class="min-w-0 flex-1">
                                                <p class="font-medium text-gray-900 dark:text-white truncate text-sm">{{ $user->firstname }} {{ $user->lastname }}</p>
                                                <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ $user->staff->position ?? 'Employee' }}</p>
                                            </div>
                                        </button>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                    @error('newComment')
                        <p class="mt-1 ml-10 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </form>
            </div>

            {{-- Comments List --}}
            <div class="space-y-3">
                @foreach($post->comments as $comment)
                    <div class="flex items-start space-x-2">
                        <a href="{{ route('settings.profile') }}" class="flex-shrink-0">
                            <img class="h-8 w-8 rounded-full object-cover border-2 border-gray-200 dark:border-gray-600 cursor-pointer hover:opacity-90 transition-opacity"
                                 src="{{ $comment->user->profile_image_url }}"
                                 alt="{{ $comment->user->firstname }} {{ $comment->user->lastname }}"
                                 onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($comment->user->firstname . ' ' . $comment->user->lastname) }}&background=random&color=fff&size=100&bold=true'">
                        </a>
                        <div class="flex-1 min-w-0">
                            <div class="bg-gray-100 dark:bg-gray-700 rounded-2xl px-3 py-2">
                                <div class="flex items-center space-x-2 mb-1">
                                    <a href="{{ route('settings.profile') }}" class="font-semibold text-gray-900 dark:text-white hover:underline text-sm">
                                        {{ $comment->user->firstname }} {{ $comment->user->lastname }}
                                    </a>
                                    <span class="text-xs text-gray-500 dark:text-gray-400">{{ $comment->created_at->diffForHumans() }}</span>
                                </div>
                                <p class="text-gray-900 dark:text-white text-sm leading-relaxed">{!! $this->parseMentions($comment->content) !!}</p>
                            </div>
                            
                            {{-- Comment Actions --}}
                            <div class="flex items-center space-x-4 mt-1 ml-2 text-xs">
                                <button wire:click="toggleCommentLike({{ $comment->id }})"
                                        class="font-semibold text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                                    {{ $comment->isLikedBy(auth()->user()) ? 'Unlike' : 'Like' }}
                                </button>
                                @if($comment->replies_count > 0 || isset($showReplies[$comment->id]))
                                    <button wire:click="toggleReplies({{ $comment->id }})"
                                            class="font-semibold text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                                        {{ $comment->replies_count }} {{ $comment->replies_count == 1 ? 'reply' : 'replies' }}
                                    </button>
                                @else
                                    <button wire:click="startReply({{ $comment->id }})"
                                            class="font-semibold text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                                        Reply
                                    </button>
                                @endif
                            </div>

                            {{-- Replies Section --}}
                            @if(isset($showReplies[$comment->id]) && $showReplies[$comment->id])
                                <div class="mt-2 space-y-2">
                                    {{-- Add Reply Form --}}
                                    <form wire:submit.prevent="addReply({{ $comment->id }})" class="flex items-start space-x-2">
                                        <img class="h-7 w-7 rounded-full object-cover border-2 border-gray-200 dark:border-gray-600 flex-shrink-0"
                                             src="{{ auth()->user()->profile_image_url }}"
                                             alt="{{ auth()->user()->firstname }} {{ auth()->user()->lastname }}"
                                             onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->firstname . ' ' . auth()->user()->lastname) }}&background=random&color=fff&size=100&bold=true'">
                                        <div class="flex-1 relative">
                                            <div class="bg-gray-100 dark:bg-gray-700 rounded-2xl px-3 py-1.5 focus-within:ring-2 focus-within:ring-blue-500 transition-all">
                                                <textarea wire:model="newReply.{{ $comment->id }}"
                                                          wire:keyup="searchUsers($event.target.value, 'reply_{{ $comment->id }}')"
                                                          wire:keydown.escape="hideMentionSuggestions"
                                                          placeholder="Write a reply..."
                                                          class="w-full bg-transparent border-0 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none resize-none text-sm"
                                                          rows="1"
                                                          style="min-height: 18px; max-height: 80px;"
                                                          oninput="this.style.height = 'auto'; this.style.height = this.scrollHeight + 'px';"></textarea>
                                            </div>
                                            
                                            {{-- Mention Suggestions for Reply --}}
                                            @if($showMentionSuggestions && $currentMentionField === 'reply_' . $comment->id)
                                                <div class="absolute left-0 right-0 top-full mt-2 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 rounded-lg shadow-xl max-h-56 overflow-y-auto z-10">
                                                    @foreach($mentionSuggestions as $index => $user)
                                                        <button type="button"
                                                                wire:click="selectMention({{ $user->id }}, 'reply_{{ $comment->id }}')"
                                                                class="w-full px-3 py-2 text-left hover:bg-gray-100 dark:hover:bg-gray-700 flex items-center gap-3 {{ $selectedMentionIndex === $index ? 'bg-blue-50 dark:bg-blue-900/60' : '' }}">
                                                            <img class="h-8 w-8 rounded-full object-cover"
                                                                 src="{{ $user->profile_image_url }}"
                                                                 alt="{{ $user->firstname }} {{ $user->lastname }}">
                                                            <div class="min-w-0 flex-1">
                                                                <p class="font-medium text-gray-900 dark:text-white truncate text-sm">{{ $user->firstname }} {{ $user->lastname }}</p>
                                                                <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ $user->staff->position ?? 'Employee' }}</p>
                                                            </div>
                                                        </button>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    </form>

                                    {{-- Replies List --}}
                                    @foreach($comment->replies->where('parent_reply_id', null) as $reply)
                                        <div class="flex items-start space-x-2">
                                            <a href="{{ route('settings.profile') }}" class="flex-shrink-0">
                                                <img class="h-7 w-7 rounded-full object-cover border-2 border-gray-200 dark:border-gray-600 cursor-pointer hover:opacity-90 transition-opacity"
                                                     src="{{ $reply->user->profile_image_url }}"
                                                     alt="{{ $reply->user->firstname }} {{ $reply->user->lastname }}"
                                                     onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($reply->user->firstname . ' ' . $reply->user->lastname) }}&background=random&color=fff&size=100&bold=true'">
                                            </a>
                                            <div class="flex-1 min-w-0">
                                                <div class="bg-gray-100 dark:bg-gray-700 rounded-2xl px-3 py-2">
                                                    <div class="flex items-center space-x-2 mb-1">
                                                        <a href="{{ route('settings.profile') }}" class="font-semibold text-gray-900 dark:text-white hover:underline text-sm">
                                                            {{ $reply->user->firstname }} {{ $reply->user->lastname }}
                                                        </a>
                                                        <span class="text-xs text-gray-500 dark:text-gray-400">{{ $reply->created_at->diffForHumans() }}</span>
                                                    </div>
                                                    <p class="text-gray-900 dark:text-white text-sm leading-relaxed">{!! $this->parseMentions($reply->content) !!}</p>
                                                </div>
                                                
                                                {{-- Reply Actions --}}
                                                <div class="flex items-center space-x-4 mt-1 ml-2 text-xs">
                                                    <button wire:click="toggleCommentLike({{ $reply->id }})"
                                                            class="font-semibold text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                                                        {{ $reply->isLikedBy(auth()->user()) ? 'Unlike' : 'Like' }}
                                                    </button>
                                                    @if($reply->childReplies->count() > 0 || isset($showNestedReplies[$reply->id]))
                                                        <button wire:click="toggleNestedReplies({{ $reply->id }})"
                                                                class="font-semibold text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                                                            {{ $reply->childReplies->count() }} {{ $reply->childReplies->count() == 1 ? 'reply' : 'replies' }}
                                                        </button>
                                                    @else
                                                        <button wire:click="startNestedReply({{ $reply->id }})"
                                                                class="font-semibold text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                                                            Reply
                                                        </button>
                                                    @endif
                                                </div>

                                                {{-- Nested Replies --}}
                                                @if(isset($showNestedReplies[$reply->id]) && $showNestedReplies[$reply->id])
                                                    <div class="mt-2 space-y-2">
                                                        {{-- Add Nested Reply Form --}}
                                                        <form wire:submit.prevent="addNestedReply({{ $reply->id }})" class="flex items-start space-x-2">
                                                            <img class="h-6 w-6 rounded-full object-cover border-2 border-gray-200 dark:border-gray-600 flex-shrink-0"
                                                                 src="{{ auth()->user()->profile_image_url }}"
                                                                 alt="{{ auth()->user()->firstname }} {{ auth()->user()->lastname }}"
                                                                 onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->firstname . ' ' . auth()->user()->lastname) }}&background=random&color=fff&size=100&bold=true'">
                                                            <div class="flex-1 relative">
                                                                <div class="bg-gray-100 dark:bg-gray-700 rounded-2xl px-3 py-1.5 focus-within:ring-2 focus-within:ring-blue-500 transition-all">
                                                                    <textarea wire:model="newNestedReply.{{ $reply->parent_reply_id ?? $reply->id }}"
                                                                              wire:keyup="searchUsers($event.target.value, 'nested_reply_{{ $reply->id }}')"
                                                                              wire:keydown.escape="hideMentionSuggestions"
                                                                              placeholder="Write a reply..."
                                                                              class="w-full bg-transparent border-0 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none resize-none text-sm"
                                                                              rows="1"
                                                                              style="min-height: 18px; max-height: 80px;"
                                                                              oninput="this.style.height = 'auto'; this.style.height = this.scrollHeight + 'px';"></textarea>
                                                                </div>
                                                            </div>
                                                        </form>

                                                        {{-- Nested Replies List --}}
                                                        @foreach($reply->childReplies as $nestedReply)
                                                            <div class="flex items-start space-x-2">
                                                                <a href="{{ route('settings.profile') }}" class="flex-shrink-0">
                                                                    <img class="h-6 w-6 rounded-full object-cover border-2 border-gray-200 dark:border-gray-600 cursor-pointer hover:opacity-90 transition-opacity"
                                                                         src="{{ $nestedReply->user->profile_image_url }}"
                                                                         alt="{{ $nestedReply->user->firstname }} {{ $nestedReply->user->lastname }}"
                                                                         onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($nestedReply->user->firstname . ' ' . $nestedReply->user->lastname) }}&background=random&color=fff&size=100&bold=true'">
                                                                </a>
                                                                <div class="flex-1 min-w-0">
                                                                    <div class="bg-gray-100 dark:bg-gray-700 rounded-2xl px-3 py-2">
                                                                        <div class="flex items-center space-x-2 mb-1">
                                                                            <a href="{{ route('settings.profile') }}" class="font-semibold text-gray-900 dark:text-white hover:underline text-sm">
                                                                                {{ $nestedReply->user->firstname }} {{ $nestedReply->user->lastname }}
                                                                            </a>
                                                                            <span class="text-xs text-gray-500 dark:text-gray-400">{{ $nestedReply->created_at->diffForHumans() }}</span>
                                                                        </div>
                                                                        <p class="text-gray-900 dark:text-white text-sm leading-relaxed">{!! $this->parseMentions($nestedReply->content) !!}</p>
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
</div>
