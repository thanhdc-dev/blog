<?php

use Illuminate\Support\Facades\Route;

if(!function_exists('generator_resource')) {
    function generator_resource(string $prefix, string $controllerClass, array $resources = []) {
        Route::group(['prefix' => $prefix], function () use ($controllerClass, $resources) {

            /** Get items */
            if(empty($resources) || in_array('index', $resources)){
                Route::get('/', $controllerClass . '@index');
            }

            /** Add item */
            if(empty($resources) || in_array('store', $resources)) {
                Route::post('/', $controllerClass . '@store');
            }

            /** Show item */
            if(empty($resources) || in_array('show', $resources)) {
                Route::get('{id:[0-9]+}', $controllerClass . '@show');
            }

            /** Update item */
            if(empty($resources) || in_array('update', $resources)) {
                Route::put('{id:[0-9]+}', $controllerClass . '@update');
            }

            /** Delete item */
            if(empty($resources) || in_array('trash', $resources)) {
                Route::put('trash', $controllerClass . '@trash');
            }
        });
    }
}
