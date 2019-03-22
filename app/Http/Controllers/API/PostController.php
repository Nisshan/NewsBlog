<?php

namespace App\Http\Controllers\API;

use App\Post;
use App\Http\Resources\PostResource;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function index()
    {
        return PostResource::collection(Post::paginate(10));
    }
}
