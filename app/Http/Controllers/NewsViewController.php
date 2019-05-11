<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class NewsViewController extends Controller
{
    public function index(){
        $data['news'] = Post::paginate(10);
        return view('news.view')->with($data);
    }
    public function show($slug){

        $post = \App\Post::where('slug', '=' ,$slug)->firstOrFail();
        \App\PostView::createViewLog($post);
        $data['news'] =Post::where('slug', $slug)->first();
        return view('news.show')->with($data);


//        return $post;

    }

//    public function showpost($id){
//        $post = \App\PostView::where('id', '=' ,$id)->firstOrFail();
//        return $post;
//        \App\PostView::createViewLog($post);
//    }
}
