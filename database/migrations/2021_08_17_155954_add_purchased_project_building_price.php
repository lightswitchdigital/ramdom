<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPurchasedProjectBuildingPrice extends Migration
{

    public function up()
    {
        Schema::table('purchased_projects', function (Blueprint $table) {
            $table->double('building_price', 9, 2);
        });
    }


    public function down()
    {
        Schema::table('purchased_projects', function (Blueprint $table) {
            $table->dropColumn('building_price');
        });
    }
}
