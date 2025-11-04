<header class="fixed w-full top-0 z-50 bg-white/95 dark:bg-gray-800/95 backdrop-blur-md border-b border-gray-200/20 dark:border-gray-700/20 shadow-lg shadow-gray-900/5 dark:shadow-gray-900/20">
    <nav class="h-16 px-4 lg:px-8">
        <div class="flex items-center justify-between h-full max-w-7xl mx-auto">
            <!-- Logo Section -->
            <a href="{{route('index')}}" class="flex items-center space-x-2 group">
                <!-- Light mode logos -->
                <div class="flex items-center space-x-2 dark:hidden">
                    <img src="/images/DTI_w12.png" class="h-8 w-16 transition-transform duration-300 group-hover:scale-105" alt="DTI Logo" />
                    <img src="/images/lightmode.png" class="h-10 transition-transform duration-300 group-hover:scale-105" alt="DTI Wellness" />
                </div>
                <!-- Dark mode logos -->
                <div class="hidden dark:flex items-center space-x-2">
                    <img src="/images/DTI_w12.png" class="h-8 w-16 transition-transform duration-300 group-hover:scale-105" alt="DTI Logo" />
                    <img src="/images/final.png" class="h-10 transition-transform duration-300 group-hover:scale-105" alt="DTI Wellness" />
                </div>
            </a>

            <!-- Desktop Navigation -->
            <div class="hidden lg:flex items-center space-x-1">
                <nav class="flex items-center space-x-1">
                    <!-- Home -->
                    <a href="{{ route('index') }}"
                        class="flex items-center space-x-2 px-3 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('index') 
                           ? 'text-primary-700 dark:text-primary-400 bg-primary-50 dark:bg-primary-900/20' 
                           : 'text-gray-700 dark:text-gray-300 hover:text-primary-700 dark:hover:text-primary-400 hover:bg-gray-50 dark:hover:bg-gray-800' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        <span>Home</span>
                    </a>

                    <!-- Journal -->
                    <a href="{{ route('journal') }}"
                        class="flex items-center space-x-2 px-3 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('journal') 
                           ? 'text-primary-700 dark:text-primary-400 bg-primary-50 dark:bg-primary-900/20' 
                           : 'text-gray-700 dark:text-gray-300 hover:text-primary-700 dark:hover:text-primary-400 hover:bg-gray-50 dark:hover:bg-gray-800' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        <span>Journal</span>
                    </a>

                    <!-- Nutrition -->
                    <a href="{{ route('nutrition') }}"
                        class="flex items-center space-x-2 px-3 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('nutrition') 
                           ? 'text-primary-700 dark:text-primary-400 bg-primary-50 dark:bg-primary-900/20' 
                           : 'text-gray-700 dark:text-gray-300 hover:text-primary-700 dark:hover:text-primary-400 hover:bg-gray-50 dark:hover:bg-gray-800' }}">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-1-13h2v6h-2zm0 8h2v2h-2z" />
                        </svg>
                        <span>Nutrition</span>
                    </a>

                    <!-- Games & Quizzes Dropdown -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" @click.away="open = false"
                            class="flex items-center space-x-2 px-3 py-2 rounded-lg text-sm font-medium transition-all duration-200 text-gray-700 dark:text-gray-300 hover:text-primary-700 dark:hover:text-primary-400 hover:bg-gray-50 dark:hover:bg-gray-800">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>Games & Quizzes</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div x-show="open"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="opacity-100 scale-100"
                            x-transition:leave-end="opacity-0 scale-95"
                            class="absolute left-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700 py-1 z-50">
                            <a href="{{ route('quiz') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">Quizzes</a>
                            <a href="{{ route('scramble') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">Scramble Word</a>
                        </div>
                    </div>

                    <!-- Well-being Tools Dropdown -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" @click.away="open = false"
                            class="flex items-center space-x-2 px-3 py-2 rounded-lg text-sm font-medium transition-all duration-200 text-gray-700 dark:text-gray-300 hover:text-primary-700 dark:hover:text-primary-400 hover:bg-gray-50 dark:hover:bg-gray-800">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                            <span>Well-being Tools</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div x-show="open"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="opacity-100 scale-100"
                            x-transition:leave-end="opacity-0 scale-95"
                            class="absolute left-0 mt-2 w-56 bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700 py-1 z-50">
                            <a href="{{ route('physical.tools') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">Physical Well-Being</a>
                            <a href="{{ route('mental.tools') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">Mental Well-Being</a>
                            <a href="{{ route('emotional.tools') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">Emotional Well-Being</a>
                            <a href="{{ route('financial.tools') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">Financial Well-being</a>
                            <a href="{{ route('social.tools') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">Social Well-being</a>
                        </div>
                    </div>

                    <!-- Policies -->
                    <a href="{{ route('policies') }}"
                        class="flex items-center space-x-2 px-3 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('policies') 
                           ? 'text-primary-700 dark:text-primary-400 bg-primary-50 dark:bg-primary-900/20' 
                           : 'text-gray-700 dark:text-gray-300 hover:text-primary-700 dark:hover:text-primary-400 hover:bg-gray-50 dark:hover:bg-gray-800' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <span>Policies</span>
                    </a>
                </nav>
            </div>

            <!-- Right Side Actions -->
            <div class="flex items-center space-x-2">
                <!-- Notifications -->
                @if(Auth::check())
                <div class="relative">
                    @livewire('notification-bell')
                </div>
                @endif

                <!-- Dark Mode Toggle -->
                <button x-data x-on:click="$flux.dark = ! $flux.dark"
                    class="p-2 rounded-lg text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-primary-500/20">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!$flux.dark" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                        <path x-show="$flux.dark" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </button>

                <!-- User Actions -->
                @if (Auth::check())
                @if (Auth::user()->role == 'admin')
                <a href="{{route('dashboard')}}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 rounded-lg shadow-sm hover:shadow-md transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-primary-500/20">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v2H8V5z" />
                    </svg>
                    Dashboard
                </a>
                @elseif (Auth::user()->role == 'user')
                <!-- User Profile Dropdown -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" @click.away="open = false"
                        class="flex items-center space-x-2 p-1 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-primary-500/20">
                        @if (auth()->user()->profileimage)
                        <img src="{{ asset('storage/' . auth()->user()->profileimage) }}"
                            alt="Profile"
                            class="w-8 h-8 rounded-full object-cover border-2 border-gray-200 dark:border-gray-600">
                        @else
                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-primary-500 to-primary-600 flex items-center justify-center text-white text-sm font-medium">
                            {{ substr(auth()->user()->firstname, 0, 1) }}{{ substr(auth()->user()->lastname, 0, 1) }}
                        </div>
                        @endif
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <!-- Dropdown Menu -->
                    <div x-show="open"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 scale-95"
                        x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="opacity-100 scale-100"
                        x-transition:leave-end="opacity-0 scale-95"
                        class="absolute right-0 mt-2 w-64 bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 z-50">
                        <!-- User Info -->
                        <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700">
                            <div class="flex items-center space-x-3">
                                @if (auth()->user()->profileimage)
                                <img src="{{ asset('storage/' . auth()->user()->profileimage) }}"
                                    alt="Profile"
                                    class="w-10 h-10 rounded-full object-cover border-2 border-gray-200 dark:border-gray-600">
                                @else
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-primary-500 to-primary-600 flex items-center justify-center text-white font-medium">
                                    {{ substr(auth()->user()->firstname, 0, 1) }}{{ substr(auth()->user()->lastname, 0, 1) }}
                                </div>
                                @endif
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white truncate">
                                        {{ auth()->user()->firstname }} {{ auth()->user()->lastname }}
                                    </p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 truncate">
                                        {{ auth()->user()->email }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Menu Items -->
                        <div class="py-2">
                            <a href="{{ route('settings.profile') }}"
                                class="flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Account Settings
                            </a>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="flex items-center w-full px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors duration-200">
                                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endif
                @else
                <a href="{{route('login')}}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 rounded-lg shadow-sm hover:shadow-md transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-primary-500/20">
                    Get Started
                </a>
                @endif

                <!-- Mobile Menu Toggle -->
                <button id="mobile-sidebar-toggle" type="button"
                    class="lg:hidden p-2 rounded-lg text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-primary-500/20">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </nav>
</header>

<!-- Mobile Sidebar -->
<div id="mobile-sidebar" class="fixed inset-0 z-50 lg:hidden hidden">
    <!-- Backdrop -->
    <div id="mobile-sidebar-backdrop" class="fixed inset-0 bg-gray-900 bg-opacity-50 transition-opacity duration-300"></div>

    <!-- Sidebar -->
    <div class="fixed left-0 top-0 h-full w-80 bg-white dark:bg-gray-800 shadow-xl transform -translate-x-full transition-transform duration-300 ease-in-out overflow-y-auto overscroll-contain" id="mobile-sidebar-content">
        <!-- Sidebar Header -->
        <div class="flex items-center justify-between p-4 border-b border-gray-200 dark:border-gray-700">
            <div class="flex items-center space-x-2">
                <!-- Light mode logos -->
                <div class="flex items-center space-x-2 dark:hidden">
                    <img src="/images/DTI_w12.png" class="h-6 w-6" alt="DTI Logo" />
                    <img src="/images/lightmode.png" class="h-8" alt="DTI Wellness" />
                </div>
                <!-- Dark mode logos -->
                <div class="hidden dark:flex items-center space-x-2">
                    <img src="/images/DTI_w12.png" class="h-6 w-6" alt="DTI Logo" />
                    <img src="/images/final.png" class="h-8" alt="DTI Wellness" />
                </div>
            </div>
            <!-- Close Button -->
            <button id="mobile-sidebar-close" class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                <svg class="w-6 h-6 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- User Info -->
        @if(Auth::check())
        <div class="p-4 border-b border-gray-200 dark:border-gray-700">
            <div class="flex items-center space-x-3">
                @if(auth()->user()->profileimage)
                <img src="{{ asset('storage/' . auth()->user()->profileimage) }}" alt="Profile" class="w-12 h-12 rounded-full object-cover border-2 border-gray-300 dark:border-gray-600">
                @else
                <img src="{{ asset('images/default.png') }}" alt="Default Profile" class="w-12 h-12 rounded-full object-cover border-2 border-gray-300 dark:border-gray-600">
                @endif
                <div>
                    <div class="font-medium text-gray-800 dark:text-white">{{ auth()->user()->firstname }} {{ auth()->user()->lastname }}</div>
                    <div class="text-sm text-gray-500 dark:text-gray-400">{{ auth()->user()->email }}</div>
                </div>
            </div>
        </div>
        @endif

        <!-- Navigation Menu -->
        <nav class="flex-1 p-4 space-y-2">
            <!-- Home -->
            <a href="{{ route('index') }}" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors {{ request()->routeIs('index') ? 'bg-primary-100 dark:bg-primary-900 text-primary-700 dark:text-primary-300' : 'text-gray-700 dark:text-gray-300' }}">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M11.293 3.293a1 1 0 0 1 1.414 0l6 6 2 2a1 1 0 0 1-1.414 1.414L19 12.414V19a2 2 0 0 1-2 2h-3a1 1 0 0 1-1-1v-3h-2v3a1 1 0 0 1-1 1H7a2 2 0 0 1-2-2v-6.586l-.293.293a1 1 0 0 1-1.414-1.414l2-2 6-6Z" clip-rule="evenodd" />
                </svg>
                <span>Home</span>
            </a>

            <!-- Journal -->
            <a href="{{ route('journal') }}" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors {{ request()->routeIs('journal') ? 'bg-primary-100 dark:bg-primary-900 text-primary-700 dark:text-primary-300' : 'text-gray-700 dark:text-gray-300' }}">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M6 2a2 2 0 0 0-2 2v15a3 3 0 0 0 3 3h12a1 1 0 1 0 0-2h-2v-2h2a1 1 0 0 0 1-1V4a2 2 0 0 0-2-2h-8v16h5v2H7a1 1 0 1 1 0-2h1V2H6Z" clip-rule="evenodd" />
                </svg>
                <span>Journal</span>
            </a>

            <!-- Food and Diet -->
            <a href="{{ route('nutrition') }}" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors {{ request()->routeIs('nutrition') ? 'bg-primary-100 dark:bg-primary-900 text-primary-700 dark:text-primary-300' : 'text-gray-700 dark:text-gray-300' }}">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M10.9715 12.2168c-.0118.0406-.0234.0795-.0347.1166.0391.0574.0819.1192.1278.1855.3277.473.812 1.172 1.2141 2.0892.2147-.2864.4616-.5799.7447-.8832l-.0024-.0317c-.0236-.3254-.0361-.7783.0091-1.2905.0882-.9978.4095-2.3695 1.4623-3.39555 1.0079-.98229 2.3556-1.42385 3.4044-1.59916.5344-.08932 1.0323-.11665 1.4296-.09869.1954.00883.3932.02974.5707.07034.0872.01996.1979.05097.3114.10232.0867.03927.3102.14854.4769.39195.1453.21217.1993.45929.22.55586.0321.14963.0559.32134.0712.50398.0307.36676.0311.82807-.0291 1.32915-.1181.9828-.4871 2.2522-1.47 3.2102-1.0357 1.0093-2.4736 1.3803-3.5197 1.5249-.542.0749-1.0253.0952-1.3736.0969-.036.0002-.0706.0002-.1037 0-.931.9987-1.2688 1.7317-1.4072 2.3512-.0345.1545-.0581.303-.0739.451.0004.0342.0006.0685.0006.1029v2c0 .5523-.4477 1-1 1s-1-.4477-1-1c0-.1991-.0064-.4114-.0131-.6334-.0142-.4713-.0298-.9868.0117-1.5138-.0358-1.8786-.7555-2.9405-1.40123-3.8932-.13809-.2037-.2728-.4025-.39671-.6032-.05186-.0105-.10709-.0222-.16538-.035-.39471-.0865-.93803-.2268-1.53416-.4432-1.15636-.4197-2.67587-1.1841-3.58743-2.5531-.90552-1.35993-1.03979-2.96316-.96002-4.15955.04066-.60984.13916-1.15131.24451-1.56046.05234-.20327.10977-.38715.16845-.53804.02865-.07367.06419-.15663.10713-.23658.02132-.03968.0522-.09319.0933-.15021.03213-.04456.11389-.15344.24994-.25057.18341-.13093.36351-.16755.42749-.17932.0854-.01572.16019-.01941.21059-.02024.1023-.0017.20235.00733.28493.0176.17089.02126.37298.06155.58906.11526.43651.1085.99747.2886 1.59668.54576 1.16944.50188 2.63819 1.3629 3.52935 2.70126.9248 1.38891.9601 2.99601.818 4.14739-.0726.589-.1962 1.0975-.3016 1.4594Z" />
                </svg>
                <span>Food and Diet</span>
            </a>

            <!-- Games & Quizzes (Dropdown) -->
            <div class="space-y-1">
                <button id="mobile-dd-games-toggle" type="button" class="w-full flex items-center justify-between p-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 text-left text-gray-700 dark:text-gray-300">
                    <span class="inline-flex items-center space-x-3">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm9.008-3.018a1.502 1.502 0 0 1 2.522 1.159v.024a1.44 1.44 0 0 1-1.493 1.418 1 1 0 0 0-1.037.999V14a1 1 0 1 0 2 0v-.539a3.44 3.44 0 0 0 2.529-3.256 3.502 3.502 0 0 0-7-.255 1 1 0 0 0 2 .076c.014-.398.187-.774.48-1.044Zm.982 7.026a1 1 0 1 0 0 2H12a1 1 0 1 0 0-2h-.01Z" clip-rule="evenodd" />
                        </svg>
                        <span class="font-medium">Games & Quizzes</span>
                    </span>
                    <svg id="mobile-dd-games-arrow" class="w-4 h-4 text-gray-500 dark:text-gray-400 transform transition-transform duration-200 {{ (request()->routeIs('quiz') || request()->routeIs('scramble')) ? 'rotate-180' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m6 9 6 6 6-6" />
                    </svg>
                </button>
                <div id="mobile-dd-games" class="ml-9 space-y-1 {{ (request()->routeIs('quiz') || request()->routeIs('scramble')) ? '' : 'hidden' }}">
                    <a href="{{ route('quiz') }}" class="block p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors {{ request()->routeIs('quiz') ? 'bg-primary-100 dark:bg-primary-900 text-primary-700 dark:text-primary-300' : 'text-gray-600 dark:text-gray-400' }}">
                        Quizzes
                    </a>
                    <a href="{{ route('scramble') }}" class="block p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors {{ request()->routeIs('scramble') ? 'bg-primary-100 dark:bg-primary-900 text-primary-700 dark:text-primary-300' : 'text-gray-600 dark:text-gray-400' }}">
                        Scramble Word
                    </a>
                </div>
            </div>

            <!-- Well-being Tools (Dropdown) -->
            <div class="space-y-1">
                <button id="mobile-dd-tools-toggle" type="button" class="w-full flex items-center justify-between p-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 text-left text-gray-700 dark:text-gray-300">
                    <span class="inline-flex items-center space-x-3">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linejoin="round" stroke-width="1.2" d="M7.58209 8.96025 9.8136 11.1917l-1.61782 1.6178c-1.08305-.1811-2.23623.1454-3.07364.9828-1.1208 1.1208-1.32697 2.8069-.62368 4.1363.14842.2806.42122.474.73509.5213.06726.0101.1347.0133.20136.0098-.00351.0666-.00036.1341.00977.2013.04724.3139.24069.5867.52125.7351 1.32944.7033 3.01552.4971 4.13627-.6237.8375-.8374 1.1639-1.9906.9829-3.0736l4.8107-4.8108c1.0831.1811 2.2363-.1454 3.0737-.9828 1.1208-1.1208 1.3269-2.80688.6237-4.13632-.1485-.28056-.4213-.474-.7351-.52125-.0673-.01012-.1347-.01327-.2014-.00977.0035-.06666.0004-.13409-.0098-.20136-.0472-.31386-.2406-.58666-.5212-.73508-1.3294-.70329-3.0155-.49713-4.1363.62367-.8374.83741-1.1639 1.9906-.9828 3.07365l-1.7788 1.77875-2.23152-2.23148-1.41419 1.41424Zm1.31056-3.1394c-.04235-.32684-.24303-.61183-.53647-.76186l-1.98183-1.0133c-.38619-.19746-.85564-.12345-1.16234.18326l-.86321.8632c-.3067.3067-.38072.77616-.18326 1.16235l1.0133 1.98182c.15004.29345.43503.49412.76187.53647l1.1127.14418c.3076.03985.61628-.06528.8356-.28461l.86321-.8632c.21932-.21932.32446-.52801.2846-.83561l-.14417-1.1127ZM19.4448 16.4052l-3.1186-3.1187c-.7811-.781-2.0474-.781-2.8285 0l-.1719.172c-.7811.781-.7811 2.0474 0 2.8284l3.1186 3.1187c.7811.781 2.0474.781 2.8285 0l.1719-.172c.7811-.781.7811-2.0474 0-2.8284Z" />
                        </svg>
                        <span class="font-medium">Well-being Tools</span>
                    </span>
                    <svg id="mobile-dd-tools-arrow" class="w-4 h-4 text-gray-500 dark:text-gray-400 transform transition-transform duration-200 {{ (request()->routeIs('physical.tools') || request()->routeIs('mental.tools') || request()->routeIs('emotional.tools') || request()->routeIs('financial.tools') || request()->routeIs('social.tools')) ? 'rotate-180' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m6 9 6 6 6-6" />
                    </svg>
                </button>
                <div id="mobile-dd-tools" class="ml-9 space-y-1 {{ (request()->routeIs('physical.tools') || request()->routeIs('mental.tools') || request()->routeIs('emotional.tools') || request()->routeIs('financial.tools') || request()->routeIs('social.tools')) ? '' : 'hidden' }}">
                    <a href="{{ route('physical.tools') }}" class="block p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors {{ request()->routeIs('physical.tools') ? 'bg-primary-100 dark:bg-primary-900 text-primary-700 dark:text-primary-300' : 'text-gray-600 dark:text-gray-400' }}">
                        Physical Well-Being
                    </a>
                    <a href="{{ route('mental.tools') }}" class="block p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors {{ request()->routeIs('mental.tools') ? 'bg-primary-100 dark:bg-primary-900 text-primary-700 dark:text-primary-300' : 'text-gray-600 dark:text-gray-400' }}">
                        Mental Well-Being
                    </a>
                    <a href="{{ route('emotional.tools') }}" class="block p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors {{ request()->routeIs('emotional.tools') ? 'bg-primary-100 dark:bg-primary-900 text-primary-700 dark:text-primary-300' : 'text-gray-600 dark:text-gray-400' }}">
                        Emotional Well-Being
                    </a>
                    <a href="{{ route('financial.tools') }}" class="block p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors {{ request()->routeIs('financial.tools') ? 'bg-primary-100 dark:bg-primary-900 text-primary-700 dark:text-primary-300' : 'text-gray-600 dark:text-gray-400' }}">
                        Financial Well-being
                    </a>
                    <a href="{{ route('social.tools') }}" class="block p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors {{ request()->routeIs('social.tools') ? 'bg-primary-100 dark:bg-primary-900 text-primary-700 dark:text-primary-300' : 'text-gray-600 dark:text-gray-400' }}">
                        Social Well-being
                    </a>
                </div>
            </div>

            <!-- Policies -->
            <a href="{{ route('policies') }}" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors {{ request()->routeIs('policies') ? 'bg-primary-100 dark:bg-primary-900 text-primary-700 dark:text-primary-300' : 'text-gray-700 dark:text-gray-300' }}">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 4h3a1 1 0 0 1 1 1v15a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1h3m0 3h6m-3 5h3m-6 0h.01M12 16h3m-6 0h.01M10 3v4h4V3h-4Z" />
                </svg>
                <span>Policies</span>
            </a>
        </nav>

        <!-- Sidebar Footer -->
        @if(Auth::check())
        <div class="p-4 border-t border-gray-200 dark:border-gray-700">
            <div class="space-y-2">
                <a href="{{ route('settings.profile') }}" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors text-gray-700 dark:text-gray-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <span>Account Settings</span>
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-red-100 dark:hover:bg-red-900 transition-colors text-red-600 dark:text-red-400 w-full text-left">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>
        @endif
    </div>
</div>

<!-- Mobile Sidebar JavaScript -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('mobile-sidebar');
        const sidebarContent = document.getElementById('mobile-sidebar-content');
        const sidebarToggle = document.getElementById('mobile-sidebar-toggle');
        const sidebarClose = document.getElementById('mobile-sidebar-close');
        const sidebarBackdrop = document.getElementById('mobile-sidebar-backdrop');

        function openSidebar() {
            sidebar.classList.remove('hidden');
            setTimeout(() => {
                sidebarContent.classList.remove('-translate-x-full');
            }, 10);
        }

        function closeSidebar() {
            sidebarContent.classList.add('-translate-x-full');
            setTimeout(() => {
                sidebar.classList.add('hidden');
            }, 300);
        }

        sidebarToggle?.addEventListener('click', openSidebar);
        sidebarClose?.addEventListener('click', closeSidebar);
        sidebarBackdrop?.addEventListener('click', closeSidebar);

        // Mobile dropdown toggles
        const gamesToggle = document.getElementById('mobile-dd-games-toggle');
        const gamesMenu = document.getElementById('mobile-dd-games');
        const gamesArrow = document.getElementById('mobile-dd-games-arrow');

        gamesToggle?.addEventListener('click', () => {
            gamesMenu.classList.toggle('hidden');
            gamesArrow.classList.toggle('rotate-180');
        });

        const toolsToggle = document.getElementById('mobile-dd-tools-toggle');
        const toolsMenu = document.getElementById('mobile-dd-tools');
        const toolsArrow = document.getElementById('mobile-dd-tools-arrow');

        toolsToggle?.addEventListener('click', () => {
            toolsMenu.classList.toggle('hidden');
            toolsArrow.classList.toggle('rotate-180');
        });
    });
</script>