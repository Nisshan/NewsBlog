<?php

namespace App\Http\Controllers;

use App\Country;
use App\District;
use App\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->hasPermissionTo('create district')) {
            $data['countries'] = Country::all();
            $data['states'] = State::all();
            $data['districts'] = District::all();
            $countries = DB::table("countries")->pluck("name", "id");
            return view('admin.districts.create', compact('countries'));
        } else {
            flash(__('You are not authorized to create District'))->error();
            return view('admin.districts.index');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function extractKeyWords($string)
    {
        mb_internal_encoding('UTF-8');
        $stopwords = array();
        $string = preg_replace('/[\pP]/u', '', trim(preg_replace('/\s\s+/iu', '', mb_strtolower($string))));
        $matchWords = array_filter(explode(' ', $string), function ($item) use ($stopwords) {
            return !($item == '' || in_array($item, $stopwords) || mb_strlen($item) <= 2 || is_numeric($item));
        });
        $wordCountArr = array_count_values($matchWords);
        arsort($wordCountArr);
        return array_keys(array_slice($wordCountArr, 0, 10));
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|min:100'
        ]);
        $district = new District;
        $district->name = trim($request->name);
        $district->description = trim($request->description);
        $district->slug = str_slug($district['name'], '-');
        do {
            $validatedSlug = District::where('slug', $district->slug)->first();
            if ($validatedSlug) {
                $district->slug = str_slug($district->slug . ' ' . rand());
            }
        } while ($validatedSlug);
        $district->keywords = implode(',', $this->extractKeyWords($district['description']));
        $district->state_id = $request->state;
        $district->meta_description = str_limit(trim($district['description']), 200);
        $district->user_id = auth()->id();
        $district->save();
        flash('District Name Created Successfully')->success();
        return redirect()->action('DistrictController@create');

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (auth()->user()->hasPermissionTo('create district')) {
            $data['district'] = District::find($id);
            return view('admin.districts.view')->with($data);
        } else {
            flash(__('You are not authorized to view District Data'))->error();
            return view('admin.districts.index');
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['country'] = Country::find($id);
        $data['state'] = State::find($id);
        $data['district'] = District::find($id);
        return view('admin.districts.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $district = District::find($id);
        $district->name = trim($request->name);
        $district->description = trim($request->description);
        $district->slug = $request->slug;
        $district->keywords = trim($request->keywords);
        $district->meta_description = str_limit($request->meta_description, 200);
        $district->save();
        flash('District Name Updated Successfully')->success();
        return redirect()->action('DistrictController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (auth()->user()->haspermissionTo('delete district')) {
            $district = District::find($id);
            $post = $district->posts->all();
            if (!$district) {
                flash(__('Unable to Find District'))->error();
                return response()->json([
                    "error" => true,
                    "message" => 'District does not exist'
                ], 400);
            } elseif (!empty($post)) {
                flash(__('Unable to delete Districts. Post exists'))->error();
                return response()->json([
                    "error" => true,
                    "message" => 'Unable to delete Districts. Post exists'
                ], 400);
            } else {
                $delete = $district->delete();
                if ($delete) {
                    flash(__('District Deleted Successfully'))->success();
                    return response()->json([
                        'error' => false,
                        "message" => 'Deleted Successfully'
                    ], 200);

                } else {
                    flash('District cannot be Deleted')->error();
                    return response()->json([
                        'error' => true,
                        'message' => "District cannot be deleted"
                    ], 400);

                }
            }
        } else {
            flash(__('You are not authorized to create District'))->error();
            return view('admin.districts.index');
        }

    }
}
