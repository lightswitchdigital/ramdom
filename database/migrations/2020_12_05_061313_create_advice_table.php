<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdviceTable extends Migration
{

    public function up()
    {
        Schema::create('advice', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->text('content');

            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('advice');
    }
}
