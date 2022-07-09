<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserBalance extends Migration
{

    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedDouble('balance', 9, 2);
        });
    }


    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('balance');
        });
    }
}
