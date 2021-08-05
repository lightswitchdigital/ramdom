<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;


Route::get('/', 'Projects\ProjectsController@index')->name('home');

Auth::routes();

/*
|--------------------------------------------------------------------------
| Root routes
|--------------------------------------------------------------------------
|
*/

Route::get('/about', 'HomeController@about')->name('about');
Route::get('/faq', 'HomeController@faq')->name('faq');
Route::get('/discounts', 'HomeController@discounts')->name('discounts');
Route::get('test', function(\App\Services\Projects\ProjectsService $service, \Barryvdh\DomPDF\PDF $PDF) {

    $service->composeDocs(Auth::user(), \App\Models\Projects\Project::first(), $PDF);

});

Route::group([
    'middleware' => 'auth',
    'prefix' => 'notifications',
    'as' => 'notifications.'
], function() {


    Route::get('/get', function (\Illuminate\Http\Request $request) {

        $batch = (int) $request->get('batch') ?? 1;
        $user = User::find(Auth::id());

        $count = env('NOTIFICATIONS_COUNT_BATCH');

        $notifications = $user->notifications()
            ->skip(($batch - 1) * $count)
            ->take($count)
            ->orderBy('id', 'DESC')
            ->get();

        return $notifications;

    })->name('get');

    Route::post('/{notification}/see', function(\App\Models\Notification $notification) {

        $notification->update([
            'seen' => true
        ]);

        return $notification;
    })->name('seen');

});

Route::group([
    'prefix' => 'projects',
    'as' => 'projects.',
    'namespace' => 'Projects'
], function() {

    Route::get('/', 'ProjectsController@index')->name('index');
    Route::get('/{project}', 'ProjectsController@show')->name('show');

    Route::group([
        'prefix' => '{project}',
        'middleware' => ['auth'],
    ], function() {

        Route::post('/buy', 'ProjectsController@buy')->name('buy');
        Route::post('/favorites/add', 'ProjectsController@addToFavorites')->name('favorites.add');
        Route::post('/favorites/remove', 'ProjectsController@removeFromFavorites')->name('favorites.remove');

        Route::group([
            'prefix' => 'editor',
            'as' => 'editor.'
        ], function() {

            Route::get('/', 'EditorController@index');

        });

        Route::group([
            'prefix' => 'modify',
            'as' => 'modify.'
        ], function() {

            Route::post('/save', 'ModifyController@save')->name('save');

        });

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

//    Route::get('/', 'HomeController@index')->name('index');

    Route::group([
        'prefix' => 'projects',
        'as' => 'projects.'
    ], function() {

        Route::get('/get-projects', 'ProjectsController@getProjects')->name('get-projects');

        Route::get('/', 'ProjectsController@index')->name('index');
        Route::get('/{project}/order', 'ProjectsController@order')->name('order');
        Route::post('/{project}/order/{developer}/submit')->name('order.submit');

        Route::post('/{project}/remove-from-saved', 'ProjectsController@removedFromSaved')->name('order.submit');
    });

    Route::group([
        'prefix' => 'plans',
        'as' => 'plans.'
    ], function() {

        Route::get('/', 'PlansController@index')->name('index');
        Route::post('/{plan}/subscribe', 'PlansController@subscribe')->name('subscribe');

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
        'prefix' => 'settings',
        'as' => 'settings.'
    ], function() {

        Route::get('/', 'SettingsController@index')->name('index');

        Route::put('/update', 'SettingsController@update')->name('update');
        Route::put('/update-individual-information', 'SettingsController@updateIndividualInformation')->name('update-individual-information');
        Route::put('/update-entity-information', 'SettingsController@updateIndividualInformation')->name('update-entity-information');
        Route::put('/update-password', 'SettingsController@updateIndividualInformation')->name('update-password');

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
        'prefix' => 'advice',
        'as' => 'advice'
    ], function() {



    });
    Route::resource('advice', 'AdviceController');

    Route::group([
        'prefix' => 'faq',
        'as' => 'faq'
    ], function() {



    });
    Route::resource('faq', 'FAQController');

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

        Route::post('/{payment}/accept', 'PaymentsController@accept')->name('accept');
        Route::post('/{payment}/reject', 'PaymentsController@reject')->name('reject');

    });
    Route::resource('payments', 'PaymentsController')->only(['index']);

});

Route::group([
    'prefix' => 'advice',
    'as' => 'advice.'
], function() {

    Route::get('/', 'AdviceController@index')->name('index');
    Route::get('/{advice}', 'AdviceController@show')->name('show');
    Route::post('/{advice}/comment', 'AdviceController@addComment')->name('comment');

});

//Route::get('/preloader', function() {
//    return view('preloader');
//});
