<!-- Update Article Modal -->
<div id="modalupdate-{{ $article->id }}" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50
    justify-center items-center w-full md:inset-0 h-modal md:h-full">

    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">

            <!-- Modal header -->
            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Update News Article
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900
                    rounded-lg text-sm p-1.5 ml-auto inline-flex items-center
                    dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-toggle="modalupdate-{{ $article->id }}">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                              d="M4.293 4.293a1 1 0 011.414 0L10
                              8.586l4.293-4.293a1 1 0 111.414
                              1.414L11.414 10l4.293 4.293a1 1 0
                              01-1.414 1.414L10 11.414l-4.293
                              4.293a1 1 0 01-1.414-1.414L8.586
                              10 4.293 5.707a1 1 0 010-1.414z"
                              clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>

            <!-- Modal body -->
            <form action="{{ route('news.edit', $article->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid gap-4 mb-4 sm:grid-cols-5">
                    <!-- Title -->
                    <div class="sm:col-span-6">
                        <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                        <input type="text" name="title" id="title" value="{{ $article->title }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                            focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5
                            dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" required>
                    </div>

                    <!-- Category -->
                    <div class="sm:col-span-2">
                        <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                            <select name="category" id="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                            focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5
                            dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                            <option selected>{{ $article->category }}</option>
                            <option value="WorldNews">World News</option>
                            <option value="LocalNews">Local News</option>
                            </select>
                    </div>

                    <!-- Publication Date -->
                    <div class="sm:col-span-2">
                        <label for="publication_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Publication Date</label>
                        <input type="date" name="publication_date" id="publication_date"
                            value="{{ $article->publication_date }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                            focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5
                            dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                        <select name="status" id="status"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                            focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5
                            dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <option value="draft" {{ $article->status == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="published" {{ $article->status == 'published' ? 'selected' : '' }}>Published</option>
                        </select>
                    </div>

                    <!-- Summary -->
                    <div class="sm:col-span-3">
                        <label for="summary" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Summary</label>
                        <textarea name="summary" id="summary" rows="3"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg
                            border border-gray-300 focus:ring-primary-500 focus:border-primary-500
                            dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ $article->summary }}</textarea>
                    </div>

                    <!-- Content -->
                    <div class="sm:col-span-3">
                        <label for="content" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Content</label>
                        <textarea name="content" id="content" rows="5"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg
                            border border-gray-300 focus:ring-primary-500 focus:border-primary-500
                            dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ $article->content }}</textarea>
                    </div>

                    <!-- Image Upload -->
                    <div class="sm:col-span-6">
                        <label for="image_url" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Image</label>
                        <input type="file" name="image_url" id="image_url"
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer
                            bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600">
                        @if($article->image_url)
                            <img src="{{ asset('storage/'.$article->image_url) }}" class="mt-2 w-32 rounded-lg">
                        @endif
                    </div>
                </div>

                <!-- Action buttons -->
                <div class="flex items-center space-x-4">
                    <button type="submit"
                        class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none
                        focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center
                        dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                        Update Article
                    </button>

                    <form action="{{ route('news-articles.destroy', $article->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="text-red-600 inline-flex items-center hover:text-white border border-red-600
                            hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium
                            rounded-lg text-sm px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500
                            dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                            <svg class="mr-1 -ml-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                      d="M9 2a1 1 0 00-.894.553L7.382
                                      4H4a1 1 0 000 2v10a2 2 0
                                      002 2h8a2 2 0 002-2V6a1 1 0
                                      100-2h-3.382l-.724-1.447A1 1 0
                                      0011 2H9zM7 8a1 1 0 012
                                      0v6a1 1 0 11-2 0V8zm5-1a1
                                      1 0 00-1 1v6a1 1 0 102
                                      0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            Delete
                        </button>
                    </form>
                </div>
            </form>
        </div>
    </div>
</div>
