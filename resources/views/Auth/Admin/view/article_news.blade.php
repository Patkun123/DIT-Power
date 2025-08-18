@extends('auth.admin.partials.layouts.app.head')

@section('title', 'dashboard')
@include('auth.admin.partials.layouts.side')
@include('auth.admin.partials.layouts.header')
@section('content')
@include('auth.admin.partials.modals.addnews')
<div class="h-70 md:h-80 w-full bg-gradient-to-l from-lime-300 via-lime-600 to-lime-900">
    <div class="container mx-auto flex items-start justify-start h-full px-2 md:px-70">
        <div class="flex flex-col mt-40 md:mt-40">
            <h1 class="text-2xl md:text-4xl text-white">News Management </b></h1>
            <span class="text-white text-sm md:text-base mt-2"> Manage your News with ease</span>
        </div>
    </div>
</div>

<main class="p-4 md:ml-64 h-full bg-gray-200 dark:bg-gray-900">

    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold">News Management</h1>
        <button id="defaultModalButton" data-modal-target="addnews" data-modal-toggle="addnews" class="px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white rounded-lg flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            New Article
        </button>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-1 dark:bg-gray-800 p-5 rounded-2xl sm:grid-cols-2 lg:grid-cols-5 gap-4 mb-8">
    <div class="dark:bg-gray-900 bg-gray-50 transition-all hover:bg-primary-300 hover:shadow-lg shadow-lg shadow-lime-600 hover:-translate-y-2 rounded-xl p-10 text-center">
        <p class="text-2xl font-bold">{{ $total }}</p>
        <p class="text-gray-500">Total Articles</p>
    </div>
    <div class="dark:bg-gray-900 bg-gray-50 transition-all hover:bg-primary-300 hover:shadow-lg shadow-lg shadow-lime-600 hover:-translate-y-2 rounded-xl p-10 text-center">
        <p class="text-2xl font-bold">{{ $active }}</p>
        <p class="text-gray-500">Active</p>
    </div>
    <div class="dark:bg-gray-900 bg-gray-50 transition-all hover:bg-primary-300 hover:shadow-lg shadow-lg shadow-lime-600 hover:-translate-y-2 rounded-xl p-10 text-center">
        <p class="text-2xl font-bold">{{ $inactive }}</p>
        <p class="text-gray-500">Inactive</p>
    </div>
    <div class="dark:bg-gray-900 bg-gray-50 transition-all hover:bg-primary-300 hover:shadow-lg shadow-lg shadow-lime-600 hover:-translate-y-2 rounded-xl p-10 text-center">
        <p class="text-2xl font-bold">{{ $drafts }}</p>
        <p class="text-gray-500">Drafts</p>
    </div>
    <div class="dark:bg-gray-900 bg-gray-50 transition-all hover:bg-primary-300 hover:shadow-lg shadow-lg shadow-lime-600 hover:-translate-y-2 rounded-xl p-10 text-center">
        <p class="text-2xl font-bold">{{ $archived }}</p>
        <p class="text-gray-500">Archived</p>
    </div>
</div>


    <!-- News Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 dark:bg-gray-800 p-5 rounded-2xl gap-6">
    @forelse($articles as $article)
    @include('auth.admin.partials.modals.crudnews')
<div class="group relative dark:bg-gray-900 hover:shadow-2xl transition-all hover:-translate-y-1 hover:bg-primary-500 rounded-xl shadow-primary-500 overflow-hidden border-t-4 border-primary-500">
    <div class="relative">
        <span class="absolute top-2 left-2
            {{ $article->status === 'published' ? 'bg-green-500' : 'bg-yellow-500' }}
            text-white text-sm px-3 py-1 rounded-full">
            {{ ucfirst($article->status) }}
        </span>
        <div class="h-32 flex items-center justify-center bg-gray-100">
            @if($article->image_url)
                <img src="{{ asset('storage/' . $article->image_url) }}" alt="{{ $article->title }}" class="object-cover w-full h-full">
            @else
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 16l4-4m0 0l4 4m-4-4v12m0-12l4-4m-4 4L4 4" />
                </svg>
            @endif
        </div>

        <!-- Hover Buttons -->
        <div class="absolute inset-0 bg-black bg-opacity-40 hidden group-hover:flex items-center justify-center gap-2">
            <a href=""
               class="px-3 py-2 text-sm bg-blue-500 text-white rounded hover:bg-blue-600">
               View
            </a>
            <button type="button"
                data-modal-target="modalupdate-{{ $article->id }}"
                data-modal-toggle="modalupdate-{{ $article->id }}"
                class="px-3 py-2 text-sm bg-yellow-500 text-white rounded hover:bg-yellow-600">
                Edit
            </button>
            <form action="{{ route('news-articles.destroy', $article->id) }}" method="POST"
                  onsubmit="return confirm('Are you sure?')">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="px-3 py-2 text-sm bg-red-500 text-white rounded hover:bg-red-600">
                    Delete
                </button>
            </form>
        </div>
    </div>

    <div class="p-4">
        <h3 class="font-semibold">{{ $article->title }}</h3>
        <div class="flex items-center gap-4 text-gray-500 text-sm mt-1">
            <span class="flex items-center gap-1">
                {{ $article->category }}
            </span>
            <span class="flex items-center gap-1">
                {{ \Carbon\Carbon::parse($article->publication_date)->format('M d, Y') }}
            </span>
        </div>
        <p class="mt-2 text-gray-600 text-sm">{{ Str::limit($article->summary, 60) }}</p>
    </div>
</div>

    @empty
        <p class="text-gray-500">No news articles available.</p>
    @endforelse
</div>

