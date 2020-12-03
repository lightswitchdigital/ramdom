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
        'prefix' => '{project}',
        'middleware' => ['auth'],
    ], function() {

        Route::post('/order', 'OrderController@order')->name('order');
        Route::post('/favorites/add', 'ProjectsController@addToFavorites')->name('favorites.add');
        Route::post('/favorites/remove', 'ProjectsController@removeFromFavorites')->name('favorites.remove');

    });

    Route::get('/{project}/recommendations', 'ProjectsController@recommendations')->name('recommendations');


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
        'as' => 'projects.',
        'namespace' => 'Projects'
    ], function() {

        Route::group([
            'prefix' => 'attributes',
            'as' => 'attributes.'
        ], function() {


        });
        Route::resource('attributes', 'AttributesController');

    });
    Route::resource('projects', 'Projects\ProjectsController');

    Route::group([
        'prefix' => 'plans',
        'as' => 'plans.',
        'namespace' => 'Plans'
    ], function() {



    });
    Route::resource('plans', 'Plans\PlansController')->except(['create', 'store', 'destroy']);

    Route::group([
        'prefix' => 'editor',
        'as' => 'editor.',
        'namespace' => 'Editor'
    ], function () {

        Route::get('/', 'EditorController@index')->name('index');

        Route::group([
            'prefix' => 'attributes',
            'as' => 'attributes.'
        ], function() {


        });
        Route::resource('attributes', 'AttributesController');

    });

    Route::group([
        'prefix' => 'users',
        'as' => 'users.'
    ], function() {



    });
    Route::resource('users', 'UsersController');

    Route::group([
        'prefix' => 'payments',
        'as' => 'payments.'
    ], function() {



    });
    Route::resource('payments', 'PaymentsController')->only(['index', 'show']);

});

Route::get('/about', 'HomeController@about')->name('about');
Route::get('/faq', 'HomeController@faq')->name('faq');
Route::get('/advice', 'HomeController@advice')->name('advice');
