<?php

namespace App\Http\Controllers\API;

use App\District;
use App\Http\Resources\DistrictResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DistrictController extends Controller
{
    public function index()
    {
        return DistrictResource::collection(District::paginate(10));
    }
}
