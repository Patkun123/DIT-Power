@extends('auth.admin.partials.layouts.app.head')

@section('title', 'Create Content')
@include('auth.admin.partials.layouts.side')
@include('auth.admin.partials.layouts.header')

@section('content')
<div class="h-70 md:h-80 w-full bg-gradient-to-l from-primary-400 via-primary-600 to-lime-700">
    <div class="container mx-auto flex items-start justify-start h-full px-2 md:px-70">
        <div class="flex flex-col mt-40 md:mt-40">
            <h1 class="text-2xl md:text-4xl text-white">Create <b>New Content</b></h1>
            <span class="text-white text-sm md:text-base mt-2">Add content to display on the home page</span>
        </div>
    </div>
</div>

<main class="p-4 md:ml-64 h-auto pt-5 bg-gray-200 dark:bg-gray-900">
    <div class="p-4 md:p-6 max-w-4xl">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
            <form action="{{ route('admin.content.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Title -->
                <div class="mb-6">
                    <label for="title" class="block text-sm font-medium text-gray-900 dark:text-white mb-2">
                        Title *
                    </label>
                    <input type="text" id="title" name="title" required
                        class="block w-full px-4 py-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-2 focus:ring-primary-500 @error('title') border-red-500 @enderror"
                        placeholder="Enter content title"
                        value="{{ old('title') }}"
                    >
                    @error('title')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Description -->
                <div class="mb-6">
                    <label for="description" class="block text-sm font-medium text-gray-900 dark:text-white mb-2">
                        Description (Summary)
                    </label>
                    <textarea id="description" name="description" rows="2"
                        class="block w-full px-4 py-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-2 focus:ring-primary-500 @error('description') border-red-500 @enderror"
                        placeholder="Brief description of content"
                    >{{ old('description') }}</textarea>
                    <p class="text-xs text-gray-500 mt-1">Max 500 characters</p>
                    @error('description')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Content -->
                <div class="mb-6">
                    <label for="content" class="block text-sm font-medium text-gray-900 dark:text-white mb-2">
                        Content *
                    </label>
                    <textarea id="content" name="content" rows="10" required
                        class="block w-full px-4 py-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-2 focus:ring-primary-500 @error('content') border-red-500 @enderror"
                        placeholder="Enter your content here"
                    >{{ old('content') }}</textarea>
                    @error('content')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Image Upload -->
                <div class="mb-6">
                    <label for="image" class="block text-sm font-medium text-gray-900 dark:text-white mb-2">
                        Featured Image
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
                            <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG, GIF up to 5MB</p>
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
                        <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Publish Immediately</option>
                    </select>
                    @error('status')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="flex gap-4 pt-6 border-t border-gray-200 dark:border-gray-700">
                    <button type="submit" class="px-6 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition">
                        Create Content
                    </button>
                    <a href="{{ route('admin.content.index') }}" class="px-6 py-2 bg-gray-300 dark:bg-gray-600 text-gray-900 dark:text-white rounded-lg hover:bg-gray-400 dark:hover:bg-gray-500 transition">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</main>

@endsection
