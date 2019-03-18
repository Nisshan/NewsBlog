<?php

namespace App\Http\Controllers;

use App\Category;
use App\Gallery;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $gallery = Gallery::all();
        $countries = DB::table("countries")->pluck("name","id");
        $Categories = Category::where('status', 1)->get();
        $posts = Post::all();
        $publishedNews = Post::where('status',1)->orderBy('id', 'desc')->take(1)->get();
        // dd($publishedNews);
        //$news = Post::where('id',)->orderBy('id', 'desc')->take(8)->get();
        return view('front.home.home',[
            'Categories' => $Categories,
            'countries' => $countries,
            'posts' => $posts,
            'gallery' => $gallery,
            'publishedNews' => $publishedNews
        ]);
    }

    public function getStateList(Request $request)
    {
        $states = DB::table("states")
            ->where("country_id",$request->country_id)
            ->pluck("name","id");
        return response()->json($states);
    }

    public function getDistrictList(Request $request)
    {
        $districts = DB::table("districts")
            ->where("state_id",$request->state)
            ->pluck("name","id");
        return response()->json($districts);
    }

}
