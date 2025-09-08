<?php

use function Livewire\Volt\{state};

//

?>
<style>
    .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }
</style>

<div class="p-4 sm:p-6 space-y-10 bg-gray-50 dark:bg-gray-900 min-h-screen">
    <!-- Flash Messages -->
    @if (session()->has('message'))
        <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg p-4">
            <div class="flex items-center">
                <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2l4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="text-green-800 dark:text-green-200">{{ session('message') }}</span>
            </div>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-4">
            <div class="flex items-center">
                <svg class="w-5 h-5 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="text-red-800 dark:text-red-200">{{ session('error') }}</span>
            </div>
        </div>
    @endif

    <div class="flex items-center justify-between">
        <h2 class="2xl:text-xl text-md font-semibold text-gray-800 dark:text-white">
            Leaderboards
        </h2>
        <div class="text-sm text-gray-600 dark:text-gray-400">
            Today: {{ $today }}
        </div>
        <button wire:click="refreshLeaderboards" 
                wire:loading.attr="disabled"
                class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
            <svg wire:loading.remove class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
            </svg>
            <svg wire:loading class="w-4 h-4 inline mr-2 animate-spin" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            {{ $isLoading ? 'Loading...' : 'Refresh' }}
        </button>
    </div>

    <!-- Loading Overlay -->
    @if($isLoading)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white dark:bg-gray-800 rounded-lg p-6 flex items-center space-x-3">
                <svg class="w-6 h-6 animate-spin text-blue-500" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span class="text-gray-800 dark:text-white">Loading leaderboards...</span>
            </div>
        </div>
    @endif

    <!-- Overall Leaderboard -->
    <div class="bg-white 2xl:h-110 dark:bg-gray-800 p-6 rounded-xl shadow-md dark:shadow-gray-950 shadow-gray-400">
        <h2 class="2xl:text-xl text-md font-semibold text-gray-800 dark:text-white mb-6">
            Overall Scores Leaderboard
        </h2>
        
        <div class="flex gap-4 overflow-x-auto scrollbar-hide snap-x snap-mandatory px-4 py-6 
                    lg:grid lg:grid-cols-5 lg:gap-3 lg:justify-items-center lg:overflow-visible">
            
            @forelse($overallLeaderboard as $index => $entry)
                <div class="shrink-0 snap-center text-center 
                            @if($index === 0) bg-gradient-to-b from-yellow-400 via-yellow-600 to-yellow-500 shadow-2xl shadow-yellow-500
                            @elseif($index === 1) bg-gradient-to-b from-gray-300 via-gray-500 to-gray-400 shadow-2xl shadow-gray-500
                            @elseif($index === 2) bg-gradient-to-b from-amber-600 via-amber-800 to-amber-700 shadow-2xl shadow-amber-500
                            @else bg-gradient-to-b from-silver-500 via-silver-700 to-silver-500 shadow-2xl shadow-silver-500
                            @endif
                            h-50 w-50 lg:w-35 2xl:h-70 2xl:w-45 rounded-2xl flex flex-col items-center justify-center">
                    
                    <div class="bg-gray-200 w-10 h-10 2xl:w-16 2xl:h-16 rounded-full mb-2 flex items-center justify-center text-lg font-bold">
                        {{ $index + 1 }}
                    </div>
                    <div class="font-semibold 2xl:text-md text-sm text-white">
                        {{ $entry['user']->firstname ?? 'Unknown' }} {{ $entry['user']->lastname ?? '' }}
                    </div>
                    <div class="font-semibold 2xl:text-md text-sm text-white">
                        {{ $entry['total_score'] }} pts
                    </div>
                    <div class="text-xs text-white/80">
                        {{ $entry['attempts_count'] }} attempts
                    </div>
                </div>
            @empty
                <div class="col-span-5 text-center text-gray-500 dark:text-gray-400 py-8">
                    @if($isLoading)
                        <div class="flex items-center justify-center">
                            <svg class="w-6 h-6 animate-spin text-blue-500 mr-2" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Loading...
                        </div>
                    @else
                        No quiz attempts yet. Be the first to take a quiz!
                    @endif
                </div>
            @endforelse
        </div>
    </div>

    <!-- Daily Set Leaderboards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Set 1 Leaderboard -->
        <div class="bg-white 2xl:h-110 dark:bg-gray-800 p-6 rounded-xl shadow-md dark:shadow-gray-950 shadow-gray-400">
            <h2 class="2xl:text-xl text-md font-semibold text-gray-800 dark:text-white mb-4">
                1st Set - Daily Leaderboard
            </h2>
            <div class="space-y-3">
                @forelse($set1Leaderboard as $index => $entry)
                    <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold
                                        @if($index === 0) bg-yellow-400 text-yellow-900
                                        @elseif($index === 1) bg-gray-300 text-gray-700
                                        @elseif($index === 2) bg-amber-600 text-amber-900
                                        @else bg-gray-200 text-gray-700
                                        @endif">
                                {{ $index + 1 }}
                            </div>
                            <div>
                                <div class="font-medium text-gray-800 dark:text-white">
                                    {{ $entry['user']->firstname ?? 'Unknown' }} {{ $entry['user']->lastname ?? '' }}
                                </div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ $entry['attempts_count'] }} attempt(s)
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="font-bold text-lg text-gray-800 dark:text-white">
                                {{ $entry['best_score'] }}
                            </div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                {{ $entry['best_correct'] }} correct
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center text-gray-500 dark:text-gray-400 py-8">
                        @if($isLoading)
                            <div class="flex items-center justify-center">
                                <svg class="w-4 h-4 animate-spin text-blue-500 mr-2" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Loading...
                            </div>
                        @else
                            No attempts today for Set 1
                        @endif
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Set 2 Leaderboard -->
        <div class="bg-white 2xl:h-110 dark:bg-gray-800 p-6 rounded-xl shadow-md dark:shadow-gray-950 shadow-gray-400">
            <h2 class="2xl:text-xl text-md font-semibold text-gray-800 dark:text-white mb-4">
                2nd Set - Daily Leaderboard
            </h2>
            <div class="space-y-3">
                @forelse($set2Leaderboard as $index => $entry)
                    <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold
                                        @if($index === 0) bg-yellow-400 text-yellow-900
                                        @elseif($index === 1) bg-gray-300 text-gray-700
                                        @elseif($index === 2) bg-amber-600 text-amber-900
                                        @else bg-gray-200 text-gray-700
                                        @endif">
                                {{ $index + 1 }}
                            </div>
                            <div>
                                <div class="font-medium text-gray-800 dark:text-white">
                                    {{ $entry['user']->firstname ?? 'Unknown' }} {{ $entry['user']->lastname ?? '' }}
                                </div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ $entry['attempts_count'] }} attempt(s)
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="font-bold text-lg text-gray-800 dark:text-white">
                                {{ $entry['best_score'] }}
                            </div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                {{ $entry['best_correct'] }} correct
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center text-gray-500 dark:text-gray-400 py-8">
                        @if($isLoading)
                            <div class="flex items-center justify-center">
                                <svg class="w-4 h-4 animate-spin text-blue-500 mr-2" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Loading...
                            </div>
                        @else
                            No attempts today for Set 2
                        @endif
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Set 3 Leaderboard -->
        <div class="bg-white 2xl:h-110 dark:bg-gray-800 p-6 rounded-xl shadow-md dark:shadow-gray-950 shadow-gray-400">
            <h2 class="2xl:text-xl text-md font-semibold text-gray-800 dark:text-white mb-4">
                3rd Set - Daily Leaderboard
            </h2>
            <div class="space-y-3">
                @forelse($set3Leaderboard as $index => $entry)
                    <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold
                                        @if($index === 0) bg-yellow-400 text-yellow-900
                                        @elseif($index === 1) bg-gray-300 text-gray-700
                                        @elseif($index === 2) bg-amber-600 text-amber-900
                                        @else bg-gray-200 text-gray-700
                                        @endif">
                                {{ $index + 1 }}
                            </div>
                            <div>
                                <div class="font-medium text-gray-800 dark:text-white">
                                    {{ $entry['user']->firstname ?? 'Unknown' }} {{ $entry['user']->lastname ?? '' }}
                                </div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ $entry['attempts_count'] }} attempt(s)
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="font-bold text-lg text-gray-800 dark:text-white">
                                {{ $entry['best_score'] }}
                            </div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                {{ $entry['best_correct'] }} correct
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center text-gray-500 dark:text-gray-400 py-8">
                        @if($isLoading)
                            <div class="flex items-center justify-center">
                                <svg class="w-4 h-4 animate-spin text-blue-500 mr-2" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Loading...
                            </div>
                        @else
                            No attempts today for Set 3
                        @endif
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Mini Games Note -->
    <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4">
        <div class="flex items-center">
            <svg class="w-5 h-5 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span class="text-blue-800 dark:text-blue-200">
                <strong>Note:</strong> Mini games leaderboards are excluded from daily rankings as they are separate from the main quiz sets. Daily leaderboards reset every day at midnight and only show scores from quiz sets 1, 2, and 3.
            </span>
        </div>
    </div>
</div>
