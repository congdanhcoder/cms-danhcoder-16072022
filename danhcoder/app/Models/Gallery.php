<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;
    protected $table = 'gallerys';
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

    public function posts()
    {
        return $this->belongsToMany('App\Models\Post', 'posts_and_cats', 'id_cat', 'id_post');
    }
}
