<?php

use App\Models\Region;
use App\Services\DadataService;
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


Route::get('/get-predicted-location', function(DadataService $service, Request $request) {

    $kladr = $service->getCityKladr($request->ip());
    if ($kladr) {
        return Region::findKladr($kladr)->first();
    }

    return response('', 404);
});
