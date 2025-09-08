<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class ActivityLog extends Model
{
    protected $fillable = [
        'user_id',
        'activity_type',
        'title',
        'description',
        'metadata',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'metadata' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the activity icon based on type
     */
    public function getIconAttribute(): string
    {
        return match($this->activity_type) {
            'quiz_taken' => 'academic-cap',
            'user_added' => 'user-plus',
            'feedback_sent' => 'chat-bubble-left-right',
            'journal_added' => 'book-open',
            'journal_updated' => 'pencil',
            'journal_deleted' => 'trash',
            'news_created' => 'newspaper',
            'news_updated' => 'pencil',
            'news_deleted' => 'trash',
            'user_updated' => 'user',
            'user_deleted' => 'user-minus',
            'login' => 'arrow-right-on-rectangle',
            'logout' => 'arrow-left-on-rectangle',
            'profile_updated' => 'user-circle',
            'password_changed' => 'key',
            'notification_sent' => 'bell',
            default => 'information-circle'
        };
    }

    /**
     * Get the activity color based on type
     */
    public function getColorAttribute(): string
    {
        return match($this->activity_type) {
            'quiz_taken' => 'blue',
            'user_added' => 'green',
            'feedback_sent' => 'purple',
            'journal_added' => 'indigo',
            'journal_updated' => 'yellow',
            'journal_deleted' => 'red',
            'news_created' => 'emerald',
            'news_updated' => 'amber',
            'news_deleted' => 'red',
            'user_updated' => 'cyan',
            'user_deleted' => 'red',
            'login' => 'green',
            'logout' => 'gray',
            'profile_updated' => 'blue',
            'password_changed' => 'orange',
            'notification_sent' => 'pink',
            default => 'gray'
        };
    }

    /**
     * Get formatted time ago
     */
    public function getTimeAgoAttribute(): string
    {
        return $this->created_at->diffForHumans();
    }

    /**
     * Scope for recent activities
     */
    public function scopeRecent($query, $days = 7)
    {
        return $query->where('created_at', '>=', Carbon::now()->subDays($days));
    }

    /**
     * Scope for specific activity type
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('activity_type', $type);
    }

    /**
     * Scope for user activities
     */
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
}
