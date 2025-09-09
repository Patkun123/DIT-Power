<div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
    <div class="flex items-start space-x-4">
        <div class="flex-shrink-0">
            <div class="relative profile-picture-container">
                <img class="h-12 w-12 rounded-full object-cover social-profile-pic profile-picture cursor-pointer" 
                     src="{{ auth()->user()->profile_image_url }}" 
                     alt="{{ auth()->user()->firstname }} {{ auth()->user()->lastname }}"
                     onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->firstname . ' ' . auth()->user()->lastname) }}&background=random&color=fff&size=100&bold=true'">
                <div class="online-indicator bg-green-500"></div>
            </div>
        </div>
        
        <div class="flex-1 min-w-0">
            <form wire:submit.prevent="createPost">
                <div class="mb-4">
                    <textarea wire:model="content" 
                              placeholder="What's on your mind?"
                              class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white resize-none"
                              rows="3"></textarea>
                    @error('content') 
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p> 
                    @enderror
                </div>

                <!-- Image Upload -->
                <div class="mb-4">
                    <input type="file" 
                           wire:model="image" 
                           accept="image/*"
                           class="hidden" 
                           id="image-upload">
                    <label for="image-upload" 
                           class="inline-flex items-center px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Add Image
                    </label>
                    @error('image') 
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p> 
                    @enderror
                </div>

                <!-- Image Preview -->
                @if($showImagePreview && $image)
                    <div class="mb-4 relative">
                        <img src="{{ $image->temporaryUrl() }}" 
                             alt="Preview" 
                             class="max-w-xs rounded-lg">
                        <button type="button" 
                                wire:click="removeImage"
                                class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                @endif

                <div class="flex justify-between items-center">
                    <div class="text-sm text-gray-500 dark:text-gray-400">
                        {{ strlen($content) }}/1000 characters
                    </div>
                    <button type="submit" 
                            class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition duration-200 disabled:opacity-50"
                            wire:loading.attr="disabled">
                        <span wire:loading.remove>Post</span>
                        <span wire:loading>Posting...</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    @if (session()->has('message'))
        <div class="mt-4 p-4 bg-green-100 dark:bg-green-900 border border-green-400 text-green-700 dark:text-green-300 rounded-lg">
            {{ session('message') }}
        </div>
    @endif
</div>