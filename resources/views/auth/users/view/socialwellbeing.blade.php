@extends('auth.users.partials.app.head')

@section('title', 'Tools')
@section('content')
<div class="bg-gray-50 dark:bg-gray-900 min-h-screen flex flex-col items-center py-10">
    <h1 class="text-4xl font-bold dark:text-gray-50 text-gray-900 mb-2">Social Well-being</h1>
    <div class="w-50 h-1 bg-primary-500 rounded mb-5"></div>
    <div class="w-200 mb-10 text-center max-w-4xl px-4">
        <span class="text-gray-600 dark:text-gray-400">
            Social well-being refers to your ability to form meaningful relationships, connect with others, and feel a sense of belonging in your community. It's about building and maintaining healthy relationships, effective communication, and contributing positively to your social environment. Strong social connections are essential for mental health, emotional support, and overall life satisfaction.
        </span>
    </div>

    {{-- Tools Grid Section --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
            {{-- Communication Skills Tool --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                <div class="bg-gradient-to-r from-blue-500 via-indigo-600 to-purple-600 dark:from-blue-600 dark:via-indigo-700 dark:to-purple-700 px-6 py-5">
                    <div class="flex items-center space-x-3">
                        <div class="p-2 bg-white/20 dark:bg-white/10 rounded-lg backdrop-blur-sm">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                        </div>
                        <h2 class="text-xl font-bold text-white">Communication Skills</h2>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-gray-600 dark:text-gray-400 mb-4">
                        Enhance your communication skills with tips and techniques for effective listening, expressing yourself clearly, and building stronger relationships.
                    </p>
                    <div class="space-y-3">
                        <div class="p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                            <h3 class="font-semibold text-gray-900 dark:text-white mb-2">Active Listening</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                Practice active listening by giving your full attention, asking clarifying questions, and reflecting back what you hear.
                            </p>
                        </div>
                        <div class="p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                            <h3 class="font-semibold text-gray-900 dark:text-white mb-2">Empathy Building</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                Develop empathy by trying to understand others' perspectives and emotions before responding.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Relationship Building Tool --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                <div class="bg-gradient-to-r from-green-500 via-teal-600 to-cyan-600 dark:from-green-600 dark:via-teal-700 dark:to-cyan-700 px-6 py-5">
                    <div class="flex items-center space-x-3">
                        <div class="p-2 bg-white/20 dark:bg-white/10 rounded-lg backdrop-blur-sm">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <h2 class="text-xl font-bold text-white">Relationship Building</h2>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-gray-600 dark:text-gray-400 mb-4">
                        Learn strategies for building and maintaining healthy, meaningful relationships in both personal and professional settings.
                    </p>
                    <div class="space-y-3">
                        <div class="p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                            <h3 class="font-semibold text-gray-900 dark:text-white mb-2">Trust Building</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                Build trust through consistency, honesty, and reliability in your interactions with others.
                            </p>
                        </div>
                        <div class="p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                            <h3 class="font-semibold text-gray-900 dark:text-white mb-2">Conflict Resolution</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                Develop skills to address conflicts constructively and find mutually beneficial solutions.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Social Connection Tool --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                <div class="bg-gradient-to-r from-pink-500 via-rose-600 to-red-600 dark:from-pink-600 dark:via-rose-700 dark:to-red-700 px-6 py-5">
                    <div class="flex items-center space-x-3">
                        <div class="p-2 bg-white/20 dark:bg-white/10 rounded-lg backdrop-blur-sm">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                        </div>
                        <h2 class="text-xl font-bold text-white">Social Connection</h2>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-gray-600 dark:text-gray-400 mb-4">
                        Explore ways to strengthen your social connections and build a supportive network of relationships.
                    </p>
                    <div class="space-y-3">
                        <div class="p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                            <h3 class="font-semibold text-gray-900 dark:text-white mb-2">Community Engagement</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                Get involved in community activities and groups that align with your interests and values.
                            </p>
                        </div>
                        <div class="p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                            <h3 class="font-semibold text-gray-900 dark:text-white mb-2">Networking</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                Build professional and personal networks that provide support, opportunities, and meaningful connections.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Emotional Support Tool --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                <div class="bg-gradient-to-r from-yellow-500 via-orange-600 to-red-600 dark:from-yellow-600 dark:via-orange-700 dark:to-red-700 px-6 py-5">
                    <div class="flex items-center space-x-3">
                        <div class="p-2 bg-white/20 dark:bg-white/10 rounded-lg backdrop-blur-sm">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                        </div>
                        <h2 class="text-xl font-bold text-white">Emotional Support</h2>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-gray-600 dark:text-gray-400 mb-4">
                        Learn how to provide and receive emotional support in your relationships, creating a foundation of mutual care and understanding.
                    </p>
                    <div class="space-y-3">
                        <div class="p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                            <h3 class="font-semibold text-gray-900 dark:text-white mb-2">Support Systems</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                Identify and nurture your support systems - people you can rely on during challenging times.
                            </p>
                        </div>
                        <div class="p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                            <h3 class="font-semibold text-gray-900 dark:text-white mb-2">Being Supportive</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                Develop skills to be a supportive friend, colleague, or family member who others can turn to.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Social Boundaries Tool --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                <div class="bg-gradient-to-r from-indigo-500 via-purple-600 to-pink-600 dark:from-indigo-600 dark:via-purple-700 dark:to-pink-700 px-6 py-5">
                    <div class="flex items-center space-x-3">
                        <div class="p-2 bg-white/20 dark:bg-white/10 rounded-lg backdrop-blur-sm">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                        </div>
                        <h2 class="text-xl font-bold text-white">Social Boundaries</h2>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-gray-600 dark:text-gray-400 mb-4">
                        Understand the importance of setting healthy boundaries in relationships to protect your well-being and maintain respect.
                    </p>
                    <div class="space-y-3">
                        <div class="p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                            <h3 class="font-semibold text-gray-900 dark:text-white mb-2">Setting Boundaries</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                Learn to communicate your limits clearly and respectfully in various social situations.
                            </p>
                        </div>
                        <div class="p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                            <h3 class="font-semibold text-gray-900 dark:text-white mb-2">Respecting Others</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                Understand how to recognize and respect the boundaries set by others in your relationships.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Social Wellness Assessment --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                <div class="bg-gradient-to-r from-teal-500 via-cyan-600 to-blue-600 dark:from-teal-600 dark:via-cyan-700 dark:to-blue-700 px-6 py-5">
                    <div class="flex items-center space-x-3">
                        <div class="p-2 bg-white/20 dark:bg-white/10 rounded-lg backdrop-blur-sm">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <h2 class="text-xl font-bold text-white">Wellness Assessment</h2>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-gray-600 dark:text-gray-400 mb-4">
                        Assess your current social well-being and identify areas where you can strengthen your social connections and relationships.
                    </p>
                    <div class="space-y-3">
                        <div class="p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                            <h3 class="font-semibold text-gray-900 dark:text-white mb-2">Self-Reflection</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                Take time to reflect on your social relationships and identify what's working well and what could be improved.
                            </p>
                        </div>
                        <div class="p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                            <h3 class="font-semibold text-gray-900 dark:text-white mb-2">Goal Setting</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                Set specific, achievable goals for improving your social well-being and building stronger connections.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

