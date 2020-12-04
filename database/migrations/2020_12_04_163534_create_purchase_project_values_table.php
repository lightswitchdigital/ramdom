<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseProjectValuesTable extends Migration
{

    public function up()
    {
        Schema::create('purchase_project_values', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('purchased_project_id');
            $table->foreign('purchased_project_id')->references('id')->on('purchased_projects');

            $table->unsignedBigInteger('project_id');
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('CASCADE');
            $table->unsignedBigInteger('attribute_id');
            $table->foreign('attribute_id')->references('id')->on('purchase_project_attributes')->onDelete('CASCADE');
            $table->string('value');
        });
    }

    public function down()
    {
        Schema::dropIfExists('purchase_project_values');
    }
}
