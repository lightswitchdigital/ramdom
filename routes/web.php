<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('test', function () {
    Mail::to('sireax@yandex.ru')->send(new \App\Mail\Auth\TestMail());

    return 'ok';
});

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();
Route::post('/login/verify', 'Auth\LoginController@verify')->name('login.verify');


Route::get('/profile/smeta/constructor', 'Profile\\SmetaController@constructorGetPrice')->name('profile.constructor.get-price');

/*
|--------------------------------------------------------------------------
| Root routes
|--------------------------------------------------------------------------
|
*/

Route::get('/about', 'HomeController@about')->name('about');
Route::get('/faq', 'HomeController@faq')->name('faq');
Route::get('/discounts', 'HomeController@discounts')->name('discounts');

Route::get('api/editor/v1/calculate', 'Projects\\EditorController@index')->name('api.editor.calculate');

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
            Route::post('/save-editor-data', 'ModifyController@saveEditorData')->name('save-editor-data');

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

    Route::get('/developer', 'HomeController@developer')->name('developer');
    Route::post('/developer/status', 'HomeController@changeStatus')->name('developer.changeStatus');

    Route::post('/feedback', 'HomeController@feedback')->name('feedback');

    Route::group([
        'prefix' => 'projects',
        'as' => 'projects.'
    ], function () {

        Route::get('/get-projects', 'ProjectsController@getProjects')->name('get-projects');

        Route::get('/', 'ProjectsController@index')->name('index');
        Route::get('/{project}/order', 'ProjectsController@order')->name('order');
        Route::post('/{project}/order/{developer}/submit', 'ProjectsController@orderSubmit')->name('order.submit');

        Route::post('/{project}/remove-from-saved', 'ProjectsController@removedFromSaved')->name('order.submit');
    });

    Route::group([
        'prefix' => 'balance',
        'as' => 'balance.'
    ], function () {

        Route::get('/', 'BalanceController@index')->name('index');
        Route::post('/replenish', 'BalanceController@replenish')->name('replenish');

    });

    Route::group([
        'prefix' => 'plans',
        'as' => 'plans.'
    ], function () {

        Route::get('/', 'PlansController@index')->name('index');
        Route::post('/{plan}/subscribe', 'PlansController@subscribe')->name('subscribe');

    });

    Route::group([
        'prefix' => 'smeta',
        'as' => 'smeta.'
    ], function () {

        Route::get('/', 'SmetaController@index')->name('index');
        Route::post('/', 'SmetaController@saveInputData')->name('index.save');
        Route::get('/pricelist', 'SmetaController@pricelist')->name('pricelist');
        Route::post('/pricelist', 'SmetaController@savePricelistData')->name('pricelist.save');
        Route::get('/developers', 'SmetaController@developers')->name('developers');
        Route::post('/developers', 'SmetaController@developersSave')->name('developers.save');

        Route::get('/download-docs', 'SmetaController@downloadDocs')->name('download-docs');
        Route::post('/download-docs/{buildReq}', 'SmetaController@downloadClientsDocs')->name('download-docs.client');

        Route::get('/loan', 'SmetaController@loan')->name('loan');
        Route::post('/request-loan', 'SmetaController@requestLoan')->name('request-loan');

    });

    Route::group([
        'prefix' => 'favorites',
        'as' => 'favorites.'
    ], function () {

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
        Route::put('/update-password', 'SettingsController@updateIndividualInformation')->name('update-password');

    });

    Route::get('/', 'HomeController@index')->name('index');


    Route::group([
        'prefix' => 'documents',
        'as' => 'documents.'
    ], function () {

        Route::get('/', 'DocumentsController@index')->name('index');
        Route::post('/upload', 'DocumentsController@uploadDocs')->name('upload-docs');

    });

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
    Route::post('/settings', 'HomeController@saveSettings')->name('save-settings');

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
    ], function () {


    });
    Route::resource('advice', 'AdviceController');


    Route::group([
        'prefix' => 'pricelist',
        'as' => 'pricelist.'
    ], function () {

        Route::get("/", "PricelistController@index")->name('index');
        Route::post("/save", "PricelistController@save")->name('save');

    });


    Route::group([
        'prefix' => 'calculator',
        'as' => 'calculator.',
    ], function () {

        Route::get('/', 'CalculatorController@index')->name('index');
        Route::post('/', 'CalculatorController@update')->name('update');

    });


    Route::resource('loans', 'LoansController')->except('create', 'update', 'store', 'edit');
    Route::group([], function () {

    });


    Route::group([
        'prefix' => 'faq',
        'as' => 'faq'
    ], function () {


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

        Route::post('/{user}/verify-docs', 'UsersController@verifyDocs')->name('verify-docs');

        Route::get('/export', 'UsersController@export')->name('export');

    });
    Route::resource('users', 'UsersController');

    Route::group([
        'prefix' => 'payments',
        'as' => 'payments.'
    ], function() {

        Route::post('/{payment}/accept', 'PaymentsController@accept')->name('accept');

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
