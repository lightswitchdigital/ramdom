<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegionsTable extends Migration
{

    public function up()
    {
        Schema::create('regions', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index();
            $table->string('slug');
            $table->unique(['name', 'slug']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('regions');
    }
}
