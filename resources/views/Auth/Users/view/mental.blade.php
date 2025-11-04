@extends('auth.users.partials.app.head')

@section('title', 'Mental Well-Being Tools')
@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 via-blue-50/30 to-indigo-50/20 dark:from-gray-900 dark:via-gray-800 dark:to-gray-800">
    <!-- Header Section -->
    <div class="relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-600/10 to-indigo-600/10 dark:from-blue-500/20 dark:to-indigo-500/20"></div>
        <div class="relative px-4 sm:px-6 lg:px-8 pt-20 pb-8">
            <div class="max-w-7xl mx-auto text-center">
                <h1 class="text-4xl sm:text-5xl font-bold text-gray-900 dark:text-white mb-4">
                    Mental Well-Being Tools
                </h1>
                <div class="w-24 h-1 bg-gradient-to-r from-blue-500 to-indigo-500 rounded mx-auto mb-6"></div>
                <p class="text-lg text-gray-600 dark:text-gray-300 max-w-4xl mx-auto leading-relaxed">
                    Mental well-being refers to your cognitive and psychological health — how well your mind functions,
                    how clearly you think, how well you can focus, and how capable you are of handling stress,
                    solving problems, and making decisions. Explore these tools to enhance your mental wellness.
                </p>
            </div>
        </div>
    </div>

    <div class="px-4 sm:px-6 lg:px-8 pb-12">
        <div class="max-w-7xl mx-auto space-y-8">

            <!-- Quick Access Tools -->
            <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm border border-gray-200/50 dark:border-gray-700/50 rounded-2xl shadow-xl shadow-gray-900/5 dark:shadow-gray-900/20 overflow-hidden">
                <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-6 py-4">
                    <h2 class="text-xl font-bold text-white flex items-center">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                        </svg>
                        Quick Access Tools
                    </h2>
                </div>

                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <!-- Stress Assessment -->
                        <div class="bg-gradient-to-br from-red-50 to-pink-50 dark:from-red-900/20 dark:to-pink-900/20 rounded-xl p-6 border border-red-200/50 dark:border-red-700/50 hover:shadow-lg transition-all duration-200 hover:-translate-y-1">
                            <div class="w-12 h-12 bg-red-500 rounded-lg flex items-center justify-center mb-4">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-2">Stress Assessment</h3>
                            <p class="text-gray-600 dark:text-gray-300 text-sm mb-4">Quick self-assessment to identify stress levels and triggers.</p>
                            <button onclick="openStressAssessment()" class="w-full bg-red-500 hover:bg-red-600 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-200">
                                Take Assessment
                            </button>
                        </div>

                        <!-- Mood Tracker -->
                        <div class="bg-gradient-to-br from-yellow-50 to-orange-50 dark:from-yellow-900/20 dark:to-orange-900/20 rounded-xl p-6 border border-yellow-200/50 dark:border-yellow-700/50 hover:shadow-lg transition-all duration-200 hover:-translate-y-1">
                            <div class="w-12 h-12 bg-yellow-500 rounded-lg flex items-center justify-center mb-4">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-2">Mood Tracker</h3>
                            <p class="text-gray-600 dark:text-gray-300 text-sm mb-4">Track your daily mood patterns and emotional well-being.</p>
                            <button onclick="openMoodTracker()" class="w-full bg-yellow-500 hover:bg-yellow-600 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-200">
                                Track Mood
                            </button>
                        </div>

                        <!-- Breathing Exercise -->
                        <div class="bg-gradient-to-br from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 rounded-xl p-6 border border-green-200/50 dark:border-green-700/50 hover:shadow-lg transition-all duration-200 hover:-translate-y-1">
                            <div class="w-12 h-12 bg-green-500 rounded-lg flex items-center justify-center mb-4">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-2">Breathing Exercise</h3>
                            <p class="text-gray-600 dark:text-gray-300 text-sm mb-4">Guided breathing exercises for relaxation and focus.</p>
                            <button onclick="startBreathingExercise()" class="w-full bg-green-500 hover:bg-green-600 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-200">
                                Start Exercise
                            </button>
                        </div>

                        <!-- Cognitive Games -->
                        <div class="bg-gradient-to-br from-purple-50 to-indigo-50 dark:from-purple-900/20 dark:to-indigo-900/20 rounded-xl p-6 border border-purple-200/50 dark:border-purple-700/50 hover:shadow-lg transition-all duration-200 hover:-translate-y-1">
                            <div class="w-12 h-12 bg-purple-500 rounded-lg flex items-center justify-center mb-4">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-2">Cognitive Games</h3>
                            <p class="text-gray-600 dark:text-gray-300 text-sm mb-4">Brain training games to improve memory and focus.</p>
                            <button onclick="openCognitiveGames()" class="w-full bg-purple-500 hover:bg-purple-600 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-200">
                                Play Games
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Meditation & Mindfulness -->
            <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm border border-gray-200/50 dark:border-gray-700/50 rounded-2xl shadow-xl shadow-gray-900/5 dark:shadow-gray-900/20 overflow-hidden">
                <div class="bg-gradient-to-r from-teal-500 to-cyan-500 px-6 py-4">
                    <h2 class="text-xl font-bold text-white flex items-center">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                        Meditation & Mindfulness
                    </h2>
                </div>

                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="text-center">
                            <div class="w-20 h-20 bg-teal-100 dark:bg-teal-900/30 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-10 h-10 text-teal-600 dark:text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-2">5-Minute Breathing</h3>
                            <p class="text-gray-600 dark:text-gray-300 text-sm mb-4">Quick guided meditation to center yourself.</p>
                            <button onclick="startMeditation('breathing', 5)" class="bg-teal-500 hover:bg-teal-600 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-200">
                                Start (5 min)
                            </button>
                        </div>

                        <div class="text-center">
                            <div class="w-20 h-20 bg-teal-100 dark:bg-teal-900/30 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-10 h-10 text-teal-600 dark:text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-2">Body Scan</h3>
                            <p class="text-gray-600 dark:text-gray-300 text-sm mb-4">Progressive relaxation technique.</p>
                            <button onclick="startMeditation('body-scan', 10)" class="bg-teal-500 hover:bg-teal-600 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-200">
                                Start (10 min)
                            </button>
                        </div>

                        <div class="text-center">
                            <div class="w-20 h-20 bg-teal-100 dark:bg-teal-900/30 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-10 h-10 text-teal-600 dark:text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-2">Mindful Walking</h3>
                            <p class="text-gray-600 dark:text-gray-300 text-sm mb-4">Walking meditation guide.</p>
                            <button onclick="startMeditation('walking', 15)" class="bg-teal-500 hover:bg-teal-600 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-200">
                                Start (15 min)
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cognitive Training Games -->
            <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm border border-gray-200/50 dark:border-gray-700/50 rounded-2xl shadow-xl shadow-gray-900/5 dark:shadow-gray-900/20 overflow-hidden">
                <div class="bg-gradient-to-r from-purple-500 to-pink-500 px-6 py-4">
                    <h2 class="text-xl font-bold text-white flex items-center">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                        </svg>
                        Cognitive Training Games
                    </h2>
                </div>

                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="text-center">
                            <div class="w-20 h-20 bg-purple-100 dark:bg-purple-900/30 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-10 h-10 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-2">Memory Match</h3>
                            <p class="text-gray-600 dark:text-gray-300 text-sm mb-4">Improve your short-term memory.</p>
                            <button onclick="startMemoryGame()" class="bg-purple-500 hover:bg-purple-600 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-200">
                                Play Game
                            </button>
                        </div>

                        <div class="text-center">
                            <div class="w-20 h-20 bg-purple-100 dark:bg-purple-900/30 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-10 h-10 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-2">Focus Test</h3>
                            <p class="text-gray-600 dark:text-gray-300 text-sm mb-4">Test and improve your attention span.</p>
                            <button onclick="startFocusTest()" class="bg-purple-500 hover:bg-purple-600 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-200">
                                Start Test
                            </button>
                        </div>

                        <div class="text-center">
                            <div class="w-20 h-20 bg-purple-100 dark:bg-purple-900/30 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-10 h-10 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-2">Logic Puzzles</h3>
                            <p class="text-gray-600 dark:text-gray-300 text-sm mb-4">Enhance your critical thinking.</p>
                            <button onclick="startLogicPuzzle()" class="bg-purple-500 hover:bg-purple-600 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-200">
                                Solve Puzzle
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Emergency Resources -->
            <div class="bg-gradient-to-r from-red-500 to-pink-500 rounded-2xl shadow-xl shadow-gray-900/5 dark:shadow-gray-900/20 overflow-hidden">
                <div class="px-6 py-4">
                    <h2 class="text-xl font-bold text-white flex items-center mb-2">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                        </svg>
                        Emergency Mental Health Resources
                    </h2>
                    <p class="text-red-100">If you're experiencing a mental health crisis, please reach out for help immediately.</p>
                </div>

                <div class="px-6 pb-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="bg-white/20 backdrop-blur-sm rounded-lg p-4">
                            <h3 class="font-semibold text-white mb-2">National Suicide Prevention Lifeline</h3>
                            <p class="text-red-100 text-sm mb-2">24/7 confidential support</p>
                            <a href="tel:988" class="text-white font-bold text-lg hover:text-red-200 transition-colors">988</a>
                        </div>

                        <div class="bg-white/20 backdrop-blur-sm rounded-lg p-4">
                            <h3 class="font-semibold text-white mb-2">Crisis Text Line</h3>
                            <p class="text-red-100 text-sm mb-2">Text HOME to 741741</p>
                            <a href="sms:741741&body=HOME" class="text-white font-bold text-lg hover:text-red-200 transition-colors">Text HOME</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modals and Interactive Components -->
<!-- Stress Assessment Modal -->
<div id="stressModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white dark:bg-gray-800 rounded-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-2xl font-bold text-gray-800 dark:text-white">Stress Assessment</h3>
                    <button onclick="closeModal('stressModal')" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div id="stressQuestions" class="space-y-6">
                    <!-- Questions will be dynamically loaded here -->
                </div>

                <div class="mt-8 flex justify-between">
                    <button onclick="closeModal('stressModal')" class="px-6 py-2 text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 transition-colors">
                        Cancel
                    </button>
                    <button onclick="calculateStressScore()" class="px-6 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg transition-colors">
                        Get Results
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Mood Tracker Modal -->
<div id="moodModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white dark:bg-gray-800 rounded-2xl max-w-md w-full">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-2xl font-bold text-gray-800 dark:text-white">Track Your Mood</h3>
                    <button onclick="closeModal('moodModal')" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">How are you feeling today?</label>
                        <div class="grid grid-cols-5 gap-2">
                            <button onclick="selectMood(1)" class="mood-btn p-3 rounded-lg border-2 border-gray-200 dark:border-gray-600 hover:border-yellow-400 transition-colors">
                                <div class="text-2xl">😢</div>
                                <div class="text-xs mt-1">Very Low</div>
                            </button>
                            <button onclick="selectMood(2)" class="mood-btn p-3 rounded-lg border-2 border-gray-200 dark:border-gray-600 hover:border-yellow-400 transition-colors">
                                <div class="text-2xl">😔</div>
                                <div class="text-xs mt-1">Low</div>
                            </button>
                            <button onclick="selectMood(3)" class="mood-btn p-3 rounded-lg border-2 border-gray-200 dark:border-gray-600 hover:border-yellow-400 transition-colors">
                                <div class="text-2xl">😐</div>
                                <div class="text-xs mt-1">Neutral</div>
                            </button>
                            <button onclick="selectMood(4)" class="mood-btn p-3 rounded-lg border-2 border-gray-200 dark:border-gray-600 hover:border-yellow-400 transition-colors">
                                <div class="text-2xl">😊</div>
                                <div class="text-xs mt-1">Good</div>
                            </button>
                            <button onclick="selectMood(5)" class="mood-btn p-3 rounded-lg border-2 border-gray-200 dark:border-gray-600 hover:border-yellow-400 transition-colors">
                                <div class="text-2xl">😄</div>
                                <div class="text-xs mt-1">Great</div>
                            </button>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Notes (optional)</label>
                        <textarea id="moodNotes" class="w-full p-3 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white" rows="3" placeholder="How was your day? What influenced your mood?"></textarea>
                    </div>
                </div>

                <div class="mt-8 flex justify-between">
                    <button onclick="closeModal('moodModal')" class="px-6 py-2 text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 transition-colors">
                        Cancel
                    </button>
                    <button onclick="saveMood()" class="px-6 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg transition-colors">
                        Save Mood
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Breathing Exercise Modal -->
<div id="breathingModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white dark:bg-gray-800 rounded-2xl max-w-md w-full">
            <div class="p-6 text-center">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-2xl font-bold text-gray-800 dark:text-white">Breathing Exercise</h3>
                    <button onclick="closeModal('breathingModal')" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div id="breathingCircle" class="w-48 h-48 mx-auto mb-8 bg-green-500 rounded-full flex items-center justify-center transition-all duration-1000">
                    <span id="breathingText" class="text-white text-xl font-bold">Breathe In</span>
                </div>

                <div class="space-y-4">
                    <div class="text-lg text-gray-700 dark:text-gray-300">
                        <span id="breathingCount">1</span> / <span id="breathingTotal">10</span> cycles
                    </div>
                    <div class="text-sm text-gray-500 dark:text-gray-400">
                        Follow the circle's rhythm
                    </div>
                </div>

                <div class="mt-8">
                    <button id="breathingStart" onclick="startBreathing()" class="px-8 py-3 bg-green-500 hover:bg-green-600 text-white rounded-lg transition-colors">
                        Start Exercise
                    </button>
                    <button id="breathingStop" onclick="stopBreathing()" class="px-8 py-3 bg-red-500 hover:bg-red-600 text-white rounded-lg transition-colors hidden">
                        Stop
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Global variables
    let currentMood = 0;
    let stressAnswers = {};
    let breathingInterval = null;
    let breathingCycle = 0;
    let breathingPhase = 'in'; // 'in', 'hold', 'out'
    let breathingCount = 0;

    // Modal functions
    function openModal(modalId) {
        document.getElementById(modalId).classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // Stress Assessment
    function openStressAssessment() {
        const questions = [{
                id: 'work_stress',
                question: 'How stressed do you feel about work-related tasks?',
                options: [{
                        value: 1,
                        text: 'Not stressed at all'
                    },
                    {
                        value: 2,
                        text: 'Slightly stressed'
                    },
                    {
                        value: 3,
                        text: 'Moderately stressed'
                    },
                    {
                        value: 4,
                        text: 'Very stressed'
                    },
                    {
                        value: 5,
                        text: 'Extremely stressed'
                    }
                ]
            },
            {
                id: 'personal_stress',
                question: 'How stressed do you feel about personal relationships?',
                options: [{
                        value: 1,
                        text: 'Not stressed at all'
                    },
                    {
                        value: 2,
                        text: 'Slightly stressed'
                    },
                    {
                        value: 3,
                        text: 'Moderately stressed'
                    },
                    {
                        value: 4,
                        text: 'Very stressed'
                    },
                    {
                        value: 5,
                        text: 'Extremely stressed'
                    }
                ]
            },
            {
                id: 'sleep_quality',
                question: 'How has your sleep quality been recently?',
                options: [{
                        value: 5,
                        text: 'Excellent'
                    },
                    {
                        value: 4,
                        text: 'Good'
                    },
                    {
                        value: 3,
                        text: 'Fair'
                    },
                    {
                        value: 2,
                        text: 'Poor'
                    },
                    {
                        value: 1,
                        text: 'Very poor'
                    }
                ]
            },
            {
                id: 'concentration',
                question: 'How well can you concentrate on tasks?',
                options: [{
                        value: 5,
                        text: 'Very well'
                    },
                    {
                        value: 4,
                        text: 'Well'
                    },
                    {
                        value: 3,
                        text: 'Moderately'
                    },
                    {
                        value: 2,
                        text: 'Poorly'
                    },
                    {
                        value: 1,
                        text: 'Very poorly'
                    }
                ]
            }
        ];

        const container = document.getElementById('stressQuestions');
        container.innerHTML = questions.map((q, index) => `
        <div class="border-b border-gray-200 dark:border-gray-700 pb-4">
            <h4 class="text-lg font-medium text-gray-800 dark:text-white mb-3">${index + 1}. ${q.question}</h4>
            <div class="space-y-2">
                ${q.options.map(option => `
                    <label class="flex items-center p-2 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer">
                        <input type="radio" name="${q.id}" value="${option.value}" class="mr-3" onchange="updateStressAnswer('${q.id}', ${option.value})">
                        <span class="text-gray-700 dark:text-gray-300">${option.text}</span>
                    </label>
                `).join('')}
            </div>
        </div>
    `).join('');

        openModal('stressModal');
    }

    function updateStressAnswer(questionId, value) {
        stressAnswers[questionId] = value;
    }

    function calculateStressScore() {
        const scores = Object.values(stressAnswers);
        if (scores.length < 4) {
            alert('Please answer all questions');
            return;
        }

        const totalScore = scores.reduce((sum, score) => sum + score, 0);
        const averageScore = totalScore / scores.length;

        let level, message, color;
        if (averageScore <= 2) {
            level = 'Low Stress';
            message = 'You\'re managing stress well! Keep up the good work.';
            color = 'green';
        } else if (averageScore <= 3.5) {
            level = 'Moderate Stress';
            message = 'You\'re experiencing some stress. Consider stress management techniques.';
            color = 'yellow';
        } else {
            level = 'High Stress';
            message = 'You\'re experiencing high stress levels. Consider seeking professional help.';
            color = 'red';
        }

        alert(`${level}\n\n${message}\n\nYour stress score: ${averageScore.toFixed(1)}/5`);
        closeModal('stressModal');
    }

    // Mood Tracker
    function openMoodTracker() {
        openModal('moodModal');
    }

    function selectMood(mood) {
        currentMood = mood;
        document.querySelectorAll('.mood-btn').forEach(btn => {
            btn.classList.remove('border-yellow-400', 'bg-yellow-100', 'dark:bg-yellow-900/30');
        });
        event.target.closest('.mood-btn').classList.add('border-yellow-400', 'bg-yellow-100', 'dark:bg-yellow-900/30');
    }

    function saveMood() {
        if (currentMood === 0) {
            alert('Please select a mood');
            return;
        }

        const notes = document.getElementById('moodNotes').value;
        const moodData = {
            mood: currentMood,
            notes: notes,
            date: new Date().toISOString()
        };

        // Save to localStorage (in a real app, this would be sent to server)
        const existingMoods = JSON.parse(localStorage.getItem('moods') || '[]');
        existingMoods.push(moodData);
        localStorage.setItem('moods', JSON.stringify(existingMoods));

        alert('Mood saved successfully!');
        closeModal('moodModal');
    }

    // Breathing Exercise
    function startBreathingExercise() {
        openModal('breathingModal');
    }

    function startBreathing() {
        document.getElementById('breathingStart').classList.add('hidden');
        document.getElementById('breathingStop').classList.remove('hidden');

        breathingCycle = 0;
        breathingCount = 0;
        breathingPhase = 'in';

        breathingInterval = setInterval(() => {
            const circle = document.getElementById('breathingCircle');
            const text = document.getElementById('breathingText');
            const count = document.getElementById('breathingCount');
            const total = document.getElementById('breathingTotal');

            if (breathingPhase === 'in') {
                circle.style.transform = 'scale(1.2)';
                text.textContent = 'Breathe In';
                breathingPhase = 'hold';
            } else if (breathingPhase === 'hold') {
                circle.style.transform = 'scale(1.2)';
                text.textContent = 'Hold';
                breathingPhase = 'out';
            } else if (breathingPhase === 'out') {
                circle.style.transform = 'scale(1)';
                text.textContent = 'Breathe Out';
                breathingPhase = 'in';
                breathingCount++;
                count.textContent = breathingCount;
            }

            if (breathingCount >= 10) {
                stopBreathing();
            }
        }, 3000);
    }

    function stopBreathing() {
        clearInterval(breathingInterval);
        document.getElementById('breathingStart').classList.remove('hidden');
        document.getElementById('breathingStop').classList.add('hidden');

        const circle = document.getElementById('breathingCircle');
        const text = document.getElementById('breathingText');

        circle.style.transform = 'scale(1)';
        text.textContent = 'Complete!';

        setTimeout(() => {
            closeModal('breathingModal');
        }, 2000);
    }

    // Meditation
    function startMeditation(type, duration) {
        const messages = {
            'breathing': 'Focus on your breath. Inhale slowly through your nose, exhale through your mouth.',
            'body-scan': 'Starting from your toes, slowly scan your body and release any tension.',
            'walking': 'Walk slowly and mindfully. Notice each step and your surroundings.'
        };

        alert(`Starting ${type} meditation for ${duration} minutes.\n\n${messages[type]}\n\nSet a timer and begin your practice.`);
    }

    // Cognitive Games
    function openCognitiveGames() {
        alert('Cognitive games coming soon! This will include memory games, attention training, and logic puzzles.');
    }

    function startMemoryGame() {
        alert('Memory Match Game\n\nMatch the pairs of cards to improve your memory. This feature will be implemented soon!');
    }

    function startFocusTest() {
        alert('Focus Test\n\nTest your attention span with various concentration exercises. This feature will be implemented soon!');
    }

    function startLogicPuzzle() {
        alert('Logic Puzzles\n\nSolve challenging puzzles to enhance your critical thinking. This feature will be implemented soon!');
    }

    // Close modals when clicking outside
    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('fixed')) {
            const modals = ['stressModal', 'moodModal', 'breathingModal'];
            modals.forEach(modalId => {
                if (event.target.id === modalId) {
                    closeModal(modalId);
                }
            });
        }
    });

    // Add ripple effect to buttons
    document.addEventListener('DOMContentLoaded', function() {
        const buttons = document.querySelectorAll('button');

        buttons.forEach(button => {
            button.addEventListener('click', function(e) {
                const ripple = document.createElement('span');
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;

                ripple.style.width = ripple.style.height = size + 'px';
                ripple.style.left = x + 'px';
                ripple.style.top = y + 'px';
                ripple.classList.add('ripple');

                this.appendChild(ripple);

                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });
        });
    });

    // Add CSS for ripple effect
    const style = document.createElement('style');
    style.textContent = `
    .ripple {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.6);
        transform: scale(0);
        animation: ripple 600ms linear;
        pointer-events: none;
    }
    
    @keyframes ripple {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }
`;
    document.head.appendChild(style);
</script>
@endpush
@endsection