@extends('auth.users.partials.app.head')

@section('title', 'Journal')
@section('content')

<div class="p-4 sm:p-6 lg:p-8 space-y-8 bg-gray-50 dark:bg-gray-900 min-h-screen">
    {{-- Page Header --}}
    <div class="max-w-7xl mx-auto">
        <div class="mb-8">
            <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-white mb-2">My Journal</h1>
            <p class="text-gray-600 dark:text-gray-400">Reflect on your thoughts, feelings, and experiences</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">
            {{-- New Entry Form --}}
            <div class="lg:col-span-1">
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden sticky top-4">
                    {{-- Form Header --}}
                    <div class="bg-gradient-to-r from-primary-600 via-primary-700 to-primary-800 dark:from-primary-700 dark:via-primary-800 dark:to-primary-900 px-6 py-5">
                        <div class="flex items-center space-x-3">
                            <div class="p-2 bg-white/20 dark:bg-white/10 rounded-lg backdrop-blur-sm">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </div>
                            <h2 class="text-xl font-bold text-white">New Entry</h2>
                        </div>
                    </div>

                    {{-- Form Content --}}
                    <form method="POST" action="{{ route('journal.store') }}" class="p-6 space-y-6">
                        @csrf

                        {{-- Success Message --}}
                        @if(session('success'))
                        <div class="p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-xl flex items-center space-x-3">
                            <svg class="w-5 h-5 text-green-600 dark:text-green-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <p class="text-green-800 dark:text-green-200 text-sm font-medium">{{ session('success') }}</p>
                        </div>
                        @endif

                        {{-- Validation Errors --}}
                        @if($errors->any())
                        <div class="p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-xl">
                            <div class="flex items-center space-x-2 mb-2">
                                <svg class="w-5 h-5 text-red-600 dark:text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                </svg>
                                <p class="text-red-800 dark:text-red-200 text-sm font-semibold">Please fix the following errors:</p>
                            </div>
                            <ul class="list-disc list-inside text-red-700 dark:text-red-300 text-sm space-y-1 ml-6">
                                @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        {{-- Title --}}
                        <div>
                            <label for="title" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                Title <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                id="title" 
                                name="title" 
                                value="{{ old('title') }}"
                                placeholder="Give your entry a title"
                                required
                                class="w-full px-4 py-3 border-2 border-gray-200 dark:border-gray-700 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-200 dark:focus:ring-primary-900 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 transition-all duration-200 focus:outline-none">
                        </div>

                        {{-- Thoughts/Text --}}
                        <div>
                            <label for="text" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                Your Thoughts <span class="text-red-500">*</span>
                            </label>
                            <textarea 
                                id="text" 
                                name="text" 
                                rows="6"
                                placeholder="Write your thoughts, feelings, or experiences here..."
                                required
                                class="w-full px-4 py-3 border-2 border-gray-200 dark:border-gray-700 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-200 dark:focus:ring-primary-900 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 resize-none transition-all duration-200 focus:outline-none"></textarea>
                        </div>

                        {{-- Mood Selector --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                How are you feeling today? <span class="text-red-500">*</span>
                            </label>
                            @livewire('mood-selector')
                            @error('feeling')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Tags --}}
                        <div>
                            <label for="tags" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                Tags <span class="text-gray-500 text-xs font-normal">(Optional)</span>
                            </label>
                            <input 
                                type="text" 
                                id="tags" 
                                name="tags" 
                                value="{{ old('tags') }}"
                                placeholder="e.g. work, study, personal (comma-separated)"
                                class="w-full px-4 py-3 border-2 border-gray-200 dark:border-gray-700 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-200 dark:focus:ring-primary-900 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 transition-all duration-200 focus:outline-none">
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Separate multiple tags with commas</p>
                        </div>

                        {{-- Submit Button --}}
                        <button 
                            type="submit"
                            class="w-full py-3.5 px-6 bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:focus:ring-primary-800 flex items-center justify-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>Save Entry</span>
                        </button>
                    </form>
                </div>
            </div>

            {{-- Journal Entries List --}}
            <div class="lg:col-span-2">
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
                    {{-- Entries Header --}}
                    <div class="bg-gradient-to-r from-gray-50 to-white dark:from-gray-800 dark:to-gray-900 px-6 py-5 border-b border-gray-200 dark:border-gray-700">
                        <div class="flex items-center justify-between flex-wrap gap-4">
                            <div class="flex items-center space-x-3">
                                <div class="p-2 bg-primary-100 dark:bg-primary-900/30 rounded-lg">
                                    <svg class="w-6 h-6 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h2 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-white">Previous Entries</h2>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $journals->count() }} {{ $journals->count() === 1 ? 'entry' : 'entries' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Entries Content --}}
                    <div class="p-6">
                        @if(!$hasEntries)
                        {{-- Empty State --}}
                        <div class="flex flex-col items-center justify-center py-16 text-center">
                            <div class="w-20 h-20 bg-gray-100 dark:bg-gray-700/50 rounded-full flex items-center justify-center mb-6">
                                <svg class="w-10 h-10 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-2">No Journal Entries Yet</h3>
                            <p class="text-gray-500 dark:text-gray-400 text-sm max-w-md">Start your wellness journey by creating your first journal entry. Reflect on your day, express your feelings, and track your progress.</p>
                        </div>
                        @else
                        <div class="space-y-4">
                            @foreach($journals as $journal)
                            <article class="group bg-gradient-to-br from-white to-gray-50 dark:from-gray-900 dark:to-gray-800 rounded-xl border-2 border-gray-200 dark:border-gray-700 hover:border-primary-300 dark:hover:border-primary-700 shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden">
                                {{-- Entry Header --}}
                                <div class="p-5 sm:p-6">
                                    <div class="flex items-start justify-between mb-4">
                                        <div class="flex-1 min-w-0">
                                            <h3 class="text-lg sm:text-xl font-bold text-gray-900 dark:text-white mb-2 group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors">
                                                {{ $journal->title }}
                                            </h3>
                                            <div class="flex items-center space-x-3 text-sm text-gray-500 dark:text-gray-400">
                                                <div class="flex items-center space-x-1.5">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                    </svg>
                                                    <span>{{ $journal->created_at->format('M d, Y') }}</span>
                                                </div>
                                                <span class="text-gray-300 dark:text-gray-600">•</span>
                                                <div class="flex items-center space-x-1.5">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    <span>{{ $journal->created_at->format('g:i A') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        {{-- Mood Badge --}}
                                        <div class="flex-shrink-0 ml-4">
                                            @php
                                            $moodEmojis = [
                                                'happy' => '😊',
                                                'calm' => '😌',
                                                'sad' => '😢',
                                                'angry' => '😠',
                                                'anxious' => '😰',
                                                'excited' => '🤩',
                                                'neutral' => '😐'
                                            ];
                                            $moodColors = [
                                                'happy' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300',
                                                'calm' => 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300',
                                                'sad' => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300',
                                                'angry' => 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300',
                                                'anxious' => 'bg-orange-100 text-orange-800 dark:bg-orange-900/30 dark:text-orange-300',
                                                'excited' => 'bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-300',
                                                'neutral' => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300'
                                            ];
                                            $emoji = $moodEmojis[$journal->feeling] ?? '😐';
                                            $color = $moodColors[$journal->feeling] ?? $moodColors['neutral'];
                                            @endphp
                                            <div class="flex items-center space-x-2 px-3 py-1.5 rounded-full {{ $color }} border border-current/20">
                                                <span class="text-xl">{{ $emoji }}</span>
                                                <span class="text-xs font-semibold capitalize">{{ $journal->feeling }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Entry Text Preview --}}
                                    <p class="text-gray-600 dark:text-gray-300 mb-4 line-clamp-3 leading-relaxed">
                                        {{ Str::limit($journal->text, 150) }}
                                    </p>

                                    {{-- Tags --}}
                                    @if(!empty($journal->tags))
                                    <div class="flex flex-wrap gap-2 mb-4">
                                        @foreach(explode(',', $journal->tags) as $tag)
                                            @if(trim($tag))
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg bg-primary-50 dark:bg-primary-900/20 text-primary-700 dark:text-primary-300 text-xs font-medium border border-primary-200 dark:border-primary-800">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"></path>
                                                </svg>
                                                {{ trim($tag) }}
                                            </span>
                                            @endif
                                        @endforeach
                                    </div>
                                    @endif

                                    {{-- Actions --}}
                                    <div class="flex items-center justify-between pt-4 border-t border-gray-200 dark:border-gray-700">
                                        <button 
                                            data-modal-target="view-modal{{ $journal->id }}" 
                                            data-modal-toggle="view-modal{{ $journal->id }}"
                                            class="inline-flex items-center space-x-2 px-4 py-2 text-sm font-semibold text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300 hover:bg-primary-50 dark:hover:bg-primary-900/20 rounded-lg transition-all duration-200">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                            <span>Read More</span>
                                        </button>
                                        <div class="text-xs text-gray-400 dark:text-gray-500">
                                            {{ $journal->created_at->diffForHumans() }}
                                        </div>
                                    </div>
                                </div>
                            </article>
                            @include('auth.users.partials.view-journal')
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
