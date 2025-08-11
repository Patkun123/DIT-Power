<x-layouts.app.sidebar :title="$title ?? null">
    <flux:main>
        {{ $slot }}
        @yield('content')
    </flux:main>
</x-layouts.app.sidebar>
