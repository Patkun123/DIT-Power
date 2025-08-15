@extends('auth.admin.partials.layouts.app.head')

@section('title', 'dashboard')
@include('auth.admin.partials.layouts.side')
@include('auth.admin.partials.layouts.header')
@section('content')
<div class="h-70 md:h-80 w-full bg-gradient-to-l from-lime-300 via-lime-600 to-lime-900">
    <div class="container mx-auto flex items-start justify-start h-full px-2 md:px-70">
        <div class="flex flex-col mt-40 md:mt-40">
            <h1 class="text-2xl md:text-4xl text-white">User Progress Tracking</b></h1>
            <span class="text-white text-sm md:text-base mt-2"> Manage your User Progress Tracking with ease</span>
        </div>
    </div>
</div>
<main class="p-4 md:ml-64 h-auto pt-5 bg-gray-100 dark:bg-gray-900">
    <!-- Header -->
    <div class="bg-gray-800 rounded-3xl">
    <div class="flex items-center justify-between mb-6 p-4 bg-gradient-to-l from-primary-400 via-primary-600 to-lime-700 rounded-t-lg text-white">
        <h1 class="text-xl font-semibold flex items-center">
            📈 User Progress Tracking
        </h1>
        <div class="flex items-center gap-2">
            <div class="relative">
                <form class="max-w-lg mx-auto">
                    <div class="flex">
                        <label for="search-dropdown" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Your Email</label>
                        <button id="dropdown-button" data-dropdown-toggle="search" class="shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-gray-900 bg-gray-100 border border-gray-300 rounded-s-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700 dark:text-white dark:border-gray-600" type="button">All categories <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                            </svg>
                        </button>
                        <div id="search" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 dark:bg-gray-700">
                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdown-button">
                            <li>
                                <button type="button" class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Mockups</button>
                            </li>
                            <li>
                                <button type="button" class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Templates</button>
                            </li>
                            <li>
                                <button type="button" class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Design</button>
                            </li>
                            <li>
                                <button type="button" class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Logos</button>
                            </li>
                            </ul>
                        </div>
                        <div class="relative w-full">
                            <input type="search" id="search-dropdown" class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-e-lg border-s-gray-50 border-s-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-s-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" placeholder="Search Mockups, Logos, Design Templates..." required />
                            <button type="submit" class="absolute top-0 end-0 p-2.5 text-sm font-medium h-full text-white bg-blue-700 rounded-e-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                                <span class="sr-only">Search</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        </div>
    <!-- User Card -->
<div class="grid grid-cols-1 bg-gray-800 md:grid-cols-2 lg:grid-cols-3 gap-6 p-4">
    @foreach ($users as $user)
        <div class="bg-gray-100 dark:bg-gray-900 shadow-md shadow-lime-600 rounded-lg p-5">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                   <div class="w-12 h-12 rounded-full overflow-hidden flex items-center justify-center bg-green-600 text-white text-lg font-bold">
                        @if($user->profileimage)
                            <img src="{{ asset('storage/' . $user->profileimage) }}"
                                alt="{{ $user->firstname ??  'Not' }} {{ $user->lastname ?? 'Registered'}}"
                                class="w-full h-full object-cover">
                        @else
                            <img src="/images/default.png"
                                alt="{{ $user->firstname ??  'Not' }} {{ $user->lastname ?? 'Registered'}}"
                                class="w-full h-full object-cover">
                        @endif
                    </div>
                    <div>
                        <h2 class="text-lg font-semibold">{{ $user->firstname ??  'Not' }} {{ $user->lastname ?? 'Registered'}}</h2>
                        <p class="text-sm text-gray-600">{{ $user->email }}</p>
                    </div>
                </div>
                <span class="bg-green-100 text-green-700 text-sm px-3 py-1 rounded-full">User</span>
            </div>

            <div class="grid grid-cols-2 gap-4 my-5 text-center">
                <div class="flex flex-col items-center cursor-pointer transition-all hover:-translate-y-1 rounded-xl bg-gray-200 dark:bg-gray-800 hover:shadow-2xl p-5 hover:bg-lime-300 shadow shadow-lime-500">
                    <svg class="w-6 h-6 mb-1 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M6 2a2 2 0 0 0-2 2v15a3 3 0 0 0 3 3h12a1 1 0 1 0 0-2h-2v-2h2a1 1 0 0 0 1-1V4a2 2 0 0 0-2-2h-8v16h5v2H7a1 1 0 1 1 0-2h1V2H6Z" clip-rule="evenodd"/>
                    </svg>
                    <p class="text-xl font-semibold">{{ $user->journals_count }}</p>
                    <p class="text-sm dark:text-gray-200 text-gray-500">Journal Entries</p>
                </div>
                <div class="flex flex-col items-center cursor-pointer transition-all hover:-translate-y-1 rounded-xl bg-gray-200 dark:bg-gray-800 hover:shadow-2xl p-5 hover:bg-lime-300 shadow shadow-lime-500">
                    <svg class="w-6 h-6 mb-1 text-yellow-500" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2a10 10 0 0 0-3.515 19.438c.555.102.758-.24.758-.534v-1.867c-3.08.669-3.731-1.485-3.731-1.485-.504-1.281-1.231-1.623-1.231-1.623-1.006-.688.078-.674.078-.674 1.112.078 1.698 1.142 1.698 1.142.99 1.698 2.6 1.208 3.233.922.099-.716.388-1.209.705-1.487-2.46-.278-5.045-1.23-5.045-5.482 0-1.211.434-2.2 1.142-2.978-.113-.279-.494-1.392.108-2.9 0 0 .933-.297 3.06 1.14a10.66 10.66 0 0 1 2.783-.375c.944.004 1.893.129 2.783.375 2.124-1.437 3.054-1.14 3.054-1.14.605 1.508.224 2.621.111 2.9.713.778 1.142 1.767 1.142 2.978 0 4.262-2.59 5.2-5.058 5.474.399.348.753 1.027.753 2.072v3.069c0 .297.2.641.765.531A10.004 10.004 0 0 0 12 2z"/>
                    </svg>
                    <p class="text-xl font-semibold">{{ $user->quiz_attempts_sum_score ?? 0 }}</p>
                    <p class="text-sm text-gray-500">Quiz Points</p>
                </div>

                <!-- Relaxation Sessions -->
                <div class="flex flex-col items-center cursor-pointer transition-all hover:-translate-y-1 rounded-xl bg-gray-200 dark:bg-gray-800 hover:shadow-2xl p-5 hover:bg-lime-300 shadow shadow-lime-500">
                    <svg class="w-6 h-6 mb-1 text-indigo-500" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C6.489 2 2 6.489 2 12s4.489 10 10 10 10-4.489 10-10S17.511 2 12 2zm4.5 14.5c-.828 0-1.5-.672-1.5-1.5S15.672 13.5 16.5 13.5 18 14.172 18 15s-.672 1.5-1.5 1.5zm-9 0c-.828 0-1.5-.672-1.5-1.5S6.672 13.5 7.5 13.5 9 14.172 9 15s-.672 1.5-1.5 1.5zM12 6c-3.316 0-6 2.684-6 6s2.684 6 6 6 6-2.684 6-6-2.684-6-6-6z"/>
                    </svg>
                    <p class="text-xl font-semibold">0</p>
                    <p class="text-sm dark:text-gray-200 text-gray-500">Relaxation Sessions</p>
                </div>

                <!-- Nutrition Logs -->
                <div class="flex flex-col items-center cursor-pointer transition-all hover:-translate-y-1 rounded-xl bg-gray-200 dark:bg-gray-800 hover:shadow-2xl p-5 hover:bg-lime-300 shadow shadow-lime-500">
                    <svg class="w-6 h-6 mb-1 text-rose-500" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M18 2h-1a1 1 0 0 0-1 1v5h-2V3a1 1 0 0 0-1-1h-1v6H8V3a1 1 0 0 0-1-1H6a4 4 0 0 0-4 4v13a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3V6a4 4 0 0 0-4-4z"/>
                    </svg>
                    <p class="text-xl font-semibold">0</p>
                    <p class="text-sm dark:text-gray-200 text-gray-500">Nutrition Logs</p>
                </div>
            </div>

            <p class="text-sm text-gray-500 flex items-center">
                <span class="w-2 h-2 bg-gray-400 rounded-full mr-2"></span>
                Last active:
                <span class="ml-1 font-medium">
                    {{ $user->last_active_at ? $user->last_active_at->diffForHumans() : 'Never' }}
                </span>
            </p>
        </div>
    @endforeach
</div>

</div>
</div>
</main>
@endsection
