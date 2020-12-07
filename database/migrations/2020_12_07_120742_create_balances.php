<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBalances extends Migration
{

    public function up()
    {

        Schema::table('users', function(Blueprint $table) {
            $table->double('balance', 14, 2)->default(0);
        });

        Schema::create('balance_operations', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('type');
            $table->double('amount', 8, 2);
            $table->string('status');

            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('balance');
        });
        Schema::dropIfExists('balance_operations');
    }
}
