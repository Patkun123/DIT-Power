<div class="w-full h-full flex flex-col bg-white dark:bg-gray-800">
    {{-- Messages --}}
    <div class="flex-1 overflow-y-auto p-4 space-y-3 scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-transparent min-h-0"
         wire:poll.2s
         id="chat-messages">
        @foreach ($this->messages as $msg)
            <div class="flex items-end {{ $msg->user_id === auth()->id() ? 'justify-end' : 'justify-start' }} space-x-2">
                {{-- Profile Image (Left for other users) --}}
                @if ($msg->user_id !== auth()->id())
                    <img src="{{ $msg->user->profile_image_url }}"
                         alt="{{ $msg->user->firstname }}"
                         class="w-8 h-8 rounded-full object-cover border-2 border-gray-200 dark:border-gray-600 flex-shrink-0"
                         onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($msg->user->firstname . ' ' . $msg->user->lastname) }}&background=random&color=fff&size=100&bold=true'">
                @endif

                {{-- Message Bubble --}}
                <div class="max-w-[75%] md:max-w-sm px-3 py-2 rounded-2xl
                            {{ $msg->user_id === auth()->id()
                                ? 'bg-blue-600 text-white rounded-br-sm'
                                : 'bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-white rounded-bl-sm' }}">
                    {{-- Name (only for other users) --}}
                    @if ($msg->user_id !== auth()->id())
                        <div class="mb-1">
                            <span class="text-xs font-semibold text-gray-700 dark:text-gray-300">
                                {{ $msg->user->firstname }} {{ $msg->user->lastname }}
                            </span>
                        </div>
                    @endif

                    {{-- Message Content --}}
                    <div class="break-words text-sm">
                        {!! app(\App\Livewire\Chat::class)->parseMentions(e($msg->message)) !!}
                    </div>

                    {{-- Time --}}
                    <div class="flex justify-end mt-1">
                        <span class="text-xs {{ $msg->user_id === auth()->id() ? 'text-blue-100' : 'text-gray-500 dark:text-gray-400' }}">
                            {{ $msg->created_at->format('g:i A') }}
                        </span>
                    </div>
                </div>

                {{-- Profile Image (Right for auth user) --}}
                @if ($msg->user_id === auth()->id())
                    <img src="{{ auth()->user()->profile_image_url }}"
                         alt="{{ auth()->user()->firstname }}"
                         class="w-8 h-8 rounded-full object-cover border-2 border-gray-200 dark:border-gray-600 flex-shrink-0"
                         onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->firstname . ' ' . auth()->user()->lastname) }}&background=random&color=fff&size=100&bold=true'">
                @endif
            </div>
        @endforeach
    </div>

    {{-- Input Area --}}
    <form wire:submit.prevent="sendMessage"
          class="border-t border-gray-200 dark:border-gray-700 p-3 bg-white dark:bg-gray-800 flex-shrink-0">
        <div class="flex items-end space-x-2">
            {{-- Input Field --}}
            <div class="relative flex-1">
                <div class="bg-gray-100 dark:bg-gray-700 rounded-full px-4 py-2.5 focus-within:ring-2 focus-within:ring-blue-500 transition-all">
                    <input type="text"
                           wire:model.live.debounce.150ms="messageText"
                           wire:keyup="searchUsers($event.target.value, 'chat')"
                           wire:keydown.escape="hideMentionSuggestions"
                           wire:keydown.arrow-down.prevent="moveMentionSelection('down')"
                           wire:keydown.arrow-up.prevent="moveMentionSelection('up')"
                           wire:keydown.enter.prevent="selectCurrentMention()"
                           class="w-full bg-transparent border-0 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none text-sm"
                           placeholder="Type a message...">
                </div>

                {{-- Mention Suggestions --}}
                @if($showMentionSuggestions && $currentMentionField === 'chat')
                    <div class="absolute z-50 left-0 right-0 bottom-full mb-2 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 rounded-lg shadow-xl max-h-48 overflow-y-auto">
                        <div class="px-3 pt-2 pb-1 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide">Mention someone</div>
                        @foreach($mentionSuggestions as $index => $user)
                            <button type="button"
                                    wire:click="selectMention({{ $user->id }}, 'chat')"
                                    class="w-full px-3 py-2 text-left hover:bg-gray-100 dark:hover:bg-gray-700 flex items-center gap-3 {{ $selectedMentionIndex === $index ? 'bg-blue-50 dark:bg-blue-900/60' : '' }}">
                                <img class="h-8 w-8 rounded-full object-cover"
                                     src="{{ $user->profile_image_url }}"
                                     alt="{{ $user->firstname }} {{ $user->lastname }}">
                                <div class="min-w-0 flex-1">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white truncate">{{ $user->firstname }} {{ $user->lastname }}</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ $user->staff->position ?? 'Employee' }}</p>
                                </div>
                            </button>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- Send Button --}}
            <button type="submit"
                    wire:loading.attr="disabled"
                    class="bg-blue-600 hover:bg-blue-700 text-white rounded-full p-2.5 transition-colors disabled:opacity-50 disabled:cursor-not-allowed flex-shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                </svg>
            </button>
        </div>
    </form>
</div>

<script>
    // Auto-scroll to bottom when new messages arrive
    document.addEventListener('livewire:init', () => {
        Livewire.hook('morph.updated', ({ el, component }) => {
            if (el.id === 'chat-messages') {
                el.scrollTop = el.scrollHeight;
            }
        });
    });
</script>
