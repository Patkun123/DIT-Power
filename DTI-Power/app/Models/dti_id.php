<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class dti_id extends Model
{
    protected $table = 'dti_id';
    protected $fillable = [
        'staff_id',
        'office',
        'user_id',
    ];
}
