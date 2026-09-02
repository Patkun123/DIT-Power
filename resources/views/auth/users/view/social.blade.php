@extends('auth.users.partials.app.head')

@section('title', 'Social Tools')
@section('content')
<div class="min-h-screen bg-gray-100 dark:bg-gray-900">
    {{-- Include Facebook-style Header --}}

    {{-- Main Content --}}
    <div class="pt-4">
        {{-- Social Feed Tab --}}
        <div id="social-feed-content" class="tab-content">
            @livewire('social-feed')
        </div>
    </div>

    {{-- Sticky/Floating Chat Widget (Facebook Messenger Style) --}}
    <div id="sticky-chat-widget"
        x-data="{
             isMinimized: true,
             isVisible: false,
             toggleChat() {
                 this.isMinimized = !this.isMinimized;
                 if (!this.isMinimized) {
                     this.isVisible = true;
                 }
             },
             closeChat() {
                 this.isMinimized = true;
                 this.isVisible = false;
             }
         }"
        class="fixed bottom-4 right-4 z-40 transition-all duration-300 ease-in-out"
        style="display: block;">

        {{-- Minimized Chat Button --}}
        <div x-show="isMinimized"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95">
            <button @click="toggleChat()"
                class="bg-blue-600 hover:bg-blue-700 text-white rounded-full p-4 shadow-lg hover:shadow-xl transition-all duration-200 flex items-center space-x-2 group">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.94-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z" />
                </svg>
                <span class="text-sm font-medium hidden sm:block">Global Chat</span>
            </button>
        </div>

        {{-- Expanded Chat Window --}}
        <div x-show="!isMinimized"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-95 translate-y-4"
            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
            x-transition:leave-end="opacity-0 scale-95 translate-y-4"
            class="bg-white dark:bg-gray-800 rounded-lg shadow-2xl border border-gray-200 dark:border-gray-700 flex flex-col w-[calc(100vw-2rem)] max-w-full h-[70vh] max-h-[600px] sm:w-[380px] sm:h-[500px] lg:w-[420px] lg:h-[550px] overflow-hidden">

            {{-- Chat Header --}}
            <div class="flex items-center justify-between p-3 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800">
                <div class="flex items-center space-x-2">
                    <div class="relative">
                        <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.94-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z" />
                        </svg>
                        <div class="absolute -top-0.5 -right-0.5 w-3 h-3 bg-green-500 border-2 border-white dark:border-gray-800 rounded-full"></div>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Global Chat</h3>
                        <p class="text-xs text-green-600 dark:text-green-400">Active now</p>
                    </div>
                </div>
                <div class="flex items-center space-x-1">
                    <button @click="toggleChat()"
                        class="p-1.5 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-full transition-colors">
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                        </svg>
                    </button>
                    <button @click="closeChat()"
                        class="p-1.5 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-full transition-colors">
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            {{-- Chat Content --}}
            <div class="flex-1 overflow-hidden min-h-0">
                @livewire('chat')
            </div>
        </div>
    </div>
</div>

@push('styles')
<link rel="stylesheet" href="{{ asset('css/globe-chat.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('js/mentions.js') }}"></script>
<script>
    // Auto-scroll chat to bottom on load
    document.addEventListener('DOMContentLoaded', function() {
        const chatMessages = document.getElementById('chat-messages');
        if (chatMessages) {
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }
    });
</script>
@endpush
@endsection
