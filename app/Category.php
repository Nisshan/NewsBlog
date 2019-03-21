<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Category extends Model
{
//    protected $table = 'category';

    public function district(){
       return $this->belongsToMany(District::class);
    }
    public function posts(){
        return $this->belongsToMany(Post::class,'category_post');
    }
    protected $fillable = [
        'title', 'description',
    ];
    public  function children(){
        return $this->hasMany(Category::class,'parent_id');
    }
    public function parent(){
        return $this->hasOne(Category::class,'parent_id');
    }

    use SoftDeletes;

    protected $dates=['deleted_at'];
}
