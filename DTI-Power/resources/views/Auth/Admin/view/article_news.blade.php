@extends('auth.admin.partials.layouts.app.head')

@section('title', 'dashboard')
@include('auth.admin.partials.layouts.side')
@include('auth.admin.partials.layouts.header')
@section('content')

<div class="h-70 md:h-80 w-full bg-gradient-to-l from-lime-300 via-lime-600 to-lime-900">
    <div class="container mx-auto flex items-start justify-start h-full px-2 md:px-70">
        <div class="flex flex-col mt-40 md:mt-40">
            <h1 class="text-2xl md:text-4xl text-white">News Management </b></h1>
            <span class="text-white text-sm md:text-base mt-2"> Manage your News with ease</span>
        </div>
    </div>
</div>

<main class="p-4 md:ml-64 h-auto bg-gray-200 dark:bg-gray-900">

    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold">News Management</h1>
        <button href="" class="px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white rounded-lg flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            New Article
        </button>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-1 dark:bg-gray-800 p-5 rounded-2xl sm:grid-cols-2 lg:grid-cols-5 gap-4 mb-8">
        <div class="bg-gray-900 dark:bg-grayshadow transition-all hover:bg-primary-300 hover:shadow-lg shadow-lg shadow-lime-600 hover:-translate-y-2 rounded-xl p-10 text-center">
            <p class="text-2xl font-bold">8</p>
            <p class="text-gray-500">Total Articles</p>
        </div>
        <div class="bg-gray-900 dark:bg-grayshadow transition-all hover:bg-primary-300 hover:shadow-lg shadow-lg shadow-lime-600 hover:-translate-y-2 rounded-xl p-10 text-center">
            <p class="text-2xl font-bold">2</p>
            <p class="text-gray-500">Active</p>
        </div>
        <div class="bg-gray-900 dark:bg-grayshadow transition-all hover:bg-primary-300 hover:shadow-lg shadow-lg shadow-lime-600 hover:-translate-y-2 rounded-xl p-10 text-center">
            <p class="text-2xl font-bold">2</p>
            <p class="text-gray-500">Inactive</p>
        </div>
        <div class="bg-gray-900 dark:bg-grayshadow transition-all hover:bg-primary-300 hover:shadow-lg shadow-lg shadow-lime-600 hover:-translate-y-2 rounded-xl p-10 text-center">
            <p class="text-2xl font-bold">1</p>
            <p class="text-gray-500">Drafts</p>
        </div>
        <div class="bg-gray-900 dark:bg-grayshadow transition-all hover:bg-primary-300 hover:shadow-lg shadow-lg shadow-lime-600 hover:-translate-y-2 rounded-xl p-10 text-center">
            <p class="text-2xl font-bold">3</p>
            <p class="text-gray-500">Archived</p>
        </div>
    </div>

    <!-- News Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 dark:bg-gray-800 p-5 rounded-2xl gap-6">
        <!-- Example card -->
        <div class="dark:bg-gray-900 hover:shadow-2xl transition-all hover:-translate-y-1 hover:bg-primary-500 rounded-xl shadow-primary-500 overflow-hidden border-t-4 border-primary-500">
            <div class="relative">
                <span class="absolute top-2 left-2 bg-green-500 text-white text-sm px-3 py-1 rounded-full">Active</span>
                <div class="h-32 flex items-center justify-center bg-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4-4m0 0l4 4m-4-4v12m0-12l4-4m-4 4L4 4" />
                    </svg>
                </div>
            </div>
            <div class="p-4">
                <h3 class="font-semibold">Sample Article</h3>
                <div class="flex items-center gap-4 text-gray-500 text-sm mt-1">
                    <span class="flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m0 4v10m-7-4h18m-2-8h2m-6 4h2m-2 4h2m-6 4h2m-6-4h2" />
                        </svg>
                        Local News
                    </span>
                    <span class="flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-6 4h4m-5 4h6m-9 4h12m-15 4h18" />
                        </svg>
                        Aug 12, 2025
                    </span>
                </div>
                <p class="mt-2 text-gray-600 text-sm">Short description goes here...</p>
            </div>
        </div>
    </div>
