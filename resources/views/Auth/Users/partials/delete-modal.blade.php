<!-- Delete Modal -->
<div id="delete-modal{{ $journal->id }}" tabindex="-1" aria-hidden="true"
    class="hidden fixed inset-0 z-50 flex items-center justify-center w-full h-full bg-black bg-opacity-50">
    <div class="relative bg-white rounded-lg shadow dark:bg-gray-800 w-full max-w-md">
        <!-- Modal header -->
        <div class="flex justify-between items-center p-4 border-b dark:border-gray-600">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                Confirm Delete
            </h3>
            <button type="button"
                class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                data-modal-hide="delete-modal{{ $journal->id }}">
                ✕
            </button>
        </div>

        <!-- Modal body -->
        <div class="p-4">
            <p class="text-sm text-gray-500 dark:text-gray-400">
                Are you sure you want to delete this journal entry?
            </p>
        </div>

        <!-- Modal footer -->
        <div class="flex justify-end gap-3 p-4 border-t dark:border-gray-600">
            <button data-modal-hide="delete-modal{{ $journal->id }}" type="button"
                class="px-4 py-2 text-sm rounded-lg bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600">
                Cancel
            </button>

            <!-- DELETE FORM -->
            <form action="{{ route('journals.destroy', $journal->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-400">
                    Delete
                </button>
            </form>
        </div>
    </div>
</div>
