<?php

namespace App\Http\Controllers;

use App\Category;
use App\Country;
use App\District;
use App\Gallery;
use App\Post;
use App\State;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{
    public function getStateID(Request $request){   //For State news
        $posts = Post::all();
        $gallery = Gallery::all();
        $district = District::find($request->district);
        $countries = DB::table("countries")->pluck("name","id");
        $publishedCategories = Category::where('status', 1)->get();
        $districtID = $request->district;
        //dd($district);
        return view('front.home.home',[

            'publishedCategories' => $publishedCategories,
            'countries' => $countries,
            'posts' => $posts,
            'gallery' => $gallery,
            'districtID' => $districtID,
            'district' => $district
        ]);
    }

    public function categoryNewsInfo($id) {
        //dd($id);
        //$stores = $newsById->category();
        //dd($stores);
        //$categoryNews = Post::where('id', $newsById->id)->orderBy('id', 'desc')->take(8)->get();
        //dd($categoryByNewsId);
        //$newsById = Post::with('category')->get();
        $categoryByNewsId = DB::table ('posts')
            //->join('category_post', 'post_id', '=', 'category_id')
            ->select('posts.*', 'posts.title')
            ->where('posts.id',$id)
            ->first();

        $categoryID = $id;
        $newsById = Post::find($id);
        $newDateFormat = Carbon::parse( $newsById->created_at)->format('F j');
        //dd($newDateFormat);
        $posts = Post::all();
        $countries = DB::table("countries")->pluck("name","id");
        $Categories = Category::where('status', 1)->get();
        $categories = Category::find($id);
        return view('front.category.category', [
            'newsById'=>$newsById,
            'posts' => $posts,
            'categoryByNewsId'=>$categoryByNewsId,
            'countries' => $countries,
            'Categories' => $Categories,
            'categories' => $categories,
            'newDateFormat' => $newDateFormat,
            'categoryID' => $categoryID
        ]);
    }

    public function index() {

        $publishedCategories = Category::where('publication_status', 1)->get();
        return view('front.home.home', [
            //'publishedNews' => $publishedNews,
            'publishedCategories' => $publishedCategories
        ]);
    }

    public function singleNewsInfo($id) {// $id is post id

        $countries = DB::table("countries")->pluck("name","id");
        //$Categories = Category::all();
        $Categories = Category::where('status', 1)->get();
        $posts = Post::find($id);

        return view('front.news.single-news',[
            'Categories' => $Categories,
            'countries' => $countries,
            'posts' => $posts,

        ]);
    }
    public function StateNews($id) { //$id is state id

        $countries = DB::table("countries")->pluck("name","id");
        $state = State::where('id', $id)->pluck("name","id");
        $district = District::where('state_id',$id)->get();
        //dd($district);
        $Categories = Category::where('status', 1)->get();
        $posts = Post::all();

        return view('front.state.single-news',[
            'Categories' => $Categories,
            'countries' => $countries,
            'district' => $district,
            'posts' => $posts,
            'state' => $state
        ]);
    }

    public function DistrictNews($id) {

        $countries = DB::table("countries")->pluck("name","id");
        //$Categories = Category::all();
        $Categories = Category::where('status', 1)->get();
        $district = District::where('id',$id)->first();
        $posts = Post::where('district_id',$id)->get();
        return view('front.district.singleDistrict',[
            'countries'  => $countries,
            'Categories' => $Categories,
            'district' => $district,
            'posts' => $posts,
        ]);
    }
}
