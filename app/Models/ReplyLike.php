<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReplyLike extends Model
{
    use HasFactory;

    protected $fillable = [
        'reply_id',
        'user_id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function reply(): BelongsTo
    {
        return $this->belongsTo(Reply::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}