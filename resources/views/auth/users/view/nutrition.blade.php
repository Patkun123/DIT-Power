@extends('auth.users.partials.app.head')

@section('title', 'Nutrition')
@section('content')

<div class="p-4 sm:p-6 lg:p-8 space-y-8 bg-gray-50 dark:bg-gray-900 min-h-screen">
    {{-- Page Header --}}
    <div class="max-w-7xl mx-auto">
        <div class="mb-8 text-center">
            <div class="inline-flex items-center justify-center p-3 bg-primary-100 dark:bg-primary-900/30 rounded-full mb-4">
                <svg class="w-8 h-8 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
            </div>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white mb-3">Nutrition & Healthy Eating</h1>
            <p class="text-lg text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">Discover the fundamentals of healthy eating and learn how to build a balanced diet for optimal wellness</p>
        </div>

        {{-- Video Section --}}
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden mb-8">
            {{-- Video Header --}}
            <div class="bg-gradient-to-r from-green-500 via-emerald-600 to-teal-600 dark:from-green-600 dark:via-emerald-700 dark:to-teal-700 px-6 py-5">
                <div class="flex items-center space-x-3">
                    <div class="p-2 bg-white/20 dark:bg-white/10 rounded-lg backdrop-blur-sm">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-xl sm:text-2xl font-bold text-white">The Healthy Eating Pyramid</h2>
                        <p class="text-green-100 text-sm">Learn about balanced nutrition and healthy eating habits</p>
                    </div>
                </div>
            </div>

            {{-- Video Content --}}
            <div class="p-6">
                <div class="relative w-full overflow-hidden rounded-xl shadow-lg" style="padding-top: 56.25%;">
                    <iframe
                        class="absolute top-0 left-0 w-full h-full rounded-xl"
                        src="https://www.youtube.com/embed/kdzxcYq8jdU?autoplay=0&controls=1"
                        title="YouTube video player"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen>
                    </iframe>
                </div>
            </div>
        </div>

        {{-- Information Cards Section --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            {{-- About Healthy Eating Pyramid --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="bg-gradient-to-r from-green-500 via-emerald-600 to-teal-600 dark:from-green-600 dark:via-emerald-700 dark:to-teal-700 px-6 py-5">
                    <div class="flex items-center space-x-3">
                        <div class="p-2 bg-white/20 dark:bg-white/10 rounded-lg backdrop-blur-sm">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white">The Healthy Eating Food Pyramid</h3>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-gray-600 dark:text-gray-300 leading-relaxed mb-4">
                        The Healthy Eating Food Pyramid is a visual guide that helps you understand the optimal number of servings from each food group for a balanced diet. It emphasizes eating more of certain foods and less of others to maintain good health.
                    </p>
                    <div class="flex items-center space-x-2 text-primary-600 dark:text-primary-400 font-semibold hover:text-primary-700 dark:hover:text-primary-300 transition-colors">
                        <a href="https://www.chp.gov.hk/en/static/90017.html" target="_blank" class="inline-flex items-center">
                            <span>Learn More</span>
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Balanced Diet Tips --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="bg-gradient-to-r from-green-500 via-emerald-600 to-teal-600 dark:from-green-600 dark:via-emerald-700 dark:to-teal-700 px-6 py-5">
                    <div class="flex items-center space-x-3">
                        <div class="p-2 bg-white/20 dark:bg-white/10 rounded-lg backdrop-blur-sm">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white">Key Principles</h3>
                    </div>
                </div>
                <div class="p-6">
                    <ul class="space-y-3">
                        <li class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-green-500 dark:text-green-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-600 dark:text-gray-300">Grains should be taken as the most</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-green-500 dark:text-green-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-600 dark:text-gray-300">Eat more fruits and vegetables</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-green-500 dark:text-green-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-600 dark:text-gray-300">Moderate amounts of meat, fish, eggs, and dairy</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-green-500 dark:text-green-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-600 dark:text-gray-300">Reduce fat, oil, salt, and sugar</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-green-500 dark:text-green-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-600 dark:text-gray-300">Use healthy cooking methods (steaming, boiling, etc.)</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- Food Pyramid Information Section --}}
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="bg-gradient-to-r from-green-500 via-emerald-600 to-teal-600 dark:from-green-600 dark:via-emerald-700 dark:to-teal-700 px-6 py-5">
                <div class="flex items-center space-x-3">
                    <div class="p-2 bg-white/20 dark:bg-white/10 rounded-lg backdrop-blur-sm">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-xl sm:text-2xl font-bold text-white">Understanding the Food Pyramid</h2>
                        <p class="text-purple-100 text-sm">A comprehensive guide to balanced nutrition</p>
                    </div>
                </div>
            </div>

            <div class="p-6 lg:p-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                    {{-- Content --}}
                    <div class="space-y-4">
                        <p class="text-gray-600 dark:text-gray-300 leading-relaxed text-base sm:text-lg">
                            The food pyramid is a visual representation (in the shape of a pyramid) of the optimal number of servings of food a person should eat daily from each basic food group. The food pyramid first evolved in Sweden in the 1970s and was adapted by the U.S. Department of Agriculture (USDA) in 1992.
                        </p>
                        <p class="text-gray-600 dark:text-gray-300 leading-relaxed text-base sm:text-lg">
                            The USDA revised it in 2005 to create what it called MyPyramid, which was replaced by MyPlate in 2011. Many countries across the globe have adapted versions of the food pyramid, sometimes discarding the pyramid shape altogether. Whatever form they take, such food guides are intended to help people cultivate a daily pattern of recommended (and thus presumably healthy) food choices.
                        </p>
                        <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                            <p class="text-sm text-gray-500 dark:text-gray-400 italic">
                                Balanced diet is a key to stay healthy. Follow the "Healthy Eating Food Pyramid" guide as you pick your food to achieve optimal nutrition and promote overall wellness.
                            </p>
                        </div>
                    </div>

                    {{-- Images --}}
                    <div class="grid grid-cols-2 gap-4">
                        <div class="group relative overflow-hidden rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300">
                            <img 
                                class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500" 
                                src="https://upload.wikimedia.org/wikipedia/commons/6/6d/USDA_Food_Pyramid.gif" 
                                alt="Food Pyramid Guide"
                                onerror="this.src='https://via.placeholder.com/400x300?text=Food+Pyramid'">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </div>
                        <div class="group relative overflow-hidden rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 mt-4 lg:mt-10">
                            <img 
                                class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500" 
                                src="https://upload.wikimedia.org/wikipedia/commons/6/6d/USDA_Food_Pyramid.gif" 
                                alt="Healthy Eating Guide"
                                onerror="this.src='https://via.placeholder.com/400x300?text=Healthy+Eating'">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
