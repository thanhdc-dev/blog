<?php

use Illuminate\Support\Facades\Route;

if(!function_exists('generator_resource')) {
    function generator_resource(string $prefix, string $controllerClass) {
        Route::group(['prefix' => $prefix], function () use ($controllerClass) {
            /** Get items */
            Route::get('/', $controllerClass . '@index');

            /** Add item */
            Route::post('/', $controllerClass . '@store');

            /** Show item */
            Route::get('{id:[0-9]+}', $controllerClass . '@show');

            /** Update item */
            Route::put('{id:[0-9]+}', $controllerClass . '@update');

            /** Delete item */
            Route::put('trash', $controllerClass . '@trash');
        });
    }
}
