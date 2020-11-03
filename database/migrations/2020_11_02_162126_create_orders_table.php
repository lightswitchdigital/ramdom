<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{

    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
            $table->unsignedBigInteger('project_id');
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('CASCADE');

            $table->string('order_name');
            $table->string('order_email');
            $table->string('order_phone');

            $table->double('amount', 8, 2);
            $table->string('status');

            $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
