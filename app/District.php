<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class District extends Model
{
    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function posts(){
       return $this->belongsToMany(Post::class,'district_post');
    }
    public function states(){
       return $this->belongsTo(State::class,'state_id');
    }
    use SoftDeletes;

    protected $dates=['deleted_at'];

    protected $fillable = [
        'name', 'description'
    ];
}
