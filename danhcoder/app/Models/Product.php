<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    public $timestamps = true;
    protected $fillable = [
        'id',
        'title',
        'slug',
        'status',
        'description',
        'content',
        'avatar',
        'price',
        'price_sale',
        'amount',
        'star_rating',
        'status',
        'index',
        'user_id',
        'created_at',
        'updated_at',
    ];
    public function cats()
    {
        return $this->belongsToMany('App\Models\CatProduct', 'products_and_cats', 'id_product', 'id_cat');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function imgProducts()
    {
        return $this->hasMany('App\Models\ImageProduct');
    }
}
