@extends('auth.admin.partials.layouts.app.head')

@section('title', 'dashboard')
@include('auth.admin.partials.layouts.side')
@include('auth.admin.partials.layouts.header')
@section('content')
<div class="h-70 md:h-80 w-full bg-gradient-to-l from-primary-400 via-primary-600 to-lime-700">
    <div class="container mx-auto flex items-start justify-start h-full px-2 md:px-70">
        <div class="flex flex-col mt-40 md:mt-40">
            <h1 class="text-2xl md:text-4xl text-white">Welcome, <b>{{ auth()->user()->lastname }}</b></h1>
            <span class="text-white text-sm md:text-base mt-2">Manage your wellness platform with ease</span>
        </div>
    </div>
</div>

    <main class="p-4 md:ml-64 h-auto pt-5 bg-gray-200 dark:bg-gray-900">
      <div class="grid grid-cols-1 sm:grid-cols-2 transition-all hover:shadow-lg shadow-lg hover:-translate-y-2 hover:shadow-primary-500 dark:bg-gray-800 border-2 dark:border-gray-800 bg-white p-3 rounded-xl lg:grid-cols-5 gap-4 mb-4">
        <div class="dark:bg-gray-900 hover:dark:text-gray-950 text-lg font-semibold bg-gray-50 rounded-lg transition-all hover:-translate-y-2 hover:bg-primary-400 shadow-primary-500 shadow-md dark:border-gray-600 h-32 md:h-35 flex items-center justify-center space-x-4 p-4">
            <flux:button icon="user-group" variant="primary" color="lime" class="" />
            <div class="">
                <h2 class="font-semibold">Total Users</h2>
                <span class="font-bold text-3xl">{{ $totalUsers ?? 0}}</span>
            </div>
        </div>
        {{-- <div class="dark:bg-gray-900 hover:dark:text-gray-950 text-lg font-semibold bg-gray-50 rounded-lg transition-all hover:-translate-y-2 hover:bg-primary-400 shadow-primary-500 shadow-md dark:border-gray-600 h-32 md:h-35 flex items-center justify-center space-x-4 p-4">
            <flux:button icon="clipboard" variant="primary" color="lime" />
            <div class="">
                <h2 class="font-semibold">Daily Users Quiz</h2>
                <span class="font-bold text-3xl">{{ $totalUsers ?? 0}}</span>
            </div>
        </div> --}}
        {{-- <div class="dark:bg-gray-900 hover:dark:text-gray-950 text-lg font-semibold bg-gray-50 rounded-lg transition-all hover:-translate-y-2 hover:bg-primary-400 shadow-primary-500 shadow-md dark:border-gray-600 h-32 md:h-35 flex items-center justify-center space-x-4 p-4">
            <flux:button icon="megaphone" variant="primary" color="lime" />
                <div class="">
                    <h2 class="font-semibold">Total Users</h2>
                    <span class="font-bold text-3xl">{{ $totalUsers ?? 0}}</span>
                </div>
        </div> --}}
        <div class="dark:bg-gray-900 hover:dark:text-gray-950 text-lg font-semibold bg-gray-50 rounded-lg transition-all hover:-translate-y-2 hover:bg-primary-400 shadow-primary-500 shadow-md dark:border-gray-600 h-32 md:h-35 flex items-center justify-center space-x-4 p-4">
            <flux:button icon="newspaper"  variant="primary" color="lime" />
            <div class="">
                <h2 class="font-semibold">Total News</h2>
                <span class="font-bold text-3xl">{{ $news_articleCount ?? 0}}</span>
            </div>
        </div>
        <div class="dark:bg-gray-900 hover:dark:text-gray-950 text-lg font-semibold bg-gray-50 rounded-lg transition-all hover:-translate-y-2 hover:bg-primary-400 shadow-primary-500 shadow-md dark:border-gray-600 h-32 md:h-35 flex items-center justify-center space-x-4 p-4">
            <flux:button icon="chat-bubble-left-right" variant="primary" color="lime" />
            <div class="">
                <h2 class="font-semibold">Total Feedbacks</h2>
                <span class="font-bold text-3xl">{{ $totalFeedbacks ?? 0}}</span>
            </div>
        </div>
        <div class="dark:bg-gray-900 hover:dark:text-gray-950 text-lg font-semibold bg-gray-50 rounded-lg transition-all hover:-translate-y-2 hover:bg-primary-400 shadow-primary-500 shadow-md dark:border-gray-600 h-32 md:h-35 flex items-center justify-center space-x-4 p-4">
            <flux:button icon="star" variant="primary" color="lime" />
            <div class="">
                <h2 class="font-semibold">Avg Rating</h2>
                <span class="font-bold text-3xl">{{ $averageRating ?? 0}}/5</span>
            </div>
        </div>
        <div class="dark:bg-gray-900 hover:dark:text-gray-950 text-lg font-semibold bg-gray-50 rounded-lg transition-all hover:-translate-y-2 hover:bg-primary-400 shadow-primary-500 shadow-md dark:border-gray-600 h-32 md:h-35 flex items-center justify-center space-x-4 p-4">
            <flux:button icon="clock" variant="primary" color="lime" />
            <div class="">
                <h2 class="font-semibold">This Week</h2>
                <span class="font-bold text-3xl">{{ $recentFeedbacks ?? 0}}</span>
            </div>
        </div>
      </div>
        <div class="p-4 md:p-6 rounded-lgbg-white dark:bg-gray-800 rounded-lg transition-all hover:-translate-y-2 hover:shadow-primary-500  shadow-md dark:shadow-gray-700 h-96 mb-4">
            @include('auth.admin.partials.layouts.app.graph')
        </div>
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-4">
        <div class="p-4 bg-white dark:bg-gray-800 rounded-lg transition-all hover:-translate-y-2 hover:shadow-primary-500 shadow-md dark:shadow-gray-700">
            @include('auth.admin.partials.layouts.app.bargraph')
        </div>
        <div class="p-4 bg-white dark:bg-gray-800 rounded-lg transition-all hover:-translate-y-2 hover:shadow-primary-500 shadow-md dark:shadow-gray-700">
            @include('auth.admin.partials.layouts.app.pie')
        </div>
      </div>

      <!-- Recent Activity Section -->
      <div class="mb-4">
        @livewire('recent-activity')
      </div>

      <!-- Analysis Section -->
      <div class="grid grid-cols-1 lg:grid-cols-4 gap-4 mb-6">
        <div class="p-4 bg-white dark:bg-gray-800 rounded-lg shadow-md">
          <div class="flex items-center justify-between mb-2">
            <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-200">New Users Today</h3>
            <flux:icon name="user-plus" class="w-5 h-5 text-primary-500" />
          </div>
          <div class="text-3xl font-bold text-gray-900 dark:text-white">{{ $analysis['users_today'] ?? 0 }}</div>
          <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">This month: {{ $analysis['users_this_month'] ?? 0 }}</p>
        </div>

        <div class="p-4 bg-white dark:bg-gray-800 rounded-lg shadow-md">
          <div class="flex items-center justify-between mb-2">
            <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-200">Quizzes Today</h3>
            <flux:icon name="academic-cap" class="w-5 h-5 text-primary-500" />
          </div>
          <div class="text-3xl font-bold text-gray-900 dark:text-white">{{ $analysis['quizzes_today'] ?? 0 }}</div>
          <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Avg score: {{ $analysis['avg_quiz_score_today'] ?? 0 }}</p>
        </div>

        <div class="p-4 bg-white dark:bg-gray-800 rounded-lg shadow-md">
          <div class="flex items-center justify-between mb-2">
            <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-200">Journals Today</h3>
            <flux:icon name="book-open" class="w-5 h-5 text-primary-500" />
          </div>
          <div class="text-3xl font-bold text-gray-900 dark:text-white">{{ $analysis['journals_today'] ?? 0 }}</div>
          <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Active users today: {{ $analysis['active_users_today'] ?? 0 }}</p>
        </div>

        <div class="p-4 bg-white dark:bg-gray-800 rounded-lg shadow-md">
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
