<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;

class QuizSet extends Model
{
    use HasFactory;

    protected $fillable = [
        'quiz_id',
        'set_name',
        'set_number',
        'start_time',
        'end_time',
        'status',
        'description',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    /**
     * Get the quiz that owns this set
     */
    public function quiz(): BelongsTo
    {
        return $this->belongsTo(Quiz::class);
    }

    /**
     * Get the attempts for this set
     */
    public function attempts(): HasMany
    {
        return $this->hasMany(QuizAttempt::class, 'quiz_set_id');
    }

    /**
     * Check if this set is currently active
     */
    public function isActive(): bool
    {
        $now = Carbon::now();
        return $this->status === 'active' || ($this->start_time <= $now && $this->end_time >= $now);
    }

    /**
     * Check if this set is upcoming
     */
    public function isUpcoming(): bool
    {
        return $this->status === 'scheduled' && Carbon::now() < $this->start_time;
    }

    /**
     * Check if this set has ended
     */
    public function hasEnded(): bool
    {
        return $this->status === 'ended' || Carbon::now() > $this->end_time;
    }

    /**
     * Get set status (computed based on database status and time)
     */
    public function getComputedStatusAttribute(): string
    {
        if ($this->hasEnded()) {
            return 'ended';
        } elseif ($this->isActive()) {
            return 'active';
        } elseif ($this->isUpcoming()) {
            return 'upcoming';
        } elseif ($this->status === 'scheduled') {
            return 'scheduled';
        } else {
            return 'ended';
        }
    }

    /**
     * Scope for active sets
     */
    public function scopeActive($query)
    {
        $now = Carbon::now();
        return $query->where('start_time', '<=', $now)
                    ->where('end_time', '>=', $now);
    }

    /**
     * Scope for upcoming sets
     */
    public function scopeUpcoming($query)
    {
        $now = Carbon::now();
        return $query->where('start_time', '>', $now);
    }

    /**
     * Scope for ended sets
     */
    public function scopeEnded($query)
    {
        $now = Carbon::now();
        return $query->where('end_time', '<', $now);
    }

    /**
     * Automatically update set status based on current time
     */
    public function updateStatusAutomatically(): bool
    {
        $now = Carbon::now();
        $startTime = $this->start_time;
        $endTime = $this->end_time;
        $oldStatus = $this->status;
        
        if ($startTime <= $now && $endTime >= $now && $this->status !== 'active') {
            $this->status = 'active';
            $this->save();
            return $oldStatus !== 'active';
        } elseif ($endTime < $now && $this->status !== 'ended') {
            $this->status = 'ended';
            $this->save();
            return $oldStatus !== 'ended';
        }
        
        return false;
    }

    /**
     * Get sets that need status updates
     */
    public static function getSetsNeedingStatusUpdate()
    {
        $now = Carbon::now();

        return self::where(function ($query) use ($now) {
            // Should be active but still scheduled
            $query->where('status', 'scheduled')
                ->where('start_time', '<=', $now)
                ->where('end_time', '>=', $now);
        })->orWhere(function ($query) use ($now) {
            // Should be ended but still active
            $query->where('status', 'active')
                ->where('end_time', '<', $now);
        })->get();
    }

    /**
     * Get duration in minutes
     */
    public function getDurationInMinutes(): int
    {
        return $this->start_time->diffInMinutes($this->end_time);
    }

    /**
     * Get formatted time range
     */
    public function getFormattedTimeRange(): string
    {
        $start = $this->start_time->format('M d, Y g:i A');
        $end = $this->end_time->format('g:i A');
        return "{$start} - {$end}";
    }
}