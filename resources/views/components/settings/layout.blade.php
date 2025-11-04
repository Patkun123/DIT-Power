<div class="w-full min-h-screen bg-gray-50 dark:bg-gray-900">
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-lime-500 via-lime-600 to-lime-700 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <a href="{{ route('index')}}" class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/20 backdrop-blur-sm text-white hover:bg-white/30 transition-all duration-200">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="15 18 9 12 15 6" />
                        </svg>
                        <span class="text-sm font-medium">Back to Dashboard</span>
                    </a>
                    <div>
                        <h1 class="text-2xl md:text-3xl font-bold">{{ $heading ?? 'Settings' }}</h1>
                        @if(!empty($subheading))
                        <p class="text-lime-100 text-sm md:text-base mt-1">{{ $subheading }}</p>
                        @endif
                    </div>
                </div>
                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center gap-1 bg-white/10 backdrop-blur-sm rounded-lg p-1">
                    <a href="{{ route('settings.profile') }}" class="px-4 py-2 text-sm font-medium rounded-md transition-all duration-200 {{ request()->routeIs('settings.profile') ? 'bg-white text-lime-700 shadow-sm' : 'text-white hover:bg-white/20' }}">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Profile
                        </div>
                    </a>
                    <a href="{{ route('settings.password') }}" class="px-4 py-2 text-sm font-medium rounded-md transition-all duration-200 {{ request()->routeIs('settings.password') ? 'bg-white text-lime-700 shadow-sm' : 'text-white hover:bg-white/20' }}">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                            Password
                        </div>
                    </a>
                    <a href="{{ route('settings.appearance') }}" class="px-4 py-2 text-sm font-medium rounded-md transition-all duration-200 {{ request()->routeIs('settings.appearance') ? 'bg-white text-lime-700 shadow-sm' : 'text-white hover:bg-white/20' }}">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zM21 5a2 2 0 00-2-2h-4a2 2 0 00-2 2v12a4 4 0 004 4h4a2 2 0 002-2V5z" />
                            </svg>
                            Appearance
                        </div>
                    </a>
                </div>
                <!-- Mobile menu button -->
                <button id="settings-mobile-open" class="md:hidden p-2 rounded-lg bg-white/20 backdrop-blur-sm text-white hover:bg-white/30 transition-all duration-200">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 6h18M3 12h18M3 18h18" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Sidebar -->
            <aside class="lg:col-span-1">
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 sticky top-8">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Settings</h3>
                    <nav class="space-y-2">
                        <a href="{{ route('settings.profile') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('settings.profile') ? 'bg-lime-50 text-lime-700 dark:bg-lime-900/20 dark:text-lime-400' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Profile Information
                        </a>
                        <a href="{{ route('settings.password') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('settings.password') ? 'bg-lime-50 text-lime-700 dark:bg-lime-900/20 dark:text-lime-400' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                            Password & Security
                        </a>
                        <a href="{{ route('settings.appearance') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('settings.appearance') ? 'bg-lime-50 text-lime-700 dark:bg-lime-900/20 dark:text-lime-400' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zM21 5a2 2 0 00-2-2h-4a2 2 0 00-2 2v12a4 4 0 004 4h4a2 2 0 002-2V5z" />
                            </svg>
                            Appearance
                        </a>
                    </nav>
                </div>
            </aside>

            <!-- Content -->
            <main class="lg:col-span-3">
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>

    <!-- Mobile drawer for settings navigation -->
    <div id="settings-mobile-drawer" class="fixed inset-0 z-40 hidden md:hidden">
        <div id="settings-mobile-backdrop" class="fixed inset-0 bg-black/50 backdrop-blur-sm"></div>
        <div class="fixed left-0 top-0 h-full w-80 bg-white dark:bg-gray-800 shadow-2xl transform -translate-x-full transition-transform duration-300 ease-in-out" id="settings-mobile-panel">
            <div class="p-6 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
                <div>
                    <div class="text-lg font-semibold text-gray-900 dark:text-white">Settings</div>
                    <div class="text-sm text-gray-500 dark:text-gray-400">{{ $heading ?? '' }}</div>
                </div>
                <button id="settings-mobile-close" class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                    <svg class="w-5 h-5 text-gray-600 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="p-6">
                <nav class="space-y-2">
                    <a href="{{ route('settings.profile') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('settings.profile') ? 'bg-lime-50 text-lime-700 dark:bg-lime-900/20 dark:text-lime-400' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Profile Information
                    </a>
                    <a href="{{ route('settings.password') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('settings.password') ? 'bg-lime-50 text-lime-700 dark:bg-lime-900/20 dark:text-lime-400' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        Password & Security
                    </a>
                    <a href="{{ route('settings.appearance') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('settings.appearance') ? 'bg-lime-50 text-lime-700 dark:bg-lime-900/20 dark:text-lime-400' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zM21 5a2 2 0 00-2-2h-4a2 2 0 00-2 2v12a4 4 0 004 4h4a2 2 0 002-2V5z" />
                        </svg>
                        Appearance
                    </a>
                </nav>
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