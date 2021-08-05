<?php

namespace App\Providers;

use App\Services\DadataService;
use App\Services\Projects\SmetaGateway;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind(DadataService::class, function (Application $app) {
            return new DadataService(env('DADATA_TOKEN'));
        });
    }
}
