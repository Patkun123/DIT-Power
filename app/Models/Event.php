<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $table = 'events';

    protected $fillable = [
        'title',
        'description',
        'location',
        'event_date',
        'event_time',
        'status',
        'admin_id',
        'image_url',
    ];

    protected $casts = [
        'event_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the admin who created this event
     */
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    /**
     * Scope to get only upcoming events
     */
    public function scopeUpcoming($query)
    {
        return $query->where('status', 'active')
            ->where('event_date', '>=', now()->toDateString())
            ->orderBy('event_date', 'asc')
            ->orderBy('event_time', 'asc');
    }

    /**
     * Scope to get only active events
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Check if event is happening today
     */
    public function isToday()
    {
        return $this->event_date->isToday();
    }

    /**
     * Check if event is in the past
     */
    public function isPast()
    {
        return $this->event_date->isPast();
    }
}
