<div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-8 border border-gray-100 dark:border-gray-700">
    <div class="text-center mb-8">
        <div class="flex items-center justify-center w-16 h-16 bg-gradient-to-r from-green-400 to-blue-500 rounded-full mb-4 mx-auto">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
            </svg>
        </div>
        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">How are you feeling today?</h3>
        <p class="text-gray-600 dark:text-gray-300">Take a moment to check in with yourself and track your emotional well-being.</p>
    </div>

    @if(session('mood-success'))
    <div class="mb-6 p-4 bg-green-100 dark:bg-green-900/30 border border-green-200 dark:border-green-700 rounded-lg">
        <div class="flex items-center">
            <svg class="w-5 h-5 text-green-600 dark:text-green-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            <p class="text-green-800 dark:text-green-200 font-medium">{{ session('mood-success') }}</p>
        </div>
    </div>
    @endif

    @if(session('mood-error'))
    <div class="mb-6 p-4 bg-red-100 dark:bg-red-900/30 border border-red-200 dark:border-red-700 rounded-lg">
        <div class="flex items-center">
            <svg class="w-5 h-5 text-red-600 dark:text-red-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
            <p class="text-red-800 dark:text-red-200 font-medium">{{ session('mood-error') }}</p>
        </div>
    </div>
    @endif

    <!-- Mood Selection Grid -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
        @foreach($moods as $moodKey => $moodData)
        <button
            wire:click="selectMood('{{ $moodKey }}')"
            class="p-4 rounded-xl border-2 transition-all duration-300 transform hover:scale-105 {{ $selectedMood === $moodKey ? 'border-blue-500 bg-blue-50 dark:bg-blue-900/30' : 'border-gray-200 dark:border-gray-600 hover:border-gray-300 dark:hover:border-gray-500' }}">
            <div class="text-center">
                <div class="text-4xl mb-2">{{ $moodData['emoji'] }}</div>
                <div class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ $moodData['label'] }}</div>
            </div>
        </button>
        @endforeach
    </div>

    <!-- Optional Note -->
    <div class="mb-6">
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            Add a note (optional)
        </label>
        <textarea
            wire:model="moodNote"
            placeholder="What's contributing to how you're feeling today?"
            class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white resize-none"
            rows="3"></textarea>
    </div>

    <!-- Save Button -->
    <button
        wire:click="saveMood"
        disabled="{{ empty($selectedMood) }}"
        class="w-full bg-gradient-to-r from-green-500 to-blue-600 text-white py-3 px-6 rounded-lg hover:from-green-600 hover:to-blue-700 transition-all duration-300 font-medium disabled:opacity-50 disabled:cursor-not-allowed">
        <span wire:loading.remove wire:target="saveMood">Save My Mood</span>
        <span wire:loading wire:target="saveMood" class="flex items-center justify-center">
            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Saving...
        </span>
    </button>

    <!-- Tips -->
    <div class="mt-6 p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
        <h4 class="font-medium text-blue-900 dark:text-blue-200 mb-2">💡 Tip</h4>
        <p class="text-sm text-blue-800 dark:text-blue-300">
            Regular mood tracking can help you identify patterns and triggers, leading to better emotional awareness and well-being.
        </p>
    </div>
</div>



