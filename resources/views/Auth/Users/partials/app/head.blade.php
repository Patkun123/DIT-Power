<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth md:scroll-auto">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <title>{{ $title ?? config('app.name') }} Personalized Online Wellness Resource HUB</title>

        <link rel="icon" href="/images/favicon.ico" sizes="any">
        <script src="{{asset('include/flowbite.js')}}"></script>
        <script src="{{asset('include/apexcharts.js')}}"></script>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @fluxAppearance
        @fluxScripts
                <style>
            html, body {
                overflow-x: hidden;
                scroll-behavior: smooth;
            }
        </style>
        @livewireStyles
    </head>
    <body class="dark:bg-gray-900 bg-gray-100">
        @include('auth.users.partials.header')
        <section class="mt-20">
       @yield('content')
       </section>
        @stack('scripts')
        @livewireScripts
    </body>

</html>
