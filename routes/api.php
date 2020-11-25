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
    'middleware' => ['auth'],
    'prefix' => 'projects',
    'as' => 'projects.'
], function() {

    Route::post('/{project}/favorites/add')->name('favorites.add');
    Route::post('/{project}/favorites/remove')->name('favorites.remove');

});
