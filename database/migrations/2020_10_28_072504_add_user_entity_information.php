<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserEntityInformation extends Migration
{

    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('company_name')->nullable();
            $table->text('company_address')->nullable();
            $table->string('company_inn')->nullable();
            $table->string('company_account')->nullable();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('company_name');
            $table->dropColumn('company_address');
            $table->dropColumn('company_inn');
            $table->dropColumn('company_account');
        });
    }
}
