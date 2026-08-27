@extends('auth.admin.partials.layouts.app.head')

@section('title', 'dashboard')
@include('auth.admin.partials.layouts.side')
@include('auth.admin.partials.layouts.header')
@section('content')
<div class="admin-page-hero">
    <div class="admin-page-hero-inner">
        <h1>User Progress Tracking</h1>
        <p>Monitor participation and wellness activity</p>
    </div>
</div>
<main class="admin-page-main p-4 md:ml-64 h-auto rounded-2xl">
        <!-- Search and sorting controls -->
    <div class="mb-5 flex flex-col gap-6 rounded-xl border border-[#d8e1ea] bg-white p-5 shadow-sm md:flex-row md:items-end md:justify-between dark:border-[#2d526d] dark:bg-[#16324a]">
        <div>
            <p class="mb-1 text-[0.7rem] font-bold uppercase tracking-[0.12em] text-[#176b87]">Participation</p>
            <h2 class="text-xl font-bold text-[#102a43] dark:text-[#f4f8fb]">User Progress Tracking</h2>
            <p class="mt-1 text-xs text-[#607589] dark:text-[#aec1d0]">Search users by name, email, or office and review their activity.</p>
        </div>
        <form method="GET" action="{{ route('users.tracking') }}" class="flex flex-col items-stretch justify-end gap-2 sm:flex-row sm:flex-wrap sm:items-center">
            <label class="flex w-full items-center gap-2 rounded-lg border border-[#cbd8e2] bg-slate-50 px-3 py-2 transition focus-within:border-amber-600 focus-within:ring-2 focus-within:ring-amber-600/15 sm:w-72 dark:border-[#38617c] dark:bg-[#102a43]" for="user-search">
                <svg aria-hidden="true" class="h-4 w-4 shrink-0 text-slate-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M8 4a4 4 0 1 0 2.83 6.83l3.67 3.67a1 1 0 0 0 1.41-1.41l-3.67-3.67A4 4 0 0 0 8 4ZM6 8a2 2 0 1 1 4 0 2 2 0 0 1-4 0Z" clip-rule="evenodd" /></svg>
                <input id="user-search" type="search" name="search" value="{{ $search ?? '' }}" placeholder="Search name, email, or office" class="w-full min-w-0 border-0 bg-transparent p-0 text-xs text-[#102a43] outline-none placeholder:text-slate-400 dark:text-white">
            </label>
            <label class="sr-only" for="sort">Sort users by</label>
            <select id="sort" name="sort" class="h-10 w-50 rounded-lg border border-[#cbd8e2] bg-slate-50 px-3 text-xs font-semibold text-[#304b62] outline-none focus:border-amber-600 focus:ring-2 focus:ring-amber-600/15 dark:border-[#38617c] dark:bg-[#102a43] dark:text-[#d7e4ed]">               <option value="created_at" @selected(($sort ?? 'created_at') === 'created_at')>Date registered</option>
               <option value="updated_at" @selected(($sort ?? 'created_at') === 'updated_at')>Last updated</option>
            </select>
            <label class="sr-only" for="direction">Sort direction</label>
            <select id="direction" name="direction" class="h-10 w-50 rounded-lg border border-[#cbd8e2] bg-slate-50 px-3 text-xs font-semibold text-[#304b62] outline-none focus:border-amber-600 focus:ring-2 focus:ring-amber-600/15 dark:border-[#38617c] dark:bg-[#102a43] dark:text-[#d7e4ed]">
                <option value="desc" @selected(($direction ?? 'desc') === 'desc')>Newest first</option>
                <option value="asc" @selected(($direction ?? 'desc') === 'asc')>Oldest first</option>
            </select>
            <button type="submit" class="inline-flex min-h-10 items-center justify-center rounded-lg bg-amber-600 px-4 text-sm font-bold text-white transition hover:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-amber-600/30">Search</button>
                @if(($search ?? '') !== '')
                    <a href="{{ route('users.tracking', ['sort' => $sort ?? 'created_at', 'direction' => $direction ?? 'desc']) }}" class="px-2 py-2 text-xs font-bold text-amber-700 hover:text-amber-900 dark:text-amber-300 dark:hover:text-amber-200">Clear</a>
                @endif
        </form>
        </div>
            <!-- User Card -->
        <div class="grid grid-cols-1 bg-gray-50 dark:bg-gray-800 md:grid-cols-2 lg:grid-cols-3 gap-6 p-4">
            @forelse ($users as $user)
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
                            <p class="text-xl font-semibold">0</p>
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
            @empty
                <div class="col-span-full rounded-lg border border-dashed border-gray-300 dark:border-gray-700 p-10 text-center">
                    <p class="text-base font-semibold text-gray-700 dark:text-gray-200">No users found</p>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Try a different name, email address, or office.</p>
                </div>
            @endforelse
            </div>
        </div>
    </div>
</main>
@endsection
