<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class DailyWinner extends Model
{
    protected $fillable = [
        'user_id',
        'winner_type',
        'winner_date',
        'score',
        'correct_answers',
        'attempts_count',
        'set_number',
    ];

    protected $casts = [
        'winner_date' => 'date',
    ];

    /**
     * Get the user that won
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope for overall winners
     */
    public function scopeOverall($query)
    {
        return $query->where('winner_type', 'overall');
    }

    /**
     * Scope for set-specific winners
     */
    public function scopeSet($query, $setNumber)
    {
        return $query->where('winner_type', "set_{$setNumber}");
    }

    /**
     * Scope for a specific date
     */
    public function scopeForDate($query, $date)
    {
        return $query->where('winner_date', $date);
    }

    /**
     * Scope for recent winners
     */
    public function scopeRecent($query, $days = 7)
    {
        return $query->where('winner_date', '>=', Carbon::now()->subDays($days));
    }

    /**
     * Get winner type display name
     */
    public function getWinnerTypeDisplayAttribute(): string
    {
        return match($this->winner_type) {
            'overall' => 'Overall Champion',
            'set_1' => 'Set 1 Winner',
            'set_2' => 'Set 2 Winner',
            'set_3' => 'Set 3 Winner',
            default => 'Winner'
        };
    }

    /**
     * Get formatted date
     */
    public function getFormattedDateAttribute(): string
    {
        return $this->winner_date->format('M d, Y');
    }
}
