<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MoodTracking extends Model
{
    protected $table = 'mood_tracking';

    protected $fillable = [
        'user_id',
        'mood',
        'tracked_date',
        'notes',
    ];

    protected $casts = [
        'tracked_date' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
