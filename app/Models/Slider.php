<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    public $table = "banner";
    protected $primaryKey = 'id_banner';

    protected $fillable = [
        'gambar_banner',
        'judul',
        'deskripsi',
        'status',
    ];
}