@extends('auth.users.partials.app.head')

@section('title', 'User')
@section('content')
<div class="p-4 sm:p-6 space-y-10 bg-gray-50 dark:bg-gray-900 min-h-screen">

    {{-- TOP QUIZ PERFORMERS & WELLNESS STATS --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Top Quiz Performers -->
        <div class="bg-white h-100 dark:bg-gray-800 p-6 rounded-xl shadow">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4 flex items-center justify-between">
                Top Quiz Performers
                <svg class="w-6 h-6 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 15l-5.878 3.09L5.64 12.18.782 8.91l6.74-.979L10 2.5l2.478 5.43 6.74.98-4.857 3.268 1.518 5.91z" />
                </svg>
            </h2>
            <div class="flex flex-row items-center gap-4 sm:gap-0 sm:justify-around">
                <!-- 2nd -->
                <div class="text-center bg-gray-100 h-60 mt-10 w-35 rounded-2xl">
                    <div class="bg-gray-200 w-16 h-16 mt-5 rounded-full mx-auto mb-2 flex items-center justify-center">
                        <span class="text-lg font-bold">2</span>
                    </div>
                    <div class="font-semibold">Neil Morala</div>
                    <div class="text-sm text-gray-500">Chief Accountant</div>
                    <div class="text-lg font-bold mt-1">82 pts</div>
                </div>
                <!-- 1st -->
                <div class="text-center bg-yellow-500 h-60 w-35 rounded-2xl">
                    <div class="bg-yellow-400 w-16 h-16 mt-5 rounded-full mx-auto mb-2 flex items-center justify-center">
                        <span class="text-lg font-bold">1</span>
                    </div>
                    <div class="font-semibold">Hazel E. Hautea</div>
                    <div class="text-sm text-gray-500">Chief Admin Officer</div>
                    <div class="text-lg font-bold mt-1">95 pts</div>
                </div>
                <!-- 3rd -->
                <div class="text-center bg-orange-500 h-60 mt-10 w-35 rounded-2xl">
                    <div class="bg-gray-200 w-16 h-16 mt-5 rounded-full mx-auto mb-2 flex items-center justify-center">
                        <span class="text-lg font-bold">3</span>
                    </div>
                    <div class="font-semibold">Jinnard Lubaton</div>
                    <div class="text-sm text-gray-500">Bookkeeper</div>
                    <div class="text-lg font-bold mt-1">78 pts</div>
                </div>
            </div>
            {{-- <div class="text-center mt-3">
                <a href="#" class="px-6 py-2 bg-emerald-500 text-white rounded-full hover:bg-emerald-600 transition">Start Quiz</a>
            </div> --}}
        </div>

        <!-- Wellness Stats -->
        <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">Your Wellness Journey</h2>
            <div class="grid grid-cols-2 gap-4">
                @php
                    $stats = [
                        ['label' => 'Journal Entries', 'icon' => '📝'],
                        ['label' => 'Relaxation Sessions', 'icon' => '🌿'],
                        ['label' => 'Quiz Points', 'icon' => '💡'],
                        ['label' => 'Nutrition Logs', 'icon' => '🍽️'],
                    ];
                @endphp
                @foreach($stats as $stat)
                    <div class="bg-gray-100 transition-all hover:-translate-y-2 dark:bg-gray-700 p-4 rounded-lg flex items-center gap-4">
                        <div class="text-2xl">{{ $stat['icon'] }}</div>
                        <div>
                            <div class="text-xl font-semibold">0</div>
                            <div class="text-sm text-gray-500">{{ $stat['label'] }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- UPCOMING EVENTS --}}
    <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4 border-b pb-2">Upcoming Events</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Event Card 1 -->
            <div class="transition-all hover:-translate-y-2 rounded-lg overflow-hidden shadow-sm bg-white dark:bg-gray-900">
                <img src="/images/pic/8.jpg" alt="Badminton" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="font-semibold text-lg">MADZ Badminton Court</h3>
                    <p class="text-sm text-gray-500">📍 Zone 3, Koronadal City, 9506 South Cotabato</p>
                    <div class="text-sm mt-2 text-gray-400">May 6, 2025</div>
                    <span class="text-green-600 text-sm font-medium">Wellness Day</span>
                </div>
            </div>
            <!-- Event Card 2 -->
            <div class="rounded-lg shadow-gray-500 transition-all hover:-translate-y-2 overflow-hidden shadow-sm bg-white dark:bg-gray-900">
                <img src="/images/pic/10.jpg" alt="Conference" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="font-semibold text-lg">EMR Center</h3>
                    <p class="text-sm text-gray-500">📍 QR5M+V76, Gensan Dr, Koronadal City, South Cotabato</p>
                    <div class="text-sm mt-2 text-gray-400">May 6, 2025</div>
                    <span class="text-green-600 text-sm font-medium">Wellness Day</span>
                </div>
            </div>
        </div>
    </div>

    {{-- GOOGLE MAPS EMBED --}}
    <div class="rounded-xl overflow-hidden shadow-lg">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15934.604498153018!2d124.84789529567742!3d6.497323265799879!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x32f7fbb52b5b1461%3A0x2e59c8ed6e547f76!2sKoronadal%20City%2C%20South%20Cotabato!5e0!3m2!1sen!2sph!4v1691488144480!5m2!1sen!2sph"
            width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy">
        </iframe>
    </div>

</div>
@endsection
