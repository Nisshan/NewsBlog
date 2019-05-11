<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Country extends Model
{
    public function getRouteKeyName()
    {
        return 'slug';
    }


    public function states(){
       return $this->hasmany(State::class);

   }

    use SoftDeletes;

    protected $dates=['deleted_at'];

    protected $fillable = [
        'title', 'description',
    ];
}
