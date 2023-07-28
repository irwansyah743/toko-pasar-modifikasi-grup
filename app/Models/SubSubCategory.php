<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubSubCategory extends Model
{
    use HasFactory;

    public $table = 'sub_sub_kategori';

    protected $fillable = [
        'id_kategori',
        'id_subkategori',
        'nama_subsubkategori',
        'slug_subsubkategori',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'id_kategori', 'id');
    }

    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class, 'id_subkategori', 'id');
    }
}