<section class="w-full">
    <x-settings.layout :heading="__('Appearance')" :subheading="__('Customize how the application looks and feels')">
        <div class="p-8">
            <div class="space-y-8">
                <!-- Theme Selection -->
                <div class="space-y-6">
                    <div class="border-b border-gray-200 dark:border-gray-700 pb-4">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Theme Preference</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Choose how you want the application to appear. You can select a theme or let it follow your system settings.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <!-- Light Theme -->
                        <div class="relative">
                            <input type="radio" id="light-theme" name="theme" value="light" class="sr-only" x-model="$flux.appearance">
                            <label for="light-theme" class="block cursor-pointer">
                                <div class="border-2 rounded-xl p-6 transition-all duration-200 hover:shadow-md"
                                    :class="$flux.appearance === 'light' ? 'border-lime-500 bg-lime-50 dark:bg-lime-900/20' : 'border-gray-200 dark:border-gray-700 hover:border-gray-300 dark:hover:border-gray-600'">
                                    <div class="flex items-center justify-center mb-4">
                                        <div class="w-16 h-16 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-full flex items-center justify-center shadow-lg">
                                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                                            </svg>
                                        </div>
                                    </div>
                                    <h4 class="text-lg font-semibold text-gray-900 dark:text-white text-center mb-2">Light Mode</h4>
                                    <p class="text-sm text-gray-600 dark:text-gray-400 text-center">Clean and bright interface perfect for daytime use</p>
                                    <div class="mt-4 flex items-center justify-center">
                                        <div class="w-3 h-3 rounded-full" :class="$flux.appearance === 'light' ? 'bg-lime-500' : 'bg-gray-300 dark:bg-gray-600'"></div>
                                    </div>
                                </div>
                            </label>
                        </div>

                        <!-- Dark Theme -->
                        <div class="relative">
                            <input type="radio" id="dark-theme" name="theme" value="dark" class="sr-only" x-model="$flux.appearance">
                            <label for="dark-theme" class="block cursor-pointer">
                                <div class="border-2 rounded-xl p-6 transition-all duration-200 hover:shadow-md"
                                    :class="$flux.appearance === 'dark' ? 'border-lime-500 bg-lime-50 dark:bg-lime-900/20' : 'border-gray-200 dark:border-gray-700 hover:border-gray-300 dark:hover:border-gray-600'">
                                    <div class="flex items-center justify-center mb-4">
                                        <div class="w-16 h-16 bg-gradient-to-br from-indigo-600 to-purple-700 rounded-full flex items-center justify-center shadow-lg">
                                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                                            </svg>
                                        </div>
                                    </div>
                                    <h4 class="text-lg font-semibold text-gray-900 dark:text-white text-center mb-2">Dark Mode</h4>
                                    <p class="text-sm text-gray-600 dark:text-gray-400 text-center">Easy on the eyes for low-light environments</p>
                                    <div class="mt-4 flex items-center justify-center">
                                        <div class="w-3 h-3 rounded-full" :class="$flux.appearance === 'dark' ? 'bg-lime-500' : 'bg-gray-300 dark:bg-gray-600'"></div>
                                    </div>
                                </div>
                            </label>
                        </div>

                        <!-- System Theme -->
                        <div class="relative">
                            <input type="radio" id="system-theme" name="theme" value="system" class="sr-only" x-model="$flux.appearance">
                            <label for="system-theme" class="block cursor-pointer">
                                <div class="border-2 rounded-xl p-6 transition-all duration-200 hover:shadow-md"
                                    :class="$flux.appearance === 'system' ? 'border-lime-500 bg-lime-50 dark:bg-lime-900/20' : 'border-gray-200 dark:border-gray-700 hover:border-gray-300 dark:hover:border-gray-600'">
                                    <div class="flex items-center justify-center mb-4">
                                        <div class="w-16 h-16 bg-gradient-to-br from-gray-600 to-gray-800 rounded-full flex items-center justify-center shadow-lg">
                                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                    </div>
                                    <h4 class="text-lg font-semibold text-gray-900 dark:text-white text-center mb-2">System</h4>
                                    <p class="text-sm text-gray-600 dark:text-gray-400 text-center">Follows your device's theme setting</p>
                                    <div class="mt-4 flex items-center justify-center">
                                        <div class="w-3 h-3 rounded-full" :class="$flux.appearance === 'system' ? 'bg-lime-500' : 'bg-gray-300 dark:bg-gray-600'"></div>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Additional Settings -->
                <div class="space-y-6">
                    <div class="border-b border-gray-200 dark:border-gray-700 pb-4">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Display Settings</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Additional appearance options for a personalized experience.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Font Size -->
                        <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-4">
                            <h4 class="text-sm font-medium text-gray-900 dark:text-white mb-3">Font Size</h4>
                            <div class="space-y-2">
                                <label class="flex items-center">
                                    <input type="radio" name="font-size" value="small" class="text-lime-600 focus:ring-lime-500">
                                    <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Small</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="font-size" value="medium" checked class="text-lime-600 focus:ring-lime-500">
                                    <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Medium (Default)</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="font-size" value="large" class="text-lime-600 focus:ring-lime-500">
                                    <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Large</span>
                                </label>
                            </div>
                        </div>

                        <!-- Animation -->
                        <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-4">
                            <h4 class="text-sm font-medium text-gray-900 dark:text-white mb-3">Animations</h4>
                            <div class="space-y-2">
                                <label class="flex items-center">
                                    <input type="checkbox" checked class="text-lime-600 focus:ring-lime-500 rounded">
                                    <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Enable smooth transitions</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" checked class="text-lime-600 focus:ring-lime-500 rounded">
                                    <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Show loading animations</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" class="text-lime-600 focus:ring-lime-500 rounded">
                                    <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Reduce motion (accessibility)</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Preview Section -->
                <div class="space-y-6">
                    <div class="border-b border-gray-200 dark:border-gray-700 pb-4">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Preview</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">See how your changes will look in the application.</p>
                    </div>

                    <div class="bg-gray-100 dark:bg-gray-800 rounded-xl p-6">
                        <div class="bg-white dark:bg-gray-700 rounded-lg p-4 shadow-sm">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="w-10 h-10 bg-lime-500 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900 dark:text-white">Sample Card</h4>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">This is how content will appear</p>
                                </div>
                            </div>
                            <p class="text-sm text-gray-700 dark:text-gray-300">Your theme selection will be applied throughout the application, affecting all pages and components.</p>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-between pt-6 border-t border-gray-200 dark:border-gray-700">
                    <div class="text-sm text-gray-500 dark:text-gray-400">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                        Changes are saved automatically
                    </div>

                    <div class="flex items-center gap-3">
                        <button type="button" class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-lg transition-colors">
                            Reset to Default
                        </button>
                        <button type="button" class="px-4 py-2 text-sm font-medium text-white bg-lime-600 hover:bg-lime-700 rounded-lg transition-colors">
                            Apply Changes
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </x-settings.layout>
</section>