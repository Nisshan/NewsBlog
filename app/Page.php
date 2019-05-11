<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use SoftDeletes;

    protected $dates=['deleted_at'];

    public $fillable =['title','description'];

    public function category(){
        return $this->belongsToMany(Category::class,'category_page');
    }
    public function photo(){
        return $this->hasMany(PageImage::class,'page_id');
    }
}
