<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Option;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function quizList()
    {
        $quizzes = Quiz::orderBy('level')->get();
        return view('admin.quizzes.index', compact('quizzes'));
    }

    public function create(Quiz $quiz)
    {
        return view('admin.questions.create', compact('quiz'));
    }

    public function store(Request $request, Quiz $quiz)
    {
        $request->validate([
            'text' => 'required|string',
            'type' => 'required|in:multiple_choice,fill_in_blank',
            'correct_answer' => 'nullable|string',
            'options' => 'array',
            'options.*' => 'nullable|string',
            'correct_option' => 'nullable|integer'
        ]);

        $question = $quiz->questions()->create([
            'text' => $request->text,
            'type' => $request->type,
            'correct_answer' => $request->type === 'fill_in_blank' ? $request->correct_answer : null,
        ]);

        if ($request->type === 'multiple_choice') {
            foreach ($request->options as $index => $optText) {
                if ($optText) {
                    $question->options()->create([
                        'text' => $optText,
                        'is_correct' => $request->correct_option == $index
                    ]);
                }
            }
        }

        return redirect()->route('admin.quizzes.index')->with('success', 'Question added successfully!');
    }
}
