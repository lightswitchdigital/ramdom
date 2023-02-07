<?php

namespace App\Providers;

use App\Services\DadataService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use \App\Models\Region;
use \Illuminate\Http\Request;
use View;

class ViewServiceProvider extends ServiceProvider
{

    public function boot(Request $request)
    {
        try {
            DB::connection()->getPdo();
        } catch (\Exception $e) {
            return;
        }


//        $current_region_name = $this->getCurrentRegionName($request);
//        $regions_list = $this->getRegionsList();
//
//        View::share('regions_list', $regions_list);
//        View::share('current_region_name', $current_region_name);

        $settings = json_decode(file_get_contents(public_path('internal/main.json')), true);
        View::share('settings', $settings);
    }

    public function getRegionsList() {
        return Region::all();
    }

    public function getCurrentRegionName(Request $request) {
        if ($request->hasCookie('region')) {
            $region = Region::whereSlug($request->cookie('region'))->first()->name;
        }else {
            $ip = $request->ip();
//            $kladr = $this->dadata->getCityKladr($ip);
            $kladr = null;

            if ($kladr) {
                if ($model = Region::whereKladr($kladr)->first()) {
                    $region = $model->name;
                } else {
                    $region = 'moscow';
                }
            } else {
                $region = 'moscow';
            }
        }

        return $region;
    }
}
