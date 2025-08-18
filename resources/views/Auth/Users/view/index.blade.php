@extends('auth.users.partials.app.head')

@section('title', 'User')
@section('content')
<div class="p-4 sm:p-6 space-y-10 bg-gray-50 dark:bg-gray-900 min-h-screen">

    {{-- TOP QUIZ PERFORMERS & WELLNESS STATS --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Top Quiz Performers -->
        <div class="bg-white 2xl:h-110 dark:bg-gray-800 p-6 rounded-xl shadow">
            <h2 class="2xl:text-xl text-md font-semibold text-gray-800 dark:text-white flex items-center justify-between">
                Leaderboard Ranking
                <button id="readProductButton" data-modal-target="leaderboardModal" data-modal-toggle="leaderboardModal" class="hover:bg-primary-500 cursor-pointer transition-all hover:-translate-y-1 rounded-full">
                    <img src="/images/crown.gif" class="w-15 h-15 relative" alt="">
                </button>

            </h2>
            @php
            // Prepare default empty players if not enough data
            $players = [
                $topPlayers[0] ?? (object)[
                    'user' => (object)[
                        'firstname' => '---',
                        'lastname' => '---',
                        'office' => '',
                        'profileimage' => null
                    ],
                    'best_score' => 0
                ],
                $topPlayers[1] ?? (object)[
                    'user' => (object)[
                        'firstname' => '---',
                        'lastname' => '---',
                        'office' => '',
                        'profileimage' => null
                    ],
                    'best_score' => 0
                ],
                $topPlayers[2] ?? (object)[
                    'user' => (object)[
                        'firstname' => '---',
                        'lastname' => '---',
                        'office' => '',
                        'profileimage' => null
                    ],
                    'best_score' => 0
                ],
            ];
            @endphp

            <div class="flex flex-row items-center gap-4 2xl:mt-0 mt-10 sm:gap-0 sm:justify-around">
                <!-- 2nd Place -->
                <div class="text-center bg-gradient-to-b from-silver-500 shadow-2xl shadow-silver-500 via-silver-700 to-silver-500 h-50 w-50 2xl:h-70 2xl:mt-10 2xl:w-45 rounded-2xl">
                    <div class="bg-gray-200 w-10 h-10 2xl:w-16 2xl:h-16 mt-5 rounded-full mx-auto mb-2 flex items-center justify-center">
                    @if ($players[1]->user->profileimage)
                        <img
                            src="{{ asset('storage/' . $players[1]->user->profileimage) }}"
                            alt="{{ $players[1]->user->firstname }}'s Profile"
                            class="w-[36px] h-[36px] 2xl:w-[55px] 2xl:h-[55px] rounded-full object-cover border border-gray-300 dark:border-gray-700"
                        >
                    @else
                        <img
                            src="{{ asset('images/default.png') }}"
                            alt="Default Profile"
                            class="w-[36px] h-[36px] 2xl:w-[55px] 2xl:h-[55px] rounded-full object-cover border border-gray-300 dark:border-gray-700"
                        >
                    @endif

                    </div>
                    <div class="font-semibold 2xl:text-md text-sm">{{ $players[1]->user->firstname }} <span class="hidden lg:block">{{ $players[1]->user->lastname }}</span></div>
                    <div class="text-[10px] 2xl:text-sm text-gray-500">{{ $players[1]->user->office }}</div>
                    <div class="flex items-center justify-center mt-1">
                        <div class="bg-gray-400 rounded-2xl w-auto">
                            <p class="text-sm font-bold pl-2 pr-2 2xl:text-lg">{{ $players[1]->best_score }}</p>
                        </div>
                    </div>
                    <div class="flex items-center justify-center mt-2">
                        <img src="/images/rewards/silver_cup.png" class="w-10 h-10 2xl:h-20 2xl:w-22 relative" alt="">
                    </div>
                </div>

                <!-- 1st Place -->
                <div class="text-center animate-bounce bg-gradient-to-b transition-all hover:-translate-y-1 shadow-lg shadow-gold-600 from-gold-500 via-gold-700 to-gold-400 h-50 w-50 2xl:h-70 2xl:mt-10 2xl:w-45 rounded-2xl">
                    <div class="bg-yellow-400 w-10 h-10 2xl:w-16 2xl:h-16 mt-5 rounded-full mx-auto mb-2 flex items-center justify-center">
                        @if ($players[0]->user->profileimage)
                            <img
                                src="{{ asset('storage/' . $players[0]->user->profileimage) }}"
                                alt="{{ $players[2]->user->firstname }}'s Profile"
                                class="w-[36px] h-[36px] 2xl:w-[55px] 2xl:h-[55px] rounded-full object-cover border border-gray-300 dark:border-gray-700"
                            >
                        @else
                            <img
                                src="{{ asset('images/default.png') }}"
                                alt="Default Profile"
                                class="w-[36px] h-[36px] 2xl:w-[55px] 2xl:h-[55px] rounded-full object-cover border border-gray-300 dark:border-gray-700"
                            >
                        @endif


                    </div>
                    <div class="font-semibold 2xl:text-md text-sm">{{ $players[0]->user->firstname }} <span class="hidden lg:block">{{ $players[0]->user->lastname }}</span></div>
                    <div class="text-sm text-gray-500">{{ $players[0]->user->office }}</div>
                    <div class="flex items-center justify-center mt-1">
                        <div class="bg-gold-600 rounded-2xl w-auto">
                            <p class="text-sm font-bold pl-2 pr-2 2xl:text-lg">{{ $players[0]->best_score }}</p>
                        </div>
                    </div>
                    <div class="flex items-center justify-center mt-2">
                        <img src="/images/rewards/gold_cup.png" class="w-10 h-10 2xl:h-20 2xl:w-20 relative" alt="">
                    </div>
                </div>

                <!-- 3rd Place -->
                <div class="text-center bg-gradient-to-b shadow-2xl shadow-bronze-500 from-bronze-400 via-bronze-500 to-bronze-400 h-50 w-50 2xl:h-70 2xl:mt-10 2xl:w-45 rounded-2xl">
                    <div class="bg-orange-200 w-10 h-10 2xl:w-16 2xl:h-16 mt-5 rounded-full mx-auto mb-2 flex items-center justify-center">
                        @if ($players[2]->user->profileimage)
                        <img
                            src="{{ asset('storage/' . $players[2]->user->profileimage) }}"
                            alt="{{ $players[2]->user->firstname }}'s Profile"
                            class="w-[36px] h-[36px] 2xl:w-[55px] 2xl:h-[55px] rounded-full object-cover border border-gray-300 dark:border-gray-700"
                        >
                    @else
                        <img
                            src="{{ asset('images/default.png') }}"
                            alt="Default Profile"
                            class="w-[36px] h-[36px] 2xl:w-[55px] 2xl:h-[55px] rounded-full object-cover border border-gray-300 dark:border-gray-700"
                        >
            @endif

                    </div>
                    <div class="font-semibold 2xl:text-md text-sm">{{ $players[2]->user->firstname }} <span class=" hidden lg:block">{{ $players[2]->user->lastname }}</span></div>
                    <div class="text-[10px] 2xl:text-sm text-gray-500">{{ $players[2]->user->office }}</div>
                    <div class="flex items-center justify-center mt-1">
                        <div class="bg-bronze-600 rounded-2xl w-auto">
                            <p class="text-lg font-bold pl-2 pr-2">{{ $players[2]->best_score }}</p>
                        </div>
                    </div>
                    <div class="flex items-center justify-center mt-2">
                        <img src="/images/rewards/bronze_cup.png" class="w-10 h-10 2xl:h-20 2xl:w-20 relative" alt="">
                    </div>
                </div>
            </div>
        </div>
        <!-- Wellness Stats -->
        <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">Your Wellness Journey</h2>
            <div class="grid grid-cols-2 gap-4">
                @php
                    $stats = [
                        ['label' => 'Journal Entries', 'icon' => '📝', 'count' => $journalCount],
                        ['label' => 'Relaxation Sessions', 'icon' => '🌿', 'count' => 0],
                        ['label' => 'Quiz Points', 'icon' => '💡', 'count' => $quizCount],
                        ['label' => 'Nutrition Logs', 'icon' => '🍽️', 'count' => 0],
                    ];
                @endphp

                @foreach($stats as $stat)
                    <div class="bg-gray-100 h-40 transition-all hover:-translate-y-2 dark:bg-gray-700 p-4 rounded-lg flex items-center gap-2 2xl:gap-4">
                        <div class="text-2xl">{{ $stat['icon'] }}</div>
                        <div>
                            <div class="2xl:text-xl text-lg font-semibold">{{ $stat['count'] }}</div>
                            <div class="text-sm 2xl:text-md dark:text-gray-100 text-gray-500">{{ $stat['label'] }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    {{-- UPCOMING Announcement & NEWS --}}
<div x-data="{ showAll: false }" class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow">
    <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4 border-b pb-2">
        News and Upcoming Events
    </h2>

    @php
        // Get published articles
        $publishedArticles = $articles->where('status', 'published');
    @endphp

    @if($publishedArticles->isEmpty())
        <p class="text-center text-gray-500 dark:text-gray-400">No Events Published</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @php $visibleCount = 0; @endphp
            @foreach ($publishedArticles as $article)
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
                        <p class="text-primary-600 text-sm font-medium">
                            {{ $article->category }}
                        </p>
                        <span class="text-primary-600 text-sm font-medium">
                            Author {{ $article->author }}
                        </span>

                        <!-- Learn More Button -->
                        <div class="mt-3 flex justify-end">
                            <button id="showmodalButton" data-modal-target="showmodal{{ $article->id }}" data-modal-toggle="showmodal{{ $article->id }}"
                            class="px-4 py-2 text-sm font-medium text-white bg-primary-600 cursor-pointer hover:bg-primary-700 rounded-lg">
                                Learn More
                            </button>
                        </div>
                    </div>
                </div>
                @include('Auth.Users.partials.view')
            @endforeach
        </div>

        @if ($publishedArticles->count() > 2)
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
    @endif
</div>

    {{-- GOOGLE MAPS EMBED --}}
    <section id="Feedbacks">
        <div class="container px-5 py-24 mx-auto bg-gray-100 shadow-md shadow-gray-950 dark:bg-gray-800 w-full rounded-4xl flex sm:flex-nowrap flex-wrap">
            <!-- LEFT SIDE (Map + Info) -->
            <div class="lg:w-2/3 md:w-1/2 h-150 bg-gray-300  rounded-lg overflow-hidden sm:mr-10 p-10 flex items-end justify-start relative">
                <iframe width="100%" height="100%" class="absolute inset-0" frameborder="0" title="map" marginheight="0" marginwidth="0" scrolling="no"
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d991.137245866521!2d124.87767333593972!3d6.451897731102884!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x32f821dfdc9dd0cb%3A0x10d08ed934eacc06!2sDEPARTMENT%20OF%20TRADE%20AND%20INDUSTRY-%2012%20REGIONAL%20OFFICE!5e0!3m2!1sen!2sph!4v1755492850279!5m2!1sen!2sph"></iframe>
            <div class="bg-white dark:bg-gray-800 relative flex flex-col sm:flex-row flex-wrap py-6 rounded shadow-md -mt-10 mx-4">
                <div class="sm:w-1/1 px-6 mb-4 sm:mb-0">
                <h2 class="title-font font-semibold dark:text-white text-gray-900 tracking-widest text-xs">ADDRESS</h2>
                <p class="mt-1 lg:text-md text-xs">Prime Regional Government Center, Barangay Carpenter Hill, Koronadal City, South Cotabato, Koronadal, Philippines</p>
                </div>
                <div class="sm:w-1/2 px-6">
                <h2 class="title-font font-semibold dark:text-white text-gray-900 tracking-widest text-xs">EMAIL</h2>
                <a href="mailto:dti@gmail.com" class="text-indigo-500 leading-relaxed text-sm">dti@gmail.com</a>
                <h2 class="title-font font-semibold dark:text-white text-gray-900 tracking-widest text-xs mt-4">PHONE</h2>
                <p class="leading-relaxed text-sm">123-456-7890</p>
                </div>
            </div>
            </div>
            <!-- RIGHT SIDE (Feedback Form) -->
            <div class="lg:w-1/3 md:w-1/2 bg-white  dark:bg-gray-800 p-10 rounded-xl flex flex-col md:ml-auto w-full md:py-8 mt-8 md:mt-0">
                <h2 class="text-gray-900 dark:text-gray-100 text-lg mb-1 font-medium title-font">Feedback</h2>
                <p class="leading-relaxed mb-5 text-gray-400">Your feedback helps us continually improve our services. All submissions are completely anonymous.</p>
                <!-- ⭐ STAR RATING -->
                <form action="{{ route('feedback.store') }}" method="POST" id="feedbackForm">
                @csrf
                <!-- ⭐ STAR RATING -->
                <div class="flex items-center mb-5">
                    <label class="text-sm text-gray-900 dark:text-gray-100 mr-3">Rating:</label>
                    <div class="flex space-x-1 cursor-pointer" id="starRating">
                    @for ($i = 1; $i <= 5; $i++)
                        <svg data-value="{{ $i }}"
                            class="w-6 h-6 text-gray-300 hover:text-yellow-400 transition-colors duration-200 cursor-pointer"
                            fill="currentColor"
                            viewBox="0 0 22 20">
                        <path d="M20.924 7.625a1.523 1.523 0 0 0-1.231-1.044l-5.264-.764-2.354-4.766a1.523 1.523 0 0 0-2.736 0L6.985 5.817l-5.264.764a1.523 1.523 0 0 0-.845 2.599l3.808 3.71-.9 5.241a1.523 1.523 0 0 0 2.212 1.605L11 17.813l4.705 2.474a1.523 1.523 0 0 0 2.212-1.605l-.9-5.241 3.808-3.71a1.523 1.523 0 0 0 .399-1.106Z"/>
                        </svg>
                    @endfor
                    </div>
                    <!-- Hidden input that gets updated -->
                    <input type="hidden" id="ratingInput" name="rating" value="0">
                </div>

                <!-- Message -->
                <div class="relative mb-4">
                    <label for="message" class="leading-7 text-sm text-gray-400">Message</label>
                    <textarea id="message" name="message"
                    class="w-full dark:bg-gray-900 bg-white rounded border border-gray-300
                            focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200
                            h-32 text-base outline-none text-gray-700 py-1 px-3
                            resize-none leading-6 transition-colors duration-200 ease-in-out"></textarea>
                </div>

                <!-- Submit -->
                <button type="submit"
                        class="text-white bg-primary-500 border-0 py-2 px-6 focus:outline-none
                                hover:bg-indigo-600 rounded text-lg">
                    Submit
                </button>
                </form>
            </div>
        </div>
    </section>
</div>


<!-- Script for star selection -->

@include('Auth.Users.partials.leaderboard')

@push('scripts')
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const stars = document.querySelectorAll("#starRating svg");
    const ratingInput = document.getElementById("ratingInput");

    stars.forEach(star => {
      star.addEventListener("click", function () {
        const value = this.getAttribute("data-value");
        ratingInput.value = value;

        // Reset all stars
        stars.forEach(s => s.classList.remove("text-yellow-400"));

        // Highlight stars up to selected
        stars.forEach(s => {
          if (s.getAttribute("data-value") <= value) {
            s.classList.add("text-yellow-400");
          }
        });
      });
    });
  });
</script>


@endpush
@endsection
