<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('tracking_number');
            $table->json('address');
            $table->tinyInteger('payment_mode');
            $table->string('payment_id')->nullable();
            $table->integer('total');
            $table->integer('discount_amount')->nullable();
            $table->integer('amount');
            $table->tinyInteger('status');
            $table->dateTime('shipped_at')->nullable();
            $table->dateTime('dispatched_at')->nullable();
            $table->dateTime('approved_at')->nullable();
            $table->dateTime('canceled_at')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
