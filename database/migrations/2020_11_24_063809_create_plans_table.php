<?php

use App\Models\Plans\Plan;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration
{

    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();

            $table->string('slug');
            $table->string('name');
            $table->double('price', 8, 2);
            $table->string('interval')->default(Plan::INTERVAL_MONTH);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('plans');
    }
}
