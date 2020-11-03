<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserSavedProjectsTable extends Migration
{

    public function up()
    {
        Schema::create('user_saved_projects', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
            $table->unsignedBigInteger('project_id');
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('CASCADE');

            $table->longText('data');
            $table->json('values_data');

            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('user_saved_projects');
    }
}
