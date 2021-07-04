<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

use Illuminate\Support\Facades\Route;

Route::get('/', function () use ($router) {
    return $router->app->version();
});

Route::group(['prefix' => 'api'], function() {

    /** Register User */
    Route::post('users/register', 'UserController@register');

    /** Login User */
    Route::post('users/login', 'UserController@login');

    Route::group(['middleware' => 'auth'], function() {
        /** API User */
        generator_resource('users', 'UserController', ['index', 'show', 'update', 'trash']);

        /** API Post */
        generator_resource('posts', 'PostController');
    });
});
