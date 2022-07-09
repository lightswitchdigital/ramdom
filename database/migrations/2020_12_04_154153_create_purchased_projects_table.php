<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasedProjectsTable extends Migration
{

    public function up()
    {
        Schema::create('purchased_projects', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('project_id');
            $table->foreign('project_id')->references('id')->on('projects');

            $table->longText('data');
            $table->double('price', 14, 2);

            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('purchased_projects');
    }
}
