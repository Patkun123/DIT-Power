@extends('auth.admin.partials.layouts.app.head')

@section('title', 'Analytics Dashboard')
@include('auth.admin.partials.layouts.side')
@include('auth.admin.partials.layouts.header')
@section('content')

<!-- Hero Section -->
<div class="h-70 md:h-80 w-full bg-gradient-to-l from-lime-300 via-lime-600 to-lime-900">
    <div class="container mx-auto flex items-start justify-start h-full px-2 md:px-70">
        <div class="flex flex-col mt-40 md:mt-40">
            <h1 class="text-2xl md:text-4xl text-white">Analytics Dashboard</h1>
            <span class="text-white text-sm md:text-base mt-2">Comprehensive insights into your wellness platform</span>
        </div>
    </div>
</div>

<main class="p-4 md:ml-64 bg-gray-50 dark:bg-gray-900">

    <!-- Overview Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8 ">
        <!-- Total Users -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-lime-100 dark:bg-lime-900">
                    <svg class="w-6 h-6 text-lime-600 dark:text-lime-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Users</p>
                    <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ number_format($totalUsers) }}</p>
                </div>
            </div>
        </div>

        <!-- Active Users -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 dark:bg-green-900">
                    <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Active Users (30d)</p>
                    <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ number_format($activeUsers) }}</p>
                </div>
            </div>
        </div>

        <!-- New Users This Week -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-100 dark:bg-purple-900">
                    <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">New This Week</p>
                    <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ number_format($newUsersThisWeek) }}</p>
                </div>
            </div>
        </div>

        <!-- New Users Today -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-orange-100 dark:bg-orange-900">
                    <svg class="w-6 h-6 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">New Today</p>
                    <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ number_format($newUsersToday) }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Analytics -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <!-- Content Overview -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Content Overview</h3>
            <div class="space-y-4">
                <div class="flex justify-between items-center">
                    <span class="text-gray-600 dark:text-gray-400">Events</span>
                    <span class="font-semibold">{{ $publishedEvents }}/{{ $totalEvents }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-600 dark:text-gray-400">Articles</span>
                    <span class="font-semibold">{{ $publishedArticles }}/{{ $totalArticles }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-600 dark:text-gray-400">Scramble Words</span>
                    <span class="font-semibold">{{ $activeScrambleWords }}/{{ $totalScrambleWords }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-600 dark:text-gray-400">Quizzes</span>
                    <span class="font-semibold">{{ $activeQuizzes }}/{{ $totalQuizzes }}</span>
                </div>
            </div>
        </div>

        <!-- Engagement Metrics -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Engagement Metrics</h3>
            <div class="space-y-4">
                <div class="flex justify-between items-center">
                    <span class="text-gray-600 dark:text-gray-400">Total Posts</span>
                    <span class="font-semibold">{{ number_format($totalPosts) }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-600 dark:text-gray-400">Total Comments</span>
                    <span class="font-semibold">{{ number_format($totalComments) }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-600 dark:text-gray-400">Total Likes</span>
                    <span class="font-semibold">{{ number_format($totalLikes) }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-600 dark:text-gray-400">Journals</span>
                    <span class="font-semibold">{{ number_format($totalJournals) }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Quiz Analytics -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Quiz Performance</h3>
            <div class="space-y-4">
                <div class="flex justify-between items-center">
                    <span class="text-gray-600 dark:text-gray-400">Total Attempts</span>
                    <span class="font-semibold">{{ number_format($totalQuizAttempts) }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-600 dark:text-gray-400">Average Score</span>
                    <span class="font-semibold">{{ number_format($averageQuizScore, 1) }}%</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-600 dark:text-gray-400">Completion Rate</span>
                    <span class="font-semibold">{{ number_format($quizCompletionRate, 1) }}%</span>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Recent Activity (7d)</h3>
            <div class="space-y-4">
                <div class="flex justify-between items-center">
                    <span class="text-gray-600 dark:text-gray-400">New Users</span>
                    <span class="font-semibold">{{ number_format($recentUsers) }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-600 dark:text-gray-400">Quiz Attempts</span>
                    <span class="font-semibold">{{ number_format($recentQuizAttempts) }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-600 dark:text-gray-400">New Posts</span>
                    <span class="font-semibold">{{ number_format($recentPosts) }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-600 dark:text-gray-400">New Journals</span>
                    <span class="font-semibold">{{ number_format($recentJournals) }}</span>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">System Health</h3>
            <div class="space-y-4">
                <div class="flex justify-between items-center">
                    <span class="text-gray-600 dark:text-gray-400">Database Size</span>
                    <span class="font-semibold">{{ $systemHealth['database_size'] }} MB</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-600 dark:text-gray-400">Storage Usage</span>
                    <span class="font-semibold">{{ $systemHealth['storage_usage'] }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-600 dark:text-gray-400">Notifications</span>
                    <span class="font-semibold">{{ number_format($unreadNotifications) }} unread</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-600 dark:text-gray-400">Read Rate</span>
                    <span class="font-semibold">{{ number_format($notificationReadRate, 1) }}%</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Top Performers -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <!-- Top Quiz Performers -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Top Quiz Performers</h3>
            <div class="space-y-3">
                @forelse($topQuizPerformers as $index => $performer)
                <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-lime-100 dark:bg-lime-900 rounded-full flex items-center justify-center mr-3">
                            <span class="text-sm font-semibold text-lime-600 dark:text-lime-400">#{{ $index + 1 }}</span>
                        </div>
                        <div>
                            <p class="font-medium text-gray-900 dark:text-white">
                                {{ $performer->user->firstname ?? 'Unknown' }} {{ $performer->user->lastname ?? '' }}
                            </p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $performer->attempts }} attempts</p>
                        </div>
                    </div>
                    <span class="text-lg font-semibold text-lime-600 dark:text-lime-400">
                        {{ number_format($performer->avg_score, 1) }}%
                    </span>
                </div>
                @empty
                <p class="text-gray-500 dark:text-gray-400 text-center py-4">No quiz attempts yet</p>
                @endforelse
            </div>
        </div>

        <!-- Most Active Users -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Most Active Users</h3>
            <div class="space-y-3">
                @forelse($mostActiveUsers as $index => $user)
                <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center mr-3">
                            <span class="text-sm font-semibold text-green-600 dark:text-green-400">#{{ $index + 1 }}</span>
                        </div>
                        <div>
                            <p class="font-medium text-gray-900 dark:text-white">
                                {{ $user->user->firstname ?? 'Unknown' }} {{ $user->user->lastname ?? '' }}
                            </p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $user->post_count }} posts</p>
                        </div>
                    </div>
                    <span class="text-lg font-semibold text-green-600 dark:text-green-400">
                        {{ $user->post_count }}
                    </span>
                </div>
                @empty
                <p class="text-gray-500 dark:text-gray-400 text-center py-4">No posts yet</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <!-- User Registration Chart -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">User Registration Trends (30 days)</h3>
            <div class="h-64 flex items-center justify-center">
                <canvas id="userRegistrationChart"></canvas>
            </div>
        </div>

        <!-- Quiz Attempts Chart -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Quiz Attempts (30 days)</h3>
            <div class="h-64 flex items-center justify-center">
                <canvas id="quizAttemptsChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Content Creation Chart -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 mb-8">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Content Creation Trends (30 days)</h3>
        <div class="h-64 flex items-center justify-center">
            <canvas id="contentCreationChart"></canvas>
        </div>
    </div>

</main>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // User Registration Chart
        const userRegistrationCtx = document.getElementById('userRegistrationChart').getContext('2d');
        new Chart(userRegistrationCtx, {
            type: 'line',
            data: {
                labels: {
                    !!json_encode($chartData['user_registration'] - > pluck('date')) !!
                },
                datasets: [{
                    label: 'New Users',
                    data: {
                        !!json_encode($chartData['user_registration'] - > pluck('count')) !!
                    },
                    borderColor: 'rgb(132, 204, 22)',
                    backgroundColor: 'rgba(132, 204, 22, 0.1)',
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Quiz Attempts Chart
        const quizAttemptsCtx = document.getElementById('quizAttemptsChart').getContext('2d');
        new Chart(quizAttemptsCtx, {
            type: 'bar',
            data: {
                labels: {
                    !!json_encode($chartData['quiz_attempts'] - > pluck('date')) !!
                },
                datasets: [{
                    label: 'Quiz Attempts',
                    data: {
                        !!json_encode($chartData['quiz_attempts'] - > pluck('count')) !!
                    },
                    backgroundColor: 'rgba(132, 204, 22, 0.8)',
                    borderColor: 'rgb(132, 204, 22)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Content Creation Chart
        const contentCreationCtx = document.getElementById('contentCreationChart').getContext('2d');
        new Chart(contentCreationCtx, {
            type: 'line',
            data: {
                labels: {
                    !!json_encode($chartData['content_creation']['posts'] - > pluck('date')) !!
                },
                datasets: [{
                    label: 'Posts',
                    data: {
                        !!json_encode($chartData['content_creation']['posts'] - > pluck('count')) !!
                    },
                    borderColor: 'rgb(132, 204, 22)',
                    backgroundColor: 'rgba(132, 204, 22, 0.1)',
                    tension: 0.4
                }, {
                    label: 'Journals',
                    data: {
                        !!json_encode($chartData['content_creation']['journals'] - > pluck('count')) !!
                    },
                    borderColor: 'rgb(34, 197, 94)',
                    backgroundColor: 'rgba(34, 197, 94, 0.1)',
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>
@endpush

@endsection