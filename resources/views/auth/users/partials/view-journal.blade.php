<!-- View Journal Modal -->
<div id="view-modal{{ $journal->id }}" data-modal-backdrop="view" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full backdrop-blur-sm">
    <div class="relative p-4 w-full max-w-3xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white dark:bg-gray-800 rounded-2xl shadow-2xl overflow-hidden">
            <!-- Modal header with gradient -->
            <div class="bg-gradient-to-r from-primary-600 via-primary-700 to-primary-800 dark:from-primary-700 dark:via-primary-800 dark:to-primary-900 px-6 py-5">
                <div class="flex items-center justify-between">
                    <div class="flex-1 min-w-0">
                        <h3 class="text-xl sm:text-2xl font-bold text-white mb-2 truncate">
                            {{ $journal->title }}
                        </h3>
                        <div class="flex items-center space-x-4 text-primary-100 text-sm">
                            <div class="flex items-center space-x-1.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span>{{ $journal->created_at->format('F j, Y') }}</span>
                            </div>
                            <span class="text-primary-200">•</span>
                            <div class="flex items-center space-x-1.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>{{ $journal->created_at->format('g:i A') }}</span>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="ml-4 p-2 text-white/80 hover:text-white hover:bg-white/20 rounded-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-white/50" data-modal-hide="view-modal{{ $journal->id }}">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
            </div>
            
            <!-- Modal body -->
            <div class="p-6 sm:p-8 space-y-6">
                {{-- Mood Display --}}
                <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-900/50 rounded-xl border border-gray-200 dark:border-gray-700">
                    <div class="flex items-center space-x-3">
                        <span class="text-4xl">
                            @php
                            $moodEmojis = [
                                'happy' => '😊',
                                'calm' => '😌',
                                'sad' => '😢',
                                'angry' => '😠',
                                'anxious' => '😰',
                                'excited' => '🤩',
                                'neutral' => '😐'
                            ];
                            $moodColors = [
                                'happy' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300',
                                'calm' => 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300',
                                'sad' => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300',
                                'angry' => 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300',
                                'anxious' => 'bg-orange-100 text-orange-800 dark:bg-orange-900/30 dark:text-orange-300',
                                'excited' => 'bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-300',
                                'neutral' => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300'
                            ];
                            $emoji = $moodEmojis[$journal->feeling] ?? '😐';
                            $color = $moodColors[$journal->feeling] ?? $moodColors['neutral'];
                            @endphp
                            {{ $emoji }}
                        </span>
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Feeling</p>
                            <p class="text-lg font-bold text-gray-900 dark:text-white capitalize">{{ $journal->feeling }}</p>
                        </div>
                    </div>
                    <div class="px-4 py-2 rounded-lg {{ $color }} border border-current/20">
                        <span class="text-sm font-semibold capitalize">{{ $journal->feeling }}</span>
                    </div>
                </div>

                {{-- Journal Text --}}
                <div>
                    <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3 uppercase tracking-wide">Your Thoughts</h4>
                    <div class="prose prose-sm dark:prose-invert max-w-none">
                        <p class="text-base leading-relaxed text-gray-700 dark:text-gray-300 whitespace-pre-wrap">
                            {{ $journal->text }}
                        </p>
                    </div>
                </div>

                {{-- Tags --}}
                @if(!empty($journal->tags))
                <div>
                    <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3 uppercase tracking-wide">Tags</h4>
                    <div class="flex flex-wrap gap-2">
                        @foreach(explode(',', $journal->tags) as $tag)
                            @if(trim($tag))
                            <span class="inline-flex items-center px-3 py-1.5 rounded-lg bg-primary-50 dark:bg-primary-900/20 text-primary-700 dark:text-primary-300 text-sm font-medium border border-primary-200 dark:border-primary-800">
                                <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"></path>
                                </svg>
                                {{ trim($tag) }}
                            </span>
                            @endif
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
            
            <!-- Modal footer -->
            <div class="flex items-center justify-end gap-3 p-6 bg-gray-50 dark:bg-gray-900/50 border-t border-gray-200 dark:border-gray-700">
                <button 
                    data-modal-hide="view-modal{{ $journal->id }}" 
                    data-modal-target="edit-modal{{$journal->id}}" 
                    data-modal-toggle="edit-modal{{$journal->id}}" 
                    type="button"
                    class="inline-flex items-center space-x-2 px-5 py-2.5 text-sm font-semibold text-white bg-primary-600 hover:bg-primary-700 dark:bg-primary-600 dark:hover:bg-primary-700 rounded-xl shadow-md hover:shadow-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    <span>Edit</span>
                </button>
                <button 
                    data-modal-hide="view-modal{{ $journal->id }}" 
                    data-modal-target="delete-modal{{$journal->id}}" 
                    data-modal-toggle="delete-modal{{$journal->id}}" 
                    type="button"
                    class="inline-flex items-center space-x-2 px-5 py-2.5 text-sm font-semibold text-white bg-red-600 hover:bg-red-700 dark:bg-red-600 dark:hover:bg-red-700 rounded-xl shadow-md hover:shadow-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                    <span>Delete</span>
                </button>
            </div>
        </div>
    </div>
</div>
@include('auth.users.partials.delete-modal')
@include('auth.users.partials.edit-modal')
