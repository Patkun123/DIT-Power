<div class="relative notification-bell-container" x-data="{ open: @entangle('showDropdown') }" wire:poll.3s="loadNotifications">
    <!-- Notification Bell Button - Enhanced with better alignment -->
    <button
        wire:click="toggleDropdown"
        class="relative p-2 text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white 
               transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 
               focus:ring-opacity-50 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 
               notification-bell-button group"
        @click="open"
    >
        <!-- Bell Icon - Enhanced with hover effects -->
        <svg class="w-6 h-6 transition-transform duration-200 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
            </path>
        </svg>

        <!-- Unread Count Badge - Perfectly centered and enhanced -->
        @if($unreadCount > 0)
            <span class="notification-badge">
                {{ $unreadCount > 99 ? '99+' : $unreadCount }}
            </span>
        @endif
    </button>

    <!-- Dropdown Panel - Enhanced with better positioning and styling -->
    <div 
        x-show="open"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-95 translate-y-2"
        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 scale-100 translate-y-0"
        x-transition:leave-end="opacity-0 scale-95 translate-y-2"
        @click.away="open = false"
        class="absolute right-0 mt-3 w-80 sm:w-96 max-w-[calc(100vw-2rem)] 
               bg-white dark:bg-gray-800 rounded-xl shadow-2xl border 
               border-gray-200 dark:border-gray-700 z-[9999] notification-dropdown
               transform -translate-x-2 sm:translate-x-0 backdrop-blur-sm"
        style="display: none;"
    >

        <!-- Header - Enhanced with better styling -->
        <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-gray-800 dark:to-gray-700">
            <div class="flex items-center space-x-2">
                <div class="w-2 h-2 bg-blue-500 rounded-full animate-pulse"></div>
                <h3 class="text-lg font-bold text-gray-900 dark:text-white notification-header">Notifications</h3>
                @if($unreadCount > 0)
                    <span class="bg-red-500 text-white text-xs px-2 py-1 rounded-full font-bold">
                        {{ $unreadCount }}
                    </span>
                @endif
            </div>
            @if($unreadCount > 0)
                <button
                    wire:click="markAllAsRead"
                    class="text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 
                           focus:outline-none focus:underline transition-colors duration-200 font-medium"
                >
                    Mark all as read
                </button>
            @endif
        </div>

        <!-- Notifications List - Enhanced with better styling -->
        <div class="max-h-80 sm:max-h-96 overflow-y-auto notification-scroll scrollbar-thin scrollbar-thumb-gray-300 dark:scrollbar-thumb-gray-600">
            @forelse($notifications as $notification)
                <div
                    wire:click="markAsRead({{ $notification->id }})"
                    class="px-4 py-3 border-b border-gray-100 dark:border-gray-700 
                           hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer transition-all duration-200 
                           notification-item active:bg-gray-100 dark:active:bg-gray-600 
                           {{ $notification->isRead() ? '' : 'bg-blue-50 dark:bg-blue-900/20 border-l-4 border-l-blue-500' }}"
                >
                    <div class="flex items-start space-x-3">
                        <!-- Notification Icon - Enhanced with social types -->
                        <div class="flex-shrink-0 notification-icon">
                            @if($notification->type === 'quiz_start')
                                <div class="w-8 h-8 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center ring-2 ring-green-200 dark:ring-green-800">
                                    <svg class="w-4 h-4 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            @elseif($notification->type === 'quiz_ending')
                                <div class="w-8 h-8 bg-orange-100 dark:bg-orange-900/30 rounded-full flex items-center justify-center ring-2 ring-orange-200 dark:ring-orange-800">
                                    <svg class="w-4 h-4 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            @elseif($notification->type === 'chat_message')
                                <div class="w-8 h-8 bg-purple-100 dark:bg-purple-900/30 rounded-full flex items-center justify-center ring-2 ring-purple-200 dark:ring-purple-800">
                                    <svg class="w-4 h-4 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                    </svg>
                                </div>
                            @elseif($notification->type === 'post_liked')
                                <div class="w-8 h-8 bg-red-100 dark:bg-red-900/30 rounded-full flex items-center justify-center ring-2 ring-red-200 dark:ring-red-800">
                                    <svg class="w-4 h-4 text-red-600 dark:text-red-400" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                                    </svg>
                                </div>
                            @elseif($notification->type === 'comment_liked')
                                <div class="w-8 h-8 bg-pink-100 dark:bg-pink-900/30 rounded-full flex items-center justify-center ring-2 ring-pink-200 dark:ring-pink-800">
                                    <svg class="w-4 h-4 text-pink-600 dark:text-pink-400" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                                    </svg>
                                </div>
                            @elseif($notification->type === 'comment_created')
                                <div class="w-8 h-8 bg-blue-100 dark:bg-blue-900/30 rounded-full flex items-center justify-center ring-2 ring-blue-200 dark:ring-blue-800">
                                    <svg class="w-4 h-4 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                    </svg>
                                </div>
                            @elseif($notification->type === 'reply_created')
                                <div class="w-8 h-8 bg-indigo-100 dark:bg-indigo-900/30 rounded-full flex items-center justify-center ring-2 ring-indigo-200 dark:ring-indigo-800">
                                    <svg class="w-4 h-4 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path>
                                    </svg>
                                </div>
                            @else
                                <div class="w-8 h-8 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center ring-2 ring-gray-200 dark:ring-gray-600">
                                    <svg class="w-4 h-4 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>

                        <!-- Notification Content - Enhanced styling -->
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between">
                                <p class="text-sm font-semibold text-gray-900 dark:text-white leading-snug notification-title">
                                    {{ $notification->title }}
                                </p>
                                @if(!$notification->isRead())
                                    <div class="w-2 h-2 bg-blue-500 rounded-full unread-indicator"></div>
                                @endif
                            </div>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1 leading-relaxed notification-message">
                                {{ $notification->message }}
                            </p>
                            <div class="flex items-center justify-between mt-2">
                                <p class="text-xs text-gray-500 dark:text-gray-500">
                                    {{ $notification->created_at->diffForHumans() }}
                                </p>
                                @if($notification->type === 'post_liked' || $notification->type === 'comment_liked')
                                    <span class="notification-type-badge bg-red-100 dark:bg-red-900/30 text-red-600 dark:text-red-400">
                                        Like
                                    </span>
                                @elseif($notification->type === 'comment_created' || $notification->type === 'reply_created')
                                    <span class="notification-type-badge bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400">
                                        Comment
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="px-4 py-8 text-center notification-empty">
                    <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-gray-400 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">No notifications yet</h3>
                    <p class="text-gray-500 dark:text-gray-400 text-sm">You'll see notifications here when someone interacts with your content</p>
                </div>
            @endforelse
        </div>

        <!-- Footer - Enhanced with better styling -->
        @if($notifications->count() > 0)
            <div class="px-4 py-3 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50">
                <a href="#" class="text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 
                                 text-center block focus:outline-none focus:underline transition-colors duration-200 
                                 font-medium hover:bg-blue-50 dark:hover:bg-blue-900/20 py-2 px-3 rounded-lg">
                    View all notifications
                </a>
            </div>
        @endif
    </div>
</div>
