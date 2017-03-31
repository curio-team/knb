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
    Route::resource('house', 'ApiHouseController', [
        'names' => [
            'index' => 'api.house.index',
            'show' => 'api.house.show',
            'create' => 'api.house.create',
            'store' => 'api.house.store',
            'edit' => 'api.house.edit',
            'update' => 'api.house.update',
            'destroy' => 'api.house.destroy',
        ]
    ]);
    Route::resource('post', 'ApiPostController', [
        'names' => [
            'index' => 'api.post.index',
            'show' => 'api.post.show',
            'create' => 'api.post.create',
            'store' => 'api.post.store',
            'edit' => 'api.post.edit',
            'update' => 'api.post.update',
            'destroy' => 'api.post.destroy',
        ]
    ]);
});