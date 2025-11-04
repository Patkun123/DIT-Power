<div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-8 border border-gray-100 dark:border-gray-700">
    <div class="text-center mb-8">
        <div class="flex items-center justify-center w-16 h-16 bg-gradient-to-r from-yellow-400 to-orange-500 rounded-full mb-4 mx-auto">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
            </svg>
        </div>
        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Journal Prompts</h3>
        <p class="text-gray-600 dark:text-gray-300">Explore your thoughts and feelings with guided writing prompts.</p>
    </div>

    <!-- Category Selection -->
    <div class="mb-6">
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Choose a category:</label>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-2">
            <button
                wire:click="setCategory('general')"
                class="p-3 rounded-lg text-sm font-medium transition-all duration-300 {{ $promptCategory === 'general' ? 'bg-blue-500 text-white' : 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600' }}">
                General
            </button>
            <button
                wire:click="setCategory('emotional')"
                class="p-3 rounded-lg text-sm font-medium transition-all duration-300 {{ $promptCategory === 'emotional' ? 'bg-purple-500 text-white' : 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600' }}">
                Emotional
            </button>
            <button
                wire:click="setCategory('reflection')"
                class="p-3 rounded-lg text-sm font-medium transition-all duration-300 {{ $promptCategory === 'reflection' ? 'bg-green-500 text-white' : 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600' }}">
                Reflection
            </button>
            <button
                wire:click="setCategory('gratitude')"
                class="p-3 rounded-lg text-sm font-medium transition-all duration-300 {{ $promptCategory === 'gratitude' ? 'bg-yellow-500 text-white' : 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600' }}">
                Gratitude
            </button>
        </div>
    </div>

    <!-- Current Prompt -->
    <div class="mb-6 p-6 bg-gradient-to-r from-blue-50 to-purple-50 dark:from-blue-900/20 dark:to-purple-900/20 rounded-xl border border-blue-200 dark:border-blue-700">
        <h4 class="font-semibold text-gray-900 dark:text-white mb-2">Today's Prompt:</h4>
        <p class="text-lg text-gray-700 dark:text-gray-300 italic">"{{ $currentPrompt }}"</p>
    </div>

    <!-- Response Area -->
    <div class="mb-6">
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            Your Response
        </label>
        <textarea
            wire:model="userResponse"
            placeholder="Take your time to reflect and write your thoughts..."
            class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white resize-none"
            rows="6"></textarea>
    </div>

    <!-- Action Buttons -->
    <div class="flex flex-col sm:flex-row gap-3 mb-6">
        <button
            wire:click="saveResponse"
            disabled="{{ empty($userResponse) }}"
            class="flex-1 bg-gradient-to-r from-yellow-500 to-orange-600 text-white py-3 px-6 rounded-lg hover:from-yellow-600 hover:to-orange-700 transition-all duration-300 font-medium disabled:opacity-50 disabled:cursor-not-allowed">
            <span wire:loading.remove wire:target="saveResponse">Save Response</span>
            <span wire:loading wire:target="saveResponse" class="flex items-center justify-center">
                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Saving...
            </span>
        </button>
        <button
            wire:click="getNewPrompt"
            class="flex-1 bg-gray-500 text-white py-3 px-6 rounded-lg hover:bg-gray-600 transition-all duration-300 font-medium">
            New Prompt
        </button>
    </div>

    @if(session('journal-success'))
    <div class="mb-6 p-4 bg-green-100 dark:bg-green-900/30 border border-green-200 dark:border-green-700 rounded-lg">
        <div class="flex items-center">
            <svg class="w-5 h-5 text-green-600 dark:text-green-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            <p class="text-green-800 dark:text-green-200 font-medium">{{ session('journal-success') }}</p>
        </div>
    </div>
    @endif

    @if(session('journal-error'))
    <div class="mb-6 p-4 bg-red-100 dark:bg-red-900/30 border border-red-200 dark:border-red-700 rounded-lg">
        <div class="flex items-center">
            <svg class="w-5 h-5 text-red-600 dark:text-red-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
            <p class="text-red-800 dark:text-red-200 font-medium">{{ session('journal-error') }}</p>
        </div>
    </div>
    @endif

    <!-- Tips -->
    <div class="p-4 bg-yellow-50 dark:bg-yellow-900/20 rounded-lg">
        <h4 class="font-medium text-yellow-900 dark:text-yellow-200 mb-2">💡 Journaling Tips</h4>
        <ul class="text-sm text-yellow-800 dark:text-yellow-300 space-y-1">
            <li>• Write freely without worrying about grammar or structure</li>
            <li>• Be honest with yourself - this is for your eyes only</li>
            <li>• Set aside 10-15 minutes for each prompt</li>
            <li>• Review your entries periodically to track your growth</li>
        </ul>
    </div>
</div>



