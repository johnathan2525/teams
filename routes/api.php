<?php
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', 'AuthController@login')->name('login');
    Route::post('logout', 'AuthController@logout')->name('logout');
    Route::post('refresh', 'AuthController@refresh')->name('refresh');
    Route::post('me', 'AuthController@me')->name('me');
});

Route::group(['middleware' => ['auth:api']], function () {
    Route::apiResource('teams', 'Api\TeamController');
    Route::apiResource('players', 'Api\PlayerController');
});

