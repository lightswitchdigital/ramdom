<?php

namespace Database\Seeders;

use App\Models\Plans\Plan;
use App\Models\User;
use Carbon\Carbon;
use DB;
use Illuminate\Database\Seeder;

class PlansSeeder extends Seeder
{

    public function run()
    {

        Plan::create([
            'name' => 'Профессионал',
            'slug' => User::ROLE_PRO,
            'price' => 1500,
            'interval' => Plan::INTERVAL_MONTH,
        ]);
        Plan::create([
            'name' => 'Застройщик',
            'slug' => User::ROLE_DEVELOPER,
            'price' => 10000,
            'interval' => Plan::INTERVAL_MONTH,
        ]);

    }
}
