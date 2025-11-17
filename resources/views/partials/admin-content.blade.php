<section class="text-gray-600 body-font dark:bg-gray-800 bg-white dark:text-gray-50">
    <div class="container mx-auto px-5 py-24">
        <div class="mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-2">Featured Content</h2>
            <div class="w-20 h-1 bg-gradient-to-r from-primary-400 to-lime-600 rounded"></div>
            <p class="text-gray-600 dark:text-gray-400 mt-4">Important wellness information and resources</p>
        </div>

        @forelse($adminContents as $content)
            <div class="mb-12 pb-12 border-b border-gray-200 dark:border-gray-700 last:border-b-0">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-start">
                    @if($content->image_url)
                        <div class="md:col-span-1">
                            <img src="{{ $content->image_url }}" alt="{{ $content->title }}"
                                class="w-full h-64 object-cover rounded-lg shadow-lg hover:shadow-xl transition-shadow">
                        </div>
                        <div class="md:col-span-2">
                    @else
                        <div class="md:col-span-3">
                    @endif
                        <span class="text-primary-600 dark:text-primary-400 text-sm font-semibold uppercase">Featured</span>
                        <h3 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white mt-2 mb-3">
                            {{ $content->title }}
                        </h3>

                        @if($content->description)
                            <p class="text-gray-600 dark:text-gray-400 text-base mb-4">
                                {{ $content->description }}
                            </p>
                        @endif

                        <div class="prose prose-sm dark:prose-invert max-w-none mb-6">
                            <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                                {{ Str::limit(strip_tags($content->content), 200) }}
                            </p>
                        </div>

                        <div class="flex flex-col sm:flex-row sm:items-center gap-4">
                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $content->published_at->format('M d, Y') }}
                            </div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                By {{ $content->admin->firstname }} {{ $content->admin->lastname }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m0 0h6"></path>
                </svg>
                <p class="text-gray-600 dark:text-gray-400 mt-4">No featured content available at this time.</p>
            </div>
        @endforelse
    </div>
</section>
