<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;


Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

/*
|--------------------------------------------------------------------------
| Notifications routes
|--------------------------------------------------------------------------
|
*/

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

/*
|--------------------------------------------------------------------------
| Root routes
|--------------------------------------------------------------------------
|
*/

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
        Route::post('/order', 'OrderController@order')->name('order');
        Route::post('/favorites/add', 'ProjectsController@addToFavorites')->name('favorites.add');
        Route::post('/favorites/remove', 'ProjectsController@removeFromFavorites')->name('favorites.remove');

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

    Route::get('/', 'HomeController@index')->name('index');

    Route::group([
        'prefix' => 'projects',
        'as' => 'projects.'
    ], function() {

        Route::get('/', 'ProjectsController@index')->name('index');
        Route::get('/{project}/order', 'ProjectsController@order')->name('order');
        Route::post('/{project}/order/{developer}/submit')->name('order.submit');

        Route::post('/{project}/remove-from-saved', 'ProjectsController@removedFromSaved')->name('order.submit');

        Route::get('/get-purchased-projects', 'ProjectsController@getPurchasedProjects')->name('get-purchased-projects');
        Route::get('/get-saved-projects', 'ProjectsController@getSavedProjects')->name('get-saved-projects');

    });

    Route::group([
        'prefix' => 'balance',
        'as' => 'balance.'
    ], function() {

        Route::get('/', 'BalanceController@index')->name('index');
        Route::get('/add', 'BalanceController@add')->name('add');
        Route::post('/add/check', 'BalanceController@check')->name('add.check');

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
        'prefix' => 'discounts',
        'as' => 'discounts.'
    ], function() {

        Route::get('/', 'DiscountsController@index')->name('index');

    });

    Route::group([
        'prefix' => 'settings',
        'as' => 'settings.'
    ], function() {

        Route::get('/', 'SettingsController@index')->name('index');

        Route::put('/update', 'SettingsController@update')->name('update');
        Route::put('/update-individual-information', 'SettingsController@updateIndividualInformation')->name('update-individual-information');
        Route::put('/update-entity-information', 'SettingsController@updateIndividualInformation')->name('update-individual-information');
        Route::put('/update-password', 'SettingsController@updateIndividualInformation')->name('update-individual-information');

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
        'prefix' => 'comments',
        'as' => 'comments.'
    ], function() {

        Route::post('/{comment}/activate', 'CommentsController@activate')->name('activate');

    });
    Route::resource('comments', 'CommentsController');

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

Route::get('/about', 'HomeController@about')->name('about');
Route::get('/faq', 'HomeController@faq')->name('faq');

Route::group([
    'prefix' => 'advice',
    'as' => 'advice.'
], function() {

    Route::get('/', 'AdviceController@index')->name('index');
    Route::get('/{advice}', 'AdviceController@show')->name('show');
    Route::post('/{advice}/comment', 'AdviceController@addComment')->name('comment');

});
