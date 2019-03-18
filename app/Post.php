<?php

namespace App;

use         Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Post extends Model
{


    public function category(){
        return $this->belongsToMany(Category::class,'category_post');
    }
    public function districts(){
        return $this->belongsToMany(Post::class);
    }
    public function images(){
        return $this->hasMany(PostImage::class);
    }

    use SoftDeletes;
    protected $dates=['deleted_at'];
}
