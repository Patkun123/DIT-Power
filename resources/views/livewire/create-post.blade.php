<div class="p-4">
    <!-- Facebook-style Create Post Trigger -->
    <div class="flex items-center space-x-3 mb-3">
        <img class="h-10 w-10 rounded-full object-cover"
             src="{{ auth()->user()->profile_image_url }}"
             alt="{{ auth()->user()->firstname }} {{ auth()->user()->lastname }}"
             onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->firstname . ' ' . auth()->user()->lastname) }}&background=random&color=fff&size=100&bold=true'">
        <div wire:click="openModal" 
             class="flex-1 px-4 py-3 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-full cursor-pointer transition-colors">
            <p class="text-gray-500 dark:text-gray-400">What's on your mind, {{ auth()->user()->firstname }}?</p>
        </div>
    </div>

    <!-- Action Buttons Row (Facebook Style) -->
    <div class="grid grid-cols-2 gap-1 pt-3 border-t border-gray-200 dark:border-gray-700">
        <button wire:click="openModal"
                type="button"
                class="flex items-center justify-center space-x-2 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
            <svg class="w-6 h-6 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path>
            </svg>
            <span class="text-sm font-medium text-gray-600 dark:text-gray-300">Photo/Video</span>
        </button>
        <button wire:click="openModal"
                type="button"
                class="flex items-center justify-center space-x-2 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
            <svg class="w-6 h-6 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 9a1 1 0 100-2 1 1 0 000 2zm7-1a1 1 0 11-2 0 1 1 0 012 0zm-.464 5.535a1 1 0 10-1.415-1.414 3 3 0 01-4.242 0 1 1 0 00-1.415 1.414 5 5 0 007.072 0z" clip-rule="evenodd"></path>
            </svg>
            <span class="text-sm font-medium text-gray-600 dark:text-gray-300">Feeling/Activity</span>
        </button>
    </div>

    <!-- Create Post Modal (Facebook Style) -->
    @if($showModal)
    <div wire:click="closeModal"
         class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-60 p-4">
        <div wire:click.stop
             class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl w-full max-w-lg max-h-[90vh] overflow-y-auto">
            
            <!-- Modal Header -->
            <div class="sticky top-0 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 p-4 flex items-center justify-center relative rounded-t-xl">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white">Create Post</h3>
                <button wire:click="closeModal"
                        type="button"
                        class="absolute right-4 text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-full p-2 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <form wire:submit.prevent="createPost">
                <div class="p-4">
                    <!-- User Info -->
                    <div class="flex items-center space-x-3 mb-4">
                        <img class="h-10 w-10 rounded-full object-cover"
                             src="{{ auth()->user()->profile_image_url }}"
                             alt="{{ auth()->user()->firstname }} {{ auth()->user()->lastname }}"
                             onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->firstname . ' ' . auth()->user()->lastname) }}&background=random&color=fff&size=100&bold=true'">
                        <div>
                            <p class="font-semibold text-gray-900 dark:text-white">{{ auth()->user()->firstname }} {{ auth()->user()->lastname }}</p>
                            <div class="flex items-center space-x-1 text-xs bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded">
                                <svg class="w-3 h-3 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM4.332 8.027a6.012 6.012 0 011.912-2.706C6.512 5.73 6.974 6 7.5 6A1.5 1.5 0 019 7.5V8a2 2 0 004 0 2 2 0 011.523-1.943A5.977 5.977 0 0116 10c0 .34-.028.675-.083 1H15a2 2 0 00-2 2v.878A2.996 2.996 0 0110 16a2.996 2.996 0 01-3-2.122V13a2 2 0 00-2-2H4.083C4.028 10.675 4 10.34 4 10c0-.747.1-1.468.332-2.027z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-gray-600 dark:text-gray-400">Public</span>
                            </div>
                        </div>
                    </div>

                    <!-- Text Input -->
                    <div class="relative mb-4">
                        <textarea wire:model="content"
                                  wire:keyup="searchUsers($event.target.value, 'post')"
                                  wire:keydown.escape="hideMentionSuggestions"
                                  placeholder="What's on your mind, {{ auth()->user()->firstname }}?"
                                  class="w-full px-0 py-2 bg-transparent border-0 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-0 resize-none text-2xl"
                                  rows="4"
                                  style="min-height: 120px; max-height: 300px;"
                                  oninput="this.style.height = 'auto'; this.style.height = this.scrollHeight + 'px';"></textarea>
                        
                        <!-- Mention Suggestions for Post -->
                        @if($showMentionSuggestions && $currentMentionField === 'post')
                            <div class="mention-suggestions absolute left-0 right-0 top-full mt-2 bg-white dark:bg-gray-800 backdrop-blur border border-gray-200 dark:border-gray-600 rounded-xl shadow-xl max-h-56 overflow-y-auto z-10">
                                <div class="px-3 pt-2 pb-1 text-[11px] uppercase tracking-wide text-gray-500 dark:text-gray-400">Mention someone</div>
                                @foreach($mentionSuggestions as $index => $user)
                                    <button type="button"
                                            wire:click="selectMention({{ $user->id }}, 'post')"
                                            class="mention-suggestion-item w-full px-3 py-2.5 text-left hover:bg-gray-100 dark:hover:bg-gray-700 flex items-center gap-3 {{ $selectedMentionIndex === $index ? 'bg-blue-50 dark:bg-blue-900/60' : '' }}">
                                        <img class="h-8 w-8 rounded-full object-cover ring-2 ring-white dark:ring-gray-700" 
                                             src="{{ $user->profile_image_url }}"
                                             alt="{{ $user->firstname }} {{ $user->lastname }}"
                                             onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($user->firstname . ' ' . $user->lastname) }}&background=random&color=fff&size=100&bold=true'">
                                        <div class="min-w-0">
                                            <p class="font-medium text-gray-900 dark:text-white truncate">{{ $user->firstname }} {{ $user->lastname }}</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ $user->staff->position ?? 'Employee' }}</p>
                                        </div>
                                    </button>
                                @endforeach
                            </div>
                        @endif
                        @error('content')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Image Upload Preview -->
                    @if($showImagePreview && $image)
                        <div class="mb-4 relative rounded-lg overflow-hidden border border-gray-200 dark:border-gray-700">
                            <img src="{{ $image->temporaryUrl() }}"
                                 alt="Preview"
                                 class="w-full max-h-96 object-cover">
                            <button type="button"
                                    wire:click="removeImage"
                                    class="absolute top-2 right-2 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 rounded-full p-2 hover:bg-gray-100 dark:hover:bg-gray-700 shadow-lg transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    @endif

                    <!-- Add to Post Section (Facebook Style) -->
                    <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-3 mb-4">
                        <div class="flex items-center justify-between">
                            <p class="text-sm font-medium text-gray-900 dark:text-white">Add to your post</p>
                            <div class="flex items-center space-x-2">
                                <!-- Photo/Video -->
                                <label for="image-upload"
                                       class="cursor-pointer p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-full transition-colors"
                                       title="Photo/Video">
                                    <svg class="w-6 h-6 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path>
                                    </svg>
                                </label>
                                <input type="file"
                                       wire:model="image"
                                       accept="image/*"
                                       class="hidden"
                                       id="image-upload">

                                <!-- Feeling/Activity -->
                                <button type="button"
                                        class="p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-full transition-colors"
                                        title="Feeling/Activity">
                                    <svg class="w-6 h-6 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 9a1 1 0 100-2 1 1 0 000 2zm7-1a1 1 0 11-2 0 1 1 0 012 0zm-.464 5.535a1 1 0 10-1.415-1.414 3 3 0 01-4.242 0 1 1 0 00-1.415 1.414 5 5 0 007.072 0z" clip-rule="evenodd"></path>
                                    </svg>
                                </button>

                                <!-- Tag People -->
                                <button type="button"
                                        class="p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-full transition-colors"
                                        title="Tag People">
                                    <svg class="w-6 h-6 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        @error('image')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Character Counter -->
                    @if($content)
                        <div class="mb-3 text-right">
                            <span class="text-xs {{ strlen($content) > 900 ? 'text-red-600' : 'text-gray-500 dark:text-gray-400' }}">
                                {{ strlen($content) }}/1000
                            </span>
                        </div>
                    @endif

                    <!-- Post Button -->
                    <button type="submit"
                            wire:loading.attr="disabled"
                            wire:target="image,createPost"
                            @if(!$content) disabled @endif
                            class="w-full py-2.5 px-4 rounded-lg font-semibold transition-colors {{ $content ? 'bg-blue-600 hover:bg-blue-700 text-white cursor-pointer' : 'bg-gray-200 dark:bg-gray-700 text-gray-400 dark:text-gray-500 cursor-not-allowed' }}">
                        <span wire:loading.remove wire:target="createPost">Post</span>
                        <span wire:loading wire:target="image" class="flex items-center justify-center space-x-2">
                            <svg class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <span>Uploading...</span>
                        </span>
                        <span wire:loading wire:target="createPost" class="flex items-center justify-center space-x-2">
                            <svg class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <span>Posting...</span>
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif

    <!-- Success/Error Messages -->
    @if (session()->has('message'))
        <div class="mt-4 p-3 bg-green-100 dark:bg-green-900 border border-green-400 dark:border-green-600 text-green-700 dark:text-green-300 rounded-lg">
            {{ session('message') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="mt-4 p-3 bg-red-100 dark:bg-red-900 border border-red-400 dark:border-red-600 text-red-700 dark:text-red-300 rounded-lg">
            {{ session('error') }}
        </div>
    @endif
</div>
