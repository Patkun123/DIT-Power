@extends('auth.users.partials.app.head')

@section('title', 'Tools')
@section('content')
<div class="bg-gray-50 dark:bg-gray-900 min-h-screen flex flex-col items-center py-10">
    <h1 class="text-4xl font-bold dark:text-gray-50 text-gray-900 mb-2">Physical Wellness Tools</h1>
    <div class="w-50 h-1 bg-primary-500 rounded mb-8"></div>
    <div class="grid grid-cols-1 md:grid-cols-3 mb-5 gap-8 max-w-6xl w-full px-4">
        <!-- BMI Calculator -->
        <div class="bg-white dark:bg-gray-800 rounded-xl transition-all hover:shadow-xl hover:-translate-y-1 shadow-primary-500 shadow p-6">
            <div class="flex items-center mb-4">
                <h2 class="font-bold text-lg">BMI Calculator</h2>
            </div>
            <form method="POST" action="{{ route('calculate.bmi') }}">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-600 dark:text-gray-200 mb-2">Weight (kg)</label>
                    <input type="number" name="weight" class="w-full rounded-lg shadow-sm dark:bg-gray-900 border-gray-700 focus:ring-primary-500 focus:border-primary-500">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-600 dark:text-gray-200 mb-2">Height (cm)</label>
                    <input type="number" name="height" class="w-full rounded-lg shadow-sm dark:bg-gray-900 border-gray-700 focus:ring-primary-500 focus:border-primary-500">
                </div>
                <button type="submit" class="w-full bg-primary-500 hover:bg-primary-600 text-white py-3 rounded-lg font-semibold">Calculate BMI</button>
            </form>
            @if(session('bmi'))
                <div class="mt-4 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg text-gray-700 dark:text-gray-200 text-center">
                    <strong>{{ session('bmi') }}</strong> - {{ session('status') }}
                </div>
            @endif
        </div>

        <!-- Meditation Timer -->
        @livewire('countdown-timer')

        <!-- Quick Notes -->
        <div class="bg-white dark:bg-gray-800 transition-all hover:shadow-xl hover:-translate-y-1 shadow-primary-500 rounded-xl shadow p-6">
            <div class="flex items-center mb-4">
                <span class="text-primary-600 mr-2">🗒️</span>
                <h2 class="font-bold text-lg">Quick Notes</h2>
            </div>
            <div class="p-3 bg-gray-50 dark:bg-gray-900 rounded-lg flex justify-between items-center mb-4">
                <span class="text-gray-700 dark:text-gray-200">Sample note</span>
                <div class="flex space-x-2">
                    <button class="text-gray-500 hover:text-primary-500">✏️</button>
                    <button class="text-gray-500 hover:text-red-500">🗑️</button>
                </div>
            </div>
            <button class="w-full bg-primary-500 hover:bg-primary-600 text-white py-3 rounded-lg font-semibold">Add Note</button>
        </div>
    </div>

    <!-- Zumba Section -->
    <h1 class="text-4xl font-bold mt-10 dark:text-gray-50 text-gray-900 mb-2">Zumba Session</h1>
    <div class="w-50 h-1 bg-primary-500 rounded mb-8"></div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @php
            $videos = [
                ['title' => 'Zumba Warmup', 'youtubeId' => 'snAlswICqtE'],
                ['title' => 'Zumba Dance Session', 'youtubeId' => 'PjrKaI8vbQo'],
                ['title' => 'Zumba Cooldown', 'youtubeId' => 'b1OstaWSkRs'],
            ];
        @endphp

        @foreach($videos as $video)
        <div class="bg-gray-800 rounded-lg shadow hover:shadow-lg transition p-3">
            <div class="relative cursor-pointer" onclick="playVideo('{{ $video['youtubeId'] }}')">
                <img src="https://img.youtube.com/vi/{{ $video['youtubeId'] }}/hqdefault.jpg"
                     alt="{{ $video['title'] }}"
                     class="rounded-lg w-full">
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="bg-black bg-opacity-50 p-3 rounded-full text-white text-2xl">▶</div>
                </div>
            </div>
            <h2 class="mt-3 text-lg font-semibold">{{ $video['title'] }}</h2>
        </div>
        @endforeach
    </div>
</div>

<!-- Hidden Video Player -->
<div id="videoPlayer" class="hidden fixed inset-0 z-50 bg-black flex items-center justify-center">
    <div class="relative w-full h-full">
        <!-- Close Button -->
        <button onclick="closeVideo()" class="absolute top-4 mt-10 right-4 bg-red-600 text-white px-3 py-1 rounded-lg z-50">✖</button>
        <div id="playerContainer" class="w-full h-full"></div>
    </div>
</div>

@push('scripts')
<script>
    function playVideo(videoId) {
        const container = document.getElementById("playerContainer");
        container.innerHTML = `
            <iframe
              class="absolute top-0 left-0 w-full h-full rounded-lg"
              src="https://www.youtube.com/embed/${videoId}?autoplay=1&controls=1"
              title="YouTube video player"
              frameborder="0"
              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
              allowfullscreen>
            </iframe>
        `;
        document.getElementById("videoPlayer").classList.remove("hidden");

        // Request fullscreen
        let elem = document.getElementById("videoPlayer");
        if (elem.requestFullscreen) {
            elem.requestFullscreen();
        } else if (elem.mozRequestFullScreen) {
            elem.mozRequestFullScreen();
        } else if (elem.webkitRequestFullscreen) {
            elem.webkitRequestFullscreen();
        } else if (elem.msRequestFullscreen) {
            elem.msRequestFullscreen();
        }
    }

    function closeVideo() {
        document.getElementById("videoPlayer").classList.add("hidden");
        document.getElementById("playerContainer").innerHTML = "";

        // Exit fullscreen
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
</script>
@endpush
@endsection
