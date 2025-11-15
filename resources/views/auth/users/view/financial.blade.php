@extends('auth.users.partials.app.head')

@section('title', 'Tools')
@section('content')
<div class="bg-gray-50 dark:bg-gray-900 min-h-screen flex flex-col items-center py-10">
    <h1 class="text-4xl font-bold dark:text-gray-50 text-gray-900 mb-2">Financial Well-being</h1>
    <div class="w-50 h-1 bg-primary-500 rounded mb-5"></div>
    <div class="w-200 mb-10 text-center">
        <span>
            Financial well-being refers to your ability to meet current and ongoing financial obligations, feel secure about your financial future, and make choices that allow you to enjoy life. It's not just about how much money you make—it's about how you manage and feel about your money.
        </span>
    </div>
    <div class="gap-8 items-center py-8 px-4 mx-auto max-w-screen-xl xl:gap-16 md:grid md:grid-cols-2 sm:py-16 lg:px-6">
        <div class="w-full aspect-video">
            <iframe
                class="w-full h-full rounded-lg"
                src="https://www.youtube.com/embed/blnbxbftme0?start=1"
                title="YouTube video player"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                allowfullscreen>
            </iframe>
        </div>

        <div class="mt-4 md:mt-0">
            <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">
                The Difference Between Saving, Investing, and Speculating
            </h2>
            <p class="mb-6 font-light text-gray-500 md:text-lg dark:text-gray-400">
                “Money is not just for spending—it’s a tool for building freedom, stability, and future opportunities. The earlier you understand that every peso you keep is a seed, the more your life can flourish. Save not just for things, but for peace of mind. For resilience. For dreams that take time.
                <br>Don’t save what’s left after spending—spend what’s left after saving. Build the habit, not just the amount. A good relationship with money isn’t about being rich; it’s about being prepared, being in control, and not letting money control you.
                <br>And remember, true wealth is quiet. It’s in the decisions you make every day—the budget you stick to, the impulse you resist, the future you prioritize.”
            </p>
        </div>
    </div>
    <h1 class="text-4xl font-bold dark:text-gray-50 text-gray-900 mb-2">Financial tools</h1>
    <div class="w-50 h-1 bg-primary-500 rounded mb-5"></div>
    @livewire('financialtools')
</div>
@endsection
