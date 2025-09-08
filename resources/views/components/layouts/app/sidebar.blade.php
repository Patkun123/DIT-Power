<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="bg-white dark:bg-gray-800">
        <!-- Loading Screen -->
        
        {{ $slot }}
        @fluxScripts
    </body>
</html>
