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

        Route::group([
            'middleware' => ['auth']
        ], function() {

            Route::post('/favorites/add', 'FavoritesController@add')->name('favorites.add');
            Route::post('/favorites/remove', 'FavoritesController@remove')->name('favorites.remove');

        });

        Route::get('/get-recommendations', 'ProjectsController@recommendations')->name('recommendations');

    });

});
