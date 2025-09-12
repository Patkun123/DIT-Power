<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'quiz_title',
        'start_date',
        'end_date',
        'description',
        'status',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    /**
     * Get the questions for this quiz
     */
    public function questions(): HasMany
    {
        return $this->hasMany(QuizQuestion::class);
    }

    /**
     * Get the attempts for this quiz
     */
    public function attempts(): HasMany
    {
        return $this->hasMany(QuizAttempt::class);
    }

    /**
     * Get the sets for this quiz
     */
    public function sets(): HasMany
    {
        return $this->hasMany(QuizSet::class);
    }

    /**
     * Get active sets for this quiz
     */
    public function activeSets(): HasMany
    {
        return $this->hasMany(QuizSet::class)->active();
    }

    /**
     * Get upcoming sets for this quiz
     */
    public function upcomingSets(): HasMany
    {
        return $this->hasMany(QuizSet::class)->upcoming();
    }

    /**
     * Check if quiz is currently active
     */
    public function isActive(): bool
    {
        $now = Carbon::now();
        return $this->status === 'active' || ($this->start_date <= $now && $this->end_date >= $now);
    }

    /**
     * Check if quiz is upcoming
     */
    public function isUpcoming(): bool
    {
        return $this->status === 'scheduled' && Carbon::now() < $this->start_date;
    }

    /**
     * Check if quiz has ended
     */
    public function hasEnded(): bool
    {
        return $this->status === 'ended' || Carbon::now() > $this->end_date;
    }

    /**
     * Get quiz status (computed based on database status and time)
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
     * Scope for active quizzes
     */
    public function scopeActive($query)
    {
        $now = Carbon::now();
        return $query->where('start_date', '<=', $now)
                    ->where('end_date', '>=', $now);
    }

    /**
     * Scope for upcoming quizzes
     */
    public function scopeUpcoming($query)
    {
        $now = Carbon::now();
        return $query->where('start_date', '>', $now);
    }

    /**
     * Scope for ended quizzes
     */
    public function scopeEnded($query)
    {
        $now = Carbon::now();
        return $query->where('end_date', '<', $now);
    }

    /**
     * Get quizzes that need status updates
     */
    public static function getQuizzesNeedingStatusUpdate()
    {
        $now = Carbon::now();
        
        return self::where(function($query) use ($now) {
            // Quizzes that should be active (started but not marked as active)
            $query->where('status', 'scheduled')
                  ->where('start_date', '<=', $now)
                  ->where('end_date', '>=', $now);
        })->orWhere(function($query) use ($now) {
            // Quizzes that should be ended (ended but not marked as ended)
            $query->where('status', 'active')
                  ->where('end_date', '<', $now);
        })->get();
    }

    /**
     * Update quiz status automatically based on current time
     */
    public function updateStatusAutomatically(): bool
    {
        $now = Carbon::now();
        $oldStatus = $this->status;
        
        if ($this->status === 'scheduled' && $this->start_date <= $now && $this->end_date >= $now) {
            // Quiz should be active
            $this->status = 'active';
            $this->save();
            return $oldStatus !== $this->status;
        } elseif ($this->status === 'active' && $this->end_date < $now) {
            // Quiz should be ended
            $this->status = 'ended';
            $this->save();
            return $oldStatus !== $this->status;
        }
        
        return false;
    }
}
