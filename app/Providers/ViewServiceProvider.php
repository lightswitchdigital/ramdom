<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use \App\Models\Region;
use \Illuminate\Http\Request;
use View;

class ViewServiceProvider extends ServiceProvider
{
    private $dadata;

    public function register()
    {
    }
}
