@extends('auth.admin.partials.layouts.app.head')

@section('title', 'feedbacks')
@include('auth.admin.partials.layouts.side')
@include('auth.admin.partials.layouts.header')
@section('content')
<div class="h-70 md:h-80 w-full bg-gradient-to-l from-primary-400 via-primary-600 to-lime-700">
    <div class="container mx-auto flex items-start justify-start h-full px-2 md:px-70">
        <div class="flex flex-col mt-40 md:mt-40">
            <h1 class="text-2xl md:text-4xl text-white">{{ auth()->user()->lastname }}, <b>Feedback Management</b></h1>
            <span class="text-white text-sm md:text-base mt-2">Manage Feedback with ease</span>
        </div>
    </div>
</div>
@endsection
