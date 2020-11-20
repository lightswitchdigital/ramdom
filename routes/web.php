<?php

use Illuminate\Support\Facades\Route;


Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::group([
    'prefix' => 'projects',
    'as' => 'projects.'
], function() {

    Route::get('/', 'ProjectsController@index')->name('index');
    Route::get('/{project}', 'ProjectsController@show')->name('show');

    Route::group([
        'middleware' => ['auth'],
    ], function() {



    });

});

/*
|--------------------------------------------------------------------------
| Profile routes
|--------------------------------------------------------------------------
|
*/

Route::group([
    'prefix' => 'profile',
    'as' => 'profile.',
    'namespace' => 'Profile',
    'middleware' => ['auth']
], function() {

    Route::get('/', 'HomeController@index')->name('index');

    Route::group([
        'prefix' => 'projects',
        'as' => 'projects.'
    ], function() {

        Route::get('/', 'ProjectsController@index')->name('index');

    });

    Route::group([
        'prefix' => 'favorites',
        'as' => 'favorites.'
    ], function() {

        Route::get('/', 'FavoritesController@index')->name('index');

    });

    Route::group([
        'prefix' => 'building',
        'as' => 'building.'
    ], function() {

        Route::get('/', 'BuildingController@index')->name('index');

    });

    Route::group([
        'prefix' => 'documentation',
        'as' => 'documentation.'
    ], function() {

        Route::get('/', 'DocumentationController@index')->name('index');

    });

    Route::group([
        'prefix' => 'discounts',
        'as' => 'discounts.'
    ], function() {

        Route::get('/', 'DiscountsController@index')->name('index');

    });

    Route::get('/', 'HomeController@index')->name('index');

});

/*
|--------------------------------------------------------------------------
| Admin routes
|--------------------------------------------------------------------------
|
*/

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'middleware' => ['auth', 'can:admin-panel'],
    'namespace' => 'Admin'
], function() {

    Route::get('/', 'HomeController@index')->name('index');

    Route::group([
        'prefix' => 'projects',
        'as' => 'projects.'
    ], function() {

        Route::group([
            'prefix' => 'attributes',
            'as' => 'attributes.'
        ], function() {


        });
        Route::resource('attributes', 'AttributesController');

    });
    Route::resource('projects', 'ProjectsController');

    Route::group([
        'prefix' => 'users',
        'as' => 'users.'
    ], function() {



    });
    Route::resource('users', 'UsersController');

});

Route::get('/excel', 'DocumentsController@index');
