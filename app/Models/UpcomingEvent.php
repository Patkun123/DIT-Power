<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class UpcomingEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'content',
        'category',
        'status',
        'event_date',
        'end_date',
        'location',
        'organizer',
        'author',
        'image_url',
        'slug',
        'summary'
    ];

    protected $casts = [
        'event_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    // Scope for published events
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    // Scope for upcoming events (not yet started)
    public function scopeUpcoming($query)
    {
        return $query->where('event_date', '>', now());
    }

    // Scope for active events (currently happening)
    public function scopeActive($query)
    {
        return $query->where('event_date', '<=', now())
            ->where(function ($q) {
                $q->whereNull('end_date')
                    ->orWhere('end_date', '>=', now());
            });
    }

    // Scope for past events
    public function scopePast($query)
    {
        return $query->where(function ($q) {
            $q->where('end_date', '<', now())
                ->orWhere(function ($q2) {
                    $q2->whereNull('end_date')
                        ->where('event_date', '<', now());
                });
        });
    }

    // Get formatted event date
    public function getFormattedEventDateAttribute()
    {
        return $this->event_date->format('M d, Y');
    }

    // Get formatted event time
    public function getFormattedEventTimeAttribute()
    {
        return $this->event_date->format('h:i A');
    }

    // Check if event is upcoming
    public function getIsUpcomingAttribute()
    {
        return $this->event_date > now();
    }

    // Check if event is currently active
    public function getIsActiveAttribute()
    {
        $now = now();
        return $this->event_date <= $now &&
            ($this->end_date === null || $this->end_date >= $now);
    }

    // Check if event is past
    public function getIsPastAttribute()
    {
        if ($this->end_date) {
            return $this->end_date < now();
        }
        return $this->event_date < now();
    }
}
