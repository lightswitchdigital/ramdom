<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{

    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->string('type');
            $table->unsignedDouble('amount', 9, 2);
            $table->string('status');
            $table->jsonb('meta')->nullable();

            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
