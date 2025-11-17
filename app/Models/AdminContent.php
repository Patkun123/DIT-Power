<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminContent extends Model
{
    use HasFactory;

    protected $table = 'admin_contents';

    protected $fillable = [
        'title',
        'description',
        'content',
        'image_url',
        'status',
        'admin_id',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the admin who created this content
     */
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    /**
     * Scope to get only published content
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published')->whereNotNull('published_at');
    }

    /**
     * Scope to get only active content
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'published');
    }
}
