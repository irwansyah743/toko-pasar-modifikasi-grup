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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('id_merek');
            $table->integer('id_kategori');
            $table->integer('id_subkategori');
            $table->integer('id_subsubkategori');
            $table->string('nama_produk');

            $table->string('slug_produk');

            $table->string('kode_produk');
            $table->string('kuantitas_produk');
            $table->string('tag_produk');

            $table->string('ukuran_produk');

            $table->string('warna_produk');

            $table->string('harga_jual');
            $table->string('harga_diskon')->nullable();
            $table->string('deskripsi_singkat');
            $table->string('deskripsi_panjang');
            $table->string('thumbnail_produk');
            $table->integer('diskon_besar')->nullable();
            $table->integer('unggulan')->nullable();
            $table->integer('penawaran_spesial')->nullable();
            $table->integer('penawaran_khusus')->nullable();
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('products');
    }
};