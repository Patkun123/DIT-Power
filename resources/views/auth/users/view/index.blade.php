@extends('auth.users.partials.app.head')

@section('title', 'User')
@section('content')
<div class="p-4 sm:p-6 space-y-10 bg-gray-50 dark:bg-gray-900 min-h-screen">

    {{-- TOP QUIZ PERFORMERS & WELLNESS STATS --}}
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <!-- Overall Leaderboard -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
        <!-- Header -->
        <div class="bg-gradient-to-r from-primary-600 via-primary-700 to-primary-800 dark:from-primary-700 dark:via-primary-800 dark:to-primary-900 px-6 py-4 sm:px-6 sm:py-5 relative">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="p-2 bg-white/20 dark:bg-white/10 rounded-lg backdrop-blur-sm">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                        </svg>
                    </div>
                    <h2 class="text-lg sm:text-xl 2xl:text-xl font-bold text-white">Overall Leaderboard</h2>
                </div>
            </div>

            <!-- Floating Crown Button -->
            <a href='{{route('leaderboards')}}' class="absolute right-4 top-4 hover:bg-white/20 cursor-pointer transition-all hover:-translate-y-1 rounded-full p-1.5 z-10">
                <img src="/Images/crown.gif" class="w-14 h-14 drop-shadow-lg pointer-events-none" alt="Crown">
                <span class="absolute -top-1 -right-1 w-3 h-3 bg-yellow-400 rounded-full animate-ping opacity-75"></span>
            </a>
            </div>

            <!-- Podium Content -->
            <div class="p-6">
                @php
                // Prepare default empty players if not enough data
                $players = [
                $topPlayers[0] ?? (object)[
                'user' => (object)[
                'firstname' => '---',
                'lastname' => '---',
                'office' => '',
                'profileimage' => null
                ],
                'best_score' => 0
                ],
                $topPlayers[1] ?? (object)[
                'user' => (object)[
                'firstname' => '---',
                'lastname' => '---',
                'office' => '',
                'profileimage' => null
                ],
                'best_score' => 0
                ],
                $topPlayers[2] ?? (object)[
                'user' => (object)[
                'firstname' => '---',
                'lastname' => '---',
                'office' => '',
                'profileimage' => null
                ],
                'best_score' => 0
                ],
                ];
                @endphp

                <div class="flex flex-row items-end gap-3 sm:gap-4 2xl:mt-0 mt-6 sm:gap-0 sm:justify-around">
                    <!-- 2nd Place -->
                    <div class="group text-center bg-gradient-to-b from-silver-400 via-silver-500 to-silver-600 dark:from-silver-600 dark:via-silver-700 dark:to-silver-800 shadow-2xl shadow-silver-500/50 dark:shadow-silver-700/50 h-50 w-50 lg:w-35 2xl:h-70 2xl:mt-10 2xl:w-45 rounded-2xl border-2 border-silver-300 dark:border-silver-600 transition-all duration-300 hover:shadow-3xl hover:scale-105 relative overflow-hidden">
                        <!-- Shine Effect -->
                        <div class="absolute inset-0 bg-gradient-to-br from-white/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                        <!-- Rank Badge -->

                        <div class="relative z-10 bg-gray-200 dark:bg-gray-700 w-10 h-10 2xl:w-16 2xl:h-16 mt-5 rounded-full mx-auto mb-2 flex items-center justify-center border-2 border-silver-300 dark:border-silver-600 shadow-lg">
                            @if ($players[1]->user->profileimage)
                            <img
                                src="{{ asset('storage/' . $players[1]->user->profileimage) }}"
                                alt="{{ $players[1]->user->firstname }}'s Profile"
                                class="w-[36px] h-[36px] 2xl:w-[55px] 2xl:h-[55px] rounded-full object-cover border border-gray-300 dark:border-gray-700">
                            @else
                            <img
                                src="{{ asset('Images/default.png') }}"
                                alt="Default Profile"
                                class="w-[36px] h-[36px] 2xl:w-[55px] 2xl:h-[55px] rounded-full object-cover border border-gray-300 dark:border-gray-700">
                            @endif
                        </div>
                        <div class="relative z-10 font-semibold 2xl:text-md text-sm text-gray-800 dark:text-white mt-1">
                            {{ $players[1]->user->firstname }} <span class="hidden lg:block">{{ $players[1]->user->lastname }}</span>
                        </div>
                        <div class="relative z-10 text-[10px] 2xl:text-sm text-gray-500 dark:text-gray-300">{{ $players[1]->user->office ?: '---' }}</div>
                        <div class="relative z-10 flex items-center justify-center mt-1">
                            <div class="bg-gray-400 dark:bg-gray-600 text-white rounded-2xl w-auto px-2 py-1 shadow-md">
                                <p class="text-sm font-bold pl-2 pr-2 2xl:text-lg">{{ number_format($players[1]->best_score) }}</p>
                            </div>
                        </div>
                        <div class="relative z-10 flex items-center justify-center mt-2">
                            <div class="relative">
                                <img src="/Images/rewards/silver_cup.png" class="w-10 h-10 2xl:h-20 2xl:w-22 relative drop-shadow-lg" alt="Silver Trophy">
                            </div>
                        </div>
                    </div>

                    <!-- 1st Place (Keep Animation) -->
                    <div class="group text-center animate-bounce bg-gradient-to-b transition-all hover:-translate-y-1 shadow-lg shadow-gold-600 from-gold-500 via-gold-700 to-gold-400 dark:from-gold-600 dark:via-gold-700 dark:to-gold-800 h-50 w-50 lg:w-35 2xl:h-70 2xl:mt-10 2xl:w-45 rounded-2xl border-2 border-gold-300 dark:border-gold-600 relative overflow-hidden">
                        <!-- Shine Effect -->
                        <div class="absolute inset-0 bg-gradient-to-br from-white/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                        <!-- Rank Badge -->
                        <!-- Star Icon at Top Right -->
                        <div class="absolute -top-2 -right-2 z-20">
                            <svg class="w-8 h-8 text-yellow-300 drop-shadow-lg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                        </div>

                        <div class="relative z-10 bg-yellow-400 dark:bg-yellow-500 w-10 h-10 2xl:w-16 2xl:h-16 mt-5 rounded-full mx-auto mb-2 flex items-center justify-center border-2 border-gold-300 dark:border-gold-600 shadow-xl">
                            @if ($players[0]->user->profileimage)
                            <img
                                src="{{ asset('storage/' . $players[0]->user->profileimage) }}"
                                alt="{{ $players[0]->user->firstname }}'s Profile"
                                class="w-[36px] h-[36px] 2xl:w-[55px] 2xl:h-[55px] rounded-full object-cover border border-gray-300 dark:border-gray-700">
                            @else
                            <img
                                src="{{ asset('Images/default.png') }}"
                                alt="Default Profile"
                                class="w-[36px] h-[36px] 2xl:w-[55px] 2xl:h-[55px] rounded-full object-cover border border-gray-300 dark:border-gray-700">
                            @endif
                        </div>
                        <div class="relative z-10 font-semibold 2xl:text-md text-sm text-gray-900 dark:text-white mt-1">
                            {{ $players[0]->user->firstname }} <span class="hidden lg:block">{{ $players[0]->user->lastname }}</span>
                        </div>
                        <div class="relative z-10 text-sm 2xl:text-sm text-gray-500 dark:text-gray-200">{{ $players[0]->user->office ?: '---' }}</div>
                        <div class="relative z-10 flex items-center justify-center mt-1">
                            <div class="bg-gold-600 dark:bg-gold-700 text-white rounded-2xl w-auto px-2 py-1 shadow-md">
                                <p class="text-sm font-bold pl-2 pr-2 2xl:text-lg">{{ number_format($players[0]->best_score) }}</p>
                            </div>
                        </div>
                        <div class="relative z-10 flex items-center justify-center mt-2">
                            <div class="relative">
                                <img src="/Images/rewards/gold_cup.png" class="w-10 h-10 2xl:h-20 2xl:w-20 relative drop-shadow-2xl" alt="Gold Trophy">
                            </div>
                        </div>
                    </div>

                    <!-- 3rd Place -->
                    <div class="group text-center bg-gradient-to-b shadow-2xl shadow-bronze-500 from-bronze-400 via-bronze-500 to-bronze-400 dark:from-bronze-600 dark:via-bronze-700 dark:to-bronze-800 h-50 w-50 2xl:h-70 lg:w-35 2xl:mt-10 2xl:w-45 rounded-2xl border-2 border-bronze-300 dark:border-bronze-600 transition-all duration-300 hover:shadow-3xl hover:scale-105 relative overflow-hidden">
                        <!-- Shine Effect -->
                        <div class="absolute inset-0 bg-gradient-to-br from-white/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                        <!-- Rank Badge -->

                        <div class="relative z-10 bg-orange-200 dark:bg-orange-700 w-10 h-10 2xl:w-16 2xl:h-16 mt-5 rounded-full mx-auto mb-2 flex items-center justify-center border-2 border-bronze-300 dark:border-bronze-600 shadow-lg">
                            @if ($players[2]->user->profileimage)
                            <img
                                src="{{ asset('storage/' . $players[2]->user->profileimage) }}"
                                alt="{{ $players[2]->user->firstname }}'s Profile"
                                class="w-[36px] h-[36px] 2xl:w-[55px] 2xl:h-[55px] rounded-full object-cover border border-gray-300 dark:border-gray-700">
                            @else
                            <img
                                src="{{ asset('Images/default.png') }}"
                                alt="Default Profile"
                                class="w-[36px] h-[36px] 2xl:w-[55px] 2xl:h-[55px] rounded-full object-cover border border-gray-300 dark:border-gray-700">
                            @endif
                        </div>
                        <div class="relative z-10 font-semibold 2xl:text-md text-sm text-gray-800 dark:text-white mt-1">
                            {{ $players[2]->user->firstname }} <span class="hidden lg:block">{{ $players[2]->user->lastname }}</span>
                        </div>
                        <div class="relative z-10 text-[10px] 2xl:text-sm text-gray-500 dark:text-gray-300">{{ $players[2]->user->office ?: '---' }}</div>
                        <div class="relative z-10 flex items-center justify-center mt-1">
                            <div class="bg-bronze-600 dark:bg-bronze-700 text-white rounded-2xl w-auto px-2 py-1 shadow-md">
                                <p class="text-lg font-bold pl-2 pr-2 2xl:text-lg">{{ number_format($players[2]->best_score) }}</p>
                            </div>
                        </div>
                        <div class="relative z-10 flex items-center justify-center mt-2">
                            <div class="relative">
                                <img src="/Images/rewards/bronze_cup.png" class="w-10 h-10 2xl:h-20 2xl:w-20 relative drop-shadow-lg" alt="Bronze Trophy">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Your Wellness Journey -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-r from-green-500 via-emerald-600 to-teal-600 dark:from-green-600 dark:via-emerald-700 dark:to-teal-700 px-6 py-4 sm:px-6 sm:py-5">
                <div class="flex items-center space-x-3">
                    <div class="p-2 bg-white/20 dark:bg-white/10 rounded-lg backdrop-blur-sm">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h2 class="text-lg sm:text-xl font-bold text-white">Your Wellness Journey</h2>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="p-6">
                <div class="grid grid-cols-2 gap-4 sm:gap-6">
                    @php
                    $stats = [
                        [
                            'label' => 'Journal Entries',
                            'icon' => '📝',
                            'count' => $journalCount,
                            'color' => 'from-blue-500 to-blue-600',
                            'bgColor' => 'bg-blue-50 dark:bg-blue-900/20',
                            'iconBg' => 'bg-blue-100 dark:bg-blue-900/40',
                            'textColor' => 'text-blue-600 dark:text-blue-400',
                            'borderColor' => 'group-hover:border-blue-300 dark:group-hover:border-blue-600'
                        ],
                        [
                            'label' => 'Relaxation Sessions',
                            'icon' => '🌿',
                            'count' => 0,
                            'color' => 'from-green-500 to-emerald-600',
                            'bgColor' => 'bg-green-50 dark:bg-green-900/20',
                            'iconBg' => 'bg-green-100 dark:bg-green-900/40',
                            'textColor' => 'text-green-600 dark:text-green-400',
                            'borderColor' => 'group-hover:border-green-300 dark:group-hover:border-green-600'
                        ],
                        [
                            'label' => 'Quiz Points',
                            'icon' => '💡',
                            'count' => $quizCount,
                            'color' => 'from-yellow-500 to-amber-600',
                            'bgColor' => 'bg-yellow-50 dark:bg-yellow-900/20',
                            'iconBg' => 'bg-yellow-100 dark:bg-yellow-900/40',
                            'textColor' => 'text-yellow-600 dark:text-yellow-400',
                            'borderColor' => 'group-hover:border-yellow-300 dark:group-hover:border-yellow-600'
                        ],
                        [
                            'label' => 'Nutrition Logs',
                            'icon' => '🍽️',
                            'count' => 0,
                            'color' => 'from-orange-500 to-red-600',
                            'bgColor' => 'bg-orange-50 dark:bg-orange-900/20',
                            'iconBg' => 'bg-orange-100 dark:bg-orange-900/40',
                            'textColor' => 'text-orange-600 dark:text-orange-400',
                            'borderColor' => 'group-hover:border-orange-300 dark:group-hover:border-orange-600'
                        ],
                    ];
                    @endphp

                    @foreach($stats as $stat)
                    <div class="group relative {{ $stat['bgColor'] }} h-40 sm:h-44 2xl:h-48 transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl rounded-xl sm:rounded-2xl p-4 sm:p-5 2xl:p-6 border-2 border-gray-200 dark:border-gray-700 {{ $stat['borderColor'] }} overflow-hidden cursor-pointer">
                        <!-- Background Pattern -->
                        <div class="absolute inset-0 opacity-5 dark:opacity-10">
                            <div class="absolute inset-0 bg-gradient-to-br {{ $stat['color'] }}"></div>
                        </div>

                        <!-- Animated Background Shine -->
                        <div class="absolute inset-0 bg-gradient-to-br from-white/0 via-white/10 to-white/0 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

                        <!-- Content -->
                        <div class="relative z-10 flex flex-col h-full justify-between">
                            <!-- Icon -->
                            <div class="flex items-center justify-between">
                                <div class="{{ $stat['iconBg'] }} w-12 h-12 sm:w-14 sm:h-14 2xl:w-16 2xl:h-16 rounded-xl sm:rounded-2xl flex items-center justify-center text-2xl sm:text-3xl 2xl:text-4xl shadow-lg group-hover:scale-110 group-hover:rotate-6 transition-all duration-300">
                                    {{ $stat['icon'] }}
                                </div>
                                <!-- Decorative Pulse Element -->
                                <div class="relative">
                                    <div class="w-3 h-3 rounded-full bg-gradient-to-br {{ $stat['color'] }} opacity-60"></div>
                                    <div class="absolute inset-0 w-3 h-3 rounded-full bg-gradient-to-br {{ $stat['color'] }} opacity-40 animate-ping"></div>
                                </div>
                            </div>

                            <!-- Count and Label -->
                            <div class="space-y-1">
                                <div class="text-3xl sm:text-4xl 2xl:text-5xl font-bold {{ $stat['textColor'] }} group-hover:scale-105 transition-transform duration-300">
                                    {{ number_format($stat['count']) }}
                                </div>
                                <div class="text-xs sm:text-sm 2xl:text-base font-semibold text-gray-700 dark:text-gray-300 leading-tight">
                                    {{ $stat['label'] }}
                                </div>
                            </div>
                        </div>

                        <!-- Hover Glow Effect -->
                        <div class="absolute -inset-1 rounded-xl sm:rounded-2xl bg-gradient-to-br {{ $stat['color'] }} opacity-0 group-hover:opacity-20 blur-xl transition-all duration-300 -z-10"></div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- DAILY REPORT SECTION --}}
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
        <!-- Header -->
        <div class="bg-gradient-to-r from-primary-600 to-primary-700 dark:from-primary-700 dark:to-primary-800 px-6 py-5">
            <div class="flex items-center justify-between flex-wrap gap-3">
                <div class="flex items-center space-x-3">
                    <div class="p-2 bg-white/20 dark:bg-white/10 rounded-lg backdrop-blur-sm">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-white">Daily Report</h2>
                        <p class="text-primary-100 text-sm mt-0.5">{{ $today }}</p>
                    </div>
                </div>
                <div class="px-3 py-1.5 bg-white/20 dark:bg-white/10 rounded-full backdrop-blur-sm">
                    <span class="text-white text-xs font-medium">Quiz Sets 1, 2, 3</span>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="p-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Your Daily Performance -->
                <div class="bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 dark:from-blue-900/20 dark:via-indigo-900/20 dark:to-purple-900/20 rounded-xl p-6 border border-blue-100 dark:border-blue-800/50 shadow-sm hover:shadow-md transition-shadow duration-200">
                    <div class="flex items-center justify-between mb-5">
                        <h3 class="text-lg font-bold text-gray-800 dark:text-white flex items-center gap-2">
                            <svg class="w-5 h-5 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Your Performance Today
                        </h3>
                    </div>
                    <div class="grid grid-cols-3 gap-4">
                        <!-- Best Score -->
                        <div class="bg-white dark:bg-gray-800/50 rounded-xl p-4 text-center border border-blue-200 dark:border-blue-700/50 hover:border-blue-400 dark:hover:border-blue-500 transition-colors group">
                            <div class="mb-2 flex justify-center">
                                <div class="p-2 bg-blue-100 dark:bg-blue-900/30 rounded-lg group-hover:scale-110 transition-transform">
                                    <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="text-3xl font-bold text-blue-600 dark:text-blue-400 mb-1">{{ $userDailyStats['today_score'] }}</div>
                            <div class="text-xs font-medium text-gray-600 dark:text-gray-400 uppercase tracking-wide">Best Score</div>
                        </div>

                        <!-- Correct Answers -->
                        <div class="bg-white dark:bg-gray-800/50 rounded-xl p-4 text-center border border-green-200 dark:border-green-700/50 hover:border-green-400 dark:hover:border-green-500 transition-colors group">
                            <div class="mb-2 flex justify-center">
                                <div class="p-2 bg-green-100 dark:bg-green-900/30 rounded-lg group-hover:scale-110 transition-transform">
                                    <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="text-3xl font-bold text-green-600 dark:text-green-400 mb-1">{{ $userDailyStats['today_correct'] }}</div>
                            <div class="text-xs font-medium text-gray-600 dark:text-gray-400 uppercase tracking-wide">Correct</div>
                        </div>

                        <!-- Attempts -->
                        <div class="bg-white dark:bg-gray-800/50 rounded-xl p-4 text-center border border-purple-200 dark:border-purple-700/50 hover:border-purple-400 dark:hover:border-purple-500 transition-colors group">
                            <div class="mb-2 flex justify-center">
                                <div class="p-2 bg-purple-100 dark:bg-purple-900/30 rounded-lg group-hover:scale-110 transition-transform">
                                    <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="text-3xl font-bold text-purple-600 dark:text-purple-400 mb-1">{{ $userDailyStats['today_attempts'] }}</div>
                            <div class="text-xs font-medium text-gray-600 dark:text-gray-400 uppercase tracking-wide">Attempts</div>
                        </div>
                    </div>
                </div>

                <!-- Daily Top 3 -->
                <div class="bg-gradient-to-br from-amber-50 via-orange-50 to-yellow-50 dark:from-amber-900/20 dark:via-orange-900/20 dark:to-yellow-900/20 rounded-xl p-6 border border-amber-100 dark:border-amber-800/50 shadow-sm hover:shadow-md transition-shadow duration-200">
                    <div class="flex items-center justify-between mb-5">
                        <h3 class="text-lg font-bold text-gray-800 dark:text-white flex items-center gap-2">
                            <svg class="w-5 h-5 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                            </svg>
                            Today's Top Performers
                        </h3>
                        @if($dailyTopPlayers->count() > 0)
                        <span class="px-2.5 py-1 bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-300 text-xs font-semibold rounded-full">
                            Top 3
                        </span>
                        @endif
                    </div>
                    @if($dailyTopPlayers->count() > 0)
                    <div class="space-y-3">
                        @foreach($dailyTopPlayers as $index => $player)
                        @php
                        $rankColors = [
                        1 => ['bg' => 'bg-yellow-100 dark:bg-yellow-900/30', 'text' => 'text-yellow-700 dark:text-yellow-300', 'border' => 'border-yellow-300 dark:border-yellow-700', 'icon' => '🥇'],
                        2 => ['bg' => 'bg-gray-100 dark:bg-gray-700/50', 'text' => 'text-gray-700 dark:text-gray-300', 'border' => 'border-gray-300 dark:border-gray-600', 'icon' => '🥈'],
                        3 => ['bg' => 'bg-orange-100 dark:bg-orange-900/30', 'text' => 'text-orange-700 dark:text-orange-300', 'border' => 'border-orange-300 dark:border-orange-700', 'icon' => '🥉'],
                        ];
                        $rank = $index + 1;
                        $colors = $rankColors[$rank] ?? $rankColors[3];
                        @endphp
                        <div class="flex items-center justify-between p-4 bg-white dark:bg-gray-800/50 rounded-xl border {{ $colors['border'] }} hover:shadow-md transition-all duration-200 group">
                            <div class="flex items-center space-x-4 flex-1">
                                <!-- Rank Badge -->
                                <div class="flex-shrink-0">
                                    <div class="w-10 h-10 rounded-full {{ $colors['bg'] }} border-2 {{ $colors['border'] }} flex items-center justify-center font-bold {{ $colors['text'] }} text-lg">
                                        {{ $rank }}
                                    </div>
                                </div>
                                <!-- Profile Image -->
                                <div class="flex-shrink-0">
                                    <div class="w-12 h-12 rounded-full overflow-hidden border-2 border-gray-200 dark:border-gray-700 ring-2 ring-white dark:ring-gray-800 shadow-sm group-hover:ring-primary-300 dark:group-hover:ring-primary-700 transition-all">
                                        @if($player['user']->profileimage)
                                        <img src="{{ asset('storage/' . $player['user']->profileimage) }}"
                                            alt="{{ $player['user']->firstname }} {{ $player['user']->lastname }}"
                                            class="w-full h-full object-cover">
                                        @else
                                        <img src="{{ asset('Images/default.png') }}"
                                            alt="Default Profile"
                                            class="w-full h-full object-cover">
                                        @endif
                                    </div>
                                </div>
                                <!-- User Info -->
                                <div class="flex-1 min-w-0">
                                    <div class="font-semibold text-sm text-gray-800 dark:text-white truncate">
                                        {{ $player['user']->firstname }} {{ $player['user']->lastname }}
                                    </div>
                                    <div class="flex items-center gap-2 mt-1">
                                        <span class="text-xs text-gray-500 dark:text-gray-400">
                                            {{ $player['attempts_count'] }} {{ $player['attempts_count'] == 1 ? 'attempt' : 'attempts' }}
                                        </span>
                                        <span class="text-gray-300 dark:text-gray-600">•</span>
                                        <span class="text-xs text-gray-500 dark:text-gray-400">
                                            {{ $player['best_correct'] }} correct
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <!-- Score -->
                            <div class="flex-shrink-0 ml-4">
                                <div class="text-right">
                                    <div class="text-2xl font-bold text-primary-600 dark:text-primary-400">
                                        {{ $player['best_score'] }}
                                    </div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400 font-medium">
                                        Points
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="flex flex-col items-center justify-center py-12 text-center">
                        <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700/50 rounded-full flex items-center justify-center mb-4">
                            <svg class="w-8 h-8 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <p class="text-gray-600 dark:text-gray-400 font-medium mb-1">No quiz attempts today yet</p>
                        <p class="text-sm text-gray-500 dark:text-gray-500">Be the first to take a quiz and appear on the leaderboard!</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Note about mini games exclusion -->
            <div class="mt-6 p-4 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-xl">
                <div class="flex items-start gap-3">
                    <div class="flex-shrink-0 mt-0.5">
                        <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-blue-900 dark:text-blue-200 mb-1">About Daily Reports</p>
                        <p class="text-sm text-blue-800 dark:text-blue-300">
                            Daily reports only include quiz sets 1, 2, and 3. Mini games are excluded from rankings to ensure fair competition.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- NEWS AND UPCOMING EVENTS --}}
    <div x-data="{ showAll: false }" class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
        <!-- Header Section -->
        <div class="bg-gradient-to-r from-primary-600 via-primary-700 to-primary-800 dark:from-primary-700 dark:via-primary-800 dark:to-primary-900 px-6 py-5 sm:px-8 sm:py-6">
            <div class="flex items-center justify-between flex-wrap gap-3">
                <div class="flex items-center space-x-3 sm:space-x-4">
                    <div class="p-2.5 sm:p-3 bg-white/20 dark:bg-white/10 rounded-xl backdrop-blur-sm shadow-lg">
                        <svg class="w-6 h-6 sm:w-7 sm:h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-2xl sm:text-3xl font-bold text-white">News & Upcoming Events</h2>
                        <p class="text-primary-100 text-sm sm:text-base mt-1">Stay updated with the latest announcements</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Section -->
        <div class="p-6 sm:p-8">
            @php
            // Get published articles
            $publishedArticles = $articles->where('status', 'published');
            @endphp

            @if($publishedArticles->isEmpty())
            <!-- Empty State -->
            <div class="flex flex-col items-center justify-center py-16 sm:py-20 text-center">
                <div class="w-20 h-20 sm:w-24 sm:h-24 bg-gray-100 dark:bg-gray-700/50 rounded-full flex items-center justify-center mb-6">
                    <svg class="w-10 h-10 sm:w-12 sm:h-12 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                    </svg>
                </div>
                <h3 class="text-xl sm:text-2xl font-semibold text-gray-800 dark:text-white mb-2">No Events Published</h3>
                <p class="text-gray-500 dark:text-gray-400 text-sm sm:text-base max-w-md">Check back later for exciting news and upcoming events!</p>
            </div>
            @else
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 sm:gap-8">
                @php
                $visibleCount = 0;
                $categoryColors = [
                'Announcement' => ['bg' => 'bg-blue-100 dark:bg-blue-900/30', 'text' => 'text-blue-700 dark:text-blue-300', 'border' => 'border-blue-200 dark:border-blue-800'],
                'Event' => ['bg' => 'bg-purple-100 dark:bg-purple-900/30', 'text' => 'text-purple-700 dark:text-purple-300', 'border' => 'border-purple-200 dark:border-purple-800'],
                'News' => ['bg' => 'bg-green-100 dark:bg-green-900/30', 'text' => 'text-green-700 dark:text-green-300', 'border' => 'border-green-200 dark:border-green-800'],
                'Update' => ['bg' => 'bg-orange-100 dark:bg-orange-900/30', 'text' => 'text-orange-700 dark:text-orange-300', 'border' => 'border-orange-200 dark:border-orange-800'],
                ];
                @endphp
                @foreach ($publishedArticles as $article)
                @php
                $visibleCount++;
                $categoryColor = $categoryColors[$article->category] ?? $categoryColors['News'];
                $isVisible = $visibleCount <= 2;
                    @endphp
                    <article
                    class="group relative bg-white dark:bg-gray-900 rounded-xl sm:rounded-2xl overflow-hidden shadow-md hover:shadow-2xl transition-all duration-300 border border-gray-200 dark:border-gray-700 hover:border-primary-300 dark:hover:border-primary-700"
                    x-show="showAll || {{ $visibleCount }} <= 2"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform translate-y-4"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0">

                    <!-- Image Container with Overlay -->
                    <div class="relative h-48 sm:h-56 lg:h-64 overflow-hidden bg-gradient-to-br from-gray-200 to-gray-300 dark:from-gray-700 dark:to-gray-800">
                        @if($article->image_url)
                        <img
                            src="{{ asset('storage/' . $article->image_url) }}"
                            alt="{{ $article->title }}"
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        @else
                        <div class="w-full h-full flex items-center justify-center">
                            <svg class="w-16 h-16 text-gray-400 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        @endif

                        <!-- Gradient Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                        <!-- Category Badge -->
                        <div class="absolute top-4 left-4">
                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold {{ $categoryColor['bg'] }} {{ $categoryColor['text'] }} {{ $categoryColor['border'] }} border backdrop-blur-sm shadow-lg">
                                <svg class="w-3 h-3 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"></path>
                                </svg>
                                {{ $article->category }}
                            </span>
                        </div>

                        <!-- Date Badge -->
                        <div class="absolute top-4 right-4">
                            <div class="bg-white/90 dark:bg-gray-900/90 backdrop-blur-sm rounded-lg px-3 py-1.5 shadow-lg">
                                <div class="flex items-center space-x-1.5">
                                    <svg class="w-4 h-4 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <span class="text-xs font-semibold text-gray-700 dark:text-gray-300">
                                        {{ \Carbon\Carbon::parse($article->publication_date)->format('M d, Y') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Section -->
                    <div class="p-5 sm:p-6">
                        <!-- Title -->
                        <h3 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-white mb-3 line-clamp-2 group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors duration-200">
                            {{ $article->title }}
                        </h3>

                        <!-- Summary -->
                        <p class="text-sm sm:text-base text-gray-600 dark:text-gray-300 mb-4 line-clamp-3 leading-relaxed">
                            {{ $article->summary ?? 'No summary available.' }}
                        </p>

                        <!-- Meta Information -->
                        <div class="flex items-center justify-between pt-4 border-t border-gray-200 dark:border-gray-700">
                            <div class="flex items-center space-x-2 text-sm text-gray-500 dark:text-gray-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <span class="font-medium">{{ $article->author ?? 'Admin' }}</span>
                            </div>

                            <!-- Learn More Button -->
                            <button
                                id="showmodalButton"
                                data-modal-target="showmodal{{ $article->id }}"
                                data-modal-toggle="showmodal{{ $article->id }}"
                                class="inline-flex items-center space-x-2 px-4 py-2 sm:px-5 sm:py-2.5 text-sm font-semibold text-white bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 rounded-lg shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                                <span>Read More</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Hover Effect Border -->
                    <div class="absolute inset-0 border-2 border-primary-500 rounded-xl sm:rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none"></div>
                    </article>
                    @include('auth.users.partials.view')
                    @endforeach
            </div>

            <!-- See More/Less Button -->
            @if ($publishedArticles->count() > 2)
            <div class="flex justify-center mt-8 sm:mt-10">
                <button
                    @click="showAll = !showAll"
                    class="group inline-flex items-center space-x-2 px-6 py-3 sm:px-8 sm:py-3.5 text-sm sm:text-base font-semibold text-white bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-200 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:focus:ring-primary-800">
                    <span x-show="!showAll">View All Events</span>
                    <span x-show="showAll">Show Less</span>
                    <svg
                        x-show="!showAll"
                        class="w-5 h-5 transform group-hover:translate-x-1 transition-transform"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                    <svg
                        x-show="showAll"
                        class="w-5 h-5 transform group-hover:-translate-y-1 transition-transform"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
                    </svg>
                </button>
            </div>
            @endif
            @endif
        </div>
    </div>

    {{-- GOOGLE MAPS EMBED & FEEDBACK SECTION --}}
    <section id="Feedbacks" class="mt-6 sm:mt-8 lg:mt-10">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 xl:px-12 2xl:px-16">
            <div class="bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 rounded-xl sm:rounded-2xl shadow-xl overflow-hidden">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-0">
                    <!-- LEFT SIDE (Map + Contact Info) -->
                    <div class="relative bg-gray-100 dark:bg-gray-900 p-4 sm:p-6 lg:p-8 order-2 lg:order-1">
                        <div class="h-full min-h-[400px] sm:min-h-[500px] md:min-h-[550px] lg:min-h-[600px] xl:min-h-[650px] 2xl:min-h-[700px] rounded-lg sm:rounded-xl overflow-hidden shadow-lg relative">
                            <iframe
                                width="100%"
                                height="100%"
                                class="absolute inset-0 rounded-lg sm:rounded-xl"
                                frameborder="0"
                                title="DTI Office Location Map"
                                marginheight="0"
                                marginwidth="0"
                                scrolling="no"
                                loading="lazy"
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d991.137245866521!2d124.87767333593972!3d6.451897731102884!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x32f821dfdc9dd0cb%3A0x10d08ed934eacc06!2sDEPARTMENT%20OF%20TRADE%20AND%20INDUSTRY-%2012%20REGIONAL%20OFFICE!5e0!3m2!1sen!2sph!4v1755492850279!5m2!1sen!2sph">
                            </iframe>
                            <!-- Contact Info Overlay -->
                            <div class="absolute bottom-2 left-2 right-2 sm:bottom-4 sm:left-4 sm:right-4 bg-white/95 dark:bg-gray-800/95 backdrop-blur-sm rounded-lg sm:rounded-xl shadow-2xl p-4 sm:p-6 transform transition-transform hover:scale-[1.02]">
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                                    <div class="space-y-2 sm:space-y-3">
                                        <div class="flex items-center space-x-2">
                                            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-primary-600 dark:text-primary-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                            <h3 class="font-semibold text-gray-900 dark:text-white text-xs sm:text-sm uppercase tracking-wide">Address</h3>
                                        </div>
                                        <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-300 leading-relaxed pl-6 sm:pl-7">
                                            Prime Regional Government Center, Barangay Carpenter Hill, Koronadal City, South Cotabato, Philippines
                                        </p>
                                    </div>
                                    <div class="space-y-3 sm:space-y-4">
                                        <div class="space-y-1 sm:space-y-2">
                                            <div class="flex items-center space-x-2">
                                                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-primary-600 dark:text-primary-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                                </svg>
                                                <h3 class="font-semibold text-gray-900 dark:text-white text-xs sm:text-sm uppercase tracking-wide">Email</h3>
                                            </div>
                                            <a href="mailto:dti@gmail.com" class="text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300 text-xs sm:text-sm font-medium pl-6 sm:pl-7 transition-colors break-all">
                                                dti@gmail.com
                                            </a>
                                        </div>
                                        <div class="space-y-1 sm:space-y-2">
                                            <div class="flex items-center space-x-2">
                                                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-primary-600 dark:text-primary-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                                </svg>
                                                <h3 class="font-semibold text-gray-900 dark:text-white text-xs sm:text-sm uppercase tracking-wide">Phone</h3>
                                            </div>
                                            <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-300 pl-6 sm:pl-7">123-456-7890</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- RIGHT SIDE (Feedback Form) -->
                    <div class="bg-white dark:bg-gray-800 p-5 sm:p-6 md:p-8 lg:p-10 flex flex-col justify-center order-1 lg:order-2">
                        <div class="max-w-lg mx-auto w-full">
                            <!-- Header -->
                            <div class="mb-6 sm:mb-8">
                                <div class="flex items-center space-x-2 sm:space-x-3 mb-2 sm:mb-3">
                                    <div class="p-1.5 sm:p-2 bg-primary-100 dark:bg-primary-900/30 rounded-lg">
                                        <svg class="w-5 h-5 sm:w-6 sm:h-6 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                                        </svg>
                                    </div>
                                    <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-white">Share Your Feedback</h2>
                                </div>
                                <p class="text-sm sm:text-base text-gray-600 dark:text-gray-400 leading-relaxed">
                                    Your opinion matters! Help us improve by sharing your thoughts. All feedback is anonymous and greatly appreciated.
                                </p>
                            </div>

                            <!-- Success/Error Messages -->
                            @if(session('success'))
                            <div class="mb-4 sm:mb-6 p-3 sm:p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg flex items-center space-x-3 animate-fade-in">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-green-600 dark:text-green-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                <p class="text-green-800 dark:text-green-200 text-xs sm:text-sm font-medium">{{ session('success') }}</p>
                            </div>
                            @endif

                            @if($errors->any())
                            <div class="mb-4 sm:mb-6 p-3 sm:p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg">
                                <div class="flex items-center space-x-2 sm:space-x-3 mb-2">
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-red-600 dark:text-red-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                    </svg>
                                    <p class="text-red-800 dark:text-red-200 text-xs sm:text-sm font-semibold">Please fix the following errors:</p>
                                </div>
                                <ul class="list-disc list-inside text-red-700 dark:text-red-300 text-xs sm:text-sm space-y-1 ml-6 sm:ml-8">
                                    @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif

                            <!-- Feedback Form -->
                            <form action="{{ route('feedback.store') }}" method="POST" id="feedbackForm" class="space-y-5 sm:space-y-6">
                                @csrf

                                <!-- Star Rating Section -->
                                <div class="space-y-2 sm:space-y-3">
                                    <label class="block text-xs sm:text-sm font-semibold text-gray-700 dark:text-gray-300">
                                        How would you rate your experience?
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <div class="flex flex-col sm:flex-row sm:items-center space-y-3 sm:space-y-0 sm:space-x-3 bg-gray-50 dark:bg-gray-700/50 p-3 sm:p-4 rounded-xl">
                                        <div class="flex items-center justify-center sm:justify-start space-x-0.5 sm:space-x-1" id="starRating" role="radiogroup">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <button
                                                type="button"
                                                data-value="{{ $i }}"
                                                aria-label="Rate {{ $i }} star{{ $i > 1 ? 's' : '' }}"
                                                class="star-button focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-1 sm:focus:ring-offset-2 rounded p-0.5 sm:p-1 transition-all transform hover:scale-110 active:scale-95 touch-manipulation">
                                                <svg
                                                    data-value="{{ $i }}"
                                                    class="w-7 h-7 sm:w-8 sm:h-8 md:w-9 md:h-9 lg:w-10 lg:h-10 text-gray-300 dark:text-gray-600 star-icon transition-all duration-200"
                                                    fill="currentColor"
                                                    viewBox="0 0 22 20"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.231-1.044l-5.264-.764-2.354-4.766a1.523 1.523 0 0 0-2.736 0L6.985 5.817l-5.264.764a1.523 1.523 0 0 0-.845 2.599l3.808 3.71-.9 5.241a1.523 1.523 0 0 0 2.212 1.605L11 17.813l4.705 2.474a1.523 1.523 0 0 0 2.212-1.605l-.9-5.241 3.808-3.71a1.523 1.523 0 0 0 .399-1.106Z" />
                                                </svg>
                                                </button>
                                                @endfor
                                        </div>
                                        <span id="ratingText" class="text-center sm:text-left text-xs sm:text-sm font-medium text-gray-500 dark:text-gray-400 min-w-[100px] sm:min-w-[120px]">
                                            Select rating
                                        </span>
                                    </div>
                                    <input type="hidden" id="ratingInput" name="rating" value="0" required>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 text-center sm:text-left">Click on a star to rate</p>
                                </div>

                                <!-- Message Section -->
                                <div class="space-y-2">
                                    <label for="message" class="block text-xs sm:text-sm font-semibold text-gray-700 dark:text-gray-300">
                                        Your Feedback
                                        <span class="text-gray-500 font-normal">(Optional)</span>
                                    </label>
                                    <div class="relative">
                                        <textarea
                                            id="message"
                                            name="message"
                                            rows="4"
                                            maxlength="1000"
                                            placeholder="Tell us what you think... Your feedback helps us improve our services."
                                            class="w-full px-3 sm:px-4 py-2.5 sm:py-3 text-sm sm:text-base border-2 border-gray-200 dark:border-gray-700 rounded-xl
                                                   focus:border-primary-500 focus:ring-2 focus:ring-primary-200 dark:focus:ring-primary-900
                                                   bg-white dark:bg-gray-700 text-gray-900 dark:text-white
                                                   placeholder-gray-400 dark:placeholder-gray-500
                                                   resize-none transition-all duration-200
                                                   focus:outline-none"></textarea>
                                        <div class="absolute bottom-2.5 sm:bottom-3 right-2.5 sm:right-3 text-xs text-gray-400 dark:text-gray-500">
                                            <span id="charCount">0</span>/1000
                                        </div>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="pt-1 sm:pt-2">
                                    <button
                                        type="submit"
                                        id="submitBtn"
                                        class="w-full py-2.5 sm:py-3 px-4 sm:px-6 bg-gradient-to-r from-primary-600 to-primary-700
                                               hover:from-primary-700 hover:to-primary-800
                                               text-white text-sm sm:text-base font-semibold rounded-xl
                                               shadow-lg hover:shadow-xl
                                               transform hover:-translate-y-0.5
                                               transition-all duration-200
                                               focus:outline-none focus:ring-4 focus:ring-primary-300 dark:focus:ring-primary-800
                                               disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none
                                               flex items-center justify-center space-x-2">
                                        <span>Submit Feedback</span>
                                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                        </svg>
                                    </button>
                                    <p class="mt-2 sm:mt-3 text-xs text-center text-gray-500 dark:text-gray-400">
                                        🔒 Your feedback is completely anonymous
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


<!-- Script for star selection -->

@include('auth.users.partials.leaderboard')

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const starButtons = document.querySelectorAll(".star-button");
        const starIcons = document.querySelectorAll(".star-icon");
        const ratingInput = document.getElementById("ratingInput");
        const ratingText = document.getElementById("ratingText");
        const messageTextarea = document.getElementById("message");
        const charCount = document.getElementById("charCount");
        const feedbackForm = document.getElementById("feedbackForm");
        const submitBtn = document.getElementById("submitBtn");
        const starContainer = document.getElementById("starRating");

        // Rating labels
        const ratingLabels = {
            1: "Poor",
            2: "Fair",
            3: "Good",
            4: "Very Good",
            5: "Excellent"
        };

        // Star rating functionality
        let currentRating = 0;
        let hoveredRating = 0;

        function updateStarDisplay(rating, isHover = false) {
            // Clear all star colors first
            starIcons.forEach((icon) => {
                icon.classList.remove(
                    "text-yellow-400",
                    "text-yellow-500",
                    "text-yellow-600",
                    "text-gray-300",
                    "text-gray-600",
                    "dark:text-gray-600"
                );
            });

            // Update stars based on rating
            starIcons.forEach((icon) => {
                const starValue = parseInt(icon.getAttribute("data-value"));

                if (rating > 0 && starValue <= rating) {
                    // Highlight stars up to and including the rating
                    if (isHover) {
                        icon.classList.add("text-yellow-500");
                    } else {
                        icon.classList.add("text-yellow-400");
                    }
                } else {
                    // Keep unselected stars gray
                    icon.classList.add("text-gray-300", "dark:text-gray-600");
                }
            });

            // Update rating text
            if (rating > 0) {
                ratingText.textContent = ratingLabels[rating];
                if (isHover) {
                    ratingText.classList.remove("text-gray-500", "text-gray-400", "text-primary-600", "font-semibold");
                    ratingText.classList.add("text-primary-500", "dark:text-primary-400");
                } else {
                    ratingText.classList.remove("text-gray-500", "text-gray-400", "text-primary-500");
                    ratingText.classList.add("text-primary-600", "dark:text-primary-400", "font-semibold");
                }
            } else {
                ratingText.textContent = "Select rating";
                ratingText.classList.remove("text-primary-600", "text-primary-500", "font-semibold", "dark:text-primary-400");
                ratingText.classList.add("text-gray-500", "dark:text-gray-400");
            }
        }

        // Click handler - set permanent rating
        starButtons.forEach(button => {
            button.addEventListener("click", function(e) {
                e.preventDefault();
                e.stopPropagation();
                const value = parseInt(this.getAttribute("data-value"));
                currentRating = value;
                ratingInput.value = value;
                hoveredRating = 0; // Reset hover on click
                updateStarDisplay(value, false);
            });
        });

        // Hover handlers - temporary highlight on desktop
        starButtons.forEach(button => {
            // Mouse hover for desktop
            button.addEventListener("mouseenter", function(e) {
                const value = parseInt(this.getAttribute("data-value"));
                hoveredRating = value;
                updateStarDisplay(value, true);
            });

            // Touch support for mobile - show preview on touch
            let touchStartValue = 0;
            button.addEventListener("touchstart", function(e) {
                const value = parseInt(this.getAttribute("data-value"));
                touchStartValue = value;
                hoveredRating = value;
                updateStarDisplay(value, true);
            }, {
                passive: true
            });

            // On mobile, keep showing the hovered rating until user lifts finger
            button.addEventListener("touchend", function(e) {
                // Don't prevent default - allow click to fire
                if (touchStartValue > 0) {
                    // Click will handle the actual selection
                    setTimeout(() => {
                        // If no click happened, reset (rare case)
                        if (currentRating === 0 && hoveredRating === touchStartValue) {
                            hoveredRating = 0;
                            updateStarDisplay(0, false);
                        }
                    }, 300);
                }
            }, {
                passive: true
            });
        });

        // Reset hover when leaving star container (desktop)
        if (starContainer) {
            starContainer.addEventListener("mouseleave", function() {
                hoveredRating = 0;
                // Show selected rating, or reset if no rating selected
                updateStarDisplay(currentRating, false);
            });
        }

        // Character counter
        if (messageTextarea && charCount) {
            function updateCharCount() {
                const length = messageTextarea.value.length;
                charCount.textContent = length;

                if (length > 900) {
                    charCount.classList.add("text-red-500", "font-semibold");
                    charCount.classList.remove("text-gray-400", "text-gray-500", "text-yellow-500");
                } else if (length > 700) {
                    charCount.classList.add("text-yellow-500");
                    charCount.classList.remove("text-red-500", "text-gray-400", "text-gray-500", "font-semibold");
                } else {
                    charCount.classList.remove("text-red-500", "text-yellow-500", "font-semibold");
                    charCount.classList.add("text-gray-400", "dark:text-gray-500");
                }
            }

            messageTextarea.addEventListener("input", updateCharCount);
            updateCharCount(); // Initial count
        }

        // Form validation
        if (feedbackForm) {
            feedbackForm.addEventListener("submit", function(e) {
                const rating = parseInt(ratingInput.value);

                if (rating === 0 || isNaN(rating)) {
                    e.preventDefault();
                    ratingText.textContent = "Please select a rating";
                    ratingText.classList.remove("text-gray-500", "text-gray-400", "text-primary-600", "text-primary-500");
                    ratingText.classList.add("text-red-500", "font-semibold");

                    // Add pulse animation
                    if (starContainer) {
                        starContainer.parentElement.classList.add("animate-pulse");
                        setTimeout(() => {
                            starContainer.parentElement.classList.remove("animate-pulse");
                        }, 500);
                    }

                    return false;
                }

                // Disable button and show loading state
                submitBtn.disabled = true;
                submitBtn.innerHTML = `
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span>Submitting...</span>
                `;
            });
        }

        // Initialize - no stars selected
        updateStarDisplay(0, false);
    });
</script>

<style>
    @keyframes fade-in {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fade-in {
        animation: fade-in 0.3s ease-out;
    }

    .star-button {
        -webkit-tap-highlight-color: transparent;
    }

    .star-button:hover .star-icon,
    .star-button:focus .star-icon {
        transform: scale(1.1);
    }

    .star-button:active .star-icon {
        transform: scale(0.95);
    }

    /* Improve touch targets on mobile */
    @media (max-width: 640px) {
        .star-button {
            min-width: 44px;
            min-height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    }

    /* Responsive star sizing */
    @media (min-width: 1280px) {
        .star-icon {
            transition: all 0.2s ease;
        }
    }
</style>

@endpush
@endsection
