<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Country;
use App\State;
use App\District;
use Yajra\DataTables\Facades\DataTables;

class DynamicDependent extends Controller

{
    public function getDistrict()
    {
        return Datatables::of(District::query())->addColumn('action', function ($district) {
            return '
                <div class="btn-group">
                    <button type="button" data-toggle="dropdown" class="btn btn-default dropdown-toggle">Action <span class="caret"></span></button>
                <ul class="dropdown-menu">
                    <li><a type="button" href="'.route('districts.show',[$district->id]).'" >View</a></li>
                    <li><a href="'.route('districts.edit',[$district->id]).'">Edit</a></li>
                    <li class="divider"></li>
                    <li><a href="'.route('districts.destroy', [$district->id]).'">Delete</a></li>
                </ul>
             </div>
            ';
        })
            ->make(true);
    }

    public function index()
    {
        $data['districts'] = District::all();
        // $data['districts'] = District::with('State')->get();
        return view('admin.districts.index')->with($data);
    }

    public function getStateList(Request $request)
    {
        $states = DB::table("states")
            ->where("country_id", $request->country_id)
            ->pluck("name", "id");
        return response()->json($states);
    }
}


