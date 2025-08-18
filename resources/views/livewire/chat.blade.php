<div class="flex-1 flex justify-center items-center">
    <div class="w-full h-full flex flex-col bg-gray-100 shadow-md shadow-gray-900 dark:bg-gray-800 rounded-xl">

        {{-- Messages --}}
        <div class="flex-1 overflow-y-auto border-b p-4 space-y-3 max-h-[70vh] scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-gray-100" wire:poll.2s>
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
                    <div class="max-w-xs md:max-w-sm px-3 py-2 rounded-2xl
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
                        <div>
                            {{ $msg->message }} <br>
                            <span class="text-xs {{ $msg->user_id === auth()->id() ? 'text-gray-200' : 'text-gray-500' }}">
                                {{ $msg->created_at->format('H:i') }}
                            </span>
                        </div>
                    </div>

                    {{-- Profile Image (Right for auth user) --}}
                    @if ($msg->user_id === auth()->id())
                        <img src="{{ $msg->user->profileimage
                                    ? asset('storage/'.$msg->user->profileimage)
                                    : asset('images/default.png') }}"
                             class="w-10 h-10 rounded-full mr-2 border shadow object-cover">
                    @endif
                </div>
            @endforeach
        </div>

        {{-- Input --}}
        <form wire:submit.prevent="sendMessage" class="flex gap-2 p-3">
            <input type="text"
                   wire:model="messageText"
                   class="flex-1 border dark:bg-gray-800 rounded-lg p-2 focus:ring focus:ring-blue-300"
                   placeholder="Type a message...">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg">Send</button>
        </form>
    </div>
</div>
