<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';
    public $timestamps = true;
    protected $fillable = [
        'id',
        'title',
        'slug',
        'status',
        'description',
        'content',
        'avatar',
        'status',
        'index',
        'user_id',
        'created_at',
        'updated_at',
    ];
    public function cats()
    {
        return $this->belongsToMany('App\Models\CatPost', 'posts_and_cats', 'id_post', 'id_cat');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
