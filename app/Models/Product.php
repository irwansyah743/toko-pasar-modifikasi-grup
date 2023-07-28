<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public $table = 'produk';

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class, 'id_kategori', 'id');
    }


    public function brand()
    {
        return $this->belongsTo(Brand::class, 'id_merek', 'id');
    }
}