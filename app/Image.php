<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Image extends Model
{
    protected $fillable = ['url', 'gallery_id'];

    public function images()
    {
        return $this->belongsTo(Gallery::class, 'gallery_id');
    }

    use SoftDeletes;

    protected $dates = ['deleted_at'];
}
