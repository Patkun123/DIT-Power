@extends('auth.users.partials.app.head')

@section('title', 'User')
@section('content')
<div class="p-4 sm:p-6 space-y-10 bg-gray-50 dark:bg-gray-900 min-h-screen">

    {{-- TOP QUIZ PERFORMERS & WELLNESS STATS --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Top Quiz Performers -->
        <div class="bg-white h-110 dark:bg-gray-800 p-6 rounded-xl shadow">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white flex items-center justify-between">
                Leaderboard Ranking
                <div class="hover:bg-primary-500 transition-all hover:-translate-y-1 rounded-full">
                    <img src="/images/crown.gif" class="w-15 h-15 relative" alt="">
                </div>

            </h2>
            <div class="flex flex-row items-center gap-4 sm:gap-0 sm:justify-around">
                <!-- 2nd -->
                <div class="text-center bg-gradient-to-b  from-silver-500 via-silver-700  to-silver-500 h-70 mt-10 w-45 rounded-2xl">
                    <div class="bg-gray-200 w-16 h-16 mt-5 rounded-full mx-auto mb-2 flex items-center justify-center">
                        <span class="text-lg font-bold">2</span>
                    </div>
                    <div class="font-semibold">Neil Morala</div>
                    <div class="text-sm text-gray-500">Chief Accountant</div>
                    <div class="flex items-center justify-center mt-1" >
                        <div class="bg-gray-400 rounded-2xl w-auto">
                            <p class="text-lg font-bold pl-2 pr-2">14</p>
                        </div>
                    </div>
                    <div class="flex items-center justify-center mt-2">
                        <img src="/images/rewards/silver_cup.png" class="w-20 h-20 relative" alt="">
                    </div>
                </div>
                <!-- 1st -->
                <div class="text-center animate-bounce bg-gradient-to-b transition-all hover:-translate-y-1 shadow-lg shadow-gold-600 from-gold-500 via-gold-700 to-gold-400 h-70 w-45 rounded-2xl">
                    <div class="bg-yellow-400 w-16 h-16 mt-5 rounded-full mx-auto mb-2 flex items-center justify-center">
                        <span class="text-lg font-bold">1</span>
                    </div>
                    <div class="font-semibold">Hazel E. Hautea</div>
                    <div class="text-sm text-gray-500">Chief Admin Officer</div>
                    <div class="flex items-center justify-center mt-1" >
                        <div class="bg-gold-600 rounded-2xl w-auto">
                            <p class="text-lg font-bold pl-2 pr-2">14</p>
                        </div>
                    </div>
                     <div class="flex items-center justify-center mt-2">
                        <img src="/images/rewards/gold_cup.png" class="w-20 h-20 relative" alt="">
                    </div>
                </div>
                <!-- 3rd -->
                <div class="text-center bg-gradient-to-b from-bronze-400 via-bronze-500 to-bronze-400 h-70 mt-10 w-45 rounded-2xl">
                    <div class="bg-orange-200 w-16 h-16 mt-5 rounded-full mx-auto mb-2 flex items-center justify-center">
                        <span class="text-lg font-bold">3</span>
                    </div>
                    <div class="font-semibold">Jinnard Lubaton</div>
                    <div class="text-sm text-gray-500">Bookkeeper</div>
                                        <div class="flex items-center justify-center mt-1" >
                        <div class="bg-bronze-600 rounded-2xl w-auto">
                            <p class="text-lg font-bold pl-2 pr-2">14</p>
                        </div>
                    </div>
                     <div class="flex items-center justify-center mt-2">
                        <img src="/images/rewards/bronze_cup.png" class="w-20 h-20 relative" alt="">
                    </div>
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
                        ['label' => 'Journal Entries', 'icon' => '📝', 'count' => $journalCount],
                        ['label' => 'Relaxation Sessions', 'icon' => '🌿', 'count' => 0],
                        ['label' => 'Quiz Points', 'icon' => '💡', 'count' => 0],
                        ['label' => 'Nutrition Logs', 'icon' => '🍽️', 'count' => 0],
                    ];
                @endphp

                @foreach($stats as $stat)
                    <div class="bg-gray-100 h-40 transition-all hover:-translate-y-2 dark:bg-gray-700 p-4 rounded-lg flex items-center gap-4">
                        <div class="text-4xl">{{ $stat['icon'] }}</div>
                        <div>
                            <div class="text-xl font-semibold">{{ $stat['count'] }}</div>
                            <div class="text-md dark:text-gray-100 text-gray-500">{{ $stat['label'] }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- UPCOMING Announcement & NEWS --}}
<div
    x-data="{ showAll: false }"
    class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow"
>
    <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4 border-b pb-2">
        News and Upcoming Events
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @php $visibleCount = 0; @endphp
        @foreach ($articles as $article)
            @if ($article->status === 'published')
                @php $visibleCount++; @endphp
                <div
                    class="transition-all hover:-translate-y-2 rounded-lg overflow-hidden shadow-sm bg-white dark:bg-gray-900"
                    x-show="showAll || {{ $visibleCount }} <= 2"
                    x-transition
                >
                    <img src="{{ asset('storage/' . $article->image_url) }}"
                        alt="{{ $article->title }}"
                        class="w-full h-50 object-cover">

                    <div class="p-4">
                        <h3 class="font-semibold text-lg">{{ $article->title }}</h3>
                        <p class="text-sm text-gray-500">{{ $article->summary }}</p>
                        <div class="text-sm mt-2 text-gray-400">
                            {{ \Carbon\Carbon::parse($article->event_date)->format('F j, Y') }}
                        </div>
                        <span class="text-green-600 text-sm font-medium">
                            {{ $article->category }}
                        </span>
                    </div>
                </div>
            @endif
        @endforeach
    </div>

    @if ($articles->where('status', 'Publish')->count() > 2)
        <div class="flex justify-center mt-4">
            <button
                @click="showAll = !showAll"
                class="px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg"
            >
                <span x-show="!showAll">See More</span>
                <span x-show="showAll">See Less</span>
            </button>
        </div>
    @endif
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
