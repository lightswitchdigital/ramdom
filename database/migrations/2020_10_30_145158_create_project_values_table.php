<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectValuesTable extends Migration
{

    public function up()
    {
        Schema::create('project_values', function (Blueprint $table) {
            $table->unsignedBigInteger('project_id');
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('CASCADE');
            $table->unsignedBigInteger('attribute_id');
            $table->foreign('attribute_id')->references('id')->on('project_attributes')->onDelete('CASCADE');
            $table->string('value');
            $table->primary(['project_id', 'attribute_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('project_values');
    }
}
