<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderProjectDataTable extends Migration
{

    public function up()
    {
        Schema::create('order_project_data', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('CASCADE');

            $table->unsignedBigInteger('project_id');
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('CASCADE');

            $table->longText('data');

            $table->double('total_price', 8, 2);

        });
    }


    public function down()
    {
        Schema::dropIfExists('order_project_data');
    }
}
