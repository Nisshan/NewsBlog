<?php

namespace App\Http\Controllers;

use App\Country;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCountry()
    {
        return Datatables::of(Country::query())->addColumn('action', function ($country) {
            return '
                <div class="btn-group">
                    <button type="button" data-toggle="dropdown" class="btn btn-default dropdown-toggle">Action <span class="caret"></span></button>
                <ul class="dropdown-menu">
                    <li><a type="button" href="' . route('countries.show', [$country->id]) . '" >View</a></li>
                    <li><a href="' . route('countries.edit', [$country->id]) . '">Edit</a></li>
                    <li class="divider"></li>
                    <li ><a class="delete" href="' . route('countries.destroy', [$country->id]) . '">Delete</a></li>
                </ul>
             </div>
            ';
        })
            ->make(true);
    }

//    public function __construct()
//    {
//        $this->middleware('auth:api');
//    }
//    public function view(){
//        //        this is for api
//        $data['countries'] = Country::all();
//        return CountryResource::collection($data['countries']);
//    }
//    public function viewsingle($id){
//        //        this is for api
//        $data['countries'] = Country::find($id);
//        return new CountryResource($data['countries']);
//    }


    public function index()
    {
        $user = auth()->user()->getAllPermissions()->count();
        if ($user > 0) {
            $data['countries'] = Country::all();
            return view('admin.countries.index')->with($data);
        } else {
            return redirect()->route('home');
        }


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->hasPermissionTo('create country')) {
            return view('admin.countries.create');
        } else {
            flash(__('You are not authorized to create Country'))->error();
            return view('admin.countries.index');
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
        $validator = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|min:100',
        ]);
        $country = new Country;
        $country->name = $request->name;
        $country->description = $request->description;
        $country->slug = str_slug($country['name'], '-');
        do {
            $validatedSlug = Country::where('slug', $country->slug)->first();
            if ($validatedSlug) {
                $country->slug = str_slug($country->slug . ' ' . rand());
            }
        } while ($validatedSlug);

        $country->keywords = strip_tags(implode(',', $this->extractKeyWords($country['description'])));
        $country->meta_description = str_limit(trim($country['description']), 200);
        $country->user_id = auth()->id();
        $country->save();
        flash('Country Name Saved Successfully')->success();
        return redirect()->action("CountryController@create");

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (auth()->user()->hasPermissionTo('view country')) {
            $data['country'] = Country::find($id);
            return view('admin.countries.view')->with($data);
//            api call
//            return new CountryResource($data['country']);
        } else {
            flash(__('You are not authorized to view Country'))->error();
            return redirect()->action("CountryController@index");
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
        if (auth()->user()->hasPermissionTo('edit country')) {
            $data['country'] = Country::find($id);
            return view('admin.countries.edit')->with($data);
        } else {
            flash(__('You are not authorized to edit Country'))->error();
            return redirect()->action("CountryController@index");
        }
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
        $validator = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|min:100',
        ]);
        $country = Country::find($id);
        $country->name = trim($request->name);
        $country->description = trim($request->description);
        $country->keywords = strip_tags(trim($request->keywords));
        $country->meta_description = str_limit(trim($request->meta_description, 200));
        $country->save();
        flash('Country Details Edited Successfully')->success();
        return redirect()->action("CountryController@index");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (auth()->user()->hasPermissionTo('delete country')) {
            $country = Country::find($id);
            $stat = $country->states->all();
            if (!$country) {
                flash('Unable to Find Country')->error();
                return response()->json([
                    "error" => true,
                    "message" => 'Country does not exist'
                ], 400);
            } elseif (!empty($stat)) {
                flash(__('Cannot Delete Country. State exists'))->error();
                return response()->json([
                    "error" => true,
                    "message" => 'Cannot Delete Country. State exists!!'
                ]);
            } else {
                $delete = $country->delete();
                if ($delete) {
                    flash('Country Deleted Successfully')->success();
                    return response()->json([
                        'error' => false,
                        "message" => 'Deleted Successfully'
                    ], 200);

                } else {
                    flash('Country cannot be Deleted')->error();
                    return response()->json([
                        'error' => true,
                        'message' => "country cannot be deleted"
                    ], 400);

                }
            }

        } else {
            flash(__('You are not authorized to delete Country'))->error();
            return redirect()->action("CountryController@index");
        }
    }
}
