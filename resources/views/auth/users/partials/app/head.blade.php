<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth md:scroll-auto">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>{{ $title ?? config('app.name') }} Personalized Online Wellness Resource HUB</title>

    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="dtilogo-icon" href="/dtilogo-icon.png">

    <script src="{{asset('include/flowbite.js')}}"></script>
    <script src="{{asset('include/apexcharts.js')}}"></script>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @fluxAppearance
    @fluxScripts
    <style>
        html,
        body {
            overflow-x: hidden;
            scroll-behavior: smooth;
        }
    </style>
    @livewireStyles
</head>

<body class="dark:bg-gray-900 bg-gray-100">
    @include('sweetalert2::index')
    @include('auth.users.partials.header')
    <section class="mt-16 lg:mt-20">
        @yield('content')
    </section>
    @stack('scripts')
    @livewireScripts
    <script>
        document.getElementById('scrollAllBtn')?.addEventListener('click', () => {
            const container = document.getElementById('answersContainer');
            container.scrollTo({
                top: container.scrollHeight,
                behavior: 'smooth'
            });
        });
    </script>
    <script src="{{asset('js/drawer.js')}}"></script>
</body>

</html>
