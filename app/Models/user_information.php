<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class user_information extends Model
{
    protected $table = 'user_information';
    protected $fillable = [
        'user_id',
        'staff_id',
        'phone_number',
        'gender',
        'birthday',
        'address',
        'civil_status',
        'career',
        'level_career',
        'nature_of_work',
        'function',
        'educational_attachment_type',
        'educational_attachment',
        'post_graduate',
        'height',
        'weight',
        'activity_level',
        'health_goals',
        'dietary_preferences',
    ];

    protected $casts = [
        'birthday' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
