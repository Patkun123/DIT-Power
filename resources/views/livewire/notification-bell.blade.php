<div class="relative notification-bell-container" x-data="{ open: @entangle('showDropdown') }">
    <!-- Notification Bell Button - Mobile optimized -->
    <button
        wire:click="toggleDropdown"
        class="relative p-1.5 sm:p-2 text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white 
               transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 
               focus:ring-opacity-50 rounded-lg notification-bell-button"
        @click="open"
    >
        <!-- Bell Icon - Responsive sizing -->
        <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
            </path>
        </svg>

        <!-- Unread Count Badge - Responsive sizing -->
        @if($unreadCount > 0)
            <span class="absolute -top-0.5 -right-0.5 sm:-top-1 sm:-right-1 bg-red-500 text-white text-xs rounded-full h-4 w-4 sm:h-5 sm:w-5 flex items-center justify-center animate-pulse font-medium">
                {{ $unreadCount > 99 ? '99+' : $unreadCount }}
            </span>
        @endif
    </button>

    <!-- Dropdown Panel - Mobile-optimized positioning -->
    <div 
        x-show="open"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        @click.away="open = false"
        class="absolute right-0 mt-2 w-80 sm:w-96 max-w-[calc(100vw-1rem)] 
               bg-white dark:bg-gray-800 rounded-lg shadow-xl border 
               border-gray-200 dark:border-gray-700 z-[9999] notification-dropdown
               transform -translate-x-2 sm:translate-x-0"
        style="display: none;"
    >

        <!-- Header - Mobile-optimized text sizing -->
        <div class="px-3 sm:px-4 py-2 sm:py-3 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
            <h3 class="text-base sm:text-lg font-semibold text-gray-900 dark:text-white notification-header">Notifications</h3>
            @if($unreadCount > 0)
                <button
                    wire:click="markAllAsRead"
                    class="text-xs sm:text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 focus:outline-none focus:underline"
                >
                    Mark all as read
                </button>
            @endif
        </div>

        <!-- Notifications List - Mobile-optimized height and padding -->
        <div class="max-h-80 sm:max-h-96 overflow-y-auto notification-scroll">
            @forelse($notifications as $notification)
                <div
                    wire:click="markAsRead({{ $notification->id }})"
                    class="px-4 py-3 sm:px-4 sm:py-3 border-b border-gray-100 dark:border-gray-700 
                           hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer transition-colors duration-150 
                           notification-item active:bg-gray-100 dark:active:bg-gray-600 
                           {{ $notification->isRead() ? '' : 'bg-blue-50 dark:bg-blue-900/20' }}"
                >
                    <div class="flex items-start space-x-2 sm:space-x-3">
                        <!-- Notification Icon - Responsive sizing -->
                        <div class="flex-shrink-0">
                            @if($notification->type === 'quiz_start')
                                <div class="w-6 h-6 sm:w-8 sm:h-8 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center">
                                    <svg class="w-3 h-3 sm:w-4 sm:h-4 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            @elseif($notification->type === 'quiz_ending')
                                <div class="w-6 h-6 sm:w-8 sm:h-8 bg-orange-100 dark:bg-orange-900/30 rounded-full flex items-center justify-center">
                                    <svg class="w-3 h-3 sm:w-4 sm:h-4 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            @else
                                <div class="w-6 h-6 sm:w-8 sm:h-8 bg-blue-100 dark:bg-blue-900/30 rounded-full flex items-center justify-center">
                                    <svg class="w-3 h-3 sm:w-4 sm:h-4 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>

                        <!-- Notification Content - Mobile-optimized text sizing -->
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 dark:text-white leading-snug notification-title">
                                {{ $notification->title }}
                            </p>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1 leading-relaxed notification-message">
                                {{ $notification->message }}
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-500 mt-1">
                                {{ $notification->created_at->diffForHumans() }}
                            </p>
                        </div>

                        <!-- Unread Indicator - Responsive sizing -->
                        @if(!$notification->isRead())
                            <div class="flex-shrink-0">
                                <div class="w-1.5 h-1.5 sm:w-2 sm:h-2 bg-blue-500 rounded-full"></div>
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="px-3 sm:px-4 py-6 sm:py-8 text-center">
                    <svg class="w-8 h-8 sm:w-12 sm:h-12 text-gray-400 dark:text-gray-600 mx-auto mb-2 sm:mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                    </svg>
                    <p class="text-gray-500 dark:text-gray-400 text-xs sm:text-sm">No notifications yet</p>
                </div>
            @endforelse
        </div>

        <!-- Footer - Responsive padding and text -->
        @if($notifications->count() > 0)
            <div class="px-3 sm:px-4 py-2 sm:py-3 border-t border-gray-200 dark:border-gray-700">
                <a href="#" class="text-xs sm:text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 text-center block focus:outline-none focus:underline">
                    View all notifications
                </a>
            </div>
        @endif
    </div>
</div>
