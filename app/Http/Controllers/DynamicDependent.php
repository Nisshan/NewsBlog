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
                <div class="btn-group btn-octonary">
                    <a type="button" href="' . route('districts.show', [$district->id]) . '" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                    <a class="btn btn-success" href="' . route('districts.edit', [$district->id]) . '"><i class="fa fa-edit"></i></a>
                    <a href="' . route('districts.destroy', [$district->id]) . '" class="delete btn btn-danger"><i class="fa fa-remove"></i></a>
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


