@extends('auth.users.partials.app.head')

@section('title', 'User')
@section('content')

<div class="p-10 sm:p-6 lg:p-20 space-y-10 bg-gray-50 dark:bg-gray-900 min-h-screen overflow-x-hidden">
    <h1 class="text-2xl font-bold text-center mb-6">Your Meal Plans</h1>
    <div class="border-t-2 border-primary-500 w-40 mx-auto mb-8"></div>

    <div class="grid grid-cols-1  md:grid-cols-2 gap-6">
        <!-- Weekly Meal Plan -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <h2 class="flex items-center text-lg font-semibold mb-4">
                <svg class="w-5 h-5 text-primary-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2h-1V3a1 1 0 00-1-1H6z"></path>
                    <path fill-rule="evenodd" d="M18 9H2v7a2 2 0 002 2h12a2 2 0 002-2V9zM7 11a1 1 0 012 0v3a1 1 0 11-2 0v-3zm4 0a1 1 0 012 0v3a1 1 0 11-2 0v-3z" clip-rule="evenodd"></path>
                </svg>
                Weekly Meal Plan
            </h2>

            @foreach(['Breakfast', 'Lunch', 'Dinner', 'Snacks'] as $meal)
                <button class="flex justify-between items-center w-full p-3 bg-gray-100 rounded mb-2 hover:bg-gray-200">
                    <span>{{ $meal }}</span>
                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
            @endforeach

            <button class="mt-4 w-full bg-primary-500 hover:bg-primary-600 text-white py-2 px-4 rounded">
                View Full Plan
            </button>
        </div>
        <!-- Upcoming Workshops -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="flex items-center text-lg font-semibold mb-4">
                <svg class="w-5 h-5 text-primary-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2h-1V3a1 1 0 00-1-1H6z"></path>
                    <path fill-rule="evenodd" d="M18 9H2v7a2 2 0 002 2h12a2 2 0 002-2V9zM7 11a1 1 0 012 0v3a1 1 0 11-2 0v-3zm4 0a1 1 0 012 0v3a1 1 0 11-2 0v-3z" clip-rule="evenodd"></path>
                </svg>
                Upcoming Workshops
            </h2>

            @php
                $workshops = [
                    ['title' => 'Healthy Meal Prep Basics', 'desc' => 'Learn how to prepare nutritious meals for the week', 'date' => 'June 15, 2024 - 2:00 PM'],
                    ['title' => 'Understanding Nutrition Labels', 'desc' => 'Master reading and understanding food labels', 'date' => 'June 20, 2024 - 3:00 PM'],
                    ['title' => 'Balanced Diet Planning', 'desc' => 'Create your personalized balanced diet plan', 'date' => 'June 25, 2024 - 1:00 PM'],
                ];
            @endphp

            @foreach($workshops as $workshop)
                <div class="bg-gray-800 rounded p-4 mb-3 flex justify-between items-center">
                    <div>
                        <h3 class="font-semibold">{{ $workshop['title'] }}</h3>
                        <p class="text-sm text-gray-600">{{ $workshop['desc'] }}</p>
                        <p class="text-primary-600 font-medium mt-1">{{ $workshop['date'] }}</p>
                    </div>
                    <button class="bg-primary-500 hover:bg-primary-600 text-white px-4 py-2 rounded">
                        Register
                    </button>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
