<div class="p-4">
    <!-- Facebook-style Create Post -->
    <div class="flex items-center space-x-3 mb-4">
        <img class="h-10 w-10 rounded-full object-cover"
             src="{{ auth()->user()->profile_image_url }}"
             alt="{{ auth()->user()->firstname }} {{ auth()->user()->lastname }}"
             onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->firstname . ' ' . auth()->user()->lastname) }}&background=random&color=fff&size=100&bold=true'">
        <div class="flex-1 relative">
            <form wire:submit.prevent="createPost">
                <textarea wire:model="content"
                          wire:keyup="searchUsers($event.target.value, 'post')"
                          wire:keydown.escape="hideMentionSuggestions"
                          placeholder="What's on your mind, {{ auth()->user()->firstname }}?"
                          class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-full text-gray-900 dark:text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none transition-all duration-200"
                          rows="1"
                          style="min-height: 40px; max-height: 120px;"
                          oninput="this.style.height = 'auto'; this.style.height = this.scrollHeight + 'px';"></textarea>
                
                <!-- Mention Suggestions for Post -->
                @if($showMentionSuggestions && $currentMentionField === 'post')
                    <div class="mention-suggestions absolute left-0 right-0 top-full mt-2 bg-white/95 dark:bg-gray-800/95 backdrop-blur border border-gray-200 dark:border-gray-600 rounded-xl shadow-xl ring-1 ring-black/5 dark:ring-white/10 max-h-56 overflow-y-auto">
                        <div class="px-3 pt-2 pb-1 text-[11px] uppercase tracking-wide text-gray-500 dark:text-gray-400">Mention someone</div>
                        @foreach($mentionSuggestions as $index => $user)
                            <button type="button"
                                    wire:click="selectMention({{ $user->id }}, 'post')"
                                    class="mention-suggestion-item w-full px-3 py-2.5 text-left hover:bg-gray-100/80 dark:hover:bg-gray-700/80 flex items-center gap-3 {{ $selectedMentionIndex === $index ? 'bg-blue-50 dark:bg-blue-900/60' : '' }}">
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
    </div>

    <!-- Image Upload Preview -->
    @if($showImagePreview && $image)
        <div class="mb-4 relative">
            <img src="{{ $image->temporaryUrl() }}"
                 alt="Preview"
                 class="w-full max-h-96 object-cover rounded-lg">
            <button type="button"
                    wire:click="removeImage"
                    class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-2 hover:bg-red-600 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    @endif

    <!-- Action Buttons -->
    <div class="flex items-center justify-between pt-3 border-t border-gray-200 dark:border-gray-700">
        <div class="flex items-center space-x-4">
            <!-- Photo/Video Button -->
            <label for="image-upload"
                   class="flex items-center space-x-2 px-4 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 cursor-pointer transition-colors">
                <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path>
                </svg>
                <span class="text-sm font-medium text-gray-600 dark:text-gray-400">Photo/Video</span>
            </label>
            <input type="file"
                   wire:model="image"
                   accept="image/*"
                   class="hidden"
                   id="image-upload">
            @error('image')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <!-- Post Button -->
        <button type="submit"
                wire:loading.attr="disabled"
                class="bg-blue-600 hover:bg-blue-700 disabled:opacity-50 disabled:cursor-not-allowed text-white font-medium py-2 px-6 rounded-lg transition duration-200">
            <span wire:loading.remove wire:target="createPost">Post</span>
            <span wire:loading wire:target="createPost" class="flex items-center space-x-2">
                <svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Posting...
            </span>
        </button>
    </div>

    <!-- Character Counter -->
    @if($content)
        <div class="mt-2 text-right">
            <span class="text-xs text-gray-500 dark:text-gray-400">{{ strlen($content) }}/1000</span>
        </div>
    @endif
    </form>

    <!-- Success Message -->
    @if (session()->has('message'))
        <div class="mt-4 p-3 bg-green-100 dark:bg-green-900 border border-green-400 text-green-700 dark:text-green-300 rounded-lg">
            {{ session('message') }}
        </div>
    @endif

    <!-- General Error Messages -->
    @if ($errors->any())
        <div class="mt-4 p-3 bg-red-100 dark:bg-red-900 border border-red-400 text-red-700 dark:text-red-300 rounded-lg">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
