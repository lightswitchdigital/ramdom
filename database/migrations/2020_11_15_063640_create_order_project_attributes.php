<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderProjectAttributes extends Migration
{

    public function up()
    {
        Schema::create('order_project_attributes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type');
            $table->json('variants');
            $table->integer('sort');
            $table->double('price', 8, 2)->default(0);
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_project_attributes');
    }
}
