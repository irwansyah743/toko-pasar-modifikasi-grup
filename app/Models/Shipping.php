<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;

    protected $fillable = [
        'provinsi',
        'kabupaten',
        'kecamatan',
        'address',
        'shipping_name',
        'shipping_email',
        'shipping_phone',
        'post_code',
        'notes'
    ];
}
