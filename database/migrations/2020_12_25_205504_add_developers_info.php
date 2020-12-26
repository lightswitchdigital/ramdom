<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDevelopersInfo extends Migration
{

    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->mediumText('developer_desc')->nullable();
            $table->string('developer_avatar')->nullable();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('developer_desc');
            $table->dropColumn('developer_avatar');
        });
    }
}
