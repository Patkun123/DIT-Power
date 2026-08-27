<div class="w-full min-h-screen bg-[#f0f2f5] dark:bg-[#18191a] -m-4 md:-m-6 lg:-m-8 p-0">
    <div class="max-w-[1000px] mx-auto grid grid-cols-1 md:grid-cols-12 gap-0 md:gap-6 px-0 md:px-6 py-0 md:py-6">

        <!-- ============ Sidebar (Facebook style) ============ -->
        <aside class="md:col-span-4 lg:col-span-4 hidden md:block">
            <div class="sticky top-20">

                <!-- Header -->
                <div class="px-2 mb-2">
                    <h1 class="text-[28px] font-bold text-gray-900 dark:text-gray-100 leading-tight">Settings</h1>
                </div>

                <!-- Search -->
                <div class="px-2 mb-3">
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z"/>
                        </svg>
                        <input type="text" placeholder="Search settings"
                            class="w-full bg-[#f0f2f5] dark:bg-[#3a3b3c] border-none rounded-full pl-9 pr-3 py-2 text-sm text-gray-800 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-500/40" />
                    </div>
                </div>

                <!-- Nav -->
                <nav class="space-y-0.5">
                    <a href="{{ route('settings.profile') }}" wire:navigate
                        class="flex items-center gap-3 px-2 py-2.5 rounded-lg transition-colors duration-100 {{ request()->routeIs('settings.profile') ? 'bg-blue-50 dark:bg-[#263951]' : 'hover:bg-gray-200/70 dark:hover:bg-[#3a3b3c]' }}">
                        <span class="flex items-center justify-center w-9 h-9 rounded-full bg-blue-500 flex-shrink-0">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </span>
                        <span class="text-[15px] {{ request()->routeIs('settings.profile') ? 'font-semibold text-blue-600 dark:text-blue-400' : 'font-medium text-gray-900 dark:text-gray-100' }}">
                            {{ __('Profile') }}
                        </span>
                    </a>

                    <a href="{{ route('settings.password') }}" wire:navigate
                        class="flex items-center gap-3 px-2 py-2.5 rounded-lg transition-colors duration-100 {{ request()->routeIs('settings.password') ? 'bg-blue-50 dark:bg-[#263951]' : 'hover:bg-gray-200/70 dark:hover:bg-[#3a3b3c]' }}">
                        <span class="flex items-center justify-center w-9 h-9 rounded-full bg-green-500 flex-shrink-0">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </span>
                        <span class="text-[15px] {{ request()->routeIs('settings.password') ? 'font-semibold text-blue-600 dark:text-blue-400' : 'font-medium text-gray-900 dark:text-gray-100' }}">
                            {{ __('Password & Security') }}
                        </span>
                    </a>

                    <a href="{{ route('settings.appearance') }}" wire:navigate
                        class="flex items-center gap-3 px-2 py-2.5 rounded-lg transition-colors duration-100 {{ request()->routeIs('settings.appearance') ? 'bg-blue-50 dark:bg-[#263951]' : 'hover:bg-gray-200/70 dark:hover:bg-[#3a3b3c]' }}">
                        <span class="flex items-center justify-center w-9 h-9 rounded-full bg-purple-500 flex-shrink-0">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/>
                            </svg>
                        </span>
                        <span class="text-[15px] {{ request()->routeIs('settings.appearance') ? 'font-semibold text-blue-600 dark:text-blue-400' : 'font-medium text-gray-900 dark:text-gray-100' }}">
                            {{ __('Appearance') }}
                        </span>
                    </a>
                </nav>
            </div>
        </aside>

        <!-- ============ Content ============ -->
        <main class="md:col-span-8 lg:col-span-8">
            <!-- Mobile top bar -->
            <div class="md:hidden sticky top-0 z-20 bg-white dark:bg-[#242526] border-b border-gray-200 dark:border-gray-700 px-3 py-3 flex items-center gap-3">
                <a href="{{ route('index') }}" class="inline-flex items-center justify-center w-9 h-9 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                    <svg class="w-5 h-5 text-gray-800 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </a>
                <div>
                    <div class="text-[17px] font-bold text-gray-900 dark:text-gray-100 leading-tight">{{ $heading ?? '' }}</div>
                </div>
                <button id="settings-mobile-open" class="ml-auto inline-flex items-center justify-center w-9 h-9 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                    <svg class="w-5 h-5 text-gray-800 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>

            <!-- Desktop header -->
            <div class="hidden md:block px-2 pt-1 pb-4">
                <a href="{{ route('index') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 mb-2 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Back
                </a>
                <h2 class="text-xl font-bold text-gray-900 dark:text-gray-100">{{ $heading ?? '' }}</h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">{{ $subheading ?? '' }}</p>
            </div>

            <div class="w-full px-3 md:px-0 py-4 md:py-0">
                {{ $slot }}
            </div>
        </main>
    </div>

    <!-- ============ Mobile drawer ============ -->
    <div id="settings-mobile-drawer" class="fixed inset-0 z-40 hidden md:hidden">
        <div id="settings-mobile-backdrop" class="fixed inset-0 bg-black/50"></div>
        <div class="fixed left-0 top-0 h-full w-[85%] max-w-xs bg-white dark:bg-[#242526] shadow-xl transform -translate-x-full transition-transform duration-250 ease-out" id="settings-mobile-panel">
            <div class="px-4 py-4 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
                <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">Settings</h3>
                <button id="settings-mobile-close" class="w-9 h-9 rounded-full flex items-center justify-center hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                    <svg class="w-5 h-5 text-gray-700 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <nav class="p-3 space-y-0.5">
                <a href="{{ route('settings.profile') }}" wire:navigate class="flex items-center gap-3 px-3 py-3 rounded-lg {{ request()->routeIs('settings.profile') ? 'bg-blue-50 dark:bg-[#263951]' : 'hover:bg-gray-100 dark:hover:bg-[#3a3b3c]' }}">
                    <span class="flex items-center justify-center w-9 h-9 rounded-full bg-blue-500 flex-shrink-0">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </span>
                    <span class="text-[15px] {{ request()->routeIs('settings.profile') ? 'font-semibold text-blue-600 dark:text-blue-400' : 'font-medium text-gray-900 dark:text-gray-100' }}">{{ __('Profile') }}</span>
                </a>
                <a href="{{ route('settings.password') }}" wire:navigate class="flex items-center gap-3 px-3 py-3 rounded-lg {{ request()->routeIs('settings.password') ? 'bg-blue-50 dark:bg-[#263951]' : 'hover:bg-gray-100 dark:hover:bg-[#3a3b3c]' }}">
                    <span class="flex items-center justify-center w-9 h-9 rounded-full bg-green-500 flex-shrink-0">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    </span>
                    <span class="text-[15px] {{ request()->routeIs('settings.password') ? 'font-semibold text-blue-600 dark:text-blue-400' : 'font-medium text-gray-900 dark:text-gray-100' }}">{{ __('Password & Security') }}</span>
                </a>
                <a href="{{ route('settings.appearance') }}" wire:navigate class="flex items-center gap-3 px-3 py-3 rounded-lg {{ request()->routeIs('settings.appearance') ? 'bg-blue-50 dark:bg-[#263951]' : 'hover:bg-gray-100 dark:hover:bg-[#3a3b3c]' }}">
                    <span class="flex items-center justify-center w-9 h-9 rounded-full bg-purple-500 flex-shrink-0">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/></svg>
                    </span>
                    <span class="text-[15px] {{ request()->routeIs('settings.appearance') ? 'font-semibold text-blue-600 dark:text-blue-400' : 'font-medium text-gray-900 dark:text-gray-100' }}">{{ __('Appearance') }}</span>
                </a>
            </nav>
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
        setTimeout(() => drawer.classList.add('hidden'), 250);
    }

    if (openBtn) openBtn.addEventListener('click', openDrawer);
    if (closeBtn) closeBtn.addEventListener('click', closeDrawer);
    if (backdrop) backdrop.addEventListener('click', closeDrawer);
});
</script>
