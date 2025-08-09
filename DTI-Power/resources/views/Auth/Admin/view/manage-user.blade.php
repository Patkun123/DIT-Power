@extends('auth.admin.partials.layouts.app.head')

@section('title', 'manageusers')
@include('auth.admin.partials.layouts.side')
@include('auth.admin.partials.layouts.header')
@section('content')
<div class="h-70 md:h-80 w-full bg-gradient-to-r from-emerald-400 via-emerald-600 to-emerald-950">
    <div class="container mx-auto flex items-start justify-start h-full px-2 md:px-70">
        <div class="flex flex-col mt-40 md:mt-40">
            <h1 class="text-2xl md:text-4xl text-white">{{ auth()->user()->lastname }}, <b>User Management</b></h1>
            <span class="text-white text-sm md:text-base mt-2">Manage your User with ease</span>
        </div>
    </div>
</div>
 <main class="p-4 md:ml-64 h-auto pt-4">
    <div class="grid grid-cols-1 sm:grid-cols-2 transition-all hover:-translate-y-2 hover:shadow-emerald-500  shadow-md dark:bg-gray-800 border-2 dark:border-gray-800 bg-white p-3 rounded-xl lg:grid-cols-4 gap-4 mb-4">
        <div class="bg-gray-300 rounded-lg transition-all hover:-translate-y-2 hover:shadow-emerald-500  shadow-md dark:border-gray-600 h-32 md:h-35 items-center flex justify-center">
        </div>
        <div class="bg-gray-300 rounded-lg transition-all hover:-translate-y-2 hover:shadow-emerald-500  shadow-md dark:border-gray-600 h-32 md:h-35 items-center flex justify-center">
        </div>
        <div class="bg-gray-300 rounded-lg transition-all hover:-translate-y-2 hover:shadow-emerald-500  shadow-md dark:border-gray-600 h-32 md:h-35 items-center flex justify-center">
        </div>
        <div class="bg-gray-300 rounded-lg transition-all hover:-translate-y-2 hover:shadow-emerald-500  shadow-md dark:border-gray-600 h-32 md:h-35 items-center flex justify-center">
        </div>
      </div>
      <div class="bg-white dark:bg-gray-800 relative sm:rounded-lg overflow-hidden rounded-lg transition-all hover:-translate-y-2 hover:shadow-emerald-500  shadow-md border-gray-300 dark:border-gray-600 h-96 mb-4">
        @include('auth.admin.partials.layouts.app.tables.user-table')
      </div>
    </main>

@endsection
