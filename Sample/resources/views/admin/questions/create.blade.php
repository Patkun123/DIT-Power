@extends('layouts.app')
@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-xl font-bold mb-4">Add Question to Level {{ $quiz->level }}</h1>

    <form method="POST" action="{{ route('admin.questions.store', $quiz->id) }}">
        @csrf

        <div class="mb-4">
            <label class="block font-semibold">Question Text</label>
            <textarea name="text" class="w-full border p-2 rounded" required></textarea>
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Question Type</label>
            <select name="type" id="type" class="border p-2 rounded" required>
                <option value="multiple_choice">Multiple Choice</option>
                <option value="fill_in_blank">Fill in the Blank</option>
            </select>
        </div>

        <div id="mcqOptions">
            <label class="block font-semibold mb-2">Options</label>
            @for($i=0; $i<4; $i++)
                <div class="flex items-center mb-2">
                    <input type="text" name="options[]" class="border p-2 rounded w-full mr-2" placeholder="Option {{ $i+1 }}">
                    <input type="radio" name="correct_option" value="{{ $i }}"> Correct
                </div>
            @endfor
        </div>

        <div id="fillAnswer" class="hidden">
            <label class="block font-semibold">Correct Answer</label>
            <input type="text" name="correct_answer" class="border p-2 rounded w-full">
        </div>

        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Save Question</button>
    </form>
</div>

<script>
document.getElementById('type').addEventListener('change', function(){
    if (this.value === 'multiple_choice') {
        document.getElementById('mcqOptions').classList.remove('hidden');
        document.getElementById('fillAnswer').classList.add('hidden');
    } else {
        document.getElementById('mcqOptions').classList.add('hidden');
        document.getElementById('fillAnswer').classList.remove('hidden');
    }
});
</script>
@endsection
