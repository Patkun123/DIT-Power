<!-- Modal for this article -->
<div id="showmodal{{ $article->id }}" tabindex="-1" aria-hidden="true"
     class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
<div class="relative p-4 w-full max-w-4xl h-full md:h-auto">
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-700 sm:p-5">
                            <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 inline-flex dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="showmodal{{ $article->id }}">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                              clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            <!-- Article Image at the TOP -->
            <div class="mb-4">
                <img src="{{ asset('storage/' . $article->image_url) }}"
                     alt="{{ $article->title }}"
                     class="w-full h-64 object-cover rounded-lg">
            </div>

            <!-- Header -->
            <div class="flex justify-between mb-4 sm:mb-5">
                <div class="text-lg text-gray-900 md:text-xl dark:text-white">
                    <h3 class="font-semibold">{{ $article->title }}</h3>
                    <p class="font-bold">{{ $article->author }}</p>
                </div>

            </div>

            <!-- Content -->
            <dl>
                <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Content</dt>
                <dd class="mb-4 font-light text-xs text-gray-500 sm:mb-5 dark:text-gray-300">
                    {{ $article->content ?? 'No content available.' }}
                </dd>
                <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Author</dt>
                <dd class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">{{ $article->author }}</dd>
            </dl>
        </div>
    </div>
</div>
