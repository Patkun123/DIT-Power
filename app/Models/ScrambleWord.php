<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScrambleWord extends Model
{
    use HasFactory;

    protected $fillable = [
        'word',
        'set',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];
}


