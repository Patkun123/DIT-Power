<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class news_article extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'content',
        'category',
        'status',
        'publication_date',
        'author',
        'summary',
        'image_url',
        'slug',
    ];
}
