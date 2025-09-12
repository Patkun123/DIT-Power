@extends('auth.admin.partials.layouts.app.head')

@section('title', 'Create Quiz Set')
@include('auth.admin.partials.layouts.side')
@include('auth.admin.partials.layouts.header')
@section('content')
<div class="h-70 md:h-80 w-full bg-gradient-to-l from-primary-400 via-primary-600 to-lime-700">
    <div class="container mx-auto flex items-start justify-start h-full px-2 md:px-70">
        <div class="flex flex-col mt-40 md:mt-40">
            <h1 class="text-2xl md:text-4xl text-white">{{ auth()->user()->lastname }}, <b>Create Quiz Set</b></h1>
            <span class="text-white text-sm md:text-base mt-2">Add a new set for: <strong>{{ $quiz->quiz_title }}</strong></span>
        </div>
    </div>
</div>

<main class="p-4 md:ml-64 h-auto pt-4">
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('admin.quizzes.sets', $quiz) }}" 
           class="inline-flex items-center px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white font-medium rounded-lg transition-colors duration-200">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to Quiz Sets
        </a>
    </div>

    <!-- Form Card -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md border border-gray-200 dark:border-gray-700 p-6">
        <form action="{{ route('admin.quizzes.sets.store', $quiz) }}" method="POST">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Set Name -->
                <div>
                    <label for="set_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Set Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           id="set_name" 
                           name="set_name" 
                           value="{{ old('set_name') }}"
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:text-white"
                           placeholder="e.g., Morning Session, Set 1, Afternoon Session"
                           required>
                    @error('set_name')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Set Number -->
                <div>
                    <label for="set_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Set Number <span class="text-red-500">*</span>
                    </label>
                    <input type="number" 
                           id="set_number" 
                           name="set_number" 
                           value="{{ old('set_number', 1) }}"
                           min="1"
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:text-white"
                           required>
                    @error('set_number')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Start Time -->
                <div>
                    <label for="start_time" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Start Time (Philippines) <span class="text-red-500">*</span>
                    </label>
                    <input type="datetime-local" 
                           id="start_time" 
                           name="start_time" 
                           value="{{ old('start_time') }}"
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:text-white"
                           required>
                    @error('start_time')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- End Time -->
                <div>
                    <label for="end_time" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        End Time (Philippines) <span class="text-red-500">*</span>
                    </label>
                    <input type="datetime-local" 
                           id="end_time" 
                           name="end_time" 
                           value="{{ old('end_time') }}"
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:text-white"
                           required>
                    @error('end_time')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div class="md:col-span-2">
                    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Description (Optional)
                    </label>
                    <textarea id="description" 
                              name="description" 
                              rows="3"
                              class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:text-white"
                              placeholder="Optional description for this quiz set">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-end space-x-4 mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                <a href="{{ route('admin.quizzes.sets', $quiz) }}" 
                   class="px-6 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                    Cancel
                </a>
                <button type="submit" 
                        class="px-6 py-2 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-md transition-colors duration-200">
                    Create Quiz Set
                </button>
            </div>
        </form>
    </div>

    <!-- Help Card -->
    <div class="mt-6 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-blue-800 dark:text-blue-200">Tips for creating quiz sets:</h3>
                <div class="mt-2 text-sm text-blue-700 dark:text-blue-300">
                    <ul class="list-disc list-inside space-y-1">
                        <li>Use descriptive names like "Morning Session", "Afternoon Session", or "Set 1", "Set 2"</li>
                        <li>Set numbers help organize sets in chronological order</li>
                        <li>All times are in Philippines timezone (Asia/Manila)</li>
                        <li>Make sure end time is after start time</li>
                        <li>You can create multiple sets for the same quiz with different time slots</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
// Auto-set end time when start time changes
document.getElementById('start_time').addEventListener('change', function() {
    const startTime = new Date(this.value);
    if (startTime) {
        // Add 1 hour to start time for end time
        const endTime = new Date(startTime.getTime() + 60 * 60 * 1000);
        const endTimeString = endTime.toISOString().slice(0, 16);
        document.getElementById('end_time').value = endTimeString;
    }
});
</script>
@endsection

