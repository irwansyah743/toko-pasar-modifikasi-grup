<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    public $table = 'sub_kategori';

    protected $primaryKey = 'id_subkategori';

    protected $fillable = [
        'id_subkategori',
        'id_kategori',
        'nama_subkategori',
        'slug_subkategori',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'id_kategori', 'id_kategori');
    }




    // Accessor for the old 'id' attribute
    public function getIdAttribute()
    {
        return $this->attributes['id_subkategori'];
    }

    // Mutator for the old 'id' attribute
    public function setIdAttribute($value)
    {
        $this->attributes['id_subkategori'] = $value;
    }

    public function getKeyName()
    {
        return 'id_subkategori';
    }
}