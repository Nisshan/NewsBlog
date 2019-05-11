<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    protected $fillable = ['eventdate','location','name','post_id'];



    public function post(){
        return $this->belongsToMany(Post::class,'event_post');
    }
}
