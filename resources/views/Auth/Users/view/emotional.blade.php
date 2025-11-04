@extends('auth.users.partials.app.head')

@section('title', 'Emotional Well-Being Tools')
@section('content')
<div class="bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 min-h-screen">
    <!-- Hero Section -->
    <div class="relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-600/10 to-purple-600/10 dark:from-blue-400/5 dark:to-purple-400/5"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full mb-6 shadow-lg">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                </div>
                <h1 class="text-5xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent mb-4">
                    Emotional Well-Being
                </h1>
                <div class="w-24 h-1 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full mx-auto mb-8"></div>
                <p class="text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto leading-relaxed">
                    Nurture your emotional health with our comprehensive toolkit. Learn to understand, manage, and express your emotions while building resilience for life's challenges.
                </p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">

        <!-- Interactive Tools Section -->
        <div class="mb-16">
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white text-center mb-12">
                Interactive Wellness Tools
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                <!-- Interactive Tools -->
                <div class="col-span-full">
                    @livewire('mood-tracker')
                </div>

                <div class="col-span-full">
                    <x-breathing-exercise />
                </div>

                <div class="col-span-full">
                    @livewire('journal-prompts')
                </div>
            </div>
        </div>

        <!-- Educational Videos Section -->
        <div class="mb-16">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">
                    Educational Resources
                </h2>
                <p class="text-lg text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                    Watch these carefully curated videos to learn more about emotional health and wellness strategies.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Video 1 -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300">
                    <div class="aspect-video">
                        <iframe
                            class="w-full h-full"
                            src="https://www.youtube.com/embed/SmbIcdJ0Zx8?start=1"
                            title="Understanding Emotional Intelligence"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen>
                        </iframe>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Understanding Emotional Intelligence</h3>
                        <p class="text-gray-600 dark:text-gray-300">Learn the fundamentals of emotional intelligence and how it impacts your daily life.</p>
                    </div>
                </div>

                <!-- Video 2 -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300">
                    <div class="aspect-video">
                        <iframe
                            class="w-full h-full"
                            src="https://www.youtube.com/embed/sgpEZm5anlo"
                            title="Managing Stress and Anxiety"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen>
                        </iframe>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Managing Stress and Anxiety</h3>
                        <p class="text-gray-600 dark:text-gray-300">Discover effective techniques for managing stress and anxiety in your daily routine.</p>
                    </div>
                </div>

                <!-- Video 3 -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300">
                    <div class="aspect-video">
                        <iframe
                            class="w-full h-full"
                            src="https://www.youtube.com/embed/ScD1iwXcYIo"
                            title="Building Emotional Resilience"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen>
                        </iframe>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Building Emotional Resilience</h3>
                        <p class="text-gray-600 dark:text-gray-300">Learn how to build resilience and bounce back from life's challenges.</p>
                    </div>
                </div>

                <!-- Video 4 -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300">
                    <div class="aspect-video">
                        <iframe
                            class="w-full h-full"
                            src="https://www.youtube.com/embed/zXw6nIMn5gU"
                            title="Mindfulness and Emotional Well-being"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen>
                        </iframe>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Mindfulness and Emotional Well-being</h3>
                        <p class="text-gray-600 dark:text-gray-300">Explore mindfulness practices that can enhance your emotional well-being.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Daily Inspiration Section -->
        <div class="mb-16">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">
                    Daily Inspiration
                </h2>
                <p class="text-lg text-gray-600 dark:text-gray-300">
                    Start your day with positive affirmations and motivational quotes.
                </p>
            </div>

            <div class="max-w-4xl mx-auto">
                <div class="bg-gradient-to-r from-blue-500 to-purple-600 rounded-2xl shadow-2xl p-8 text-center text-white relative overflow-hidden">
                    <div class="absolute inset-0 bg-white/10 backdrop-blur-sm"></div>
                    <div class="relative z-10">
                        @livewire('quote-generator')
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Tips Section -->
        <div class="mb-16">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">
                    Quick Wellness Tips
                </h2>
                <p class="text-lg text-gray-600 dark:text-gray-300">
                    Simple practices you can incorporate into your daily routine.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 border-l-4 border-blue-500">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                        </div>
                        <h3 class="font-semibold text-gray-900 dark:text-white">Practice Gratitude</h3>
                    </div>
                    <p class="text-gray-600 dark:text-gray-300 text-sm">Write down three things you're grateful for each day to boost positive emotions.</p>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 border-l-4 border-green-500">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                        </div>
                        <h3 class="font-semibold text-gray-900 dark:text-white">Deep Breathing</h3>
                    </div>
                    <p class="text-gray-600 dark:text-gray-300 text-sm">Take 5 deep breaths when feeling overwhelmed to activate your calm response.</p>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 border-l-4 border-purple-500">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 bg-purple-100 dark:bg-purple-900 rounded-full flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                        </div>
                        <h3 class="font-semibold text-gray-900 dark:text-white">Connect with Others</h3>
                    </div>
                    <p class="text-gray-600 dark:text-gray-300 text-sm">Reach out to friends or family for support when you need it most.</p>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 border-l-4 border-yellow-500">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 bg-yellow-100 dark:bg-yellow-900 rounded-full flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                        </div>
                        <h3 class="font-semibold text-gray-900 dark:text-white">Get Sunlight</h3>
                    </div>
                    <p class="text-gray-600 dark:text-gray-300 text-sm">Spend time outdoors in natural light to improve mood and regulate sleep.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection