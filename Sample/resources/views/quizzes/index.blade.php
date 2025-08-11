<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=<div class="container mx-auto p-6">
  <h1 class="text-2xl font-bold mb-4">Quizzes</h1>

  @foreach($quizzes as $q)
    <div class="p-4 mb-3 bg-white rounded shadow flex items-center justify-between">
      <div>
        <h2 class="font-semibold">Level {{ $q->level }} — {{ $q->title }}</h2>
        <p class="text-sm text-gray-600">{{ $q->description }}</p>
      </div>

      @php
        $locked = $q->level > 1 && !in_array(\App\Models\Quiz::where('level', $q->level-1)->first()->id, $passedQuizIds ?? []);
      @endphp

      <div>
        @if($locked)
          <button class="px-4 py-2 bg-gray-400 text-white rounded cursor-not-allowed" disabled>Locked</button>
        @else
          <a href="{{ route('quiz.start', $q->level) }}" class="px-4 py-2 bg-blue-600 text-white rounded">Start Quiz</a>
        @endif
      </div>
    </div>
  @endforeach
</div>, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

</body>
</html>
