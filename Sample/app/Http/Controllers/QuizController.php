<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\QuizResult;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::orderBy('level')->get();
        // get user's passed levels
        $passedQuizIds = auth()->user()->quizResults()->where('passed', true)->pluck('quiz_id')->toArray();
        return view('quizzes.index', compact('quizzes','passedQuizIds'));
    }

    public function start($level)
    {
        $quiz = Quiz::where('level', $level)->firstOrFail();

        // check eligibility: if level >1, user must have passed previous level
        if ($level > 1) {
            $prevQuiz = Quiz::where('level', $level-1)->first();
            $passedPrev = auth()->user()->quizResults()->where('quiz_id',$prevQuiz->id)->where('passed',true)->exists();
            if (!$passedPrev) {
                return redirect()->route('quizzes.index')->with('error','You must pass level '.($level-1).' first.');
            }
        }

        return view('quizzes.start', compact('quiz'));
    }

    public function take($level)
    {
        $quiz = Quiz::where('level',$level)->with('questions.options')->firstOrFail();
        return view('quizzes.take', compact('quiz'));
    }

    public function submit(Request $request, $level)
    {
        $quiz = Quiz::where('level',$level)->with('questions.options')->firstOrFail();
        $total = $quiz->questions->count();
        $correct = 0;

        foreach($quiz->questions as $question) {
            $ans = $request->input('question_'.$question->id);
            if ($question->type == 'multiple_choice') {
                // if options have is_correct flags:
                $correctOption = $question->options->firstWhere('is_correct', true);
                if ($correctOption && $ans == $correctOption->text) $correct++;
                else {
                    // fallback: compare to stored correct_answer
                    if ($question->correct_answer && strtolower(trim($ans)) == strtolower(trim($question->correct_answer))) $correct++;
                }
            } else {
                if ($question->correct_answer && strtolower(trim($ans)) == strtolower(trim($question->correct_answer))) $correct++;
            }
        }

        $percentage = $total ? ($correct / $total) * 100 : 0;
        $passed = $percentage >= 80;

        QuizResult::create([
            'user_id' => auth()->id(),
            'quiz_id' => $quiz->id,
            'score' => round($percentage,2),
            'passed' => $passed,
        ]);

        if ($passed) {
            return redirect()->route('quizzes.index')->with('success','You passed! Score: '.round($percentage,2).'%');
        } else {
            return redirect()->route('quizzes.index')->with('error','You did not pass. Score: '.round($percentage,2).'%');
        }
    }

    public function leaderboard()
    {
        // top users by their best score across all quizzes
        $top = DB::table('quiz_results')
            ->select('user_id', DB::raw('MAX(score) as best'))
            ->groupBy('user_id')
            ->orderByDesc('best')
            ->take(10)
            ->get();

        // attach user objects
        $top = $top->map(function($row){
            $row->user = \App\Models\User::find($row->user_id);
            return $row;
        });

        return view('quizzes.leaderboard', compact('top'));
    }
}
