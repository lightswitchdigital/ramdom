<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanSubscriptionsTable extends Migration
{

    public function up()
    {
        Schema::create('plan_subscriptions', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('plan_id');
            $table->foreign('plan_id')->references('id')->on('plans')->onDelete('CASCADE');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');

            $table->boolean('active')->default(false);
            $table->dateTime('starts_at')->nullable();
            $table->dateTime('ends_at')->nullable();
            $table->dateTime('canceled_at')->nullable();

            $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('plan_subscriptions');
    }
}
