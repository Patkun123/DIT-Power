<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container mx-auto p-6">
        <h2 class="text-xl font-bold mb-2">Level {{ $quiz->level }}</h2>
        <p id="timer" class="mb-4">Time left: <span id="timeRemaining">{{ $quiz->time_limit_seconds }}</span>s</p>

        <form id="quizForm" method="POST" action="{{ route('quiz.submit', $quiz->level) }}">
            @csrf
            @foreach($quiz->questions as $question)
                <div class="mb-4 p-4 bg-white rounded shadow">
                    <p class="font-medium">{{ $loop->iteration }}. {{ $question->text }}</p>

                    @if($question->type === 'multiple_choice')
                        @foreach($question->options as $opt)
                            <label class="block">
                                <input type="radio" name="question_{{ $question->id }}" value="{{ $opt->text }}"> {{ $opt->text }}
                            </label>
                        @endforeach
                    @else
                        <input type="text" name="question_{{ $question->id }}" class="w-full border p-2 rounded" />
                    @endif
                </div>
            @endforeach

            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Submit</button>
        </form>
    </div>

    <script>
        let timeLeft = {{ $quiz->time_limit_seconds }};
        const timerEl = document.getElementById('timeRemaining');
        const form = document.getElementById('quizForm');

        // Countdown timer
        const interval = setInterval(() => {
            timeLeft--;
            timerEl.innerText = timeLeft;
            if (timeLeft <= 0) {
                clearInterval(interval);
                alert('Time is up — submitting automatically.');
                form.submit();
            }
        }, 1000);
    </script>
</body>
</html>
