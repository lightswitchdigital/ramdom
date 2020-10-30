<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserCredentials extends Migration
{

    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('last_name')->after('name');
            $table->string('middle_name')->after('last_name')->nullable();
            $table->string('phone')->after('email');
            $table->text('address')->nullable();

            $table->string('type');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('last_name');
            $table->dropColumn('middle_name');
            $table->dropColumn('phone');
            $table->dropColumn('address');

            $table->dropColumn('type');
        });
    }
}
