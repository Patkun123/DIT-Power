@extends('auth.admin.partials.layouts.app.head')

@section('title', 'Add Question')
@include('auth.admin.partials.layouts.side')
@include('auth.admin.partials.layouts.header')
@section('content')
<div class="h-70 md:h-80 w-full bg-gradient-to-l from-primary-400 via-primary-600 to-lime-700">
    <div class="container mx-auto flex items-start justify-start h-full px-2 md:px-70">
        <div class="flex flex-col mt-40 md:mt-40">
            <h1 class="text-2xl md:text-4xl text-white">{{ auth()->user()->lastname }}, <b>Add Question</b></h1>
            <span class="text-white text-sm md:text-base mt-2">{{ $quiz->quiz_title }}</span>
        </div>
    </div>
</div>

<main class="p-4 md:ml-64 h-auto pt-4">
    <div class="max-w-4xl mx-auto">
        <!-- Breadcrumb -->
        <nav class="flex mb-6" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('managequiz') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-primary-600 dark:text-gray-400 dark:hover:text-white">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                        </svg>
                        Quiz Management
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <a href="{{ route('admin.quizzes.questions', $quiz) }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-primary-600 md:ml-2 dark:text-gray-400 dark:hover:text-white">{{ $quiz->quiz_title }}</a>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Add Question</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Add Question Form -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md border border-gray-200 dark:border-gray-700">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Question Details</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Create a new question for {{ $quiz->quiz_title }}</p>
            </div>

            <form action="{{ route('admin.quizzes.questions.store', $quiz) }}" method="POST" class="p-6">
                @csrf

                <div class="space-y-6">
                    <!-- Question Content -->
                    <div>
                        <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Question <span class="text-red-500">*</span>
                        </label>
                        <textarea id="content"
                                  name="content"
                                  rows="4"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                  placeholder="Enter your question here..."
                                  required>{{ old('content') }}</textarea>
                        @error('content')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Set -->
                    <div>
                        <label for="set" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Set
                        </label>
                        @php
                            $quizSets = $quiz->sets()->orderBy('set_number')->get();
                            $defaultSet = old('set', $quizSets->first()?->set_number ?? '1');
                        @endphp
                        <select id="set"
                                name="set"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            @if($quizSets->isEmpty())
                                <option value="1" {{ (string) $defaultSet === '1' ? 'selected' : '' }}>Set 1</option>
                            @else
                                @foreach($quizSets as $quizSet)
                                    <option value="{{ $quizSet->set_number }}" {{ (string) $defaultSet === (string) $quizSet->set_number ? 'selected' : '' }}>
                                        {{ $quizSet->set_name ?: 'Set ' . $quizSet->set_number }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                        @error('set')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Answer Choices -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">
                            Answer Choices <span class="text-red-500">*</span>
                        </label>
                        <div class="space-y-3">
                            @foreach(['A', 'B', 'C', 'D'] as $letter)
                                <div class="flex items-center space-x-3">
                                    <label class="flex-shrink-0 w-8 text-sm font-medium text-gray-700 dark:text-gray-300">
                                        {{ $letter }}.
                                    </label>
                                    <input type="text"
                                           name="choices[{{ $letter }}]"
                                           value="{{ old('choices.' . $letter) }}"
                                           class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                           placeholder="Enter choice {{ $letter }}"
                                           required>
                                </div>
                                @error('choices.' . $letter)
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            @endforeach
                        </div>
                        @error('choices')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Correct Answer -->
                    <div>
                        <label for="answer" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Correct Answer <span class="text-red-500">*</span>
                        </label>
                        <select id="answer"
                                name="answer"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                required>
                            <option value="">Select correct answer</option>
                            <option value="A" {{ old('answer') == 'A' ? 'selected' : '' }}>A</option>
                            <option value="B" {{ old('answer') == 'B' ? 'selected' : '' }}>B</option>
                            <option value="C" {{ old('answer') == 'C' ? 'selected' : '' }}>C</option>
                            <option value="D" {{ old('answer') == 'D' ? 'selected' : '' }}>D</option>
                        </select>
                        @error('answer')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex items-center justify-end space-x-4 mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                    <a href="{{ route('admin.quizzes.questions', $quiz) }}"
                       class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700">
                        Cancel
                    </a>
                    <button type="submit"
                            class="px-4 py-2 text-sm font-medium text-white bg-primary-600 rounded-lg hover:bg-primary-700 focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-800">
                        Add Question
                    </button>
                </div>
            </form>
        </div>

        <!-- Help Section -->
        <div class="mt-6 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-blue-800 dark:text-blue-200">
                        Tips for Creating Questions
                    </h3>
                    <div class="mt-2 text-sm text-blue-700 dark:text-blue-300">
                        <ul class="list-disc list-inside space-y-1">
                            <li>Make questions clear and concise</li>
                            <li>Ensure all answer choices are plausible</li>
                            <li>Only one answer should be correct</li>
                            <li>Use sets to organize questions by difficulty or topic</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
