<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class QuizQuestion extends Model
{
    /** @use HasFactory<\Database\Factories\QuizQuestionFactory> */
    use HasFactory;

    protected $fillable = [
        'quiz_id',
        'content',
        'answer',
        'set',
    ];

    /**
     * Get the quiz that owns this question
     */
    public function quiz(): BelongsTo
    {
        return $this->belongsTo(Quiz::class);
    }

    /**
     * Get the choices for this question
     */
    public function choices(): HasMany
    {
        return $this->hasMany(QuizChoice::class, 'question_id');
    }

    /**
     * Get the correct answer choice
     */
    public function correctAnswer() {
        return $this->hasOne(QuizChoice::class, 'question_id')
                    ->where('letter', $this->answer)->first();
    }
}
