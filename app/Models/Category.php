<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public $table = "kategori";

    protected $fillable = [
        'category_name',
        'category_slug',
        'category_icon',
        'category_image',
    ];
}