@extends('auth.admin.partials.layouts.app.head')

@section('title', 'dashboard')
@include('auth.admin.partials.layouts.side')
@include('auth.admin.partials.layouts.header')
@section('content')
<div class="admin-page-hero">
  <div class="admin-page-hero-inner">
    <h1>Welcome, <b>{{ auth()->user()->lastname }}</b></h1>
    <p>Monitor your wellness platform at a glance</p>
    </div>
</div>

    <main class="admin-page-main p-4 md:ml-64 h-auto">
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 mb-6">
        <div class="admin-metric-card text-lg font-semibold h-32 flex items-center justify-center space-x-4 p-4">
            <flux:button icon="user-group" variant="primary" color="amber" class="" />
            <div class="">
                <h2 class="font-semibold">Total Users</h2>
                <span class="font-bold text-3xl">{{ $totalUsers ?? 0}}</span>
            </div>
        </div>
        {{-- <div class="dark:bg-gray-900 hover:dark:text-gray-950 text-lg font-semibold bg-gray-50 rounded-lg transition-all hover:-translate-y-2 hover:bg-primary-400 shadow-primary-500 shadow-md dark:border-gray-600 h-32 md:h-35 flex items-center justify-center space-x-4 p-4">
            <flux:button icon="clipboard" variant="primary" color="amber" />
            <div class="">
                <h2 class="font-semibold">Daily Users Quiz</h2>
                <span class="font-bold text-3xl">{{ $totalUsers ?? 0}}</span>
            </div>
        </div> --}}
        {{-- <div class="dark:bg-gray-900 hover:dark:text-gray-950 text-lg font-semibold bg-gray-50 rounded-lg transition-all hover:-translate-y-2 hover:bg-primary-400 shadow-primary-500 shadow-md dark:border-gray-600 h-32 md:h-35 flex items-center justify-center space-x-4 p-4">
            <flux:button icon="megaphone" variant="primary" color="amber" />
                <div class="">
                    <h2 class="font-semibold">Total Users</h2>
                    <span class="font-bold text-3xl">{{ $totalUsers ?? 0}}</span>
                </div>
        </div> --}}
        <div class="admin-metric-card text-lg font-semibold h-32 flex items-center justify-center space-x-4 p-4">
            <flux:button icon="newspaper"  variant="primary" color="amber" />
            <div class="">
                <h2 class="font-semibold">Total News</h2>
                <span class="font-bold text-3xl">{{ $news_articleCount ?? 0}}</span>
            </div>
        </div>
        <div class="admin-metric-card text-lg font-semibold h-32 flex items-center justify-center space-x-4 p-4">
            <flux:button icon="chat-bubble-left-right" variant="primary" color="amber" />
            <div class="">
                <h2 class="font-semibold">Total Feedbacks</h2>
                <span class="font-bold text-3xl">{{ $totalFeedbacks ?? 0}}</span>
            </div>
        </div>
        <div class="admin-metric-card text-lg font-semibold h-32 flex items-center justify-center space-x-4 p-4">
            <flux:button icon="star" variant="primary" color="amber" />
            <div class="">
                <h2 class="font-semibold">Avg Rating</h2>
                <span class="font-bold text-3xl">{{ $averageRating ?? 0}}/5</span>
            </div>
        </div>
        <div class="admin-metric-card text-lg font-semibold h-32 flex items-center justify-center space-x-4 p-4">
            <flux:button icon="clock" variant="primary" color="amber" />
            <div class="">
                <h2 class="font-semibold">This Week</h2>
                <span class="font-bold text-3xl">{{ $recentFeedbacks ?? 0}}</span>
            </div>
        </div>
      </div>
        <div class="admin-surface p-4 md:p-6 h-96 mb-4">
            @include('auth.admin.partials.layouts.app.graph')
        </div>
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-4">
        <div class="admin-surface p-4">
            @include('auth.admin.partials.layouts.app.bargraph')
        </div>
        <div class="admin-surface p-4">
            @include('auth.admin.partials.layouts.app.pie')
        </div>
      </div>

      <!-- Recent Activity Section -->
      <div class="mb-4">
        @livewire('recent-activity')
      </div>

      <!-- Analysis Section -->
      <div class="grid grid-cols-1 lg:grid-cols-4 gap-4 mb-6">
        <div class="admin-metric-card p-4">
          <div class="flex items-center justify-between mb-2">
            <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-200">New Users Today</h3>
            <flux:icon name="user-plus" class="w-5 h-5 text-primary-500" />
          </div>
          <div class="text-3xl font-bold text-gray-900 dark:text-white">{{ $analysis['users_today'] ?? 0 }}</div>
          <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">This month: {{ $analysis['users_this_month'] ?? 0 }}</p>
        </div>

        <div class="admin-metric-card p-4">
          <div class="flex items-center justify-between mb-2">
            <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-200">Quizzes Today</h3>
            <flux:icon name="academic-cap" class="w-5 h-5 text-primary-500" />
          </div>
          <div class="text-3xl font-bold text-gray-900 dark:text-white">{{ $analysis['quizzes_today'] ?? 0 }}</div>
          <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Avg score: {{ $analysis['avg_quiz_score_today'] ?? 0 }}</p>
        </div>

        <div class="admin-metric-card p-4">
          <div class="flex items-center justify-between mb-2">
            <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-200">Journals Today</h3>
            <flux:icon name="book-open" class="w-5 h-5 text-primary-500" />
          </div>
          <div class="text-3xl font-bold text-gray-900 dark:text-white">{{ $analysis['journals_today'] ?? 0 }}</div>
          <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Active users today: {{ $analysis['active_users_today'] ?? 0 }}</p>
        </div>

        <div class="admin-metric-card p-4">
          <div class="flex items-center justify-between mb-2">
            <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-200">Feedbacks Today</h3>
            <flux:icon name="chat-bubble-left-right" class="w-5 h-5 text-primary-500" />
          </div>
          <div class="text-3xl font-bold text-gray-900 dark:text-white">{{ $analysis['feedbacks_today'] ?? 0 }}</div>
          <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Avg rating (month): {{ $analysis['avg_rating_this_month'] ?? 0 }}/5</p>
        </div>
      </div>
{{-- </div>
        <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-96 mb-4">
        </div>
      <div
        class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-96 mb-4"
      ></div> --}}

      <!-- Upcoming Events Section -->
      <div class="mt-10 mb-6">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Upcoming Events</h2>
        @if($upcomingEvents->count())
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($upcomingEvents as $event)
              <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                @if($event->image_url)
                  <img src="{{ $event->image_url }}" alt="{{ $event->title }}" class="w-full h-40 object-cover">
                @else
                  <div class="w-full h-40 bg-gradient-to-r from-primary-400 to-primary-600 flex items-center justify-center">
                    <svg class="w-12 h-12 text-white opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                  </div>
                @endif
                <div class="p-4">
                  <h3 class="font-semibold text-gray-900 dark:text-white truncate">{{ $event->title }}</h3>
                  <div class="flex items-center text-sm text-gray-600 dark:text-gray-400 mt-2">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    {{ $event->event_date->format('M d, Y') }}
                  </div>
                  <div class="flex items-center text-sm text-gray-600 dark:text-gray-400 mt-1">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    {{ $event->event_time }}
                  </div>
                  <div class="flex items-center text-sm text-gray-600 dark:text-gray-400 mt-1">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span class="truncate">{{ Str::limit($event->location, 20) }}</span>
                  </div>
                  <div class="flex items-center justify-between mt-3">
                    <span class="text-xs font-semibold px-2 py-1 rounded-full
                      @if($event->status === 'active')
                        bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300
                      @elseif($event->status === 'completed')
                        bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300
                      @else
                        bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300
                      @endif
                    ">
                      {{ ucfirst($event->status) }}
                    </span>
                    <a href="{{ route('admin.events.edit', $event) }}" class="text-primary-600 hover:text-primary-900 text-sm font-medium">Edit</a>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        @else
          <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 text-center">
            <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            <p class="text-gray-600 dark:text-gray-400">No upcoming events scheduled.</p>
            <a href="{{ route('admin.events.create') }}" class="inline-block mt-4 px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition">
              Create Event
            </a>
          </div>
        @endif
      </div>
      {{-- <div class="grid grid-cols-2 gap-4">
            <div class=" p-4 md:p-6 bg-white dark:bg-gray-800 rounded-lg transition-all hover:-translate-y-2 hover:shadow-primary-500  shadow-md dark:shadow-gray-700  h-auto md:h-auto">

            </div>
        <div
          class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72"
        ></div>
        <div
          class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72"
        ></div>
        <div
          class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72"
        ></div>
      </div> --}}
    </main>
  </div>

  <script>
    if (document.getElementById("area-chart") && typeof ApexCharts !== 'undefined') {
    const options = {
        chart: { height: "68%", maxWidth: "90%", type: "area", fontFamily: "Inter, sans-serif", dropShadow: { enabled: false }, toolbar: { show: false } },
        series: [{
            name: "New users",
            data: @json($weeklyData),
            color: "#1A56DB",
        }],
        xaxis: {
            categories: @json($weeklyLabels),
            labels: { show: false },
            axisBorder: { show: false },
            axisTicks: { show: false },
        },
        fill: {
            type: "gradient",
            gradient: {
                opacityFrom: 0.55,
                opacityTo: 0,
                shade: "#1C64F2",
                gradientToColors: ["#1C64F2"],
            },
        },
        stroke: { width: 6 },
        grid: { show: false, strokeDashArray: 4, padding: { left: 2, right: 2, top: 0 } },
        dataLabels: { enabled: false },
        tooltip: { enabled: true, x: { show: false } },
        yaxis: { show: false },
    };

    const chart = new ApexCharts(document.getElementById("area-chart"), options);
    chart.render();
}

  </script>

  @include('auth.admin.partials.layouts.footer')
@endsection
