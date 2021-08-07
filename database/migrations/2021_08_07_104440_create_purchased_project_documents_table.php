<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasedProjectDocumentsTable extends Migration
{

    public function up()
    {
        Schema::create('purchased_project_documents', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('purchased_project_id');
            $table->string('file');

            $table->timestamps();
        });

        Schema::dropIfExists('project_documents');
    }


    public function down()
    {
        Schema::dropIfExists('purchased_project_documents');
    }
}
