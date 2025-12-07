@extends('auth.users.partials.app.head')

@section('title', 'Tools')
@section('content')
<div class="p-4 sm:p-6 lg:p-8 space-y-8 bg-gray-50 dark:bg-gray-900 min-h-screen">
    {{-- Page Header --}}
    <div class="max-w-7xl mx-auto">
        <div class="mb-8 text-center">
            <div class="inline-flex items-center justify-center p-3 bg-primary-100 dark:bg-primary-900/30 rounded-full mb-4">
                <svg class="w-8 h-8 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                </svg>
            </div>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white mb-3">Mental & Emotional Well-Being</h1>
            <div class="space-y-4 max-w-3xl mx-auto">
                <p class="text-lg text-gray-600 dark:text-gray-400">
                    <strong class="text-gray-900 dark:text-white">Mental well-being</strong> refers to your cognitive and psychological health — how well your mind functions, how clearly you think, how well you can focus, and how capable you are of handling stress, solving problems, and making decisions. It's closely connected with emotional well-being, but focuses more on your mental processes and overall state of mind.
                </p>
                <p class="text-lg text-gray-600 dark:text-gray-400">
                    <strong class="text-gray-900 dark:text-white">Emotional well-being</strong> is about how you understand, manage, and express your emotions — and how well you cope with life's challenges. It's at the heart of mental health and affects everything from your relationships to your productivity and self-esteem.
                </p>
            </div>
        </div>

        {{-- Short Films Section --}}
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden mb-8">
            <div class="bg-gradient-to-r from-pink-500 via-rose-600 to-red-600 dark:from-pink-600 dark:via-rose-700 dark:to-red-700 px-6 py-5">
                <div class="flex items-center space-x-3">
                    <div class="p-2 bg-white/20 dark:bg-white/10 rounded-lg backdrop-blur-sm">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-xl sm:text-2xl font-bold text-white">Short Films: Mental & Emotional Health Awareness</h2>
                        <p class="text-pink-100 text-sm">Explore inspiring stories and insights about mental and emotional wellness</p>
                    </div>
                </div>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @php
                        $videos = [
                            ['title' => 'Understanding Emotions', 'youtubeId' => 'SmbIcdJ0Zx8', 'start' => '1', 'description' => 'Learn about emotional awareness'],
                            ['title' => 'Managing Stress', 'youtubeId' => 'sgpEZm5anlo', 'start' => '0', 'description' => 'Effective stress management techniques'],
                            ['title' => 'Building Resilience', 'youtubeId' => 'ScD1iwXcYIo', 'start' => '0', 'description' => 'Develop emotional resilience'],
                            ['title' => 'Self-Care Practices', 'youtubeId' => 'zXw6nIMn5gU', 'start' => '0', 'description' => 'Importance of self-care'],
                        ];
                    @endphp

                    @foreach($videos as $video)
                    <div class="group bg-gradient-to-br from-white to-gray-50 dark:from-gray-900 dark:to-gray-800 rounded-xl border-2 border-gray-200 dark:border-gray-700 hover:border-primary-300 dark:hover:border-primary-700 shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden">
                        <div class="relative overflow-hidden">
                            <img 
                                src="https://img.youtube.com/vi/{{ $video['youtubeId'] }}/hqdefault.jpg"
                                alt="{{ $video['title'] }}"
                                class="w-full h-40 object-cover transform group-hover:scale-110 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <div class="bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm p-3 rounded-full transform group-hover:scale-110 transition-transform cursor-pointer" onclick="playVideo('{{ $video['youtubeId'] }}', '{{ $video['start'] }}')">
                                    <svg class="w-10 h-10 text-primary-600 dark:text-primary-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="absolute top-3 right-3 opacity-0 group-hover:opacity-100 transition-opacity">
                                <div class="bg-primary-600 text-white px-2 py-1 rounded-full text-xs font-semibold shadow-lg">
                                    Watch
                                </div>
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="text-base font-bold text-gray-900 dark:text-white mb-1 group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors line-clamp-2">
                                {{ $video['title'] }}
                            </h3>
                            <p class="text-xs text-gray-600 dark:text-gray-400 line-clamp-2">
                                {{ $video['description'] }}
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Tools Grid Section --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            {{-- Mood Tracker --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                <div class="bg-gradient-to-r from-pink-500 via-rose-600 to-red-600 dark:from-pink-600 dark:via-rose-700 dark:to-red-700 px-6 py-5">
                    <div class="flex items-center space-x-3">
                        <div class="p-2 bg-white/20 dark:bg-white/10 rounded-lg backdrop-blur-sm">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                        </div>
                        <h2 class="text-xl font-bold text-white">Mood Tracker</h2>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">How are you feeling today?</p>
                    @livewire('mood-selector')
                    @if(isset($todayData['mood']) && $todayData['mood'])
                    <div class="mt-3 text-xs text-gray-500 dark:text-gray-400 text-center">
                        Last tracked: {{ $todayData['mood']->mood }}
                    </div>
                    @endif
                </div>
            </div>

            {{-- Breathing Exercise --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                <div class="bg-gradient-to-r from-cyan-500 via-blue-600 to-indigo-600 dark:from-cyan-600 dark:via-blue-700 dark:to-indigo-700 px-6 py-5">
                    <div class="flex items-center space-x-3">
                        <div class="p-2 bg-white/20 dark:bg-white/10 rounded-lg backdrop-blur-sm">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                            </svg>
                        </div>
                        <h2 class="text-xl font-bold text-white">Breathing Exercise</h2>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Take a moment to breathe and relax</p>
                    <div id="breathingCircle" class="w-32 h-32 mx-auto mb-4 rounded-full bg-gradient-to-br from-cyan-400 to-blue-500 flex items-center justify-center transition-all duration-4s ease-in-out">
                        <span class="text-white font-semibold text-lg" id="breathingText">Breathe In</span>
                    </div>
                    <div class="flex justify-center space-x-2">
                        <button onclick="startBreathing()" id="breathingBtn" class="px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white rounded-lg transition-colors text-sm font-medium">
                            Start
                        </button>
                        <button onclick="stopBreathing()" id="stopBreathingBtn" class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg transition-colors text-sm font-medium hidden">
                            Stop
                        </button>
                    </div>
                </div>
            </div>

            {{-- Stress Level Assessment --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                <div class="bg-gradient-to-r from-orange-500 via-amber-600 to-yellow-600 dark:from-orange-600 dark:via-amber-700 dark:to-yellow-700 px-6 py-5">
                    <div class="flex items-center space-x-3">
                        <div class="p-2 bg-white/20 dark:bg-white/10 rounded-lg backdrop-blur-sm">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <h2 class="text-xl font-bold text-white">Stress Level</h2>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Rate your current stress level</p>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-700 dark:text-gray-300">Low</span>
                            <div class="flex-1 mx-4">
                                <input type="range" id="stressLevel" min="1" max="10" value="@if(isset($todayData['stress_assessment']) && $todayData['stress_assessment']){{ $todayData['stress_assessment']->stress_level }}@else 5 @endif" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-primary-600" onchange="saveStressLevel()">
                            </div>
                            <span class="text-sm text-gray-700 dark:text-gray-300">High</span>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-gray-900 dark:text-white mb-1">
                                <span id="stressValue">@if(isset($todayData['stress_assessment']) && $todayData['stress_assessment']){{ $todayData['stress_assessment']->stress_level }}@else 5 @endif</span>/10
                            </div>
                            <div class="text-xs text-gray-500 dark:text-gray-400" id="stressLabel">{{ isset($todayData['stress_label']) ? $todayData['stress_label'] : 'Moderate' }}</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Gratitude Journal --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                <div class="bg-gradient-to-r from-green-500 via-emerald-600 to-teal-600 dark:from-green-600 dark:via-emerald-700 dark:to-teal-700 px-6 py-5">
                    <div class="flex items-center space-x-3">
                        <div class="p-2 bg-white/20 dark:bg-white/10 rounded-lg backdrop-blur-sm">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <h2 class="text-xl font-bold text-white">Gratitude Journal</h2>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">What are you grateful for today?</p>
                    <textarea 
                        id="gratitudeNote" 
                        rows="4" 
                        placeholder="Write something you're grateful for..."
                        class="w-full px-4 py-3 border-2 border-gray-200 dark:border-gray-700 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-200 dark:focus:ring-primary-900 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 transition-all duration-200 focus:outline-none resize-none mb-3"></textarea>
                    <button onclick="saveGratitude()" class="w-full py-2.5 px-4 bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 text-white font-semibold rounded-xl shadow-md hover:shadow-lg transition-all duration-200 flex items-center justify-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span>Save</span>
                    </button>
                    <div id="gratitudeList" class="mt-4 space-y-2 max-h-32 overflow-y-auto">
                        @if(isset($todayData['gratitude_entries']) && $todayData['gratitude_entries']->count() > 0)
                            @foreach($todayData['gratitude_entries'] as $entry)
                            <div class="p-3 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg flex items-start justify-between group" data-entry-id="{{ $entry->id }}">
                                <p class="text-sm text-gray-700 dark:text-gray-300 flex-1">{{ $entry->entry }}</p>
                                <button onclick="deleteGratitude({{ $entry->id }})" class="ml-2 p-1 text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 rounded opacity-0 group-hover:opacity-100 transition-opacity">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

            {{-- Self-Care Checklist --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                <div class="bg-gradient-to-r from-purple-500 via-violet-600 to-fuchsia-600 dark:from-purple-600 dark:via-violet-700 dark:to-fuchsia-700 px-6 py-5">
                    <div class="flex items-center space-x-3">
                        <div class="p-2 bg-white/20 dark:bg-white/10 rounded-lg backdrop-blur-sm">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h2 class="text-xl font-bold text-white">Self-Care Checklist</h2>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Track your self-care activities</p>
                    <div class="space-y-2" id="selfCareList">
                        @php
                        $selfCareItems = [
                            ['id' => 'exercise', 'label' => 'Exercise or physical activity'],
                            ['id' => 'meditation', 'label' => 'Meditation or mindfulness'],
                            ['id' => 'sleep', 'label' => 'Adequate sleep'],
                            ['id' => 'nutrition', 'label' => 'Healthy nutrition'],
                            ['id' => 'social', 'label' => 'Social connection'],
                            ['id' => 'hobby', 'label' => 'Time for hobbies'],
                        ];
                        @endphp
                        @foreach($selfCareItems as $item)
                        @php
                            $isChecked = isset($todayData['self_care_logs'][$item['id']]) && $todayData['self_care_logs'][$item['id']]->completed;
                        @endphp
                        <label class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700/50 cursor-pointer transition-colors">
                            <input type="checkbox" 
                                   data-activity="{{ $item['id'] }}"
                                   class="w-5 h-5 text-primary-600 rounded focus:ring-primary-500 focus:ring-2 self-care-checkbox" 
                                   onchange="saveSelfCare('{{ $item['id'] }}', this.checked)"
                                   {{ $isChecked ? 'checked' : '' }}>
                            <span class="text-sm text-gray-700 dark:text-gray-300">{{ $item['label'] }}</span>
                        </label>
                        @endforeach
                    </div>
                    <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-xs font-medium text-gray-600 dark:text-gray-400">Progress</span>
                            <span class="text-xs font-bold text-primary-600 dark:text-primary-400" id="selfCareProgress">0%</span>
                        </div>
                        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                            <div id="selfCareBar" class="bg-gradient-to-r from-primary-500 to-primary-600 h-2 rounded-full transition-all duration-300" style="width: 0%"></div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Quick Reflection --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                <div class="bg-gradient-to-r from-indigo-500 via-purple-600 to-pink-600 dark:from-indigo-600 dark:via-purple-700 dark:to-pink-700 px-6 py-5">
                    <div class="flex items-center space-x-3">
                        <div class="p-2 bg-white/20 dark:bg-white/10 rounded-lg backdrop-blur-sm">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </div>
                        <h2 class="text-xl font-bold text-white">Quick Reflection</h2>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Take a moment to reflect</p>
                        <div class="space-y-3">
                        <div>
                            <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">What went well today?</label>
                            <textarea id="whatWentWell" rows="2" placeholder="Write your thoughts..." onblur="saveReflection()" class="w-full px-3 py-2 text-sm border border-gray-200 dark:border-gray-700 rounded-lg focus:border-primary-500 focus:ring-1 focus:ring-primary-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 resize-none">@if(isset($todayData['reflection']) && $todayData['reflection']){{ $todayData['reflection']->what_went_well }}@endif</textarea>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">What can I improve?</label>
                            <textarea id="whatCanImprove" rows="2" placeholder="Write your thoughts..." onblur="saveReflection()" class="w-full px-3 py-2 text-sm border border-gray-200 dark:border-gray-700 rounded-lg focus:border-primary-500 focus:ring-1 focus:ring-primary-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 resize-none">@if(isset($todayData['reflection']) && $todayData['reflection']){{ $todayData['reflection']->what_can_improve }}@endif</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Quote Generator Section --}}
        <div class="max-w-4xl mx-auto">
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="bg-gradient-to-r from-purple-500 via-indigo-600 to-blue-600 dark:from-purple-600 dark:via-indigo-700 dark:to-blue-700 px-6 py-5">
                    <div class="flex items-center space-x-3">
                        <div class="p-2 bg-white/20 dark:bg-white/10 rounded-lg backdrop-blur-sm">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                            </svg>
                        </div>
                        <h2 class="text-xl sm:text-2xl font-bold text-white">Daily Inspiration</h2>
                    </div>
                </div>
                <div class="p-6 sm:p-8">
                    @livewire('quote-generator')
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Enhanced Video Player Modal -->
<div id="videoPlayer" class="hidden fixed inset-0 z-50 bg-black/90 dark:bg-black/95 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="relative w-full max-w-6xl h-full max-h-[90vh] flex flex-col">
        <!-- Close Button -->
        <button 
            onclick="closeVideo()" 
            class="absolute -top-12 right-0 bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg shadow-lg transition-all duration-200 flex items-center space-x-2 z-50 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 focus:ring-offset-black">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
            <span>Close</span>
        </button>
        <div id="playerContainer" class="w-full h-full rounded-xl overflow-hidden shadow-2xl bg-black"></div>
    </div>
</div>

@push('scripts')
<script>
    // Video Player Functions
    function playVideo(videoId, startTime = '0') {
        const container = document.getElementById("playerContainer");
        const modal = document.getElementById("videoPlayer");
        
        container.innerHTML = `
            <iframe
              class="w-full h-full"
              src="https://www.youtube.com/embed/${videoId}?autoplay=1&controls=1&rel=0&start=${startTime}"
              title="YouTube video player"
              frameborder="0"
              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
              allowfullscreen>
            </iframe>
        `;
        
        modal.classList.remove("hidden");
        document.body.style.overflow = 'hidden';
    }

    function closeVideo() {
        const modal = document.getElementById("videoPlayer");
        const container = document.getElementById("playerContainer");
        
        modal.classList.add("hidden");
        container.innerHTML = "";
        document.body.style.overflow = '';

        if (document.exitFullscreen) {
            document.exitFullscreen();
        } else if (document.mozCancelFullScreen) {
            document.mozCancelFullScreen();
        } else if (document.webkitExitFullscreen) {
            document.webkitExitFullscreen();
        } else if (document.msExitFullscreen) {
            document.msExitFullscreen();
        }
    }

    // Close video on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const modal = document.getElementById("videoPlayer");
            if (!modal.classList.contains("hidden")) {
                closeVideo();
            }
        }
    });

    // Close video on backdrop click
    document.getElementById("videoPlayer")?.addEventListener('click', function(e) {
        if (e.target === this) {
            closeVideo();
        }
    });

    // Breathing Exercise
    let breathingInterval = null;
    let isBreathing = false;
    let breatheIn = true;

    function startBreathing() {
        if (isBreathing) return;
        
        isBreathing = true;
        const circle = document.getElementById('breathingCircle');
        const text = document.getElementById('breathingText');
        const btn = document.getElementById('breathingBtn');
        const stopBtn = document.getElementById('stopBreathingBtn');
        
        btn.classList.add('hidden');
        stopBtn.classList.remove('hidden');
        
        breatheIn = true;
        animateBreathing();
    }

    function stopBreathing() {
        isBreathing = false;
        if (breathingInterval) {
            clearInterval(breathingInterval);
        }
        
        const circle = document.getElementById('breathingCircle');
        const text = document.getElementById('breathingText');
        const btn = document.getElementById('breathingBtn');
        const stopBtn = document.getElementById('stopBreathingBtn');
        
        circle.style.transform = 'scale(1)';
        circle.style.opacity = '1';
        text.textContent = 'Breathe In';
        btn.classList.remove('hidden');
        stopBtn.classList.add('hidden');
    }

    function animateBreathing() {
        const circle = document.getElementById('breathingCircle');
        const text = document.getElementById('breathingText');
        
        if (!isBreathing) return;
        
        if (breatheIn) {
            circle.style.transform = 'scale(1.5)';
            circle.style.opacity = '0.8';
            text.textContent = 'Breathe In';
            breatheIn = false;
        } else {
            circle.style.transform = 'scale(1)';
            circle.style.opacity = '1';
            text.textContent = 'Breathe Out';
            breatheIn = true;
        }
        
        breathingInterval = setTimeout(animateBreathing, 4000);
    }

    // Stress Level Assessment
    async function saveStressLevel() {
        const stressSlider = document.getElementById('stressLevel');
        const stressValue = document.getElementById('stressValue');
        const stressLabel = document.getElementById('stressLabel');
        
        const value = parseInt(stressSlider.value);
        stressValue.textContent = value;
        
        let label = '';
        if (value <= 3) {
            label = 'Low';
        } else if (value <= 6) {
            label = 'Moderate';
        } else if (value <= 8) {
            label = 'High';
        } else {
            label = 'Very High';
        }
        
        stressLabel.textContent = label;
        
        // Save to database
        try {
            await fetch('{{ route("mental.tools.stress") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ stress_level: value })
            });
        } catch (error) {
            console.error('Error saving stress level:', error);
        }
    }

    // Gratitude Journal
    async function saveGratitude() {
        const textarea = document.getElementById('gratitudeNote');
        const note = textarea.value.trim();
        
        if (!note) {
            alert('Please write something you\'re grateful for!');
            return;
        }
        
        try {
            const response = await fetch('{{ route("mental.tools.gratitude") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ entry: note })
            });
            
            const data = await response.json();
            
            if (data.success) {
                const list = document.getElementById('gratitudeList');
                const item = document.createElement('div');
                item.className = 'p-3 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg flex items-start justify-between group';
                item.setAttribute('data-entry-id', data.entry.id);
                item.innerHTML = `
                    <p class="text-sm text-gray-700 dark:text-gray-300 flex-1">${note}</p>
                    <button onclick="deleteGratitude(${data.entry.id})" class="ml-2 p-1 text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 rounded opacity-0 group-hover:opacity-100 transition-opacity">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                `;
                
                list.appendChild(item);
                textarea.value = '';
            }
        } catch (error) {
            console.error('Error saving gratitude:', error);
            alert('Failed to save. Please try again.');
        }
    }

    async function deleteGratitude(id) {
        if (!confirm('Are you sure you want to delete this entry?')) {
            return;
        }
        
        try {
            const response = await fetch(`{{ url('mental-tools/gratitude') }}/${id}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });
            
            const data = await response.json();
            
            if (data.success) {
                const item = document.querySelector(`[data-entry-id="${id}"]`);
                if (item) {
                    item.remove();
                }
            }
        } catch (error) {
            console.error('Error deleting gratitude:', error);
            alert('Failed to delete. Please try again.');
        }
    }

    // Self-Care Checklist Progress
    async function saveSelfCare(activity, completed) {
        try {
            await fetch('{{ route("mental.tools.selfcare") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ activity: activity, completed: completed })
            });
            
            updateSelfCareProgress();
        } catch (error) {
            console.error('Error saving self-care:', error);
        }
    }

    function updateSelfCareProgress() {
        const checkboxes = document.querySelectorAll('#selfCareList input[type="checkbox"]');
        const checked = Array.from(checkboxes).filter(cb => cb.checked).length;
        const total = checkboxes.length;
        const percentage = Math.round((checked / total) * 100);
        
        document.getElementById('selfCareProgress').textContent = percentage + '%';
        document.getElementById('selfCareBar').style.width = percentage + '%';
    }

    // Save reflection
    async function saveReflection() {
        const whatWentWell = document.getElementById('whatWentWell').value.trim();
        const whatCanImprove = document.getElementById('whatCanImprove').value.trim();
        
        try {
            await fetch('{{ route("mental.tools.reflection") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    what_went_well: whatWentWell,
                    what_can_improve: whatCanImprove
                })
            });
        } catch (error) {
            console.error('Error saving reflection:', error);
        }
    }

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        // Update self-care progress on load
        updateSelfCareProgress();
        
        // Allow Enter key to save gratitude
        const gratitudeTextarea = document.getElementById('gratitudeNote');
        if (gratitudeTextarea) {
            gratitudeTextarea.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' && e.ctrlKey) {
                    saveGratitude();
                }
            });
        }
    });
</script>
@endpush
@endsection
