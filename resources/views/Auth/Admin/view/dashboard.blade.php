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
      <div class="grid grid-cols-1 sm:grid-cols-2 transition-all hover:-translate-y-2 hover:shadow-emerald-500  shadow-md dark:bg-gray-800 border-2 dark:border-gray-800 bg-white p-3 rounded-xl lg:grid-cols-4 gap-4 mb-4">
        <div class="bg-gray-300 rounded-lg transition-all hover:-translate-y-2 hover:shadow-emerald-500 shadow-md dark:border-gray-600 h-32 md:h-35 flex items-center justify-center space-x-4 p-4">
            <flux:button icon="user-group" class="shadow-xl shadow-gray-500 hover:bg-gray-200 hover:dark:bg-gray-700" />
            <div>
                <h2 class="text-gray-950 dark:text-white text-lg font-semibold">Total Users</h2>
                <span class="text-gray-950 dark:text-gray-950 text-xl font-bold">{{ $totalUsers ?? 0}}</span>
            </div>
        </div>
        <div class="bg-gray-300 rounded-lg transition-all hover:-translate-y-2 hover:shadow-emerald-500  shadow-md border-gray-300 dark:border-gray-600 h-32 md:h-35 items-center flex justify-center">
            <flux:button icon="clipboard" class="shadow-xl shadow-gray-500 hover:bg-gray-200 hover:dark:bg-gray-700">
            </flux:button>
        </div>
        <div class="bg-gray-300 rounded-lg transition-all hover:-translate-y-2 hover:shadow-emerald-500  shadow-md border-gray-300 dark:border-gray-600 h-32 md:h-35 items-center flex justify-center">
            <flux:button icon="megaphone" class="shadow-xl shadow-gray-500 hover:bg-gray-200 hover:dark:bg-gray-700">
            </flux:button>
        </div>
        <div class="bg-gray-300 rounded-lg transition-all hover:-translate-y-2 hover:shadow-emerald-500  shadow-md border-gray-300 dark:border-gray-600 h-32 md:h-35 items-center flex justify-center">
            <flux:button icon="newspaper" class="shadow-xl shadow-gray-500 hover:bg-gray-200 hover:dark:bg-gray-700">
            </flux:button>
        </div>
      </div>
      <div class="grid grid-cols-2 gap-4 mb-4 ">
        <div class=" p-4 md:p-6 bg-white dark:bg-gray-800 rounded-lg transition-all hover:-translate-y-2 hover:shadow-emerald-500  shadow-md dark:shadow-gray-700  h-100 md:h-auto">
            @include('auth.admin.partials.layouts.app.graph')
        </div>
        <div class=" p-10 md:p-4 bg-white dark:bg-gray-800 rounded-lg transition-all hover:-translate-y-2 hover:shadow-emerald-500  shadow-md dark:shadow-gray-700  h-auto md:h-auto">
            @include('auth.admin.partials.layouts.app.bargraph')
        </div>
      </div>
      {{-- </div>
        <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-96 mb-4">
      </div>
      <div
        class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-96 mb-4"
      ></div> --}}
      <div class="grid grid-cols-2 gap-4">
            <div class=" p-4 md:p-6 bg-white dark:bg-gray-800 rounded-lg transition-all hover:-translate-y-2 hover:shadow-emerald-500  shadow-md dark:shadow-gray-700  h-auto md:h-auto">

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
      </div>
    </main>
  </div>

  <script>
    if (document.getElementById("area-chart") && typeof ApexCharts !== 'undefined') {
    const options = {
        chart: { height: "73%", maxWidth: "100%", type: "area", fontFamily: "Inter, sans-serif", dropShadow: { enabled: false }, toolbar: { show: false } },
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

@endsection
