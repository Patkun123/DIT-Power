@extends('auth.admin.partials.layouts.app.head')

@section('title', 'Manage Events')
@include('auth.admin.partials.layouts.side')
@include('auth.admin.partials.layouts.header')

@section('content')
<div class="admin-page-hero">
    <div class="admin-page-hero-inner">
        <h1>Manage <b>Upcoming Events</b></h1>
        <p>Create and manage wellness events</p>
    </div>
</div>

<main class="admin-page-main p-4 md:ml-64 h-auto">
    <div class="p-4 md:p-6 mb-6">
        @if (session('success'))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                <span class="font-medium">Success!</span> {{ session('success') }}
            </div>
        @endif

        <!-- Stats Section -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-white dark:bg-gray-800 rounded-lg p-4 shadow">
                <div class="text-sm text-gray-600 dark:text-gray-400">Total Events</div>
                <div class="text-3xl font-bold text-primary-600 dark:text-primary-400">{{ $stats['total'] }}</div>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-lg p-4 shadow">
                <div class="text-sm text-gray-600 dark:text-gray-400">Active</div>
                <div class="text-3xl font-bold text-green-600">{{ $stats['active'] }}</div>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-lg p-4 shadow">
                <div class="text-sm text-gray-600 dark:text-gray-400">Completed</div>
                <div class="text-3xl font-bold text-blue-600">{{ $stats['completed'] }}</div>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-lg p-4 shadow">
                <div class="text-sm text-gray-600 dark:text-gray-400">Cancelled</div>
                <div class="text-3xl font-bold text-red-600">{{ $stats['cancelled'] }}</div>
            </div>
        </div>

        <!-- Create Button -->
        <div class="mb-6">
            <a href="{{ route('admin.events.create') }}" class="inline-flex items-center px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Create New Event
            </a>
        </div>

        <!-- Events Table -->
        <div class="admin-surface overflow-hidden">
            @if($events->count())
                <table class="admin-table min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Event</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Date & Time</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Location</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($events as $event)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900 dark:text-white">
                                    {{ Str::limit($event->title, 50) }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">
                                    {{ $event->event_date->format('M d, Y') }} at {{ $event->event_time }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">
                                    {{ Str::limit($event->location, 30) }}
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold
                                        @if($event->status === 'active')
                                            bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300
                                        @elseif($event->status === 'completed')
                                            bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300
                                        @else
                                            bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300
                                        @endif
                                    ">
                                        {{ ucfirst($event->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm space-x-2">
                                    <a href="{{ route('admin.events.edit', $event) }}" class="text-primary-600 hover:text-primary-900 dark:hover:text-primary-400">Edit</a>
                                    <form action="{{ route('admin.events.destroy', $event) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="bg-white dark:bg-gray-800 px-6 py-4">
                    {{ $events->links() }}
                </div>
            @else
                <div class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m0 0h6"></path>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">No events</h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Get started by creating a new event.</p>
                    <div class="mt-6">
                        <a href="{{ route('admin.events.create') }}" class="inline-flex items-center px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Create Event
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</main>

@endsection
