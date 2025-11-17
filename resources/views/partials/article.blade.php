<!-- Related Articles Section -->
<div class="px-1 py-20">
    <div class="max-w-screen-2xl mx-auto max-h-screen-xl overflow-hidden">
        <!-- Centered Title -->
        <div class="max-w-screen-md mb-8 lg:mb-16 mx-auto text-center relative">
            <div class="inline-block relative mb-6">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">
                DTI 12 Updates
                </h2>
                <span class="absolute -left-18 -bottom-1 h-1 w-90 bg-primary-500 dark:bg-primary-400 rounded"></span>
            </div>
        </div>
        <!-- Flex scroll on mobile, grid on desktop -->
        <div class="flex space-x-10 space-y-6 p-10 overflow-x-auto lg:grid-cols-3">
            @if(isset($adminContents) && $adminContents->count() > 0)
                @foreach($adminContents as $content)
                    <!-- Dynamic Content Card -->
                    <div class="min-w-[320px] w-60 lg:w-320 lg:h-110 h-110 max-w-sm flex-shrink-0 rounded-lg overflow-hidden bg-primary-600 text-gray-50 dark:bg-gray-800 shadow shadow-primary-500 hover:shadow-lg transition-all hover:translate-x-2">
                            @if($content->image_url)
                                <img src="{{ $content->image_url }}" alt="{{ $content->title }}" class="w-full h-40 object-cover">
                            @else
                                <div class="w-full h-40 bg-primary-700 dark:bg-gray-700 flex items-center justify-center">
                                    <span class="text-gray-400">No image</span>
                                </div>
                            @endif
                            <div class="p-4">
                                <span class="text-sm">{{ $content->published_at?->format('M d, Y') ?? $content->created_at->format('M d, Y') }}</span>
                                <h3 class="text-lg font-bold mt-5 mb-2 dark:text-gray-100">{{ $content->title }}</h3>
                                <p class="text-sm text-gray-300 mb-4">{{ substr($content->description, 0, 100) }}{{ strlen($content->description) > 100 ? '...' : '' }}</p>
                                <a href="#" class="text-primary-50 hover:underline">Read more</a>
                            </div>
                    </div>
                @endforeach
            @else
            <!-- No Content Message -->
            <div class="w-full text-center py-8">
                <p class="text-gray-500 dark:text-gray-400">No news available at this time.</p>
            </div>
            @endif
        </div>
  </div>
</div>
