@extends('auth.admin.partials.layouts.app.head')

@section('title', 'Quiz Answers')
@include('auth.admin.partials.layouts.side')
@include('auth.admin.partials.layouts.header')

@section('content')
<div class="admin-page-hero">
    <div class="admin-page-hero-inner">
        <h1>{{ $user->lastname }}, <b>Quiz Answers</b></h1>
        <p>{{ $user->firstname }} {{ $user->lastname }} · {{ $attempt->quiz?->quiz_title ?? 'Quiz' }}</p>
    </div>
</div>

<main class="admin-page-main p-4 md:ml-64 min-h-screen pt-5 pb-12">
    <div class="admin-surface mx-auto max-w-5xl p-4 md:p-6">
        <div class="mb-6 flex flex-col gap-3 border-b border-gray-200 pb-4 dark:border-gray-700 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Answer Review</h2>
                <p class="text-sm text-gray-500 dark:text-gray-400">Score: {{ $attempt->score }} · Correct: {{ $attempt->correct }}</p>
            </div>
            <a href="{{ route('users.tracking') }}" class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:text-gray-200 dark:hover:bg-gray-700">Back to Tracking</a>
        </div>

        <div class="space-y-5">
            @forelse($attempt->answers as $attemptAnswer)
                @php
                    $question = $attemptAnswer->question;
                    $selectedChoice = $attemptAnswer->answer;
                    $correctChoice = $question?->choices->firstWhere('letter', $question->answer);
                @endphp
                @if($question)
                    <section class="rounded-lg border border-gray-200 bg-gray-50 p-4 dark:border-gray-700 dark:bg-gray-800">
                        <p class="font-semibold text-gray-900 dark:text-white">{{ $loop->iteration }}. {{ $question->content }}</p>
                        <div class="mt-3 space-y-2 text-sm text-gray-700 dark:text-gray-200">
                            @foreach($question->choices as $choice)
                                <div class="rounded-md px-3 py-2 {{ $choice->id === $correctChoice?->id ? 'bg-green-100 font-semibold text-green-800 dark:bg-green-900/40 dark:text-green-200' : ($choice->id === $selectedChoice?->id ? 'bg-red-100 font-semibold text-red-800 dark:bg-red-900/40 dark:text-red-200' : '') }}">
                                    {{ $choice->letter }}. {{ $choice->content }}
                                    @if($choice->id === $correctChoice?->id) <span class="ml-2 text-xs">Correct answer</span> @endif
                                    @if($choice->id === $selectedChoice?->id) <span class="ml-2 text-xs">User answer</span> @endif
                                </div>
                            @endforeach
                        </div>
                    </section>
                @endif
            @empty
                <p class="text-sm text-gray-500 dark:text-gray-400">No answer details are available for this attempt.</p>
            @endforelse
        </div>
    </div>
</main>
@endsection
