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
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="2xl:text-xl text-md font-semibold text-gray-800 dark:text-white">
                    Today's Overall Leaderboard
                </h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ $today }}</p>
            </div>
        </div>

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

                    <div class="bg-gray-200 w-12 h-12 2xl:w-16 2xl:h-16 rounded-full mb-2 overflow-hidden border-2 border-white/60">
                        @if(($entry['user']->profileimage ?? null))
                            <img src="{{ asset('storage/' . $entry['user']->profileimage) }}" alt="{{ $entry['user']->firstname }} {{ $entry['user']->lastname }}" class="w-full h-full object-cover">
                        @else
                            <img src="{{ asset('Images/default.png') }}" alt="Default Profile" class="w-full h-full object-cover">
                        @endif
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
                        No quiz attempts today yet. Be the first to take a quiz and appear on the leaderboard!
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
                            <div class="w-8 h-8 rounded-full overflow-hidden border-2
                                        @if($index === 0) border-yellow-300
                                        @elseif($index === 1) border-gray-300
                                        @elseif($index === 2) border-amber-600
                                        @else border-white/30
                                        @endif">
                                @if(($entry['user']->profileimage ?? null))
                                    <img src="{{ asset('storage/' . $entry['user']->profileimage) }}" alt="{{ $entry['user']->firstname }} {{ $entry['user']->lastname }}" class="w-full h-full object-cover">
                                @else
                                    <img src="{{ asset('Images/default.png') }}" alt="Default Profile" class="w-full h-full object-cover">
                                @endif
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
                            <div class="w-8 h-8 rounded-full overflow-hidden border-2
                                        @if($index === 0) border-yellow-300
                                        @elseif($index === 1) border-gray-300
                                        @elseif($index === 2) border-amber-600
                                        @else border-white/30
                                        @endif">
                                @if(($entry['user']->profileimage ?? null))
                                    <img src="{{ asset('storage/' . $entry['user']->profileimage) }}" alt="{{ $entry['user']->firstname }} {{ $entry['user']->lastname }}" class="w-full h-full object-cover">
                                @else
                                    <img src="{{ asset('Images/default.png') }}" alt="Default Profile" class="w-full h-full object-cover">
                                @endif
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

    <!-- Previous Winners Section -->
    <div class="space-y-6">
        <!-- All-Time Champions -->
        @if($allTimeChampions->isNotEmpty())
        <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-md dark:shadow-gray-950 shadow-gray-400">
            <h2 class="2xl:text-xl text-md font-semibold text-gray-800 dark:text-white mb-6 flex items-center">
                <svg class="w-6 h-6 text-yellow-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                </svg>
                All-Time Champions
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($allTimeChampions->take(6) as $index => $champion)
                <div class="bg-gradient-to-r from-yellow-50 to-yellow-100 dark:from-yellow-900/20 dark:to-yellow-800/20 border border-yellow-200 dark:border-yellow-700 rounded-lg p-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center text-sm font-bold
                                    @if($index === 0) bg-yellow-400 text-yellow-900
                                    @elseif($index === 1) bg-gray-300 text-gray-700
                                    @elseif($index === 2) bg-amber-600 text-amber-900
                                    @else bg-gray-200 text-gray-700
                                    @endif">
                            {{ $index + 1 }}
                        </div>
                        <div class="flex-1">
                            <div class="font-semibold text-gray-800 dark:text-white">
                                {{ $champion->user->firstname ?? 'Unknown' }} {{ $champion->user->lastname ?? '' }}
                            </div>
                            <div class="text-sm text-gray-600 dark:text-gray-400">
                                {{ $champion->win_count }} wins | {{ $champion->total_score }} total points
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Previous Winners -->
        <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-md dark:shadow-gray-950 shadow-gray-400">
            <h2 class="2xl:text-xl text-md font-semibold text-gray-800 dark:text-white mb-6 flex items-center">
                <svg class="w-6 h-6 text-indigo-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                </svg>
                Previous Winners
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Overall Previous Winners -->
                <div class="space-y-3">
                    <h3 class="font-semibold text-gray-700 dark:text-gray-300 text-sm uppercase tracking-wide flex items-center">
                        <svg class="w-4 h-4 text-purple-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                        </svg>
                        Overall Champions
                    </h3>
                    @forelse($previousWinners['overall']->take(5) as $winner)
                    <div class="bg-gradient-to-r from-purple-50 to-purple-100 dark:from-purple-900/20 dark:to-purple-800/20 border border-purple-200 dark:border-purple-700 rounded-lg p-3">
                        <div class="font-medium text-gray-800 dark:text-white text-sm">
                            {{ $winner->user->firstname ?? 'Unknown' }} {{ $winner->user->lastname ?? '' }}
                        </div>
                        <div class="text-xs text-gray-600 dark:text-gray-400">
                            {{ $winner->formatted_date }} - {{ $winner->score }} pts
                        </div>
                    </div>
                    @empty
                    <div class="text-center text-gray-500 dark:text-gray-400 py-4 text-sm">
                        No overall winners yet
                    </div>
                    @endforelse
                </div>

                <!-- Set 1 Previous Winners -->
                <div class="space-y-3">
                    <h3 class="font-semibold text-gray-700 dark:text-gray-300 text-sm uppercase tracking-wide flex items-center">
                        <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                        </svg>
                        Set 1 Winners
                    </h3>
                    @forelse($previousWinners['set_1']->take(5) as $winner)
                    <div class="bg-gradient-to-r from-green-50 to-green-100 dark:from-green-900/20 dark:to-green-800/20 border border-green-200 dark:border-green-700 rounded-lg p-3">
                        <div class="font-medium text-gray-800 dark:text-white text-sm">
                            {{ $winner->user->firstname ?? 'Unknown' }} {{ $winner->user->lastname ?? '' }}
                        </div>
                        <div class="text-xs text-gray-600 dark:text-gray-400">
                            {{ $winner->formatted_date }} - {{ $winner->score }} pts
                        </div>
                    </div>
                    @empty
                    <div class="text-center text-gray-500 dark:text-gray-400 py-4 text-sm">
                        No Set 1 winners yet
                    </div>
                    @endforelse
                </div>

                <!-- Set 2 Previous Winners -->
                <div class="space-y-3">
                    <h3 class="font-semibold text-gray-700 dark:text-gray-300 text-sm uppercase tracking-wide flex items-center">
                        <svg class="w-4 h-4 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                        </svg>
                        Set 2 Winners
                    </h3>
                    @forelse($previousWinners['set_2']->take(5) as $winner)
                    <div class="bg-gradient-to-r from-blue-50 to-blue-100 dark:from-blue-900/20 dark:to-blue-800/20 border border-blue-200 dark:border-blue-700 rounded-lg p-3">
                        <div class="font-medium text-gray-800 dark:text-white text-sm">
                            {{ $winner->user->firstname ?? 'Unknown' }} {{ $winner->user->lastname ?? '' }}
                        </div>
                        <div class="text-xs text-gray-600 dark:text-gray-400">
                            {{ $winner->formatted_date }} - {{ $winner->score }} pts
                        </div>
                    </div>
                    @empty
                    <div class="text-center text-gray-500 dark:text-gray-400 py-4 text-sm">
                        No Set 2 winners yet
                    </div>
                    @endforelse
                </div>

                <!-- Set 3 Previous Winners -->
                <div class="space-y-3">
                    <h3 class="font-semibold text-gray-700 dark:text-gray-300 text-sm uppercase tracking-wide flex items-center">
                        <svg class="w-4 h-4 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                        </svg>
                        Set 3 Winners
                    </h3>
                    @forelse($previousWinners['set_3']->take(5) as $winner)
                    <div class="bg-gradient-to-r from-red-50 to-red-100 dark:from-red-900/20 dark:to-red-800/20 border border-red-200 dark:border-red-700 rounded-lg p-3">
                        <div class="font-medium text-gray-800 dark:text-white text-sm">
                            {{ $winner->user->firstname ?? 'Unknown' }} {{ $winner->user->lastname ?? '' }}
                        </div>
                        <div class="text-xs text-gray-600 dark:text-gray-400">
                            {{ $winner->formatted_date }} - {{ $winner->score }} pts
                        </div>
                    </div>
                    @empty
                    <div class="text-center text-gray-500 dark:text-gray-400 py-4 text-sm">
                        No Set 3 winners yet
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Recent Winners -->
        @if($previousWinners['overall']->isNotEmpty() || $previousWinners['set_1']->isNotEmpty() || $previousWinners['set_2']->isNotEmpty() || $previousWinners['set_3']->isNotEmpty())
        <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-md dark:shadow-gray-950 shadow-gray-400">
            <h2 class="2xl:text-xl text-md font-semibold text-gray-800 dark:text-white mb-6 flex items-center">
                <svg class="w-6 h-6 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Recent Winners (Last 7 Days)
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Overall Recent Winners -->
                @if($previousWinners['overall']->isNotEmpty())
                <div class="space-y-3">
                    <h3 class="font-semibold text-gray-700 dark:text-gray-300 text-sm uppercase tracking-wide">Overall Champions</h3>
                    @foreach($previousWinners['overall']->take(3) as $winner)
                    <div class="bg-gradient-to-r from-purple-50 to-purple-100 dark:from-purple-900/20 dark:to-purple-800/20 border border-purple-200 dark:border-purple-700 rounded-lg p-3">
                        <div class="font-medium text-gray-800 dark:text-white text-sm">
                            {{ $winner->user->firstname ?? 'Unknown' }} {{ $winner->user->lastname ?? '' }}
                        </div>
                        <div class="text-xs text-gray-600 dark:text-gray-400">
                            {{ $winner->formatted_date }} - {{ $winner->score }} pts
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif

                <!-- Set 1 Recent Winners -->
                @if($previousWinners['set_1']->isNotEmpty())
                <div class="space-y-3">
                    <h3 class="font-semibold text-gray-700 dark:text-gray-300 text-sm uppercase tracking-wide">Set 1 Winners</h3>
                    @foreach($previousWinners['set_1']->take(3) as $winner)
                    <div class="bg-gradient-to-r from-green-50 to-green-100 dark:from-green-900/20 dark:to-green-800/20 border border-green-200 dark:border-green-700 rounded-lg p-3">
                        <div class="font-medium text-gray-800 dark:text-white text-sm">
                            {{ $winner->user->firstname ?? 'Unknown' }} {{ $winner->user->lastname ?? '' }}
                        </div>
                        <div class="text-xs text-gray-600 dark:text-gray-400">
                            {{ $winner->formatted_date }} - {{ $winner->score }} pts
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif

                <!-- Set 2 Recent Winners -->
                @if($previousWinners['set_2']->isNotEmpty())
                <div class="space-y-3">
                    <h3 class="font-semibold text-gray-700 dark:text-gray-300 text-sm uppercase tracking-wide">Set 2 Winners</h3>
                    @foreach($previousWinners['set_2']->take(3) as $winner)
                    <div class="bg-gradient-to-r from-blue-50 to-blue-100 dark:from-blue-900/20 dark:to-blue-800/20 border border-blue-200 dark:border-blue-700 rounded-lg p-3">
                        <div class="font-medium text-gray-800 dark:text-white text-sm">
                            {{ $winner->user->firstname ?? 'Unknown' }} {{ $winner->user->lastname ?? '' }}
                        </div>
                        <div class="text-xs text-gray-600 dark:text-gray-400">
                            {{ $winner->formatted_date }} - {{ $winner->score }} pts
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif

                <!-- Set 3 Recent Winners -->
                @if($previousWinners['set_3']->isNotEmpty())
                <div class="space-y-3">
                    <h3 class="font-semibold text-gray-700 dark:text-gray-300 text-sm uppercase tracking-wide">Set 3 Winners</h3>
                    @foreach($previousWinners['set_3']->take(3) as $winner)
                    <div class="bg-gradient-to-r from-red-50 to-red-100 dark:from-red-900/20 dark:to-red-800/20 border border-red-200 dark:border-red-700 rounded-lg p-3">
                        <div class="font-medium text-gray-800 dark:text-white text-sm">
                            {{ $winner->user->firstname ?? 'Unknown' }} {{ $winner->user->lastname ?? '' }}
                        </div>
                        <div class="text-xs text-gray-600 dark:text-gray-400">
                            {{ $winner->formatted_date }} - {{ $winner->score }} pts
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
        @endif

    </div>

    <!-- Mini Games Note -->
    <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4">
        <div class="flex items-center">
            <svg class="w-5 h-5 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span class="text-blue-800 dark:text-blue-200">
                <strong>Note:</strong> Today's overall leaderboard shows cumulative scores from all quiz attempts made today in sets 1, 2, and 3. Mini games are excluded from rankings to ensure fair competition. Leaderboards reset every day at midnight.
            </span>
        </div>
    </div>
</div>
