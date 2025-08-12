<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizChoice extends Model
{
    public function question()
    {
        return $this->belongsTo(QuizQuestion::class, 'question_id');
    }
}
