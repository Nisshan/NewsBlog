<?php

namespace App\Http\Controllers;

use App\Post;
use Carbon\Carbon;



class DashboardController extends Controller
{
    public function index()
    {

        $user= auth()->user() ->getAllPermissions()->count();

        if($user > 0){
            $data['posts'] = Post::all();
            $data['last'] =Post::orderBy('id', 'desc')->paginate(5);
            $data['tpost'] = Post::where('created_at', '>=', Carbon::today()->toDateString());
            $data['status'] =Post::where('created_at', '>=', Carbon::today()->toDateString())->where('status',1)->paginate(5);
            $data['todaypost'] = Post ::where('created_at', '>=', Carbon::today()->toDateString());
//        return $data['status'];
            return view('dashboard')->with($data);
        }
        else
        {
            return redirect()->route('home');
        }

    }

}
