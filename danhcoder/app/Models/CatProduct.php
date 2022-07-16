<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatProduct extends Model
{
    use HasFactory;
    protected $table = 'cat_products';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'title',
        'slug',
        'status',
        'description',
        'content',
        'avatar',
        'parent_id',
    ];

    public function products()
    {
        return $this->belongsToMany('App\Models\Product', 'products_and_cats', 'id_cat', 'id_product');
    }
}
