<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends BaseModel
{
    use HasFactory;
    protected $fillable = [
        'title',
        'body',
    ];

    protected $table = 'posts';
}
