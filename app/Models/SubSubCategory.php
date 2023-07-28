<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubSubCategory extends Model
{
    use HasFactory;

    public $table = 'sub_sub_kategori';

    protected $primaryKey = 'id_subsubkategori';

    protected $fillable = [
        'id_kategori',
        'id_subkategori',
        'nama_subsubkategori',
        'slug_subsubkategori',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'id_kategori', 'id_kategori');
    }

    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class, 'id_subkategori', 'id_subkategori');
    }

    

    // Accessor for the old 'id' attribute
    public function getIdAttribute()
    {
        return $this->attributes['id_subsubkategori'];
    }

    // Mutator for the old 'id' attribute
    public function setIdAttribute($value)
    {
        $this->attributes['id_subsubkategori'] = $value;
    }

    public function getKeyName()
    {
        return 'id_subsubkategori';
    }
}