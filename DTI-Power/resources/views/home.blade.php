<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }} " class="scroll-smooth">
    <head>
        <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <title>{{ $title ?? config('app.name') }}</title>

        <link rel="icon" href="/logo.ico" sizes="any">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        <!-- Lucide Icons -->
        @vite(['resources/css/app.css','resources/js/app.js'])

        <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
        @fluxAppearance
        @fluxScripts
        <style>
            html, body {
                max-width: 100%;
                overflow-x: hidden;
                scroll-behavior: smooth;
            }
        </style>


    </head>
<body class="bg-gray-50 dark:bg-gray-900 min-h-screen w-full">
        @include('partials.header')
        <section class="text-gray-600 body-font w-full overflow-x-auto">
            <div class="container mx-auto my-5 flex px-auto md:px-5 lg:px-25 overflow-auto py-25 md:flex-row flex-col items-center ">
                <div class="lg:flex-grow md:w-1/2 lg:pr-24 md:pr-16 flex flex-col lg:items-start md:items-end md:text-left mb-16 md:mb-0 items-center text-center">
                    <h1 class="title-font sm:text-5xl 2xl:text-5xl text-4xl md:text-3xl lg:text-6xl mb-4 font-extrablack tracking-wider dark:text-primary-50 text-gray-900 -translate-y-1"><b>DTI REGION 12
                        <br class="hidden lg:inline-block">Personalized Online Wellness Resource</b></h1>
                    </h1>
                    <p class="mb-8 leading-relaxed xl:text-lg dark:text-gray-400">Empowering Wellness, Anytime, Anywhere.</p>
                    <div class="flex justify-center">
                        <a href="{{route('login')}}" class="group cursor-pointer relative inline-flex items-center px-6 py-2 text-lg bg-primary-500 hover:bg-gray-100 hover:ring-2 dark:hover:ring-2 hover:text-primary-500 dark:hover:bg-gray-800 hover:ring-primary-400 text-white rounded border-0 transition-all duration-300 hover:-translate-y-1 focus:outline-none">
                        <span class="relative inline-block">
                            Get Started
                            <span class="absolute left-0 -bottom-0.5 w-0 h-0.5 dark:bg-primary-400 bg-primary-500 transition-all duration-300 group-hover:w-full"></span>
                        </span>
                        </a>
                        <button class="group relative inline-flex items-center px-6 hover:text-primary-500 py-2 ml-4 text-lg dark:text-gray-100 text-gray-800 rounded border-0 transition-all duration-300 hover:-translate-x-1 cursor-pointer">
                        <span class="relative inline-block  ">
                            Learn More
                            <span class="absolute left-0 -bottom-0.5 w-0 h-0.5 bg-primary-500  transition-all duration-300 group-hover:w-full"></span>
                        </span>
                        </button>

                    </div>
                </div>
                <div
                    x-data="{
                        slides: [
                            { type: 'video', src: '/images/video/DTISportfest.mp4' },
                            { type: 'image', src: '/images/pic/1.jpg' },
                            { type: 'image', src: '/images/pic/2.jpg' },
                            { type: 'image', src: '/images/pic/3.jpg' },
                            { type: 'image', src: '/images/pic/4.jpg' },
                        ],
                        current: 0,
                        interval: null,

                        init() {
                            this.setupAutoSlide();
                        },

                        setupAutoSlide() {
                            if (this.interval) clearInterval(this.interval);
                            const slide = this.slides[this.current];

                            if (slide.type === 'image') {
                                this.interval = setInterval(() => this.next(), 5000);
                            }

                            this.$nextTick(() => {
                                const video = this.$el.querySelector('video');
                                if (video) {
                                    video.addEventListener('ended', () => this.next(), { once: true });
                                }
                            });
                        },

                        getVisibleIndex(index) {
                            if (index === this.current) return 0;
                            if (index === (this.current - 1 + this.slides.length) % this.slides.length) return -1;
                            if (index === (this.current + 1) % this.slides.length) return 1;
                            return null;
                        },

                        next() {
                            this.current = (this.current + 1) % this.slides.length;
                            this.setupAutoSlide();
                        },

                        prev() {
                            this.current = (this.current - 1 + this.slides.length) % this.slides.length;
                            this.setupAutoSlide();
                        }
                    }"
                    x-init="init"
                    class="relative w-full md:w-190 2xl:w-200 2xl:p-15 lg:px-4 md:px-10 max-w-full px-4 sm:px-6 py-6 overflow-hidden flex items-center justify-center"
                >

                    <!-- Slides -->
                    <div class="relative w-full aspect-video flex items-center justify-center max-w-screen-md">
                        <template x-for="(slide, index) in slides" :key="index">
                            <div
                                x-show="getVisibleIndex(index) !== null"
                                x-transition:enter="transition-all duration-500"
                                x-transition:enter-start="opacity-0 scale-95"
                                x-transition:enter-end="opacity-100 scale-100"
                                x-transition:leave="transition-all duration-500"
                                x-transition:leave-start="opacity-100 scale-100"
                                x-transition:leave-end="opacity-0 scale-95"
                                class="absolute top-0 left-0 w-full h-full transform transition-transform duration-500 rounded-lg shadow-lg"
                                :class="{
                                    'z-20 scale-100 opacity-100': getVisibleIndex(index) === 0,
                                    'z-10 scale-90 opacity-50 -translate-x-full': getVisibleIndex(index) === -1,
                                    'z-10 scale-90 opacity-50 translate-x-full': getVisibleIndex(index) === 1
                                }"
                            >
                                <!-- Video Slide -->
                                <template x-if="slide.type === 'video'">
                                    <video
                                        x-bind:src="slide.src"
                                        controls
                                        muted
                                        preload="metadata"
                                        class="w-full h-full object-cover rounded-lg"
                                    ></video>
                                </template>

                                <!-- Image Slide -->
                                <template x-if="slide.type === 'image'">
                                    <img
                                        x-bind:src="slide.src"
                                        alt="Slide"
                                        class="w-full h-full object-cover rounded-lg"
                                    />
                                </template>
                            </div>
                        </template>
                    </div>

                    <!-- Left Arrow -->
                    <button @click="prev" aria-label="Previous slide"
                        class="absolute left-2 sm:left-4 top-1/2 -translate-y-1/2 flex items-center justify-center bg-gray-700/80 dark:bg-gray-200/10 hover:bg-gray-700 dark:hover:bg-gray-600 text-white w-10 h-10 sm:w-12 sm:h-12 rounded-full transition z-30">
                        <flux:icon.arrow-left></flux:icon.arrow-left>
                    </button>

                    <!-- Right Arrow -->
                    <button @click="next" aria-label="Next slide"
                        class="absolute right-2 sm:right-4 top-1/2 -translate-y-1/2 flex items-center justify-center bg-gray-700/80 dark:bg-gray-200/10 hover:bg-gray-700 dark:hover:bg-gray-600 text-white w-10 h-10 sm:w-12 sm:h-12 rounded-full transition z-30">
                        <flux:icon.arrow-right></flux:icon.arrow-right>
                    </button>

                </div>

            </div>
        </section>
        <section class="text-gray-600 body-font dark:bg-gray-800 bg-white dark:text-gray-50" id="news">
            @include('partials.article')
        </section>
        @include('partials.features')

        @if (Route::has('login'))
            <div class="h-14.5 hidden lg:block"></div>
        @endif
        @include('partials.footer')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                lucide.createIcons();
            });
        </script>
    </body>
</html>
