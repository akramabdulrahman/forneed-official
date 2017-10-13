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


Route::group(['namespace'=>'Api', 'as' => 'api.','middleware'=>'auth:api'],function (){
    Route::get('projects', 'ProjectsController@index')->name('projects');
    Route::group(['prefix' => 'surveys', 'as' => 'surveys.'],function () {
        Route::get('/', 'SurveysController@index')->name('list');
        Route::post('/{survey}/{citizen}', 'SurveysController@store')->name('store');
        Route::get('{survey}/citizens', 'CitizensController@index');
    });

    Route::group(['prefix' => 'citizens', 'as' => 'citizens.'],function () {
        Route::post('', 'CitizensController@store');
    });

    Route::post('login', 'UserController@login');

});

