<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container mx-auto p-6">
  <h1 class="text-2xl font-bold mb-4">Level {{ $quiz->level }} — {{ $quiz->title }}</h1>
  <p class="mb-4">{{ $quiz->description }}</p>
  <p class="mb-6">Time: {{ $quiz->time_limit_seconds }} seconds</p>

  <button id="startBtn" class="px-6 py-2 bg-green-600 text-white rounded">Start Quiz</button>
</div>

<script>
document.getElementById('startBtn').addEventListener('click', async function(){
  // request fullscreen
  const el = document.documentElement;
  if (el.requestFullscreen) {
    try { await el.requestFullscreen(); } catch(e) { /* ignore */ }
  }
  // then redirect to take page
  window.location.href = "{{ route('quiz.take', $quiz->level) }}";
});
</script>
</body>
</html>
