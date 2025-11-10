<div class="text-center">
    <div class="mb-6">
        <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-purple-100 to-indigo-100 dark:from-purple-900/30 dark:to-indigo-900/30 rounded-full mb-4">
            <svg class="w-8 h-8 text-purple-600 dark:text-purple-400" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
            </svg>
        </div>
        <h3 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-white mb-2">Encouragement for You</h3>
        <p class="text-sm text-gray-500 dark:text-gray-400">Get inspired with daily motivation</p>
    </div>
    
    <div class="relative mb-6">
        <div class="absolute inset-0 bg-gradient-to-r from-purple-200 via-indigo-200 to-blue-200 dark:from-purple-900/20 dark:via-indigo-900/20 dark:to-blue-900/20 rounded-2xl blur-xl opacity-50"></div>
        <div class="relative bg-gradient-to-br from-purple-50 via-indigo-50 to-blue-50 dark:from-purple-900/20 dark:via-indigo-900/20 dark:to-blue-900/20 rounded-2xl p-6 sm:p-8 border-2 border-purple-200 dark:border-purple-800">
            <div class="flex items-start justify-center mb-4">
                <svg class="w-8 h-8 text-purple-500 dark:text-purple-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <p class="text-lg sm:text-xl italic text-gray-800 dark:text-gray-200 leading-relaxed font-medium">
                "{{ $quote }}"
            </p>
        </div>
    </div>
    
    <button 
        wire:click="generateQuote"
        class="inline-flex items-center space-x-2 px-6 py-3 bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 focus:outline-none focus:ring-4 focus:ring-purple-300 dark:focus:ring-purple-800">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
        </svg>
        <span>Get New Quote</span>
    </button>
</div>

