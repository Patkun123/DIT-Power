<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FinancialGoal extends Model
{
    protected $fillable = [
        'user_id',
        'goal_name',
        'target_amount',
        'current_amount',
        'target_date',
        'status',
        'description',
    ];

    protected $casts = [
        'target_amount' => 'decimal:2',
        'current_amount' => 'decimal:2',
        'target_date' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getProgressPercentageAttribute(): float
    {
        if ($this->target_amount == 0 || $this->target_amount == null) {
            return 0;
        }
        $percentage = ($this->current_amount / $this->target_amount) * 100;
        return min(100, max(0, round($percentage, 2)));
    }
}
