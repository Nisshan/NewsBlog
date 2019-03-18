<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class District extends Model
{
    public function posts(){
       return $this->hasMany(Post::class);
    }
    public function states(){
       return $this->belongsTo(State::class,'state_id');
    }
    use SoftDeletes;

    protected $dates=['deleted_at'];

    protected $fillable = [
        'name', 'description',
    ];
}
