<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectAttributesTable extends Migration
{

    public function up()
    {
        Schema::create('project_attributes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type');
            $table->json('variants');
            $table->integer('sort');
        });
    }

    public function down()
    {
        Schema::dropIfExists('project_attributes');
    }
}
