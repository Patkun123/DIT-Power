@extends('auth.users.partials.app.head')

@section('title', 'Tools')
@section('content')
<div class="p-4 sm:p-6 space-y-10 bg-gray-100 dark:bg-gray-900 min-h-screen flex flex-col items-center justify-center">
    <h1 class="text-4xl font-bold dark:text-gray-50 text-gray-900 mb-2">Social Well-being</h1>
    <div class="w-50 h-1 bg-primary-500 rounded mb-5"></div>
    <div class="max-w-3xl mb-10 text-center px-4">
        <span>
            Social well-being is about the quality of your relationships and your ability to connect with others in meaningful, supportive, and respectful ways. It plays a huge role in overall happiness and life satisfaction.
        </span>
    </div>
    <h1 class="text-4xl font-bold self-end mr-10 dark:text-gray-50 text-gray-900 mb-2">Live chats</h1>
    {{-- Main Content --}}
    <div class="flex flex-col md:flex-row flex-1 w-full px-6 gap-6">

        {{-- IMAGE SLIDER --}}
        <div class="flex-1 flex justify-center items-center">
            <div
                x-data="{ active: 0, images: [
                    '{{ asset('images/pic/1.jpg') }}',
                    '{{ asset('images/pic/2.jpg') }}',
                    '{{ asset('images/pic/3.jpg') }}'
                ] }"
                x-init="setInterval(() => active = (active + 1) % images.length, 4000)"
                class="relative w-full h-[300px] md:h-[500px] overflow-hidden rounded-xl shadow-lg"
            >
                {{-- Slider Track --}}
                <div class="flex transition-transform duration-700 ease-in-out"
                     :style="`transform: translateX(-${active * 100}%);`">
                    <template x-for="(img, index) in images" :key="index">
                        <div class="w-full flex-shrink-0 h-full">
                            <img :src="img" class="w-full h-full object-cover">
                        </div>
                    </template>
                </div>

                {{-- Left Arrow --}}
                <button @click="active = (active - 1 + images.length) % images.length"
                        class="absolute left-2 top-1/2 -translate-y-1/2 bg-black bg-opacity-50 text-white p-2 rounded-full">
                    &#8592;
                </button>

                {{-- Right Arrow --}}
                <button @click="active = (active + 1) % images.length"
                        class="absolute right-2 top-1/2 -translate-y-1/2 bg-black bg-opacity-50 text-white p-2 rounded-full">
                    &#8594;
                </button>
            </div>
        </div>

        {{-- CHAT BOX --}}
        @livewire('chat')

    </div>
</div>
@endsection
