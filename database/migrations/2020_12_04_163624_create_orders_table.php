<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{

    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
            $table->unsignedBigInteger('purchased_project_id');
            $table->foreign('purchased_project_id')->references('id')->on('purchased_projects')->onDelete('CASCADE');
            $table->unsignedBigInteger('developer_id');
            $table->foreign('developer_id')->references('id')->on('users');

            $table->string('order_name');
            $table->string('order_email');
            $table->string('order_phone');
            $table->string('order_city');
            $table->string('order_address');
            $table->string('order_postal_code');

            $table->string('order_passport_serial')->nullable();
            $table->string('order_passport_number')->nullable();
            $table->string('order_passport_issue')->nullable();
            $table->string('order_passport_issue_date')->nullable();

            $table->string('order_company_name')->nullable();
            $table->string('order_company_address')->nullable();
            $table->string('order_company_inn')->nullable();
            $table->string('order_company_kpp')->nullable();
            $table->string('order_company_payment_account')->nullable();
            $table->string('order_company_correspondent_account')->nullable();

            $table->double('price', 14, 2);
            $table->string('status');

            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
