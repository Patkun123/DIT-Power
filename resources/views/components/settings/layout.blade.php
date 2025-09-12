<div class="w-full">
    <!-- Unified heading bar (merged settings-heading) -->
    <div class="sticky top-0 md:top-24 z-10 bg-gray-50 dark:bg-gray-900 border-b border-gray-200 dark:border-gray-800 px-4 md:px-6 py-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <a href="{{ route('index')}}" class="inline-flex items-center gap-2 px-3 py-2 rounded-full border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
                    <span class="text-xs font-medium">Back</span>
                </a>
                <div>
                    <flux:heading class="!text-base md:!text-xl">{{ $heading ?? '' }}</flux:heading>
                    @if(!empty($subheading))
                        <div class="hidden md:block">
                            <flux:subheading class="!text-xs md:!text-sm">{{ $subheading }}</flux:subheading>
                        </div>
                    @endif
                </div>
            </div>
            <!-- Fixed quick nav (desktop) -->
            <div class="hidden md:flex items-center gap-2">
                <a href="{{ route('settings.profile') }}" class="px-3 py-2 text-xs rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 {{ request()->routeIs('settings.profile') ? 'bg-gray-100 dark:bg-gray-800 font-semibold' : '' }}">Profile</a>
                <a href="{{ route('settings.password') }}" class="px-3 py-2 text-xs rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 {{ request()->routeIs('settings.password') ? 'bg-gray-100 dark:bg-gray-800 font-semibold' : '' }}">Password</a>
                <a href="{{ route('settings.appearance') }}" class="px-3 py-2 text-xs rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 {{ request()->routeIs('settings.appearance') ? 'bg-gray-100 dark:bg-gray-800 font-semibold' : '' }}">Appearance</a>
            </div>
            <!-- Mobile menu button -->
            <button id="settings-mobile-open" class="md:hidden p-2 rounded-lg text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18M3 12h18M3 18h18"/></svg>
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-12 gap-6 px-4 md:px-0">
        <!-- Sidebar -->
        <aside class="md:col-span-3 lg:col-span-3 xl:col-span-2 hidden md:block">
            <div class="sticky top-24">
                <div class="me-0 md:me-6 lg:me-10 w-full pb-4">
                    <flux:navlist>
                        <flux:navlist.item :href="route('settings.profile')" wire:navigate>{{ __('Profile') }}</flux:navlist.item>
                        <flux:navlist.item :href="route('settings.password')" wire:navigate>{{ __('Password') }}</flux:navlist.item>
                        <flux:navlist.item :href="route('settings.appearance')" wire:navigate>{{ __('Appearance') }}</flux:navlist.item>
                    </flux:navlist>
                </div>
            </div>
        </aside>

        <!-- Content -->
        <main class="md:col-span-9 lg:col-span-9 xl:col-span-10">
            <div class="hidden md:block">
                <flux:heading>{{ $heading ?? '' }}</flux:heading>
                <flux:subheading>{{ $subheading ?? '' }}</flux:subheading>
            </div>
            <div class="mt-5 w-full max-w-3xl">
                {{ $slot }}
            </div>
        </main>
    </div>

    <!-- Mobile drawer for settings navigation -->
    <div id="settings-mobile-drawer" class="fixed inset-0 z-40 hidden md:hidden">
        <div id="settings-mobile-backdrop" class="fixed inset-0 bg-black/40"></div>
        <div class="fixed left-0 top-0 h-full w-72 bg-white dark:bg-gray-800 shadow-xl transform -translate-x-full transition-transform duration-300 ease-in-out" id="settings-mobile-panel">
            <div class="p-4 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
                <div>
                    <div class="text-sm font-semibold text-gray-800 dark:text-gray-100">Settings</div>
                    <div class="text-xs text-gray-500 dark:text-gray-400">{{ $heading ?? '' }}</div>
                </div>
                <button id="settings-mobile-close" class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                    <svg class="w-5 h-5 text-gray-600 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <div class="p-4">
                <flux:navlist>
                    <flux:navlist.item :href="route('settings.profile')" wire:navigate>{{ __('Profile') }}</flux:navlist.item>
                    <flux:navlist.item :href="route('settings.password')" wire:navigate>{{ __('Password') }}</flux:navlist.item>
                    <flux:navlist.item :href="route('settings.appearance')" wire:navigate>{{ __('Appearance') }}</flux:navlist.item>
                </flux:navlist>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const openBtn = document.getElementById('settings-mobile-open');
    const drawer = document.getElementById('settings-mobile-drawer');
    const panel = document.getElementById('settings-mobile-panel');
    const backdrop = document.getElementById('settings-mobile-backdrop');
    const closeBtn = document.getElementById('settings-mobile-close');

    function openDrawer() {
        drawer.classList.remove('hidden');
        requestAnimationFrame(() => panel.classList.remove('-translate-x-full'));
    }
    function closeDrawer() {
        panel.classList.add('-translate-x-full');
        setTimeout(() => drawer.classList.add('hidden'), 300);
    }

    if (openBtn) openBtn.addEventListener('click', openDrawer);
    if (closeBtn) closeBtn.addEventListener('click', closeDrawer);
    if (backdrop) backdrop.addEventListener('click', closeDrawer);
});
</script>
