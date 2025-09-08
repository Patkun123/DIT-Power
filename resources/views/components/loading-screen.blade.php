<!-- Loading Screen Component -->
<div id="loading-screen" class="loading-screen">
    <!-- Loading Container -->
    <div class="loading-container flex flex-col items-center space-y-8">
        <!-- DTI Logo with Animation -->
        <div class="relative">
            <!-- Light mode logo -->
            <div class="block dark:hidden">
                <img src="/images/DTI_w12.png"
                     alt="DTI Logo"
                     class="logo h-16 w-auto loading-logo">
            </div>

            <!-- Dark mode logo -->
            <div class="hidden dark:block">
                <img src="/images/DTI_w12.png"
                     alt="DTI Logo"
                     class="logo h-16 w-auto loading-logo">
            </div>

            <!-- Rotating ring around logo -->
            <div class="absolute inset-0 -m-4">
                {{-- <div class="w-24 h-24 border-4 border-primary-200 dark:border-primary-800 border-t-primary-600 dark:border-t-primary-400 rounded-full loading-spinner"></div> --}}
            </div>
        </div>

        <!-- App Title -->
        <div class="text-center loading-content">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-2">
                DIT-Power
            </h1>
            <p class="text-sm text-gray-600 dark:text-gray-400">
                Personalized Online Wellness Resource HUB
            </p>
        </div>

        <!-- Loading Progress Bar -->
        <div class="progress-bar w-64 bg-gray-200 dark:bg-gray-700 rounded-full h-2 overflow-hidden">
            <div id="loading-progress" class="progress-fill h-full bg-gradient-to-r from-primary-500 to-primary-600 rounded-full transition-all duration-300 ease-out loading-progress" style="width: 0%"></div>
        </div>

        <!-- Loading Dots Animation -->
        <div class="flex space-x-2">
            <div class="w-3 h-3 bg-primary-500 rounded-full loading-dots" style="animation-delay: 0ms"></div>
            <div class="w-3 h-3 bg-primary-500 rounded-full loading-dots" style="animation-delay: 150ms"></div>
            <div class="w-3 h-3 bg-primary-500 rounded-full loading-dots" style="animation-delay: 300ms"></div>
        </div>

        <!-- Loading Text -->
        <div class="text-center loading-content">
            <p id="loading-text" class="text-sm text-gray-600 dark:text-gray-400">
                Loading...
            </p>
        </div>
    </div>

    <!-- Background Pattern (Optional) -->
    <div class="absolute inset-0 -z-10 opacity-5">
        <div class="absolute inset-0 bg-gradient-to-br from-primary-100 to-primary-200 dark:from-primary-900 dark:to-primary-800"></div>
        <div class="absolute inset-0" style="background-image: radial-gradient(circle at 25% 25%, rgba(34, 197, 94, 0.1) 0%, transparent 50%), radial-gradient(circle at 75% 75%, rgba(34, 197, 94, 0.1) 0%, transparent 50%);"></div>
    </div>
</div>

<style>
/* Custom animations for loading screen */
@keyframes logoFloat {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
}

@keyframes progressGlow {
    0%, 100% { box-shadow: 0 0 5px rgba(34, 197, 94, 0.3); }
    50% { box-shadow: 0 0 20px rgba(34, 197, 94, 0.6); }
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Apply animations */
#loading-screen .animate-pulse {
    animation: logoFloat 2s ease-in-out infinite;
}

#loading-progress {
    animation: progressGlow 2s ease-in-out infinite;
}

#loading-screen > div {
    animation: fadeInUp 0.8s ease-out;
}

/* Loading screen fade out animation */
#loading-screen.fade-out {
    opacity: 0;
    transform: scale(0.95);
    pointer-events: none;
}

/* Responsive adjustments */
@media (max-width: 640px) {
    #loading-screen .flex.flex-col.space-y-8 {
        padding: 0 2rem;
    }

    #loading-screen h1 {
        font-size: 1.5rem;
    }

    #loading-screen .w-64 {
        width: 16rem;
    }
}
</style>

<script>
(function() {
    'use strict';

    let loadingScreen, progressBar, loadingText;
    let loadingInterval;
    let isLoaded = false;

    // Loading messages
    const loadingMessages = [
        'Initializing DIT-Power...',
        'Loading wellness resources...',
        'Preparing your dashboard...',
        'Setting up notifications...',
        'Almost ready...',
        'Welcome to DIT-Power!'
    ];

    let currentMessage = 0;
    let progress = 0;

    // Initialize loading screen
    function initLoadingScreen() {
        loadingScreen = document.getElementById('loading-screen');
        progressBar = document.getElementById('loading-progress');
        loadingText = document.getElementById('loading-text');

        if (!loadingScreen || !progressBar || !loadingText) {
            console.warn('Loading screen elements not found');
            return;
        }

        startLoadingAnimation();
    }

    // Start loading animation
    function startLoadingAnimation() {
        // Reset state
        progress = 0;
        currentMessage = 0;
        progressBar.style.width = '0%';
        loadingText.textContent = 'Loading...';

        // Start progress simulation
        loadingInterval = setInterval(updateProgress, 150);
    }

    // Update progress and messages
    function updateProgress() {
        // Increment progress with some randomness for realistic feel
        const increment = Math.random() * 12 + 3; // 3-15% increments
        progress += increment;

        if (progress > 100) {
            progress = 100;
        }

        progressBar.style.width = progress + '%';

        // Update loading text based on progress
        updateLoadingMessage();

        // Complete loading
        if (progress >= 100) {
            completeLoading();
        }
    }

    // Update loading message
    function updateLoadingMessage() {
        if (currentMessage < loadingMessages.length - 1) {
            const messageProgress = (progress / 100) * loadingMessages.length;
            const newMessageIndex = Math.floor(messageProgress);
            if (newMessageIndex !== currentMessage && newMessageIndex < loadingMessages.length) {
                currentMessage = newMessageIndex;
                loadingText.textContent = loadingMessages[currentMessage];
            }
        }
    }

    // Complete loading process
    function completeLoading() {
        if (loadingInterval) {
            clearInterval(loadingInterval);
        }

        loadingText.textContent = 'Ready!';
        isLoaded = true;

        // Hide loading screen after a short delay
        setTimeout(() => {
            hideLoadingScreen();
        }, 800);
    }

    // Hide loading screen with animation
    function hideLoadingScreen() {
        if (loadingScreen) {
            loadingScreen.classList.add('fade-out');
            setTimeout(() => {
                loadingScreen.style.display = 'none';
                loadingScreen.classList.remove('fade-out');
            }, 500);
        }
    }

    // Show loading screen
    function showLoadingScreen() {
        if (loadingScreen) {
            loadingScreen.style.display = 'flex';
            loadingScreen.classList.remove('fade-out');
            startLoadingAnimation();
        }
    }

    // Event listeners
    function setupEventListeners() {
        // Hide loading screen on page load (fallback)
        window.addEventListener('load', function() {
            setTimeout(() => {
                if (!isLoaded && loadingScreen && loadingScreen.style.display !== 'none') {
                    completeLoading();
                }
            }, 2000); // Fallback after 2 seconds
        });

        // Livewire navigation events
        document.addEventListener('livewire:navigating', function() {
            showLoadingScreen();
        });

        document.addEventListener('livewire:navigated', function() {
            setTimeout(() => {
                hideLoadingScreen();
            }, 300);
        });

        // Handle page visibility changes
        document.addEventListener('visibilitychange', function() {
            if (document.hidden) {
                // Page is hidden, pause loading
                if (loadingInterval) {
                    clearInterval(loadingInterval);
                }
            } else if (!isLoaded) {
                // Page is visible again, resume loading
                startLoadingAnimation();
            }
        });
    }

    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
            initLoadingScreen();
            setupEventListeners();
        });
    } else {
        initLoadingScreen();
        setupEventListeners();
    }

    // Expose functions globally for manual control
    window.loadingScreen = {
        show: showLoadingScreen,
        hide: hideLoadingScreen,
        reset: function() {
            isLoaded = false;
            showLoadingScreen();
        }
    };
})();
</script>
