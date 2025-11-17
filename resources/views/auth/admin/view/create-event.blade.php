@extends('auth.admin.partials.layouts.app.head')

@section('title', 'Create Event')
@include('auth.admin.partials.layouts.side')
@include('auth.admin.partials.layouts.header')

@section('content')
<div class="h-70 md:h-80 w-full bg-gradient-to-l from-primary-400 via-primary-600 to-lime-700">
    <div class="container mx-auto flex items-start justify-start h-full px-2 md:px-70">
        <div class="flex flex-col mt-40 md:mt-40">
            <h1 class="text-2xl md:text-4xl text-white">Create <b>New Event</b></h1>
            <span class="text-white text-sm md:text-base mt-2">Schedule a new wellness event</span>
        </div>
    </div>
</div>

<main class="p-4 md:ml-64 h-auto pt-5 bg-gray-200 dark:bg-gray-900">
    <div class="p-4 md:p-6 max-w-4xl">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
            <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Title -->
                <div class="mb-6">
                    <label for="title" class="block text-sm font-medium text-gray-900 dark:text-white mb-2">
                        Event Title *
                    </label>
                    <input type="text" id="title" name="title" required
                        class="block w-full px-4 py-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-2 focus:ring-primary-500 @error('title') border-red-500 @enderror"
                        placeholder="e.g., Yoga & Wellness Workshop"
                        value="{{ old('title') }}"
                    >
                    @error('title')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Description -->
                <div class="mb-6">
                    <label for="description" class="block text-sm font-medium text-gray-900 dark:text-white mb-2">
                        Description *
                    </label>
                    <textarea id="description" name="description" rows="4" required
                        class="block w-full px-4 py-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-2 focus:ring-primary-500 @error('description') border-red-500 @enderror"
                        placeholder="Detailed description of the event"
                    >{{ old('description') }}</textarea>
                    @error('description')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Location -->
                <div class="mb-6">
                    <label for="location" class="block text-sm font-medium text-gray-900 dark:text-white mb-2">
                        Location *
                    </label>
                    <input type="text" id="location" name="location" required
                        class="block w-full px-4 py-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-2 focus:ring-primary-500 @error('location') border-red-500 @enderror"
                        placeholder="e.g., Community Center, Room 101"
                        value="{{ old('location') }}"
                    >
                    @error('location')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Date and Time -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="event_date" class="block text-sm font-medium text-gray-900 dark:text-white mb-2">
                            Event Date *
                        </label>
                        <input type="date" id="event_date" name="event_date" required
                            class="block w-full px-4 py-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-2 focus:ring-primary-500 @error('event_date') border-red-500 @enderror"
                            value="{{ old('event_date') }}"
                        >
                        @error('event_date')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="event_time" class="block text-sm font-medium text-gray-900 dark:text-white mb-2">
                            Event Time *
                        </label>
                        <input type="time" id="event_time" name="event_time" required
                            class="block w-full px-4 py-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-2 focus:ring-primary-500 @error('event_time') border-red-500 @enderror"
                            value="{{ old('event_time') }}"
                        >
                        @error('event_time')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Image Upload -->
                <div class="mb-6">
                    <label for="image" class="block text-sm font-medium text-gray-900 dark:text-white mb-2">
                        Event Image
                    </label>
                    <div class="mt-2 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg dark:border-gray-600 bg-gray-50 dark:bg-gray-700">
                        <div class="space-y-1 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4V12a4 4 0 014-4h16m0 0l-8 8m8-8l8 8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="flex text-sm text-gray-600 dark:text-gray-400">
                                <label for="image" class="relative cursor-pointer bg-white dark:bg-gray-700 rounded-md font-medium text-primary-600 dark:text-primary-400 hover:text-primary-500">
                                    <span>Upload a file</span>
                                    <input id="image" type="file" name="image" class="sr-only" accept="image/*">
                                </label>
                                <p class="pl-1">or drag and drop</p>
                            </div>
                            <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG, GIF up to 2MB</p>
                        </div>
                    </div>
                    @error('image')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Status -->
                <div class="mb-6">
                    <label for="status" class="block text-sm font-medium text-gray-900 dark:text-white mb-2">
                        Status *
                    </label>
                    <select id="status" name="status" required
                        class="block w-full px-4 py-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-2 focus:ring-primary-500 @error('status') border-red-500 @enderror"
                    >
                        <option value="active" {{ old('status') === 'active' ? 'selected' : '' }}>Active</option>
                        <option value="completed" {{ old('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ old('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                    @error('status')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="flex gap-4 pt-6 border-t border-gray-200 dark:border-gray-700">
                    <button type="submit" class="px-6 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition">
                        Create Event
                    </button>
                    <a href="{{ route('admin.events.index') }}" class="px-6 py-2 bg-gray-300 dark:bg-gray-600 text-gray-900 dark:text-white rounded-lg hover:bg-gray-400 dark:hover:bg-gray-500 transition">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</main>

@endsection
