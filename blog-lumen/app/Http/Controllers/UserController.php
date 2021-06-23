<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserValidate;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    protected $modelClass = User::class;
    protected $validateClass = UserValidate::class;

}
