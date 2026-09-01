<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title', 'Admin') | {{ config('app.name') }}</title>

        <link rel="icon" href="/dtilogo-icon.ico" sizes="any">

        <script src="{{asset('include/flowbite.js')}}"></script>
        <script src="{{asset('include/apexcharts.js')}}"></script>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @fluxScripts
        @livewireStyles()
        <script>
            // On page load or when changing themes, best to add inline in `head` to avoid FOUC
            if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark')
            }
        </script>
    </head>
    <body class="admin-shell bg-gray-100 text-gray-900 dark:bg-gray-950 dark:text-gray-100">
        @include('components.loading-screen')
        @include('sweetalert2::index')
        @yield('content')
        @include('auth.admin.partials.modals.user-add')
        @livewire('admin.question-add')
        @livewire('admin.adduser')
        @livewireScripts()
        <script src="{{asset('include/pie.js')}}"></script>
    </body>

</html>
