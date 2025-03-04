<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostImage extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected function images(){
        return $this->belongsTo(Post::class,'post_id');
    }
}
