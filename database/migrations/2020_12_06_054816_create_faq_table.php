<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaqTable extends Migration
{

    public function up()
    {
        Schema::create('faq', function (Blueprint $table) {
            $table->id();

            $table->string('question');
            $table->text('answer');
        });
    }


    public function down()
    {
        Schema::dropIfExists('faq');
    }
}
