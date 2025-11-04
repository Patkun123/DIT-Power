<!-- Related Articles Section -->
@php
use Illuminate\Support\Facades\Storage;
@endphp
<div class="px-2 py-20">
    <div class="max-w-screen-xl mx-auto max-h-screen-xl overflow-hidden">

        <!-- Centered Title -->
        <div class="max-w-screen-md mb-8 lg:mb-16 mx-auto text-center relative">
            <div class="inline-block relative mb-6">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">
                    Latest Health News & Upcoming Events
                </h2>
                <span class="absolute -left-6 -bottom-1 h-1 w-90 bg-primary-500 dark:bg-primary-400 rounded"></span>
            </div>
            <p class="text-gray-500 sm:text-xl dark:text-gray-400">
                Stay informed with the latest health news and upcoming wellness events
            </p>
        </div>
        <!-- Flex scroll on mobile, grid on desktop -->
        <div class="flex  space-x-10 space-y-6 overflow-x-auto  lg:grid-cols-3">

            {{-- <!-- Card 1 -->
            <div class="min-w-[320px] w-60 lg:w-320 lg:h-110 h-110 max-w-sm flex-shrink-0 rounded-lg overflow-hidden bg-primary-600 text-gray-50 dark:bg-gray-800 shadow shadow-primary-500 hover:shadow-lg transition-all hover:translate-x-2">
                <img src="/images/pic/5.jpg" alt="Our first office" class="w-full h-40 object-cover">
                <div class="p-4">
                    <span class="text-sm">April 28, 2025</span>
                    <h3 class="text-lg font-bold mt-5 mb-2 dark:text-gray-100">SOCCSKSARGEN logs 2 mpox cases</h3>
                    <p class="text-sm text-gray-300 mb-4">The Department of Health-SOCCSKSARGEN (DOH-12) has confirmed that the region has recorded two cases of monkeypox (mpox) Clade II.</p>
                    <a href="#" class="text-primary-50 hover:underline">Read more</a>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="min-w-[320px] w-60 lg:w-320 lg:h-110 h-110 max-w-sm flex-shrink-0 rounded-lg overflow-hidden bg-primary-600 text-gray-50 dark:bg-gray-800 shadow shadow-primary-500 hover:shadow-lg transition-all hover:translate-x-2">
                <img src="/images/pic/6.jpg" alt="Enterprise design tips" class="w-full h-40 object-cover">
                <div class="p-4">
                    <span class="text-sm">April 2, 2025</span>
                    <h3 class="text-lg font-bold mt-5 mb-2">SOCCSKSARGEN sets new standard for immunization</h3>
                    <p class="text-sm text-gray-300 mb-4">To address declining immunization rates, the 2nd SOCCSKSARGEN Immunization Summit was recently held in Koronadal City. The event aimed to strengthen partnerships and strategies to improve child health in the region.</p>
                    <a href="#" class="text-primary-50 hover:underline">Read more</a>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="min-w-[320px] w-60 lg:w-320 lg:h-110 h-110 max-w-sm flex-shrink-0 rounded-lg overflow-hidden bg-primary-600 text-gray-50 dark:bg-gray-800 shadow shadow-primary-500 hover:shadow-lg transition-all hover:translate-x-2">
                <img src="/images/pic/7.jpg" alt="We partnered with Google" class="w-full h-40 object-cover">
                <div class="p-4">
                    <span class="text-sm">November 5, 2024</span>
                    <h3 class="text-lg font-bold mt-5 mb-2">SOCCSKSARGEN sets new standard for immunization</h3>
                    <p class="text-sm text-gray-300 mb-4">Over the past year, Volosoft has undergone many changes! After months of preparation.</p>
                    <a href="#" class="text-primary-50 hover:underline">Read in 8 minutes</a>
                </div>
            </div> --}}

            <!-- Upcoming Events Section -->
            {{-- Debug: Check if events are passed --}}
            @if(isset($upcomingEvents))
            <!-- Debug: Events count: {{ $upcomingEvents->count() }} -->
            @else
            <!-- Debug: No upcomingEvents variable passed -->
            @endif

            @if(isset($upcomingEvents) && $upcomingEvents->count() > 0)
            @foreach($upcomingEvents as $event)
            <div class="min-w-[320px] w-60 lg:w-320 lg:h-110 h-110 max-w-sm flex-shrink-0 rounded-lg overflow-hidden bg-primary-600 text-gray-50 dark:bg-gray-800 shadow shadow-primary-500 hover:shadow-lg transition-all hover:translate-x-2">
                @if($event->image_url)
                <img src="{{ Storage::url($event->image_url) }}" alt="{{ $event->title }}" class="w-full h-40 object-cover">
                @else
                <div class="w-full h-40 bg-gradient-to-br from-primary-500 to-primary-900 flex items-center justify-center">
                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                @endif
                <div class="p-4">
                    <div class="flex items-center mb-2">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span class="text-sm font-medium">{{ $event->formatted_event_date }}</span>
                    </div>
                    <h3 class="text-lg font-bold mb-2 dark:text-gray-100">{{ $event->title }}</h3>
                    <p class="text-sm text-gray-300 mb-3">{{ Str::limit($event->summary ?? $event->description, 100) }}</p>

                    @if($event->location)
                    <div class="flex items-center mb-2">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span class="text-sm">{{ $event->location }}</span>
                    </div>
                    @endif

                    <div class="flex items-center justify-between mt-3">
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200">
                            {{ $event->category }}
                        </span>
                        <a href="#" class="text-purple-200 hover:text-white text-sm font-medium">
                            Learn More →
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
            @else
            <div class="flex items-center justify-center">
                no Event
            </div>
            @endif
        </div>
    </div>
</div>
