<div class="admin-activity bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center space-x-3">
            <flux:button icon="clock" variant="primary" color="blue" class="!p-2" />
            <h2 class="text-xl font-bold text-gray-800 dark:text-white">Recent Activity</h2>
        </div>
        <div class="flex items-center space-x-2">
            <button wire:click="refresh"
                    class="p-2 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 transition-colors"
                    title="Refresh">
                <flux:icon name="arrow-path" class="w-5 h-5" />
            </button>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-blue-50 dark:bg-blue-900/20 rounded-lg p-3 text-center">
            <div class="text-2xl font-bold text-blue-600 dark:text-blue-400">{{ $stats['today'] ?? 0 }}</div>
            <div class="text-sm text-blue-600 dark:text-blue-400">Today</div>
        </div>
        <div class="bg-green-50 dark:bg-green-900/20 rounded-lg p-3 text-center">
            <div class="text-2xl font-bold text-green-600 dark:text-green-400">{{ $stats['this_week'] ?? 0 }}</div>
            <div class="text-sm text-green-600 dark:text-green-400">This Week</div>
        </div>
        <div class="bg-purple-50 dark:bg-purple-900/20 rounded-lg p-3 text-center">
            <div class="text-2xl font-bold text-purple-600 dark:text-purple-400">{{ $stats['this_month'] ?? 0 }}</div>
            <div class="text-sm text-purple-600 dark:text-purple-400">This Month</div>
        </div>
        <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-3 text-center">
            <div class="text-2xl font-bold text-gray-600 dark:text-gray-400">{{ $stats['total'] ?? 0 }}</div>
            <div class="text-sm text-gray-600 dark:text-gray-400">Total</div>
        </div>
    </div>

    <!-- Filters -->
    <div class="flex flex-wrap gap-4 mb-6">
        <!-- Date Filter -->
        <div class="flex items-center space-x-2">
            <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Period:</label>
            <select wire:model.live="filter"
                    class="text-sm border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-1 bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                <option value="all">All Time</option>
                <option value="today">Today</option>
                <option value="week">This Week</option>
                <option value="month">This Month</option>
            </select>
        </div>

        <!-- Activity Type Filter -->
        <div class="flex items-center space-x-2">
            <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Type:</label>
            <select wire:model.live="activityType"
                    class="text-sm border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-1 bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                <option value="all">All Activities</option>
                <option value="quiz_taken">Quiz Taken</option>
                <option value="user_added">User Added</option>
                <option value="feedback_sent">Feedback Sent</option>
                <option value="journal_added">Journal Added</option>
                <option value="news_created">News Created</option>
                <option value="login">Login</option>
            </select>
        </div>
    </div>

    <!-- Loading State -->
    @if($isLoading)
        <div class="flex items-center justify-center py-8">
            <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-primary-600"></div>
            <span class="ml-2 text-gray-600 dark:text-gray-400">Loading activities...</span>
        </div>
    @else
        <!-- Activities List -->
        <div class="space-y-4 max-h-96 overflow-y-auto">
            @forelse($activities as $activity)
                <div class="flex items-start space-x-4 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors">
                    <!-- Activity Icon -->
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 rounded-full bg-{{ $activity->color }}-100 dark:bg-{{ $activity->color }}-900/30 flex items-center justify-center">
                            <flux:icon name="{{ $activity->icon }}" class="w-5 h-5 text-{{ $activity->color }}-600 dark:text-{{ $activity->color }}-400" />
                        </div>
                    </div>

                    <!-- Activity Content -->
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center justify-between">
                            <h3 class="text-sm font-medium text-gray-900 dark:text-white truncate">
                                {{ $activity->title }}
                            </h3>
                            <span class="text-xs text-gray-500 dark:text-gray-400">
                                {{ $activity->time_ago }}
                            </span>
                        </div>

                        <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">
                            {{ $activity->description }}
                        </p>

                        <!-- User Info -->
                        @if($activity->user)
                            <div class="flex items-center mt-2">
                                <div class="w-6 h-6 rounded-full bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center">
                                    <span class="text-xs font-medium text-primary-600 dark:text-primary-400">
                                        {{ substr($activity->user->firstname, 0, 1) }}{{ substr($activity->user->lastname, 0, 1) }}
                                    </span>
                                </div>
                                <span class="ml-2 text-xs text-gray-500 dark:text-gray-400">
                                    {{ $activity->user->firstname }} {{ $activity->user->lastname }}
                                </span>
                            </div>
                        @endif

                        <!-- Metadata -->
                        @if($activity->metadata && count($activity->metadata) > 0)
                            <div class="mt-2 flex flex-wrap gap-2">
                                @foreach($activity->metadata as $key => $value)
                                    @if($key === 'score' && isset($activity->metadata['correct']))
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-{{ $activity->color }}-100 text-{{ $activity->color }}-800 dark:bg-{{ $activity->color }}-900/30 dark:text-{{ $activity->color }}-400">
                                            Score: {{ $value }}/{{ $activity->metadata['correct'] }}
                                        </span>
                                    @elseif($key === 'rating')
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400">
                                            Rating: {{ $value }}/5
                                        </span>
                                    @elseif($key === 'set')
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400">
                                            Set {{ $value }}
                                        </span>
                                    @endif
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="text-center py-8">
                    <flux:icon name="inbox" class="w-12 h-12 text-gray-400 mx-auto mb-4" />
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">No activities found</h3>
                    <p class="text-gray-500 dark:text-gray-400">No activities match your current filters.</p>
                </div>
            @endforelse
        </div>
    @endif
</div>
