<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    public $table = "kupon";

    protected $fillable = [
        'nama_kupon',
        'diskon_kupon',
        'validitas_kupon',
        'status',
    ];
}