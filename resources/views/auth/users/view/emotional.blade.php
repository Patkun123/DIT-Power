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
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white mb-3">Emotional Well-Being</h1>
            <p class="text-lg text-gray-600 dark:text-gray-400 max-w-3xl mx-auto">
                Emotional well-being is about how you understand, manage, and express your emotions — and how well you cope with life's challenges. It's at the heart of mental health and affects everything from your relationships to your productivity and self-esteem.
            </p>
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
                        <h2 class="text-xl sm:text-2xl font-bold text-white">Short Films: Emotional Health Awareness</h2>
                        <p class="text-pink-100 text-sm">Explore inspiring stories and insights about emotional wellness</p>
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
</script>
@endpush
@endsection
