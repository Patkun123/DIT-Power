<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }} " class="scroll-smooth">
    <head>
        <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <title>{{ $title ?? config('app.name') }} Personalized Online Wellness Resource HUB</title>

        <link rel="icon" href="/images/favicon.ico" sizes="any">
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
            .minimized-video {
                position: fixed;
                bottom: 20px;
                right: 20px;
                width: 320px;
                height: 180px;
                z-index: 9999;
                background: #000;
                border-radius: 12px;
                box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
                overflow: hidden;
                transition: all 0.3s ease;
            }
            .minimized-video:hover {
                box-shadow: 0 15px 50px rgba(0, 0, 0, 0.4);
            }
            @media (max-width: 640px) {
                .minimized-video {
                    width: 240px;
                    height: 135px;
                    bottom: 10px;
                    right: 10px;
                }
            }
        </style>
    </head>
<body class="bg-gray-50 dark:bg-gray-900 min-h-screen w-full">
        <!-- Loading Screen -->
        @include('components.loading-screen')
        @include('partials.header')
        <section class="text-gray-600 body-font w-full overflow-x-auto">
            <div class="container mx-auto my-5 flex px-auto md:px-5 lg:px-25 overflow-auto py-25 md:flex-row flex-col items-center ">
                <div class="lg:flex-grow md:w-1/2 lg:pr-24 md:pr-16 flex flex-col lg:items-start md:items-end md:text-left mb-16 md:mb-0 items-center text-center">
                    <h1 class="title-font sm:text-5xl 2xl:text-5xl text-4xl md:text-3xl lg:text-6xl xl:text-4xl mb-4 font-extrablack tracking-wider dark:text-primary-50 text-gray-900 -translate-y-1"><b>DTI REGION 12
                        <br class="hidden lg:inline-block">Personalized Online Wellness Resource Hub</b></h1>
                    </h1>
                    <p class="mb-8 leading-relaxed xl:text-lg dark:text-gray-400">Empowering Wellness, Anytime, Anywhere.</p>
                    <div class="flex justify-center">
                        <a href="{{route('login')}}" class="group cursor-pointer relative inline-flex items-center px-6 py-2 text-lg bg-primary-500 hover:bg-gray-100 hover:ring-2 dark:hover:ring-2 hover:text-primary-500 dark:hover:bg-gray-800 hover:ring-primary-400 text-white rounded border-0 transition-all duration-300 hover:-translate-y-1 focus:outline-none">
                        <span class="relative inline-block">
                            Get Started
                            <span class="absolute left-0 -bottom-0.5 w-0 h-0.5 dark:bg-primary-400 bg-primary-500 transition-all duration-300 group-hover:w-full"></span>
                        </span>
                        </a>
                    </div>
                </div>
                <!-- Replace the carousel section in your Blade file with this -->
                <div
                    x-data="videoSlider()"
                    x-ref="videoSlider"
                    class="relative w-full md:w-190 2xl:w-200 2xl:p-15 lg:p-10 md:px-10 max-w-full px-4 sm:px-6 py-6 overflow-hidden flex items-center justify-center"
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
                                class="absolute top-0 left-0 w-full h-full transform transition-transform duration-500 rounded-lg shadow-lg overflow-hidden"
                                :class="{
                                    'z-20 scale-100 opacity-100': getVisibleIndex(index) === 0,
                                    'z-10 scale-90 opacity-50 -translate-x-full': getVisibleIndex(index) === -1,
                                    'z-10 scale-90 opacity-50 translate-x-full': getVisibleIndex(index) === 1
                                }"
                            >
                                <!-- YouTube Video Slide -->
                                <template x-if="slide.type === 'video'">
                                    <div class="w-full h-full">
                                        <iframe
                                            :id="'yt-player-' + index"
                                            x-bind:src="getVisibleIndex(index) === 0 ? slide.src : ''"
                                            class="w-full h-full object-cover rounded-lg"
                                            frameborder="0"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                            allowfullscreen
                                            loading="lazy"
                                        ></iframe>
                                    </div>
                                </template>

                                <!-- Image Slide -->
                                <template x-if="slide.type === 'image'">
                                    <img
                                        x-bind:src="slide.src"
                                        alt="Wellness Resource Slide"
                                        class="w-full h-full object-cover rounded-lg"
                                        loading="lazy"
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

        <!-- Minimized Floating Video Player -->
        <div 
            x-data="{}"
            x-show="window.videoSliderInstance && window.videoSliderInstance.isMinimized && window.videoSliderInstance.minimizedVideo"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-90 translate-y-4"
            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
            x-transition:leave-end="opacity-0 scale-90 translate-y-4"
            class="minimized-video"
            @click.self="window.videoSliderInstance && window.videoSliderInstance.restoreVideo()"
        >
            <div class="relative w-full h-full">
                <!-- Video Controls Header -->
                <div class="absolute top-0 left-0 right-0 z-10 flex items-center justify-between p-2 bg-gradient-to-b from-black/60 to-transparent">
                    <span class="text-white text-xs font-medium truncate flex-1">Video Playing</span>
                    <div class="flex items-center space-x-1">
                        <button 
                            @click="window.videoSliderInstance && window.videoSliderInstance.restoreVideo()"
                            class="p-1.5 rounded-full hover:bg-white/20 transition-colors"
                            title="Restore"
                        >
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"></path>
                            </svg>
                        </button>
                        <button 
                            @click="window.videoSliderInstance && window.videoSliderInstance.closeMinimized()"
                            class="p-1.5 rounded-full hover:bg-white/20 transition-colors"
                            title="Close"
                        >
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Minimized Video Iframe -->
                <template x-if="window.videoSliderInstance && window.videoSliderInstance.minimizedVideo">
                    <iframe
                        :src="window.videoSliderInstance.minimizedVideo.src"
                        class="w-full h-full"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen
                    ></iframe>
                </template>
            </div>
        </div>

        <section class="text-gray-600 body-font dark:bg-gray-800 bg-white dark:text-gray-50" id="news">
            @include('partials.article')
        </section>
        @include('partials.features')

        @include('partials.footer')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                lucide.createIcons();
            });

            // Video Slider Alpine.js Component
            function videoSlider() {
                return {
                    slides: [
                        { type: 'video', src: 'https://www.youtube.com/embed/OlY6HjxoGQw?autoplay=1&mute=1&enablejsapi=1&vq=hd1080&loop=1&playlist=OlY6HjxoGQw', videoId: 'OlY6HjxoGQw' },
                        { type: 'video', src: 'https://www.youtube.com/embed/jFpSQvYEsn0?autoplay=1&mute=1&enablejsapi=1&vq=hd1080&loop=1&playlist=jFpSQvYEsn0', videoId: 'jFpSQvYEsn0' },
                        { type: 'image', src: '/Images/pic/1.jpg' },
                        { type: 'image', src: '/Images/pic/2.jpg' },
                        { type: 'image', src: '/Images/pic/3.jpg' },
                    ],
                    current: 0,
                    interval: null,
                    players: {},
                    ytReady: false,
                    minimizedVideo: null,
                    isMinimized: false,
                    sliderElement: null,

                    init() {
                        this.setupYouTubeAPI();
                        this.setupAutoSlide();
                        this.setupScrollDetection();
                        this.sliderElement = this.$el;
                        // Store reference globally for minimized player access
                        window.videoSliderInstance = this;
                    },

                    setupScrollDetection() {
                        let ticking = false;
                        window.addEventListener('scroll', () => {
                            if (!ticking) {
                                window.requestAnimationFrame(() => {
                                    this.handleScroll();
                                    ticking = false;
                                });
                                ticking = true;
                            }
                        });
                    },

                    handleScroll() {
                        if (!this.sliderElement) return;
                        
                        const slide = this.slides[this.current];
                        if (slide.type !== 'video') {
                            this.isMinimized = false;
                            this.minimizedVideo = null;
                            return;
                        }

                        const rect = this.sliderElement.getBoundingClientRect();
                        const isOutOfView = rect.bottom < 0 || rect.top > window.innerHeight;
                        
                        if (isOutOfView && !this.isMinimized) {
                            this.minimizeVideo();
                        } else if (!isOutOfView && this.isMinimized) {
                            this.restoreVideo();
                        }
                    },

                    minimizeVideo() {
                        const slide = this.slides[this.current];
                        if (slide.type === 'video') {
                            this.isMinimized = true;
                            this.minimizedVideo = {
                                src: slide.src,
                                videoId: slide.videoId,
                                index: this.current
                            };
                        }
                    },

                    restoreVideo() {
                        this.isMinimized = false;
                        this.minimizedVideo = null;
                        // Scroll back to video
                        if (this.sliderElement) {
                            this.sliderElement.scrollIntoView({ behavior: 'smooth', block: 'start' });
                        }
                    },

                    closeMinimized() {
                        const currentPlayer = this.players[this.current];
                        if (currentPlayer) {
                            try {
                                currentPlayer.pauseVideo();
                            } catch (e) {
                                console.error('Error pausing video:', e);
                            }
                        }
                        this.restoreVideo();
                    },

                    setupYouTubeAPI() {
                        if (!window.YT) {
                            window.onYouTubeIframeAPIReady = () => {
                                this.ytReady = true;
                                this.$nextTick(() => this.initYouTubePlayer());
                            };
                            const tag = document.createElement('script');
                            tag.src = 'https://www.youtube.com/iframe_api';
                            const firstScriptTag = document.getElementsByTagName('script')[0];
                            firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
                        } else {
                            this.ytReady = true;
                            this.$nextTick(() => this.initYouTubePlayer());
                        }
                    },

                    initYouTubePlayer() {
                        const slide = this.slides[this.current];
                        if (slide.type === 'video' && this.ytReady) {
                            this.$nextTick(() => {
                                const iframeId = 'yt-player-' + this.current;
                                const iframe = this.$el.querySelector('#' + iframeId);
                                if (iframe && !this.players[this.current]) {
                                    try {
                                        this.players[this.current] = new YT.Player(iframeId, {
                                            events: {
                                                'onStateChange': (event) => {
                                                    if (event.data === YT.PlayerState.ENDED) {
                                                        this.next();
                                                    }
                                                },
                                                'onReady': (event) => {
                                                    event.target.setPlaybackQuality('hd1080');
                                                }
                                            }
                                        });
                                    } catch (e) {
                                        console.error('YouTube player init error:', e);
                                    }
                                }
                            });
                        }
                    },

                    setupAutoSlide() {
                        if (this.interval) clearInterval(this.interval);
                        const slide = this.slides[this.current];

                        if (slide.type === 'image') {
                            this.interval = setInterval(() => this.next(), 5000);
                        } else if (slide.type === 'video') {
                            this.initYouTubePlayer();
                        }
                    },

                    getVisibleIndex(index) {
                        if (index === this.current) return 0;
                        if (index === (this.current - 1 + this.slides.length) % this.slides.length) return -1;
                        if (index === (this.current + 1) % this.slides.length) return 1;
                        return null;
                    },

                    stopCurrentPlayer() {
                        const currentPlayer = this.players[this.current];
                        if (currentPlayer) {
                            try {
                                currentPlayer.stopVideo();
                            } catch (e) {
                                console.error('Error stopping video:', e);
                            }
                        }
                    },

                    next() {
                        this.stopCurrentPlayer();
                        this.current = (this.current + 1) % this.slides.length;
                        this.setupAutoSlide();
                    },

                    prev() {
                        this.stopCurrentPlayer();
                        this.current = (this.current - 1 + this.slides.length) % this.slides.length;
                        this.setupAutoSlide();
                    }
                }
            }
        </script>
    </body>
</html>
