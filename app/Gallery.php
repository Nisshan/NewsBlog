<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gallery extends Model
{
    public function images()
    {
        return $this->hasMany(Image::class, 'gallery_id');
    }

    use SoftDeletes;
    protected $dates = ['deleted_at'];
}
