@extends('auth.admin.partials.layouts.app.head')

@section('title', 'Edit Question')
@include('auth.admin.partials.layouts.side')
@include('auth.admin.partials.layouts.header')
@section('content')
<div class="h-70 md:h-80 w-full bg-gradient-to-l from-primary-400 via-primary-600 to-lime-700">
    <div class="container mx-auto flex items-start justify-start h-full px-2 md:px-70">
        <div class="flex flex-col mt-40 md:mt-40">
            <h1 class="text-2xl md:text-4xl text-white">{{ auth()->user()->lastname }}, <b>Edit Question</b></h1>
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
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Edit Question</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Edit Question Form -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md border border-gray-200 dark:border-gray-700">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Edit Question Details</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Update question for {{ $quiz->quiz_title }}</p>
            </div>

            <form action="{{ route('admin.quizzes.questions.update', [$quiz, $question]) }}" method="POST" class="p-6">
                @csrf
                @method('PUT')
                
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
                                  required>{{ old('content', $question->content) }}</textarea>
                        @error('content')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Set -->
                    <div>
                        <label for="set" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Set
                        </label>
                        <select id="set" 
                                name="set" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="1" {{ old('set', $question->set) == '1' ? 'selected' : '' }}>Set 1</option>
                            <option value="2" {{ old('set', $question->set) == '2' ? 'selected' : '' }}>Set 2</option>
                            <option value="3" {{ old('set', $question->set) == '3' ? 'selected' : '' }}>Set 3</option>
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
                                @php
                                    $choice = $question->choices->where('letter', $letter)->first();
                                    $choiceValue = old('choices.' . $letter, $choice ? $choice->content : '');
                                @endphp
                                <div class="flex items-center space-x-3">
                                    <label class="flex-shrink-0 w-8 text-sm font-medium text-gray-700 dark:text-gray-300">
                                        {{ $letter }}.
                                    </label>
                                    <input type="text" 
                                           name="choices[{{ $letter }}]" 
                                           value="{{ $choiceValue }}"
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
                            <option value="A" {{ old('answer', $question->answer) == 'A' ? 'selected' : '' }}>A</option>
                            <option value="B" {{ old('answer', $question->answer) == 'B' ? 'selected' : '' }}>B</option>
                            <option value="C" {{ old('answer', $question->answer) == 'C' ? 'selected' : '' }}>C</option>
                            <option value="D" {{ old('answer', $question->answer) == 'D' ? 'selected' : '' }}>D</option>
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
                        Update Question
                    </button>
                </div>
            </form>
        </div>

        <!-- Current Question Preview -->
        <div class="mt-6 bg-gray-50 dark:bg-gray-700 rounded-xl border border-gray-200 dark:border-gray-600">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Current Question Preview</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">How this question appears to users</p>
            </div>

            <div class="p-6">
                <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-600 p-4">
                    <div class="flex items-start justify-between mb-3">
                        <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300">Question</h4>
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100">
                            Answer: {{ $question->answer }}
                        </span>
                    </div>
                    <p class="text-gray-900 dark:text-white mb-4">{{ $question->content }}</p>
                    <div class="grid grid-cols-2 gap-2">
                        @foreach($question->choices as $choice)
                        <div class="flex items-center space-x-2">
                            <span class="inline-flex items-center justify-center w-6 h-6 text-xs font-medium text-gray-600 bg-gray-100 rounded-full dark:bg-gray-700 dark:text-gray-300">
                                {{ $choice->letter }}
                            </span>
                            <span class="text-sm text-gray-700 dark:text-gray-300">{{ $choice->content }}</span>
                            @if($choice->letter === $question->answer)
                                <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Warning Section -->
        <div class="mt-6 bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-yellow-800 dark:text-yellow-200">
                        Important Notes
                    </h3>
                    <div class="mt-2 text-sm text-yellow-700 dark:text-yellow-300">
                        <ul class="list-disc list-inside space-y-1">
                            <li>Changing the correct answer may affect existing quiz attempts</li>
                            <li>If the quiz is currently active, consider the impact on ongoing attempts</li>
                            <li>All answer choices must be filled in</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
