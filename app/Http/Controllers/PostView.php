<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostView extends Controller
{
//    public static function createViewLog(Request $post){
//        $postview = new PostView;
//        $postview->post_id = $post->post_id;
//        $postview->slug = $post->slug;
//        $postview->url = $post->getUri();
//        $postview->session_id = $post->getSession();
//        $postview -> ip = $post->getClientIp();
//        $postview -> user_id = (Auth::check())?Auth::id():null;
//        $postview ->agent = $post->header('User-Agent');
//        $postview ->save();
//
//    }

//    public function showpost($id){
//        $post = \App\PostView::where('id', '=' ,$id)->firstOrFail();
//        return $post;
//
//        \App\PostView::createViewLog($post);
//    }

}
