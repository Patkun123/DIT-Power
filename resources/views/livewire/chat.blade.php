<div class="w-full h-full flex justify-center items-center">
    <div class="chat-container w-full h-full max-w-full max-h-full flex flex-col bg-gray-100 shadow-md shadow-gray-900 dark:bg-gray-800 rounded-xl overflow-hidden">
        {{-- Messages --}}
        <div class="chat-messages flex-1 overflow-y-auto border-b p-4 space-y-3 scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-gray-100 min-h-0" wire:poll.2s>
            @foreach ($this->messages as $msg)
                <div class="flex items-end {{ $msg->user_id === auth()->id() ? 'justify-end' : 'justify-start' }}">

                    {{-- Profile Image (Left for other users) --}}
                    @if ($msg->user_id !== auth()->id())
                        <img src="{{ $msg->user->profileimage
                                    ? asset('storage/'.$msg->user->profileimage)
                                    : asset('images/default.png') }}"
                             class="w-10 h-10 rounded-full mr-2 border shadow object-cover">
                    @endif

                    {{-- Message Bubble --}}
                    <div class="max-w-[80%] md:max-w-sm px-3 py-2 rounded-2xl
                                {{ $msg->user_id === auth()->id()
                                    ? 'bg-blue-600 text-white rounded-br-none'
                                    : 'bg-gray-200 text-gray-900 rounded-bl-none' }}">
                        {{-- Name --}}
                        <div class="flex justify-between items-center mb-1">
                            <span class="text-sm font-bold">
                                {{ $msg->user->firstname }} {{ $msg->user->lastname }}
                            </span>
                        </div>

                        {{-- Message + Time --}}
                        <div class="break-words">
                            {!! app(\App\Livewire\Chat::class)->parseMentions(e($msg->message)) !!} <br>
                            <span class="text-xs {{ $msg->user_id === auth()->id() ? 'text-gray-200' : 'text-gray-500' }}">
                                {{ $msg->created_at->format('H:i') }}
                            </span>
                        </div>
                    </div>

                    {{-- Profile Image (Right for auth user) --}}
                    @if ($msg->user_id === auth()->id())
                        <img src="{{ $msg->user->profileimage
                                    ? asset('storage/'.$msg->user->profileimage)
                                    : asset('Images/default.png') }}"
                             class="w-10 h-10 rounded-full mr-2 border shadow object-cover">
                    @endif
                </div>
            @endforeach
        </div>

        {{-- Input with Globe Icon --}}
        <form wire:submit.prevent="sendMessage" class="chat-input flex gap-2 p-3 relative flex-shrink-0">
            {{-- Floating globe icon --}}
            <div class="absolute left-5 top-1/2 transform -translate-y-1/2 z-10">
                <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.94-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/>
                </svg>
            </div>

            <div class="relative flex-1">
                <input type="text"
                       wire:model.live.debounce.150ms="messageText"
                       wire:keyup="searchUsers($event.target.value, 'chat')"
                       wire:keydown.escape="hideMentionSuggestions"
                       wire:keydown.arrow-down.prevent="moveMentionSelection('down')"
                       wire:keydown.arrow-up.prevent="moveMentionSelection('up')"
                       wire:keydown.enter.prevent="selectCurrentMention()"
                       class="w-full border dark:bg-gray-800 rounded-lg p-2 pl-10 focus:ring focus:ring-blue-300 focus:border-blue-500 transition-colors"
                       placeholder="Type a global message... (use @ to mention)">
                @if($showMentionSuggestions && $currentMentionField === 'chat')
                    <div class="absolute z-50 left-0 right-0 bottom-full mb-1 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 rounded-lg shadow-lg max-h-48 overflow-y-auto">
                        @foreach($mentionSuggestions as $index => $user)
                            <button type="button"
                                    wire:click="selectMention({{ $user->id }}, 'chat')"
                                    class="w-full px-3 py-2 text-left hover:bg-gray-100 dark:hover:bg-gray-700 flex items-center gap-2 {{ $selectedMentionIndex === $index ? 'bg-blue-50 dark:bg-blue-900' : '' }}">
                                <img class="h-6 w-6 rounded-full object-cover"
                                     src="{{ $user->profile_image_url }}"
                                     alt="{{ $user->firstname }} {{ $user->lastname }}">
                                <div>
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $user->firstname }} {{ $user->lastname }}</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ $user->staff->position ?? 'Employee' }}</p>
                                </div>
                            </button>
                        @endforeach
                    </div>
                @endif
            </div>

            <button type="submit"
                    class="send-button text-white px-6 py-2 rounded-lg transition-all duration-200 flex items-center space-x-2 shadow-lg hover:shadow-xl transform hover:scale-105">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                </svg>
                <span>Send</span>
            </button>
        </form>
    </div>
</div>
