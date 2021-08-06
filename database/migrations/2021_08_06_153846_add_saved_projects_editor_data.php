<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSavedProjectsEditorData extends Migration
{

    public function up()
    {
        Schema::table('user_saved_projects', function (Blueprint $table) {
            $table->dropColumn('data');
            $table->json('editor_data')->nullable();

            $table->json('values_data')->nullable()->change();
        });
    }


    public function down()
    {
        Schema::table('user_saved_projects', function (Blueprint $table) {
            $table->dropColumn('editor_data');
            $table->longText('data');
        });
    }
}
