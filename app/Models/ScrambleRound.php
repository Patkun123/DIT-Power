<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ScrambleRound extends Model
{
    use HasFactory;

    protected $fillable = [
        'scramble_attempt_id',
        'target',
        'guess',
        'solved',
        'time',
        'score',
    ];

    protected $casts = [
        'solved' => 'boolean',
    ];

    public function attempt(): BelongsTo
    {
        return $this->belongsTo(ScrambleAttempt::class, 'scramble_attempt_id');
    }
}




