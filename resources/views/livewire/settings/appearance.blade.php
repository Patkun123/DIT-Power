<section class="w-full">
    <x-settings.layout :heading="__('Appearance')" :subheading="__('Update the appearance settings for your account')">
        <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 p-6 md:p-8 lg:p-10 shadow-lg hover:shadow-xl transition-shadow duration-300">
            <div class="flex items-center gap-3 mb-6">
                <div class="p-2 rounded-lg bg-primary-100 dark:bg-primary-900/30">
                    <svg class="w-6 h-6 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Theme Preference</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Choose how the application looks to you</p>
                </div>
            </div>

            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-4">Select Theme</label>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 lg:gap-6" x-data x-init="$watch('$flux.appearance', value => {})">
                        <label class="relative flex flex-col items-center p-5 lg:p-6 rounded-xl border-2 transition-all duration-200 cursor-pointer group hover:scale-105" 
                               :class="$flux.appearance === 'light' ? 'border-primary-500 bg-primary-50 dark:bg-primary-900/20 shadow-md' : 'border-gray-200 dark:border-gray-700 hover:border-primary-400 dark:hover:border-primary-600'"
                               @click="$flux.appearance = 'light'">
                            <input type="radio" :checked="$flux.appearance === 'light'" class="sr-only">
                            <svg class="w-8 h-8 mb-3 transition-colors" 
                                 :class="$flux.appearance === 'light' ? 'text-primary-600 dark:text-primary-400' : 'text-gray-600 dark:text-gray-400 group-hover:text-primary-600 dark:group-hover:text-primary-400'" 
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                            <div class="text-center">
                                <div class="text-base font-medium mb-1" :class="$flux.appearance === 'light' ? 'text-primary-700 dark:text-primary-300' : 'text-gray-800 dark:text-gray-200'">{{ __('Light') }}</div>
                                <div class="text-xs text-gray-500 dark:text-gray-400">Bright and clean</div>
                            </div>
                        </label>
                        <label class="relative flex flex-col items-center p-5 lg:p-6 rounded-xl border-2 transition-all duration-200 cursor-pointer group hover:scale-105" 
                               :class="$flux.appearance === 'dark' ? 'border-primary-500 bg-primary-50 dark:bg-primary-900/20 shadow-md' : 'border-gray-200 dark:border-gray-700 hover:border-primary-400 dark:hover:border-primary-600'"
                               @click="$flux.appearance = 'dark'">
                            <input type="radio" :checked="$flux.appearance === 'dark'" class="sr-only">
                            <svg class="w-8 h-8 mb-3 transition-colors" 
                                 :class="$flux.appearance === 'dark' ? 'text-primary-600 dark:text-primary-400' : 'text-gray-600 dark:text-gray-400 group-hover:text-primary-600 dark:group-hover:text-primary-400'" 
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                            </svg>
                            <div class="text-center">
                                <div class="text-base font-medium mb-1" :class="$flux.appearance === 'dark' ? 'text-primary-700 dark:text-primary-300' : 'text-gray-800 dark:text-gray-200'">{{ __('Dark') }}</div>
                                <div class="text-xs text-gray-500 dark:text-gray-400">Easy on the eyes</div>
                            </div>
                        </label>
                        <label class="relative flex flex-col items-center p-5 lg:p-6 rounded-xl border-2 transition-all duration-200 cursor-pointer group hover:scale-105" 
                               :class="$flux.appearance === 'system' ? 'border-primary-500 bg-primary-50 dark:bg-primary-900/20 shadow-md' : 'border-gray-200 dark:border-gray-700 hover:border-primary-400 dark:hover:border-primary-600'"
                               @click="$flux.appearance = 'system'">
                            <input type="radio" :checked="$flux.appearance === 'system'" class="sr-only">
                            <svg class="w-8 h-8 mb-3 transition-colors" 
                                 :class="$flux.appearance === 'system' ? 'text-primary-600 dark:text-primary-400' : 'text-gray-600 dark:text-gray-400 group-hover:text-primary-600 dark:group-hover:text-primary-400'" 
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <div class="text-center">
                                <div class="text-base font-medium mb-1" :class="$flux.appearance === 'system' ? 'text-primary-700 dark:text-primary-300' : 'text-gray-800 dark:text-gray-200'">{{ __('System') }}</div>
                                <div class="text-xs text-gray-500 dark:text-gray-400">Match your device</div>
                            </div>
                        </label>
                    </div>
                </div>

                <div class="mt-6 p-4 rounded-lg bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-blue-600 dark:text-blue-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div>
                            <p class="text-sm font-medium text-blue-800 dark:text-blue-300">Theme Information</p>
                            <p class="text-xs text-blue-600 dark:text-blue-400 mt-1">Your theme preference is saved automatically and will be applied across all your devices.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-settings.layout>
</section>
