<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{

    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->text('text');
            $table->boolean('anonymous')->default(false);
            $table->boolean('active')->default(false);

            $table->unsignedBigInteger('commentable_id');
            $table->string('commentable_type');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
