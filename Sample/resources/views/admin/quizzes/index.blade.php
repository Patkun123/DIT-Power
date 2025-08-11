@extends('layouts.app')
@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-xl font-bold mb-4">Manage Quizzes</h1>
    @foreach($quizzes as $quiz)
        <div class="p-4 bg-white rounded shadow mb-3 flex justify-between">
            <div>
                <h2 class="font-semibold">Level {{ $quiz->level }} — {{ $quiz->title }}</h2>
                <p class="text-sm text-gray-600">{{ $quiz->description }}</p>
            </div>
            <div>
                <a href="{{ route('admin.questions.create', $quiz->id) }}" class="px-4 py-2 bg-green-600 text-white rounded">
                    Add Question
                </a>
            </div>
        </div>
    @endforeach
</div>
@endsection
