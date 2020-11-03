<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderProjectValuesTable extends Migration
{

    public function up()
    {
        Schema::create('order_project_values', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders');

            $table->unsignedBigInteger('project_id');
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('CASCADE');
            $table->unsignedBigInteger('attribute_id');
            $table->foreign('attribute_id')->references('id')->on('project_attributes')->onDelete('CASCADE');
            $table->string('value');

        });
    }

    public function down()
    {
        Schema::dropIfExists('order_project_values');
    }
}
