<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([], function(){
    Route::resource('house', 'HouseController', [
        'names' => [
            'index' => 'house.index',
            'show' => 'house.show',
            'create' => 'house.create',
            'store' => 'house.store',
            'edit' => 'house.edit',
            'update' => 'house.update',
            'destroy' => 'house.destroy',
        ]
    ]);
    Route::resource('post', 'PostController', [
        'names' => [
            'index' => 'post.index',
            'show' => 'post.show',
            'create' => 'post.create',
            'store' => 'post.store',
            'edit' => 'post.edit',
            'update' => 'post.update',
            'destroy' => 'post.destroy',
        ]
    ]);
});