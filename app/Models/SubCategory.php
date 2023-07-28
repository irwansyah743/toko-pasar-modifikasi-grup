<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    public $table = 'sub_kategori';

    protected $fillable = [
        'id_kategori',
        'nama_subkategori',
        'slug_subkategori',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'id_kategori', 'id');
    }
}