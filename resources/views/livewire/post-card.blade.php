<div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-4 mb-6">
    {{-- Error Messages --}}
    @if (session()->has('error'))
        <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-4 rounded" role="alert">
            <div class="flex items-center">
                <svg class="w-5 h-5 text-red-400 mr-3" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                </svg>
                <div>
                    <p class="text-sm font-medium text-red-800">
                        {{ session('error') }}
                    </p>
                    @error('general')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
    @endif

    {{-- Success Messages --}}
    @if (session()->has('message'))
        <div class="bg-green-50 border-l-4 border-green-400 p-4 mb-4 rounded" role="alert">
            <div class="flex items-center">
                <svg class="w-5 h-5 text-green-400 mr-3" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <p class="text-sm font-medium text-green-800">
                    {{ session('message') }}
                </p>
            </div>
        </div>
    @endif

    {{-- Create Post Form --}}
    <form wire:submit.prevent="createPost">
        <div class="flex space-x-3">
            {{-- User Avatar --}}
            <img class="h-10 w-10 rounded-full object-cover flex-shrink-0"
                 src="{{ auth()->user()->profile_image_url }}"
                 alt="{{ auth()->user()->firstname }} {{ auth()->user()->lastname }}"
                 onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->firstname . ' ' . auth()->user()->lastname) }}&background=random&color=fff&size=100&bold=true'">

            <div class="flex-1">
                {{-- Content Textarea --}}
                <div class="relative mb-3">
                    <textarea
                        wire:model="content"
                        wire:keyup="searchUsers($event.target.value, 'post')"
                        wire:keydown.escape="hideMentionSuggestions"
                        placeholder="What's on your mind, {{ auth()->user()->firstname }}?"
                        class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none transition-all"
                        rows="3"
                        maxlength="1000"
                    ></textarea>

                    {{-- Character Counter --}}
                    <div class="absolute bottom-2 right-2 text-xs text-gray-400">
                        {{ strlen($content) }}/1000
                    </div>

                    @error('content')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror

                    {{-- Mention Suggestions Dropdown --}}
                    @if($showMentionSuggestions && $currentMentionField === 'post')
                        <div class="absolute z-50 w-full mt-1 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 rounded-lg shadow-lg max-h-48 overflow-y-auto">
                            @foreach($mentionSuggestions as $index => $user)
                                <button
                                    type="button"
                                    wire:click="selectMention({{ $user->id }}, 'post')"
                                    class="w-full px-4 py-3 text-left hover:bg-gray-100 dark:hover:bg-gray-700 flex items-center space-x-3 transition-colors {{ $selectedMentionIndex === $index ? 'bg-blue-50 dark:bg-blue-900/30' : '' }}"
                                >
                                    <img
                                        class="h-10 w-10 rounded-full object-cover"
                                        src="{{ $user->profile_image_url }}"
                                        alt="{{ $user->firstname }} {{ $user->lastname }}"
                                        onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($user->firstname . ' ' . $user->lastname) }}&background=random&color=fff&size=100&bold=true'"
                                    >
                                    <div class="flex-1">
                                        <p class="font-medium text-gray-900 dark:text-white">
                                            {{ $user->firstname }} {{ $user->lastname }}
                                        </p>
                                        @if($user->staff)
                                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                                {{ $user->staff->position ?? 'Employee' }}
                                            </p>
                                        @endif
                                    </div>
                                </button>
                            @endforeach
                        </div>
                    @endif
                </div>

                {{-- Image Preview --}}
                @if ($showImagePreview && $image)
                    <div class="mb-3 relative inline-block">
                        <img
                            src="{{ $image->temporaryUrl() }}"
                            class="max-h-80 rounded-lg object-cover border border-gray-200 dark:border-gray-600"
                            alt="Image preview"
                        >
                        <button
                            type="button"
                            wire:click="removeImage"
                            class="absolute top-2 right-2 bg-gray-900 bg-opacity-75 hover:bg-opacity-100 text-white rounded-full p-2 transition-all transform hover:scale-110"
                            title="Remove image"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                @endif

                @error('image')
                    <p class="mb-3 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror

                {{-- Upload Progress Indicator --}}
                <div wire:loading wire:target="image" class="mb-3">
                    <div class="flex items-center space-x-3 text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-900/20 px-4 py-3 rounded-lg">
                        <svg class="animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span class="text-sm font-medium">Uploading image...</span>
                    </div>
                </div>

                {{-- Actions Bar --}}
                <div class="flex items-center justify-between pt-3 border-t border-gray-200 dark:border-gray-700">
                    {{-- Add Media Button --}}
                    <div class="flex space-x-2">
                        <label class="cursor-pointer flex items-center space-x-2 px-4 py-2 text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors group">
                            <svg class="w-6 h-6 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span class="text-sm font-medium hidden sm:inline">Photo</span>
                            <input
                                type="file"
                                wire:model="image"
                                accept="image/jpeg,image/png,image/jpg,image/gif,image/webp"
                                class="hidden"
                            >
                        </label>
                    </div>

                    {{-- Post Button --}}
                    <button
                        type="submit"
                        wire:loading.attr="disabled"
                        wire:target="createPost, image"
                        class="px-6 py-2 bg-blue-600 hover:bg-blue-700 disabled:bg-blue-400 disabled:cursor-not-allowed text-white text-sm font-semibold rounded-lg transition-all transform hover:scale-105 active:scale-95 shadow-sm hover:shadow-md"
                    >
                        <span wire:loading.remove wire:target="createPost, image">Post</span>

                        <span wire:loading wire:target="createPost" class="flex items-center space-x-2">
                            <svg class="animate-spin h-4 w-4" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <span>Posting...</span>
                        </span>

                        <span wire:loading wire:target="image" class="flex items-center space-x-2">
                            <svg class="animate-spin h-4 w-4" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <span>Uploading...</span>
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
    // Auto-hide success messages after 5 seconds
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
            const successMessages = document.querySelectorAll('.bg-green-50');
            successMessages.forEach(function(message) {
                message.style.transition = 'opacity 0.5s';
                message.style.opacity = '0';
                setTimeout(() => message.remove(), 500);
            });
        }, 5000);
    });
</script>
@endpush
