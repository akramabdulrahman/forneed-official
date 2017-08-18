<?php

use Illuminate\Http\Request;
// Get current user

Route::group(['namespace'=>'Auth\Api'],function(){
    Route::post('/login', 'LoginController@login');
    Route::post('/login/refresh', 'LoginController@refresh');

    Route::post('/logout', 'LoginController@logout')->middleware('auth:api');
});

Route::get('/me', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');
