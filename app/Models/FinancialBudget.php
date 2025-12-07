<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FinancialBudget extends Model
{
    protected $fillable = [
        'user_id',
        'category',
        'monthly_budget',
        'year',
        'month',
    ];

    protected $casts = [
        'monthly_budget' => 'decimal:2',
        'year' => 'integer',
        'month' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
