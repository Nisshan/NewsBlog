<?php

namespace App\Http\Controllers\API;

use App\Category;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        return CategoryResource::collection(Category::paginate(10));
    }
}
