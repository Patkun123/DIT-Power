@extends('auth.users.partials.app.head')

@section('title', 'Social Tools')
@section('content')
<div class="min-h-screen bg-gray-100 dark:bg-gray-900">

    {{-- Main Content --}}
    <div class="max-w-6xl mx-auto px-2 sm:px-4 lg:px-5 py-4 lg:py-0">
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
         class="fixed bottom-4 right-4 z-50 transition-all duration-300 ease-in-out"
         :class="isMinimized ? 'scale-100' : 'scale-100'"
         style="display: none;">

        {{-- Minimized Chat Button --}}
        <div x-show="isMinimized"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95">
            <button @click="toggleChat()"
                    class="sticky-chat-button bg-blue-600 hover:bg-blue-700 text-white rounded-full p-3 sm:p-4 shadow-lg hover:shadow-xl transition-all duration-200 flex items-center space-x-3 group">
                {{-- Globe Icon --}}
                <div class="relative">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.94-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/>
                    </svg>
                    {{-- Online Indicator --}}
                    <div class="online-indicator absolute -top-1 -right-1 w-2.5 h-2.5 sm:w-3 sm:h-3 bg-green-500 rounded-full border-2 border-white"></div>
                </div>
                <span class="text-xs sm:text-sm font-medium hidden group-hover:block">Global Chat</span>
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
             class="chat-window bg-white dark:bg-gray-800 rounded-lg shadow-2xl border border-gray-200 dark:border-gray-700 flex flex-col w-[calc(100vw-2rem)] max-w-full h-[70vh] max-h-[80vh] sm:w-[360px] sm:h-[460px] lg:w-[430px] lg:h-[500px] overflow-hidden">

            {{-- Chat Header --}}
            <div class="chat-header flex items-center justify-between p-3 border-b border-gray-200 dark:border-gray-700 rounded-t-lg">
                <div class="flex items-center space-x-2">
                    <div class="relative">
                        <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.94-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/>
                        </svg>
                        <div class="online-indicator absolute -top-1 -right-1 w-2 h-2 bg-green-500 rounded-full"></div>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Global Chat</h3>
                        <p class="text-xs text-green-600 dark:text-green-400">Online</p>
                    </div>
                </div>
                <div class="flex items-center space-x-1">
                    <button @click="toggleChat()"
                            class="p-1 hover:bg-gray-200 dark:hover:bg-gray-600 rounded transition-colors">
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                        </svg>
                    </button>
                    <button @click="closeChat()"
                            class="p-1 hover:bg-gray-200 dark:hover:bg-gray-600 rounded transition-colors">
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            {{-- Chat Content --}}
            <div class="flex-1 overflow-hidden">
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
// Tab switching functionality
function showTab(tabName) {
    console.log('Switching to tab:', tabName); // Debug log

    // Hide all tab contents
    const tabContents = document.querySelectorAll('.tab-content');
    tabContents.forEach(content => {
        content.classList.add('hidden');
        console.log('Hiding content:', content.id); // Debug log
    });

    // Remove active class from all tabs (both mobile and desktop)
    const tabs = document.querySelectorAll('[id$="-tab"], [id$="-tab-desktop"]');
    tabs.forEach(tab => {
        tab.classList.remove('bg-white', 'dark:bg-gray-800', 'text-gray-900', 'dark:text-white', 'shadow-sm');
        tab.classList.add('text-gray-600', 'dark:text-gray-400');
    });

    // Show selected tab content
    const selectedContent = document.getElementById(tabName + '-content');
    if (selectedContent) {
        selectedContent.classList.remove('hidden');
        console.log('Showing content:', selectedContent.id); // Debug log
    } else {
        console.error('Tab content not found:', tabName + '-content'); // Debug log
    }

    // Add active class to selected tab (both mobile and desktop)
    const selectedTab = document.getElementById(tabName + '-tab');
    const selectedTabDesktop = document.getElementById(tabName + '-tab-desktop');

    if (selectedTab) {
        selectedTab.classList.remove('text-gray-600', 'dark:text-gray-400');
        selectedTab.classList.add('bg-white', 'dark:bg-gray-800', 'text-gray-900', 'dark:text-white', 'shadow-sm');
        console.log('Activated mobile tab:', selectedTab.id); // Debug log
    } else {
        console.error('Mobile tab not found:', tabName + '-tab'); // Debug log
    }

    if (selectedTabDesktop) {
        selectedTabDesktop.classList.remove('text-gray-600', 'dark:text-gray-400');
        selectedTabDesktop.classList.add('bg-white', 'dark:bg-gray-800', 'text-gray-900', 'dark:text-white', 'shadow-sm');
        console.log('Activated desktop tab:', selectedTabDesktop.id); // Debug log
    } else {
        console.error('Desktop tab not found:', tabName + '-tab-desktop'); // Debug log
    }

    // Handle sticky chat widget visibility
    const stickyChatWidget = document.getElementById('sticky-chat-widget');
    if (stickyChatWidget) {
        if (tabName === 'social-feed') {
            // Show sticky chat widget when on social feed
            stickyChatWidget.style.display = 'block';
        } else {
            // Hide sticky chat widget when on live chat tab
            stickyChatWidget.style.display = 'none';
        }
    }
}

// Initialize with social feed tab active
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded, initializing tabs...');
    showTab('social-feed');

    // Add click event listeners to tab buttons
    const tabButtons = document.querySelectorAll('[data-tab]');
    tabButtons.forEach(button => {
        console.log('Found tab button:', button);
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const tabName = this.getAttribute('data-tab');
            console.log('Tab button clicked:', tabName);
            showTab(tabName);
        });
    });

    // Also handle onclick attributes as fallback
    const onclickButtons = document.querySelectorAll('[onclick^="showTab"]');
    onclickButtons.forEach(button => {
        if (!button.hasAttribute('data-tab')) {
            console.log('Found onclick tab button:', button);
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const onclick = this.getAttribute('onclick');
                const tabName = onclick.match(/showTab\('([^']+)'\)/)[1];
                console.log('Onclick tab button clicked:', tabName);
                showTab(tabName);
            });
        }
    });
});

</script>
@endpush
@endsection
