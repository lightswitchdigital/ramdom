<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'prefix' => 'projects',
    'as' => 'projects.'
], function() {

    Route::group([
        'prefix' => '{project}',
    ], function() {

        Route::get('/get-recommendations', 'ProjectsController@recommendations')->name('recommendations');

    });

});
