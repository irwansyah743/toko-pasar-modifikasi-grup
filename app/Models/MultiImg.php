<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MultiImg extends Model
{
    use HasFactory;

    public $table = "gambar_produk";

    protected $fillable = [
        'id_produk',
        'nama_gambar_produk',
    ];
}