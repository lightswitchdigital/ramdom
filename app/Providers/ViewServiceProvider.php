<?php

namespace App\Providers;

use App\Services\DadataService;
use Illuminate\Support\ServiceProvider;
use \App\Models\Region;
use \Illuminate\Http\Request;
use View;

class ViewServiceProvider extends ServiceProvider
{
    private $dadata;

    public function register()
    {
        $this->dadata = $this->app->get(DadataService::class);
    }

    public function boot(Request $request)
    {
        $current_region_name = $this->getCurrentRegionName($request);
        $regions_list = $this->getRegionsList();

        View::share('regions_list', $regions_list);
        View::share('current_region_name', $current_region_name);
    }

    public function getRegionsList() {
        return Region::all();
    }

    public function getCurrentRegionName(Request $request) {
        if ($request->hasCookie('region')) {
            $region = Region::whereSlug($request->cookie('region'))->first()->name;
        }else {
            $ip = $request->ip();
            $kladr = $this->dadata->getCityKladr($ip);

            if ($kladr) {
                if($model = Region::whereKladr($kladr)->first()) {
                    $region = $model->name;
                }else {
                    $region = 'moscow';
                }
            }else {
                $region = 'moscow';
            }
        }

        return $region;
    }
}
