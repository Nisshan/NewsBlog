<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PageImage extends Model
{
    public $fillable = ['url'];

    public function page(){
         return $this->belongsTo(Page::class,'page_id');
    }
}
