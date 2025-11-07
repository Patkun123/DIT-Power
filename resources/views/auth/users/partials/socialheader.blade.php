<header class="fixed w-full shadow-md top-0 z-50 dark:bg-gray-800 bg-white">
    <nav class="h-20 px-0 lg:px-10 flex items-center dark:bg-gray-800">
        <!-- Mobile Header -->
        <div class="lg:hidden w-full flex items-center justify-between px-4">
            <h1 class="text-xl font-bold text-blue-600 dark:text-blue-400">Social</h1>
            <div class="flex items-center space-x-3">
                <button class="p-2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z">
                        </path>
                    </svg>
                </button>
                <img class="h-8 w-8 rounded-full object-cover"
                    src="{{ auth()->user()->profile_image_url }}"
                    alt="{{ auth()->user()->firstname }}">
            </div>
        </div>

        <!-- Desktop Header -->
        <div class="hidden lg:flex w-full items-center justify-between max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center space-x-2">
                <svg class="w-8 h-8 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M12 2C6.48 2 2 6.48 2 12s4.48 
                           10 10 10 10-4.48 10-10S17.52 2 
                           12 2zm-1 17.93c-3.94-.49-7-3.85-7-7.93 
                           0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 
                           2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3
                           c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 
                           1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 
                           1.19 5 4.06 5 7.41 0 2.08-.8 
                           3.97-2.1 5.39z" />
                </svg>
                <h1 class="text-2xl font-bold text-blue-600 dark:text-blue-400">Social Feedia</h1>
            </div>

            <!-- Search -->
            <div class="hidden md:flex flex-1 max-w-md mx-8">
                <div class="relative w-full">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 
                                   11-14 0 7 7 0 0114 0z">
                            </path>
                        </svg>
                    </div>
                    <input type="text" placeholder="Search posts..."
                        class="block w-full pl-10 pr-3 py-2 border border-gray-300 
                               dark:border-gray-600 rounded-full bg-gray-50 
                               dark:bg-gray-700 text-gray-900 dark:text-white 
                               placeholder-gray-500 focus:outline-none 
                               focus:ring-2 focus:ring-blue-500 
                               focus:border-transparent">
                </div>
            </div>

            <!-- Profile -->
            <div class="flex items-center space-x-6">
                <img class="h-8 w-8 rounded-full object-cover cursor-pointer"
                    src="{{ auth()->user()->profile_image_url }}"
                    alt="{{ auth()->user()->firstname }}">
            </div>
        </div>
    </nav>
</header>
