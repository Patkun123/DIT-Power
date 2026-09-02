@extends('auth.admin.partials.layouts.app.head')

@section('title', 'Quiz Management')
@include('auth.admin.partials.layouts.side')
@include('auth.admin.partials.layouts.header')
@section('content')
<div class="admin-page-hero">
    <div class="admin-page-hero-inner">
        <p class="admin-eyebrow">Content operations</p>
        <h1>Quiz <b>Management</b></h1>
        <p>Build, schedule, and maintain your assessment library.</p>
    </div>
</div>

<main class="admin-page-main admin-quiz-page p-4 md:ml-64 h-auto">
    @php
        $activeQuizzes = $quizzes->filter(fn($quiz) => $quiz->computed_status === 'active')->count();
        $upcomingQuizzes = $quizzes->filter(fn($quiz) => $quiz->computed_status === 'upcoming')->count();
    @endphp

    <section class="admin-quiz-intro">
        <div>
            <p class="admin-eyebrow">Overview</p>
            <h2>Keep every quiz ready for your community</h2>
            <p class="admin-quiz-intro-copy">Review timing, question coverage, and publishing status from one place.</p>
        </div>
        <a href="{{ route('admin.quizzes.create') }}" class="admin-primary-action">
            <svg aria-hidden="true" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v14m7-7H5"></path>
            </svg>
            Create quiz
        </a>
    </section>

    <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6" aria-label="Quiz summary">
        <div class="admin-quiz-stat">
            <span class="admin-quiz-stat-icon stat-blue"><svg aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.6a1 1 0 01.7.3l5.4 5.4a1 1 0 01.3.7V19a2 2 0 01-2 2Z"></path></svg></span>
            <span><strong>{{ $quizzes->count() }}</strong><small>Total quizzes</small></span>
        </div>
        <div class="admin-quiz-stat">
            <span class="admin-quiz-stat-icon stat-amber"><svg aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 8v4l3 3m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"></path></svg></span>
            <span><strong>{{ $activeQuizzes }}</strong><small>Live now</small></span>
        </div>
        <div class="admin-quiz-stat">
            <span class="admin-quiz-stat-icon stat-sky"><svg aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 7V3m8 4V3M5 11h14M5 21h14a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2H3a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2Z"></path></svg></span>
            <span><strong>{{ $upcomingQuizzes }}</strong><small>Upcoming</small></span>
        </div>
        <div class="admin-quiz-stat">
            <span class="admin-quiz-stat-icon stat-slate"><svg aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01"></path></svg></span>
            <span><strong>{{ $quizzes->sum('questions_count') }}</strong><small>Total questions</small></span>
        </div>
    </section>

    <section class="admin-quiz-list admin-surface overflow-hidden">
        <div class="admin-quiz-list-header">
            <div>
                <p class="admin-eyebrow">Library</p>
                <h2>All quizzes</h2>
            </div>
            <span class="admin-quiz-count">{{ $quizzes->count() }} {{ Str::plural('quiz', $quizzes->count()) }}</span>
        </div>

        <div class="overflow-x-auto">
            <table class="admin-table w-full text-sm text-left text-gray-600 dark:text-gray-300">
                <thead>
                    <tr>
                        <th scope="col" class="px-6 py-4">Quiz</th>
                        <th scope="col" class="px-6 py-4">Status</th>
                        <th scope="col" class="px-6 py-4">Availability</th>
                        <th scope="col" class="px-6 py-4">Questions</th>
                        <th scope="col" class="px-6 py-4 text-right">Manage</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($quizzes as $quiz)
                        <tr>
                            <td class="px-6 py-5">
                                <div class="admin-quiz-title">
                                    <span class="admin-quiz-number">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                                    <div>
                                        <a href="{{ route('admin.quizzes.show', $quiz) }}">{{ $quiz->quiz_title }}</a>
                                        <p>{{ $quiz->description ? Str::limit($quiz->description, 70) : 'No description provided' }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-5">
                                @php
                                    $status = $quiz->computed_status;
                                    $statusColors = [
                                        'active' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300',
                                        'upcoming' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300',
                                        'scheduled' => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300',
                                        'ended' => 'bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-300'
                                    ];
                                @endphp
                                <span class="admin-status-pill {{ $statusColors[$status] ?? 'bg-gray-100 text-gray-800' }}"><span></span>{{ ucfirst($status) }}</span>
                            </td>
                            <td class="px-6 py-5">
                                <div class="admin-quiz-dates">
                                    <span>{{ $quiz->start_date->setTimezone('Asia/Manila')->format('M d, Y') }}</span>
                                    <small>{{ $quiz->start_date->setTimezone('Asia/Manila')->format('g:i A') }} - {{ $quiz->end_date->setTimezone('Asia/Manila')->format('g:i A') }}</small>
                                </div>
                            </td>
                            <td class="px-6 py-5"><span class="admin-question-count">{{ $quiz->questions_count }}</span></td>
                            <td class="px-6 py-5 text-right">
                                <div class="admin-quiz-actions">
                                    <a href="{{ route('admin.quizzes.show', $quiz) }}"
                                                    class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300"
                                                    title="View quiz" aria-label="View quiz">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </a>
                                    <a href="{{ route('admin.quizzes.sets', $quiz) }}"
                                       class="text-purple-600 hover:text-purple-800 dark:text-purple-400 dark:hover:text-purple-300"
                                       title="Manage Sets">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                        </svg>
                                    </a>
                                    <a href="{{ route('admin.quizzes.questions', $quiz) }}"
                                       class="text-green-600 hover:text-green-800 dark:text-green-400 dark:hover:text-green-300"
                                       title="Manage Questions">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </a>
                                    <a href="{{ route('admin.quizzes.edit', $quiz) }}"
                                                    class="text-yellow-600 hover:text-yellow-800 dark:text-yellow-400 dark:hover:text-yellow-300"
                                                    title="Edit quiz" aria-label="Edit quiz">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </a>
                                    <form action="{{ route('admin.quizzes.destroy', $quiz) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300"
                                            title="Delete quiz" aria-label="Delete quiz"
                                                onclick="return confirm('Are you sure you want to delete this quiz?')">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">
                                <div class="flex flex-col items-center">
                                    <svg class="w-12 h-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <p class="text-lg font-medium mb-2">No quizzes found</p>
                                    <p class="text-sm mb-4">Get started by creating your first quiz</p>
                                    <a href="{{ route('admin.quizzes.create') }}"
                                       class="inline-flex items-center px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition-colors duration-200">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                        Create Quiz
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
      </div>
    </main>
@endsection

