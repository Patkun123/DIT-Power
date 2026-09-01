<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="bg-white dark:bg-gray-800">
        <!-- Loading Screen -->
        {{ $slot }}
        @fluxScripts
        @livewireScripts
        <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <script src="{{asset('include/flowbite.js')}}"></script>
        <script src="{{asset('include/apexcharts.js')}}"></script>
    </body>
</html>
