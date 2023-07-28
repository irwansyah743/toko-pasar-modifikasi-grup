<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;

    public $table = 'pengiriman';

    protected $fillable = [
        'provinsi',
        'kabupaten',
        'kecamatan',
        'alamat',
        'nama_pengiriman',
        'email_pengiriman',
        'no_telepon_pengiriman',
        'status_pengiriman',
        'kode_pos',
        'resi',
        'catatan'
    ];
}