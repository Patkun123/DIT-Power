<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ScrambleAttempt extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'score',
        'rounds',
        'time',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function rounds(): HasMany
    {
        return $this->hasMany(ScrambleRound::class);
    }
}




