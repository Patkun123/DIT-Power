<div class="w-full" id="settings-container">
    <div class="grid grid-cols-1 md:grid-cols-12 gap-6 lg:gap-8 px-4 md:px-6 lg:px-8 xl:px-12 py-8 lg:py-10">
        <!-- Modern Sidebar for Desktop -->
        <aside
            id="settings-sidebar"
            class="md:col-span-3 lg:col-span-3 xl:col-span-2 transition-all duration-300 block"
        >
            <div class="sticky top-32 lg:top-36">
                <div class="bg-white dark:bg-gray-800 rounded-3xl border border-gray-200/60 dark:border-gray-700/60 shadow-xl hover:shadow-2xl transition-all duration-300 p-6 lg:p-7 backdrop-blur-sm bg-white/95 dark:bg-gray-800/95">
                    <div class="mb-6">
                        <div class="flex items-center gap-3 px-2">
                            <div class="p-2 rounded-xl bg-gradient-to-br from-primary-500 to-primary-600 dark:from-primary-600 dark:to-primary-700 shadow-lg">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <h3 class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-widest">Settings</h3>
                        </div>
                    </div>
                    <nav class="space-y-2.5">
                        <a href="{{ route('settings.profile') }}" wire:navigate class="flex items-center gap-3.5 px-4 py-3.5 lg:py-4 rounded-2xl transition-all duration-200 group {{ request()->routeIs('settings.profile') ? 'bg-gradient-to-r from-primary-500 to-primary-600 dark:from-primary-600 dark:to-primary-700 text-white font-semibold shadow-lg shadow-primary-500/30 scale-105' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700/50 hover:translate-x-1 hover:shadow-md' }}">
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            <span class="text-sm font-semibold">{{ __('Profile') }}</span>
                        </a>
                        <a href="{{ route('settings.password') }}" wire:navigate class="flex items-center gap-3.5 px-4 py-3.5 lg:py-4 rounded-2xl transition-all duration-200 group {{ request()->routeIs('settings.password') ? 'bg-gradient-to-r from-primary-500 to-primary-600 dark:from-primary-600 dark:to-primary-700 text-white font-semibold shadow-lg shadow-primary-500/30 scale-105' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700/50 hover:translate-x-1 hover:shadow-md' }}">
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                            <span class="text-sm font-semibold">{{ __('Password') }}</span>
                        </a>
                        <a href="{{ route('settings.appearance') }}" wire:navigate class="flex items-center gap-3.5 px-4 py-3.5 lg:py-4 rounded-2xl transition-all duration-200 group {{ request()->routeIs('settings.appearance') ? 'bg-gradient-to-r from-primary-500 to-primary-600 dark:from-primary-600 dark:to-primary-700 text-white font-semibold shadow-lg shadow-primary-500/30 scale-105' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700/50 hover:translate-x-1 hover:shadow-md' }}">
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/>
                            </svg>
                            <span class="text-sm font-semibold">{{ __('Appearance') }}</span>
                        </a>
                    </nav>
                </div>
            </div>
        </aside>

        <!-- Modern Content Area -->
        <main id="settings-main" class="md:col-span-9 lg:col-span-9 xl:col-span-10 transition-all duration-300">
            <!-- Header with Back and Toggle buttons -->
            <div class="mb-6 flex items-center justify-between gap-4">
                <div class="flex items-center gap-3">
                    <a href="{{ route('index') }}" class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors duration-200">
                        <svg class="w-5 h-5 text-gray-700 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </a>

                    <!-- Mobile Menu Toggle -->
                    <button
                        id="settings-mobile-toggle"
                        class="md:hidden inline-flex items-center justify-center w-10 h-10 rounded-full bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors duration-200"
                        aria-label="Toggle sidebar"
                    >
                        <svg class="w-5 h-5 text-gray-700 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>

                <!-- Desktop Sidebar Toggle -->
                <button
                    id="settings-desktop-toggle"
                    class="hidden md:flex items-center gap-2 px-4 py-2 rounded-lg bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors duration-200 text-gray-700 dark:text-gray-300"
                    aria-label="Toggle sidebar"
                >
                    <svg id="toggle-icon-menu" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg id="toggle-icon-close" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    <span id="toggle-text" class="text-sm font-medium">Hide Menu</span>
                </button>
            </div>

            <div class="hidden md:block mb-10 lg:mb-12">
                <div class="flex items-center gap-5 mb-4">
                    <div class="p-4 rounded-2xl bg-gradient-to-br from-primary-500 to-primary-600 dark:from-primary-600 dark:to-primary-700 shadow-xl shadow-primary-500/20">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <flux:heading class="text-3xl lg:text-4xl font-bold bg-gradient-to-r from-gray-900 via-gray-800 to-gray-900 dark:from-gray-100 dark:via-gray-200 dark:to-gray-100 bg-clip-text text-transparent">{{ $heading ?? '' }}</flux:heading>
                        <flux:subheading class="text-base lg:text-lg mt-2.5 text-gray-600 dark:text-gray-400 font-medium">{{ $subheading ?? '' }}</flux:subheading>
                    </div>
                </div>
            </div>
            <div class="w-full max-w-5xl xl:max-w-6xl">
                {{ $slot }}
            </div>
        </main>
    </div>

    <!-- Modern mobile drawer for settings navigation -->
    <div
        id="settings-mobile-drawer"
        class="fixed inset-0 z-40 md:hidden hidden"
    >
        <div
            id="settings-mobile-backdrop"
            class="fixed inset-0 bg-black/60 backdrop-blur-md transition-opacity duration-300"
        ></div>
        <div
            class="fixed left-0 top-0 h-full w-80 bg-white dark:bg-gray-800 shadow-2xl transition-transform duration-300 ease-in-out -translate-x-full"
            id="settings-mobile-panel"
        >
            <div class="p-6 border-b border-gray-200/60 dark:border-gray-700/60 bg-gradient-to-br from-primary-500/10 via-primary-50 to-white dark:from-primary-900/30 dark:via-gray-800 dark:to-gray-900">
                <div class="flex items-center justify-between mb-5">
                    <div class="flex items-center gap-3.5">
                        <div class="p-2.5 rounded-xl bg-gradient-to-br from-primary-500 to-primary-600 dark:from-primary-600 dark:to-primary-700 shadow-lg">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <div>
                            <div class="text-base font-bold text-gray-800 dark:text-gray-100">Settings</div>
                            <div class="text-xs text-gray-500 dark:text-gray-400 font-medium">{{ $heading ?? '' }}</div>
                        </div>
                    </div>
                    <button
                        id="settings-mobile-close"
                        class="p-2.5 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-700 transition-all duration-200 border border-gray-200 dark:border-gray-700"
                    >
                        <svg class="w-6 h-6 text-gray-600 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
            </div>
            <div class="p-5">
                <nav class="space-y-2.5">
                    <a href="{{ route('settings.profile') }}" wire:navigate class="flex items-center gap-3.5 px-4 py-3.5 rounded-2xl transition-all duration-200 {{ request()->routeIs('settings.profile') ? 'bg-gradient-to-r from-primary-500 to-primary-600 dark:from-primary-600 dark:to-primary-700 text-white font-semibold shadow-lg shadow-primary-500/30' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700/50 border border-gray-200 dark:border-gray-700' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        <span class="text-sm font-semibold">{{ __('Profile') }}</span>
                    </a>
                    <a href="{{ route('settings.password') }}" wire:navigate class="flex items-center gap-3.5 px-4 py-3.5 rounded-2xl transition-all duration-200 {{ request()->routeIs('settings.password') ? 'bg-gradient-to-r from-primary-500 to-primary-600 dark:from-primary-600 dark:to-primary-700 text-white font-semibold shadow-lg shadow-primary-500/30' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700/50 border border-gray-200 dark:border-gray-700' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        <span class="text-sm font-semibold">{{ __('Password') }}</span>
                    </a>
                    <a href="{{ route('settings.appearance') }}" wire:navigate class="flex items-center gap-3.5 px-4 py-3.5 rounded-2xl transition-all duration-200 {{ request()->routeIs('settings.appearance') ? 'bg-gradient-to-r from-primary-500 to-primary-600 dark:from-primary-600 dark:to-primary-700 text-white font-semibold shadow-lg shadow-primary-500/30' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700/50 border border-gray-200 dark:border-gray-700' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/>
                        </svg>
                        <span class="text-sm font-semibold">{{ __('Appearance') }}</span>
                    </a>
                </nav>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const sidebar = document.getElementById('settings-sidebar');
    const main = document.getElementById('settings-main');
    const mobileDrawer = document.getElementById('settings-mobile-drawer');
    const mobilePanel = document.getElementById('settings-mobile-panel');
    const mobileBackdrop = document.getElementById('settings-mobile-backdrop');
    const mobileToggle = document.getElementById('settings-mobile-toggle');
    const mobileClose = document.getElementById('settings-mobile-close');
    const desktopToggle = document.getElementById('settings-desktop-toggle');
    const toggleIconMenu = document.getElementById('toggle-icon-menu');
    const toggleIconClose = document.getElementById('toggle-icon-close');
    const toggleText = document.getElementById('toggle-text');

    let sidebarOpen = window.innerWidth >= 768;

    function updateSidebarState() {
        if (window.innerWidth >= 768) {
            // Desktop view
            if (sidebarOpen) {
                sidebar.classList.remove('hidden');
                sidebar.classList.add('block');
                main.classList.remove('md:col-span-12');
                main.classList.add('md:col-span-9', 'lg:col-span-9', 'xl:col-span-10');
                toggleIconMenu.classList.add('hidden');
                toggleIconClose.classList.remove('hidden');
                toggleText.textContent = 'Hide Menu';
            } else {
                sidebar.classList.add('hidden');
                sidebar.classList.remove('block');
                main.classList.remove('md:col-span-9', 'lg:col-span-9', 'xl:col-span-10');
                main.classList.add('md:col-span-12');
                toggleIconMenu.classList.remove('hidden');
                toggleIconClose.classList.add('hidden');
                toggleText.textContent = 'Show Menu';
            }
            mobileDrawer.classList.add('hidden');
        } else {
            // Mobile view
            sidebar.classList.add('hidden');
            if (sidebarOpen) {
                mobileDrawer.classList.remove('hidden');
                setTimeout(() => {
                    mobilePanel.classList.remove('-translate-x-full');
                    mobilePanel.classList.add('translate-x-0');
                }, 10);
                document.body.style.overflow = 'hidden';
            } else {
                mobilePanel.classList.remove('translate-x-0');
                mobilePanel.classList.add('-translate-x-full');
                setTimeout(() => {
                    mobileDrawer.classList.add('hidden');
                }, 300);
                document.body.style.overflow = '';
            }
        }
    }

    function toggleSidebar() {
        sidebarOpen = !sidebarOpen;
        updateSidebarState();
    }

    // Desktop toggle
    if (desktopToggle) {
        desktopToggle.addEventListener('click', toggleSidebar);
    }

    // Mobile toggle
    if (mobileToggle) {
        mobileToggle.addEventListener('click', () => {
            sidebarOpen = true;
            updateSidebarState();
        });
    }

    // Mobile close
    if (mobileClose) {
        mobileClose.addEventListener('click', () => {
            sidebarOpen = false;
            updateSidebarState();
        });
    }

    // Mobile backdrop close
    if (mobileBackdrop) {
        mobileBackdrop.addEventListener('click', () => {
            sidebarOpen = false;
            updateSidebarState();
        });
    }

    // Handle window resize
    let resizeTimer;
    window.addEventListener('resize', () => {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(() => {
            if (window.innerWidth >= 768) {
                sidebarOpen = true; // Show sidebar by default on desktop
            } else {
                sidebarOpen = false; // Hide sidebar by default on mobile
            }
            updateSidebarState();
        }, 250);
    });

    // Initialize
    updateSidebarState();
});
</script>
