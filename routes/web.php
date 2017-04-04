<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function(){

    Route::get('/home', 'HomeController@index');
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

    Route::get('post/{id}/answer', 'PostController@answer')->name('answer');

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

    Route::resource('comment', 'CommentController', [
        'names' => [
            'index' => 'comment.index',
            'show' => 'comment.show',
            'create' => 'comment.create',
            'store' => 'comment.store',
            'edit' => 'comment.edit',
            'update' => 'comment.update',
            'destroy' => 'comment.destroy',
        ]
    ]);

});


