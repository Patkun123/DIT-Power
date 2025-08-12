<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizQuestion extends Model
{
    /** @use HasFactory<\Database\Factories\QuizQuestionFactory> */
    use HasFactory;

    public function choices()
    {
        return $this->hasMany(QuizChoice::class, 'question_id');
    }

    public function correctAnswer() {
        return $this->hasOne(QuizChoice::class, 'question_id')
                    ->where('letter', $this->answer);
    }
}
