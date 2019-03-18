<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class State extends Model
{

    public function country(){

        return $this->belongsTo(Country::class,'country_id');
    }


    public function district(){
        return $this->hasMany(District::class);
    }
    use SoftDeletes;
    protected $dates=['deleted_at'];

    protected $fillable = [
        'name', 'description',
    ];
}
