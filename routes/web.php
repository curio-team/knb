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

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::group(['middleware' => 'auth'], function() {

    Route::group(['middleware' => 'headmaster'], function(){

        Route::post('dashboard/csv/upload', 'ImportController@upload')->name('upload');
        Route::post('dashboard/user/registration', 'ImportController@singleRegistration');

        Route::get('/dashboard/import', 'DashboardController@import')->name('import');
        Route::get('/dashboard/points', 'DashboardController@points')->name('points');

        Route::get('/dashboard/badges', 'DashboardController@badges')->name('badges');
        Route::post('/dashboard/badges/toggle', 'BadgesController@toggle');


        Route::get('/dashboard', 'DashboardController@index')->name('dashboard');




        // allocate points from dashboard
        Route::post('/dashboard/points/', 'PointsController@allocate');
    });

    Route::resource('message', 'MessageController');

    Route::put('/profile/password', 'UsersController@changePassword');

    Route::get('/game-info', 'HomeController@gameInfo');
    Route::get('/about', 'HomeController@about')->name('story');
    Route::get('/profile', 'HomeController@profile')->name('profile');
    Route::get('/home', 'HomeController@index');
    Route::get('/learn', 'HomeController@learn');
    Route::get('/learn/{name}', 'HomeController@details');

    Route::resource('house', 'HouseController');
    Route::get('/house-selection', 'HouseController@selection');
    Route::get('/start-house-selection', 'HouseController@doSelection');

    Route::post('post/{post}/flag', 'PostController@flag');
    Route::post('post/{post}/vote', 'PostController@vote');
    Route::put('post/{post}/accept', 'PostController@accept');
    Route::get('post/filter', 'PostController@filter');
    Route::get('post/search', 'PostController@search');
    Route::put('answer/{post}/edit', 'PostController@updateAnswer');
    Route::get('answer/{post}', 'PostController@editAnswer');

    Route::get('post/{post}/answer', 'PostController@answer')->name('answer');
    Route::resource('post', 'PostController');


    Route::resource('comment', 'CommentController');

});
