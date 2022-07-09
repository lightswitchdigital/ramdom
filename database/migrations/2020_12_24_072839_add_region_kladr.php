<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRegionKladr extends Migration
{

    public function up()
    {
        Schema::table('regions', function (Blueprint $table) {
            $table->string('kladr');
        });
    }


    public function down()
    {
        Schema::table('regions', function (Blueprint $table) {
            $table->dropColumn('kladr');
        });
    }
}
