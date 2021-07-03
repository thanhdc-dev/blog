<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostValidate;
use App\Models\Post;

class PostController extends BaseController
{
    protected $modelClass = Post::class;
    protected $validateClass = PostValidate::class;
}
