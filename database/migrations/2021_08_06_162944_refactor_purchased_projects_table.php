<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RefactorPurchasedProjectsTable extends Migration
{

    public function up()
    {
        Schema::table('purchased_projects', function (Blueprint $table) {
            $table->json('data')->nullable()->change();
        });
    }


    public function down()
    {
        Schema::table('purchased_projects', function (Blueprint $table) {
            $table->longText('data')->change();
        });
    }
}
