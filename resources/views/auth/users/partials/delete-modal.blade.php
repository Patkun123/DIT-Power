<!-- Delete Modal -->
<div id="delete-modal{{ $journal->id }}" tabindex="-1" aria-hidden="true"
    class="hidden fixed inset-0 z-50 flex items-center justify-center w-full h-full bg-black/60 dark:bg-black/80 backdrop-blur-sm">
    <div class="relative bg-white dark:bg-gray-800 rounded-2xl shadow-2xl w-full max-w-md overflow-hidden">
        <!-- Modal header -->
        <div class="bg-gradient-to-r from-red-600 to-red-700 dark:from-red-700 dark:to-red-800 px-6 py-5">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="p-2 bg-white/20 dark:bg-white/10 rounded-lg backdrop-blur-sm">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white">Confirm Delete</h3>
                </div>
                <button type="button"
                    class="p-2 text-white/80 hover:text-white hover:bg-white/20 rounded-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-white/50"
                    data-modal-hide="delete-modal{{ $journal->id }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    <span class="sr-only">Close</span>
                </button>
            </div>
        </div>

        <!-- Modal body -->
        <div class="p-6">
            <div class="flex items-start space-x-4">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-red-100 dark:bg-red-900/30 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                    </div>
                </div>
                <div class="flex-1">
                    <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Delete Journal Entry?</h4>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">
                        Are you sure you want to delete <span class="font-semibold text-gray-900 dark:text-white">"{{ $journal->title }}"</span>?
                    </p>
                    <p class="text-xs text-gray-500 dark:text-gray-500">
                        This action cannot be undone. All data associated with this entry will be permanently deleted.
                    </p>
                </div>
            </div>
        </div>

        <!-- Modal footer -->
        <div class="flex items-center justify-end gap-3 p-6 bg-gray-50 dark:bg-gray-900/50 border-t border-gray-200 dark:border-gray-700">
            <button 
                data-modal-hide="delete-modal{{ $journal->id }}" 
                type="button"
                class="px-5 py-2.5 text-sm font-semibold text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-xl transition-all duration-200">
                Cancel
            </button>

            <!-- DELETE FORM -->
            <form action="{{ route('journals.destroy', $journal->id) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="inline-flex items-center space-x-2 px-5 py-2.5 text-sm font-semibold text-white bg-red-600 hover:bg-red-700 dark:bg-red-600 dark:hover:bg-red-700 rounded-xl shadow-md hover:shadow-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                    <span>Delete Entry</span>
                </button>
            </form>
        </div>
    </div>
</div>
