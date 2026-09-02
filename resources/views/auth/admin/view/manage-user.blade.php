@extends('auth.admin.partials.layouts.app.head')

@section('title', 'User Management')
@include('auth.admin.partials.layouts.side')
@include('auth.admin.partials.layouts.header')
@section('content')
<div class="admin-page-hero">
    <div class="admin-page-hero-inner">
        <h1>{{ auth()->user()->lastname }}, <b>User Management</b></h1>
        <p>Manage your users and access</p>
    </div>
</div>
 <main class="admin-page-main p-4 md:ml-64 h-auto">
    <div class="grid grid-cols-1 sm:grid-cols-2 transition-all hover:-translate-y-2 hover:shadow-primary-500  shadow-md dark:bg-gray-800 border-2 dark:border-gray-800 bg-white p-3 rounded-xl lg:grid-cols-4 gap-4 mb-4">
        <div class="dark:bg-gray-900 hover:dark:text-gray-950 text-lg font-semibold bg-gray-50 rounded-lg transition-all hover:-translate-y-2 hover:bg-primary-400 shadow-primary-500 shadow-md dark:border-gray-600 h-32 md:h-35 flex items-center justify-center space-x-4 p-4">
            <flux:button icon="user-group" variant="primary" color="amber" class="" />
            <div class="">
                <h2 class="font-semibold">Daily Users</h2>
                <span class="font-bold text-3xl">{{ $dailyUsers ?? 0 }}</span>
            </div>
        </div>
        <div class="dark:bg-gray-900 hover:dark:text-gray-950 text-lg font-semibold bg-gray-50 rounded-lg transition-all hover:-translate-y-2 hover:bg-primary-400 shadow-primary-500 shadow-md dark:border-gray-600 h-32 md:h-35 flex items-center justify-center space-x-4 p-4">
            <flux:button icon="user-group" variant="primary" color="amber" class="" />
            <div class="">
                <h2 class="font-semibold">Weekly Users</h2>
                <span class="font-bold text-3xl">{{ $weeklyUsers ?? 0 }}</span>
            </div>
        </div>
        <div class="dark:bg-gray-900 hover:dark:text-gray-950 text-lg font-semibold bg-gray-50 rounded-lg transition-all hover:-translate-y-2 hover:bg-primary-400 shadow-primary-500 shadow-md dark:border-gray-600 h-32 md:h-35 flex items-center justify-center space-x-4 p-4">
            <flux:button icon="user-group" variant="primary" color="amber" class="" />
            <div class="">
                <h2 class="font-semibold">Monthly Users</h2>
                <span class="font-bold text-3xl">{{ $monthlyUsers ?? 0 }}</span>
            </div>
        </div>
        <div class="dark:bg-gray-900 hover:dark:text-gray-950 text-lg font-semibold bg-gray-50 rounded-lg transition-all hover:-translate-y-2 hover:bg-primary-400 shadow-primary-500 shadow-md dark:border-gray-600 h-32 md:h-35 flex items-center justify-center space-x-4 p-4">
            <flux:button icon="user-group" variant="primary" color="amber" class="" />
            <div class="">
                <h2 class="font-semibold">Total Users</h2>
                <span class="font-bold text-3xl">{{ $totalUsers ?? 0 }}</span>
            </div>
        </div>
      </div>
    <div class="admin-surface relative overflow-hidden h-96 mb-4">
        @include('auth.admin.partials.layouts.app.tables.user-table')
      </div>
    </main>

@endsection
