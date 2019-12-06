<?php

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

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Auth'], function () {
    Route::group(['middleware' => 'guest:api'], function () {
        Route::post('/login', 'AuthController@login');
    });
    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('/me', 'AuthController@me');
    });
});

Route::group(['prefix' => 'users'], function () {
    Route::post('/new', 'UserController@store');
    Route::get('/', 'UserController@index');
    Route::get('/{user}', 'UserController@show');
    Route::put('/{user}/update', 'UserController@update');
});
