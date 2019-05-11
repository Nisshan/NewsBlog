<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Request;

class PostView extends Model
{
     use SoftDeletes;
    protected $dates=['deleted_at'];
    protected $fillable=['listing_id','titleslug','url','session_id','user_id','ip','agent'];

    public function getRouteKeyName()
    {
        return 'slug';
    }
    public static function createViewLog($post)
    {
        $postViews = new PostView();
        $postViews->post_id = $post->id;
        $postViews->slug = $post->slug;
        $postViews->url = Request::url();
        $postViews->session_id = Request::getSession()->getId();
        $postViews->user_id = (Auth::check()) ? Auth::id() : null; //this check will either put the user id or null, no need to use \Auth()->user()->id as we have an inbuild function to get auth id
        $postViews->ip = Request::getClientIp();
        $postViews->agent = Request::header('User-Agent');
        $postViews->save();
    }


}
