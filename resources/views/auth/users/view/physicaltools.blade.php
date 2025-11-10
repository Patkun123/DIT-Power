@extends('auth.users.partials.app.head')

@section('title', 'Tools')
@section('content')
<div class="p-4 sm:p-6 lg:p-8 space-y-8 bg-gray-50 dark:bg-gray-900 min-h-screen">
    {{-- Page Header --}}
    <div class="max-w-7xl mx-auto">
        <div class="mb-8 text-center">
            <div class="inline-flex items-center justify-center p-3 bg-primary-100 dark:bg-primary-900/30 rounded-full mb-4">
                <svg class="w-8 h-8 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                </svg>
            </div>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white mb-3">Physical Wellness Tools</h1>
            <p class="text-lg text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                "Physical well-being" refers to the overall condition and functioning of your body. It's about more than just not being sick — it includes how well your body operates, how energized you feel, and how capable you are of doing daily activities.
            </p>
        </div>

        {{-- Tools Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            {{-- BMI Calculator --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                <div class="bg-gradient-to-r from-blue-500 via-indigo-600 to-purple-600 dark:from-blue-600 dark:via-indigo-700 dark:to-purple-700 px-6 py-5">
                    <div class="flex items-center space-x-3">
                        <div class="p-2 bg-white/20 dark:bg-white/10 rounded-lg backdrop-blur-sm">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <h2 class="text-xl font-bold text-white">BMI Calculator</h2>
                    </div>
                </div>
                <form method="POST" action="{{ route('calculate.bmi') }}" class="p-6 space-y-5">
                    @csrf

                    @if($errors->any())
                    <div class="p-3 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg">
                        <ul class="text-sm text-red-700 dark:text-red-300 space-y-1">
                            @foreach($errors->all() as $error)
                            <li>• {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div>
                        <label for="weight" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            Weight (kg) <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="number"
                            id="weight"
                            name="weight"
                            step="0.1"
                            min="1"
                            placeholder="Enter your weight"
                            required
                            value="{{ old('weight') }}"
                            class="w-full px-4 py-3 border-2 border-gray-200 dark:border-gray-700 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-200 dark:focus:ring-primary-900 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 transition-all duration-200 focus:outline-none">
                    </div>

                    <div>
                        <label for="height" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            Height (cm) <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="number"
                            id="height"
                            name="height"
                            step="0.1"
                            min="1"
                            placeholder="Enter your height"
                            required
                            value="{{ old('height') }}"
                            class="w-full px-4 py-3 border-2 border-gray-200 dark:border-gray-700 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-200 dark:focus:ring-primary-900 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 transition-all duration-200 focus:outline-none">
                    </div>

                    <button
                        type="submit"
                        class="w-full py-3.5 px-6 bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:focus:ring-primary-800 flex items-center justify-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                        <span>Calculate BMI</span>
                    </button>
                </form>

                @if(session('bmi'))
                <div class="px-6 pb-6">
                    @php
                    $bmi = session('bmi');
                    $status = session('status');
                    $statusColors = [
                    'Underweight' => 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300 border-blue-200 dark:border-blue-800',
                    'Normal weight' => 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300 border-green-200 dark:border-green-800',
                    'Overweight' => 'bg-orange-100 text-orange-800 dark:bg-orange-900/30 dark:text-orange-300 border-orange-200 dark:border-orange-800',
                    'Obese' => 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300 border-red-200 dark:border-red-800',
                    ];
                    $color = $statusColors[$status] ?? $statusColors['Normal weight'];
                    @endphp
                    <div class="p-4 bg-gradient-to-br from-gray-50 to-white dark:from-gray-900 dark:to-gray-800 rounded-xl border-2 border-gray-200 dark:border-gray-700">
                        <div class="text-center mb-3">
                            <div class="text-4xl font-bold text-gray-900 dark:text-white mb-1">{{ number_format($bmi, 1) }}</div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">Body Mass Index</div>
                        </div>
                        <div class="flex items-center justify-center">
                            <span class="inline-flex items-center px-4 py-2 rounded-lg border-2 {{ $color }} font-semibold text-sm">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                {{ $status }}
                            </span>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            {{-- Meditation Timer --}}
            @livewire('countdown-timer')

            {{-- Quick Notes --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                <div class="bg-gradient-to-r from-green-500 via-emerald-600 to-teal-600 dark:from-green-600 dark:via-emerald-700 dark:to-teal-700 px-6 py-5">
                    <div class="flex items-center space-x-3">
                        <div class="p-2 bg-white/20 dark:bg-white/10 rounded-lg backdrop-blur-sm">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </div>
                        <h2 class="text-xl font-bold text-white">Quick Notes</h2>
                    </div>
                </div>
                <div class="p-6">
                    <div class="space-y-3 mb-4">
                        <div class="p-4 bg-gray-50 dark:bg-gray-900/50 rounded-xl border border-gray-200 dark:border-gray-700 flex justify-between items-start group hover:bg-gray-100 dark:hover:bg-gray-900 transition-colors">
                            <p class="text-sm text-gray-700 dark:text-gray-300 flex-1">Sample note - Click to edit</p>
                            <div class="flex space-x-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                <button class="p-1.5 text-primary-600 dark:text-primary-400 hover:bg-primary-50 dark:hover:bg-primary-900/20 rounded-lg transition-colors" title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </button>
                                <button class="p-1.5 text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-colors" title="Delete">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    <button class="w-full py-3 px-4 bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 text-white font-semibold rounded-xl shadow-md hover:shadow-lg transition-all duration-200 flex items-center justify-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        <span>Add Note</span>
                    </button>
                </div>
            </div>
        </div>

        {{-- Zumba Session Section --}}
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="bg-gradient-to-r from-pink-500 via-red-600 to-orange-600 dark:from-pink-600 dark:via-red-700 dark:to-orange-700 px-6 py-5">
                <div class="flex items-center space-x-3">
                    <div class="p-2 bg-white/20 dark:bg-white/10 rounded-lg backdrop-blur-sm">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-xl sm:text-2xl font-bold text-white">Zumba Session</h2>
                        <p class="text-pink-100 text-sm">Get moving with fun dance workouts</p>
                    </div>
                </div>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @php
                    $videos = [
                    ['title' => 'Zumba Warmup', 'youtubeId' => 'snAlswICqtE', 'description' => 'Start your session with a gentle warmup'],
                    ['title' => 'Zumba Dance Session', 'youtubeId' => 'PjrKaI8vbQo', 'description' => 'Full energetic dance workout'],
                    ['title' => 'Zumba Cooldown', 'youtubeId' => 'b1OstaWSkRs', 'description' => 'Cool down and stretch after your workout'],
                    ];
                    @endphp

                    @foreach($videos as $video)
                    <div class="group bg-gradient-to-br from-white to-gray-50 dark:from-gray-900 dark:to-gray-800 rounded-xl border-2 border-gray-200 dark:border-gray-700 hover:border-primary-300 dark:hover:border-primary-700 shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden cursor-pointer" data-video-id="{{ $video['youtubeId'] }}" onclick="playVideo(this.dataset.videoId)">
                        <div class="relative overflow-hidden">
                            <img
                                src="https://img.youtube.com/vi/{{ $video['youtubeId'] }}/hqdefault.jpg"
                                alt="{{ $video['title'] }}"
                                class="w-full h-48 object-cover transform group-hover:scale-110 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <div class="bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm p-4 rounded-full transform group-hover:scale-110 transition-transform">
                                    <svg class="w-12 h-12 text-primary-600 dark:text-primary-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition-opacity">
                                <div class="bg-primary-600 text-white px-3 py-1 rounded-full text-xs font-semibold shadow-lg">
                                    Watch Now
                                </div>
                            </div>
                        </div>
                        <div class="p-5">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2 group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors">
                                {{ $video['title'] }}
                            </h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">
                                {{ $video['description'] }}
                            </p>
                            <div class="flex items-center text-xs text-gray-500 dark:text-gray-500">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>Click to play</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
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
    function playVideo(videoId) {
        const container = document.getElementById("playerContainer");
        const modal = document.getElementById("videoPlayer");

        container.innerHTML = `
            <iframe
              class="w-full h-full"
              src="https://www.youtube.com/embed/${videoId}?autoplay=1&controls=1&rel=0"
              title="YouTube video player"
              frameborder="0"
              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
              allowfullscreen>
            </iframe>
        `;

        modal.classList.remove("hidden");
        document.body.style.overflow = 'hidden'; // Prevent background scrolling

        // Optional: Request fullscreen (commented out for better UX)
        // let elem = modal;
        // if (elem.requestFullscreen) {
        //     elem.requestFullscreen();
        // } else if (elem.mozRequestFullScreen) {
        //     elem.mozRequestFullScreen();
        // } else if (elem.webkitRequestFullscreen) {
        //     elem.webkitRequestFullscreen();
        // } else if (elem.msRequestFullscreen) {
        //     elem.msRequestFullscreen();
        // }
    }

    function closeVideo() {
        const modal = document.getElementById("videoPlayer");
        const container = document.getElementById("playerContainer");

        modal.classList.add("hidden");
        container.innerHTML = "";
        document.body.style.overflow = ''; // Restore scrolling

        // Exit fullscreen if active
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