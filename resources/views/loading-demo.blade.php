<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loading Screen Demo - DIT-Power</title>
    <link rel="icon" href="/images/favicon.ico" sizes="any">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    @vite(['resources/css/app.css','resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    @fluxAppearance
    @fluxScripts
</head>
<body class="bg-gray-50 dark:bg-gray-900 min-h-screen">
    <!-- Loading Screen -->
    @include('components.loading-screen')

    <!-- Demo Content -->
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <h1 class="text-4xl font-bold text-center mb-8 text-gray-800 dark:text-white">
                Loading Screen Demo
            </h1>

            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8 mb-8">
                <h2 class="text-2xl font-semibold mb-4 text-gray-800 dark:text-white">
                    Features
                </h2>
                <ul class="space-y-2 text-gray-600 dark:text-gray-300">
                    <li>✅ DTI Logo with floating animation</li>
                    <li>✅ Rotating spinner around logo</li>
                    <li>✅ Progress bar with glow effect</li>
                    <li>✅ Animated loading dots</li>
                    <li>✅ Dynamic loading messages</li>
                    <li>✅ Dark mode support</li>
                    <li>✅ Responsive design</li>
                    <li>✅ Smooth fade transitions</li>
                </ul>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8 mb-8">
                <h2 class="text-2xl font-semibold mb-4 text-gray-800 dark:text-white">
                    Test Controls
                </h2>
                <div class="flex flex-wrap gap-4">
                    <button onclick="window.loadingScreen.show()"
                            class="bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-lg transition-colors">
                        Show Loading Screen
                    </button>
                    <button onclick="window.loadingScreen.hide()"
                            class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition-colors">
                        Hide Loading Screen
                    </button>
                    <button onclick="window.loadingScreen.reset()"
                            class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition-colors">
                        Reset Loading Screen
                    </button>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">
                <h2 class="text-2xl font-semibold mb-4 text-gray-800 dark:text-white">
                    How It Works
                </h2>
                <div class="space-y-4 text-gray-600 dark:text-gray-300">
                    <p>
                        The loading screen automatically appears when the page loads and disappears when the content is ready.
                        It includes several visual elements:
                    </p>
                    <ul class="list-disc list-inside space-y-2 ml-4">
                        <li><strong>DTI Logo:</strong> Floats gently with a subtle animation</li>
                        <li><strong>Spinning Ring:</strong> Rotates around the logo to indicate activity</li>
                        <li><strong>Progress Bar:</strong> Shows loading progress with a glowing effect</li>
                        <li><strong>Loading Dots:</strong> Three dots that bounce in sequence</li>
                        <li><strong>Dynamic Messages:</strong> Changes text based on loading progress</li>
                    </ul>
                    <p>
                        The loading screen is fully responsive and supports both light and dark modes.
                        It also integrates with Livewire for smooth navigation between pages.
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
