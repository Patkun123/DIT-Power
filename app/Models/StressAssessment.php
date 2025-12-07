<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StressAssessment extends Model
{
    protected $fillable = [
        'user_id',
        'stress_level',
        'notes',
        'assessment_date',
    ];

    protected $casts = [
        'stress_level' => 'integer',
        'assessment_date' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
