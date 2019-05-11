<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hashview extends Model
{
protected $fillable = ['hash_id','views'];

        public static function createHashView($hash){
            $hashview = new Hashview();
            $hashview->hash_id = $hash->id;
            $hashview->agent = Request::header('User-Agent');
            $hashview->save();
        }
}
