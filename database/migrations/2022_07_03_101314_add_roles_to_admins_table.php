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
        Schema::table('admins', function (Blueprint $table) {
            $table->string('brand')->nullable();
            $table->string('phone')->nullable();
            $table->string('category')->nullable();
            $table->string('product')->nullable();
            $table->string('slider')->nullable();
            $table->string('coupon')->nullable();
            $table->string('orders')->nullable();
            $table->string('report')->nullable();
            $table->string('alluser')->nullable();
            $table->string('alladmin')->nullable();
            $table->string('review')->nullable();
            $table->string('type')->nullable();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->dropColumn('brand');
            $table->dropColumn('phone');
            $table->dropColumn('category');
            $table->dropColumn('product');
            $table->dropColumn('slider');
            $table->dropColumn('coupon');
            $table->dropColumn('orders');
            $table->dropColumn('report');
            $table->dropColumn('alluser');
            $table->dropColumn('alladmin');
            $table->dropColumn('review');
            $table->dropColumn('type');
        });
    }
};