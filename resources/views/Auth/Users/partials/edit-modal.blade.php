<!-- Edit Journal Modal -->
<div id="edit-modal{{ $journal->id }}" tabindex="-1" aria-hidden="true"
     class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50
            justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">

    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">

            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t
                        dark:border-gray-600 border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Edit Journal
                </h3>
                <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900
                               rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center
                               dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="edit-modal{{ $journal->id }}">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                         fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                              stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>

            <!-- Modal body -->
            <form action="{{ route('journals.update', $journal->id) }}" method="POST" class="p-4 md:p-5">
                @csrf
                @method('PUT')

                <div class="grid gap-4 mb-4">
                    <!-- Title -->
                    <div class="col-span-2">
                        <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Title
                        </label>
                        <input type="text" name="title" id="title"
                               value="{{ old('title', $journal->title) }}"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                      focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5
                                      dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400
                                      dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                               required>
                    </div>

                    <!-- Feeling -->
                    <div class="col-span-2 sm:col-span-1">
                        <label for="feeling" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Feeling
                        </label>
                        <select name="feeling" id="feeling"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                       focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5
                                       dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400
                                       dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="happy"   {{ $journal->feeling === 'happy' ? 'selected' : '' }}>😊 Happy</option>
                            <option value="sad"     {{ $journal->feeling === 'sad' ? 'selected' : '' }}>😢 Sad</option>
                            <option value="angry"   {{ $journal->feeling === 'angry' ? 'selected' : '' }}>😡 Angry</option>
                            <option value="excited" {{ $journal->feeling === 'excited' ? 'selected' : '' }}>🤩 Excited</option>
                            <option value="neutral" {{ $journal->feeling === 'neutral' ? 'selected' : '' }}>😐 Neutral</option>
                        </select>
                    </div>

                    <!-- Tags -->
                    <div class="col-span-2 sm:col-span-1">
                        <label for="tags" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Tags
                        </label>
                        <input type="text" name="tags" id="tags"
                               value="{{ old('tags', $journal->tags) }}"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                      focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5
                                      dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400
                                      dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                               placeholder="e.g. work, study">
                    </div>

                    <!-- Journal Text -->
                    <div class="col-span-2">
                        <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Journal Entry
                        </label>
                        <textarea name="text" id="text" rows="4"
                                  class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg
                                         border border-gray-300 focus:ring-blue-500 focus:border-blue-500
                                         dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400
                                         dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                  required>{{ old('text', $journal->text) }}</textarea>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                        class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800
                               focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium
                               rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600
                               dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                         xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M4 10a6 6 0 1112 0 6 6 0 01-12 0zm7-3a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd"></path>
                    </svg>
                    Save Changes
                </button>
            </form>
        </div>
    </div>
</div>
