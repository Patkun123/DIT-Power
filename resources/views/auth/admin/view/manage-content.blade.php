@extends('auth.admin.partials.layouts.app.head')

@section('title', 'Manage Content')
@include('auth.admin.partials.layouts.side')
@include('auth.admin.partials.layouts.header')

@section('content')
<div class="h-70 md:h-80 w-full bg-gradient-to-l from-primary-400 via-primary-600 to-lime-700">
    <div class="container mx-auto flex items-start justify-start h-full px-2 md:px-70">
        <div class="flex flex-col mt-40 md:mt-40">
            <h1 class="text-2xl md:text-4xl text-white">Manage <b>Home Page Content</b></h1>
            <span class="text-white text-sm md:text-base mt-2">Create and manage content displayed on the home page</span>
        </div>
    </div>
</div>

<main class="p-4 md:ml-64 h-auto pt-5 bg-gray-200 dark:bg-gray-900">
    <div class="p-4 md:p-6 mb-6">
        @if (session('success'))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                <span class="font-medium">Success!</span> {{ session('success') }}
            </div>
        @endif

        <!-- Stats Section -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-white dark:bg-gray-800 rounded-lg p-4 shadow">
                <div class="text-sm text-gray-600 dark:text-gray-400">Total Content</div>
                <div class="text-3xl font-bold text-primary-600 dark:text-primary-400">{{ $stats['total'] }}</div>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-lg p-4 shadow">
                <div class="text-sm text-gray-600 dark:text-gray-400">Published</div>
                <div class="text-3xl font-bold text-green-600">{{ $stats['published'] }}</div>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-lg p-4 shadow">
                <div class="text-sm text-gray-600 dark:text-gray-400">Drafts</div>
                <div class="text-3xl font-bold text-blue-600">{{ $stats['draft'] }}</div>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-lg p-4 shadow">
                <div class="text-sm text-gray-600 dark:text-gray-400">Archived</div>
                <div class="text-3xl font-bold text-gray-600">{{ $stats['archived'] }}</div>
            </div>
        </div>

        <!-- Create Button -->
        <div class="mb-6">
            <a href="{{ route('admin.content.create') }}" class="inline-flex items-center px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Create New Content
            </a>
        </div>

        <!-- Content Table -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
            @if($contents->count())
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Title</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Author</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Published</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($contents as $content)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900 dark:text-white">
                                    {{ Str::limit($content->title, 50) }}
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold
                                        @if($content->status === 'published')
                                            bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300
                                        @elseif($content->status === 'draft')
                                            bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300
                                        @else
                                            bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-300
                                        @endif
                                    ">
                                        {{ ucfirst($content->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">
                                    {{ $content->admin->firstname }} {{ $content->admin->lastname }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">
                                    {{ $content->published_at ? $content->published_at->format('M d, Y') : 'Not published' }}
                                </td>
                                <td class="px-6 py-4 text-sm space-x-2">
                                    <a href="{{ route('admin.content.edit', $content) }}" class="text-primary-600 hover:text-primary-900 dark:hover:text-primary-400">Edit</a>
                                    <form action="{{ route('admin.content.destroy', $content) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?')">
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
                    {{ $contents->links() }}
                </div>
            @else
                <div class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m0 0h6"></path>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">No content</h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Get started by creating a new content item.</p>
                    <div class="mt-6">
                        <a href="{{ route('admin.content.create') }}" class="inline-flex items-center px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Create Content
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</main>

@endsection
