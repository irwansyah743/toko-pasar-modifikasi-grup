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
            $table->string('user_id');
            $table->string('shipping_id')->nullable();
            $table->string('gross_amount');
            $table->string('transaction_id');
            $table->string('order_id');
            $table->string('payment_type');
            $table->string('order_date');
            $table->string('order_month');
            $table->string('order_year');
            $table->string('payment_code')->nullable();
            $table->string('pdf_url')->nullable();
            $table->string('status');
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