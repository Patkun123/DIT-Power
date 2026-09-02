<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SelfCareLog extends Model
{
    protected $fillable = [
        'user_id',
        'activity',
        'completed',
        'log_date',
    ];

    protected $casts = [
        'completed' => 'boolean',
        'log_date' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
