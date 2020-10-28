<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIndividualInformation extends Migration
{

    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('passport_serial')->nullable();
            $table->string('passport_code')->nullable();
            $table->string('passport_issue')->nullable();
            $table->date('passport_issue_date')->nullable();
        });
    }


    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('passport_serial');
            $table->dropColumn('passport_code');
            $table->dropColumn('passport_issue');
            $table->dropColumn('passport_issue_date');
        });
    }
}
