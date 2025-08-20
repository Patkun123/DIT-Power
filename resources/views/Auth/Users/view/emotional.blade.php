@extends('auth.users.partials.app.head')

@section('title', 'Tools')
@section('content')
<div class="bg-gray-50 dark:bg-gray-900 min-h-screen flex flex-col items-center py-10">
    <h1 class="text-4xl font-bold dark:text-gray-50 text-gray-900 mb-2">Emotional Well-Being</h1>
    <div class="w-50 h-1 bg-primary-500 rounded mb-5"></div>
    <div class="w-200 mb-10 text-center">
        <span>
            Emotional well-being is about how you understand, manage, and express your emotions — and how well you cope with life’s challenges. It’s at the heart of mental health and affects everything from your relationships to your productivity and self-esteem.
        </span>
    </div>

    <div class="mb-6">
        <p class="text-lg font-semibold dark:text-gray-200 text-gray-800">Short Films Emotional Health Awareness</p>
    </div>

    <!-- Grid with 4 columns -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 w-full max-w-screen-xl px-6">
        <div class="w-full aspect-video">
            <iframe
                class="w-full h-full rounded-lg"
                src="https://www.youtube.com/embed/SmbIcdJ0Zx8?start=1"
                title="YouTube video player"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                allowfullscreen>
            </iframe>
        </div>

        <div class="w-full aspect-video">
            <iframe
                class="w-full h-full rounded-lg"
                src="https://www.youtube.com/embed/sgpEZm5anlo"
                title="YouTube video player"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                allowfullscreen>
            </iframe>
        </div>

        <div class="w-full aspect-video">
            <iframe
                class="w-full h-full rounded-lg"
                src="https://www.youtube.com/embed/ScD1iwXcYIo"
                title="YouTube video player"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                allowfullscreen>
            </iframe>
        </div>

        <div class="w-full aspect-video">
            <iframe
                class="w-full h-full rounded-lg"
                src="https://www.youtube.com/embed/zXw6nIMn5gU"
                title="YouTube video player"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                allowfullscreen>
            </iframe>
        </div>
    </div>
    <div class="mt-10 w-full max-w-screen-md text-center bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6">
        @livewire('quote-generator')
    </div>

</div>
@endsection
