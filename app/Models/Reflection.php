<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reflection extends Model
{
    protected $fillable = [
        'user_id',
        'what_went_well',
        'what_can_improve',
        'reflection_date',
    ];

    protected $casts = [
        'reflection_date' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
