<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Category extends Model
{
//    protected $table = 'category';

//    public function district(){
//       return $this->belongsToMany(District::class);
//    }

    public function getRouteKeyName()
    {
        return 'slug';
    }


    public function posts(){
        return $this->belongsToMany(Post::class,'category_post');
    }
    protected $fillable = [
        'title', 'description','position'
    ];
    public  function children(){
        return $this->hasMany(Category::class,'parent_id');
    }
    public function parent(){
        return $this->hasOne(Category::class,'parent_id');
    }
    public function page(){
        return $this->belongsToMany(Page::class,'category_page');
    }

    use SoftDeletes;

    protected $dates=['deleted_at'];
    public function getSortedCategory() {
        $query = $this->orderBy("position", "ASC")->get();
        return $query;
    }
}
