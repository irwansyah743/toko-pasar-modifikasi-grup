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
            $table->string('id_pengiriman')->nullable();
            $table->string('nominal_total');
            $table->string('id_transaksi');
            $table->string('id_pesanan');
            $table->string('tipe_pembayaran');
            $table->string('tanggal_pesanan');
            $table->string('bulan_pesanan');
            $table->string('tahun_pesanan');
            $table->string('kode_pembayaran')->nullable();
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