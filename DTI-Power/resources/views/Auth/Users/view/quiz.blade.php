@extends('auth.users.partials.app.head')

@section('title', 'Quiz')
@section('content')

<div class="flex justify-center items-center min-h-screen bg-gray-100 dark:bg-gray-900">
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow p-8 max-w-md w-full text-center">

        <!-- Icon -->
        <div class="flex justify-center mb-4">
            <div class="bg-green-100 p-3 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6 text-green-500" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 12l2 2l4-4m5 2a9 9 0 11-18 0a9 9 0 0118 0z" />
                </svg>
            </div>
        </div>

        <!-- Title -->
        <h2 class="text-xl font-bold text-gray-800 dark:text-white">Health Trivia Quiz</h2>
        <p class="text-gray-500 dark:text-gray-400 mt-1">
            A fun and educational quiz about health and wellness.
        </p>

        <!-- Info boxes -->
        <div class="grid grid-cols-3 gap-3 mt-6">
            <!-- Time -->
            <div class="bg-white dark:bg-gray-700 shadow rounded-lg p-3 flex flex-col items-center">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6 text-green-500 mb-1" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 8v4l3 3m6-3a9 9 0 11-18 0a9 9 0 0118 0z" />
                </svg>
                <p class="text-gray-800 dark:text-white text-sm font-semibold">5-10</p>
                <span class="text-gray-500 dark:text-gray-400 text-xs">minutes</span>
            </div>

            <!-- Questions -->
            <div class="bg-white dark:bg-gray-700 shadow rounded-lg p-3 flex flex-col items-center">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6 text-green-500 mb-1" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                </svg>
                <p class="text-gray-800 dark:text-white text-sm font-semibold">5</p>
                <span class="text-gray-500 dark:text-gray-400 text-xs">questions</span>
            </div>

            <!-- Points -->
            <div class="bg-white dark:bg-gray-700 shadow rounded-lg p-3 flex flex-col items-center">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6 text-green-500 mb-1" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.98a1 1 0 00.95.69h4.184c.969 0 1.371 1.24.588 1.81l-3.39 2.462a1 1 0 00-.364 1.118l1.287 3.98c.3.921-.755 1.688-1.538 1.118l-3.39-2.462a1 1 0 00-1.175 0l-3.39 2.462c-.783.57-1.838-.197-1.538-1.118l1.287-3.98a1 1 0 00-.364-1.118L2.02 9.407c-.783-.57-.38-1.81.588-1.81h4.184a1 1 0 00.95-.69l1.286-3.98z" />
                </svg>
                <p class="text-gray-800 dark:text-white text-sm font-semibold">5</p>
                <span class="text-gray-500 dark:text-gray-400 text-xs">total points</span>
            </div>
        </div>

        <!-- Button -->
        <button class="mt-6 w-full bg-green-500 hover:bg-green-600 text-white font-medium py-3 rounded-full">
            Start Assessment
        </button>
    </div>
</div>

@endsection
