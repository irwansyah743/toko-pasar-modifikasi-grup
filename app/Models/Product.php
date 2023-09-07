<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public $table = 'produk';

    protected $primaryKey = 'id_produk';

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class, 'id_kategori', 'id_kategori');
    }


    public function brand()
    {
        return $this->belongsTo(Brand::class, 'id_merek', 'id_merek');
    }



    // Accessor for the old 'id' attribute
    public function getIdAttribute()
    {
        return $this->attributes['id_produk'];
    }

    // Mutator for the old 'id' attribute
    public function setIdAttribute($value)
    {
        $this->attributes['id_produk'] = $value;
    }

    public function getKeyName()
    {
        return 'id_produk';
    }
}
