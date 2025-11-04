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
<<<<<<< HEAD
<<<<<<< HEAD
=======
        'address',
>>>>>>> d57b2f1a024bf5abce2b6f9bd60bf8ece88c09fb
=======
        'address',
>>>>>>> d57b2f1a024bf5abce2b6f9bd60bf8ece88c09fb
        'phone_number',
        'gender',
        'civil_status',
        'career',
        'level_career',
        'nature_of_work',
        'function',
        'educational_attachment_type',
        'educational_attachment',
        'post_graduate',
        'birthday',
<<<<<<< HEAD
<<<<<<< HEAD
        'address',
        'civil_status',
        'career',
        'level_career',
        'nature_of_work',
        'function',
        'educational_attachment_type',
        'educational_attachment',
        'post_graduate',
=======
>>>>>>> d57b2f1a024bf5abce2b6f9bd60bf8ece88c09fb
=======
>>>>>>> d57b2f1a024bf5abce2b6f9bd60bf8ece88c09fb
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
