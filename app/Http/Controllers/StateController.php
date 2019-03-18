<?php

namespace App\Http\Controllers;

use App\Country;
use App\State;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getState()
    {
        return Datatables::of(State::query())->addColumn('action', function ($state) {
            return '
               
             <div class="btn-group">
                    <button type="button" data-toggle="dropdown" class="btn btn-default dropdown-toggle">Action <span class="caret"></span></button>
                <ul class="dropdown-menu">
                    <li><a type="button" href="'.route('states.show',[$state->id]).'" >View</a></li>
                    <li><a href="'.route('states.edit',[$state->id]).'">Edit</a></li>
                    <li class="divider"></li>
                    <li><a href="'.route('states.destroy', [$state->id]).'">Delete</a></li>
                </ul>
             </div>
            ';
        })
            ->make(true);
    }

    public function index()
    {
        $data['states'] = State::with('Country')->get();
        $data['states'] = State::all();
        return view('admin.states.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(auth()->user()->hasPermissionTO('create state')){
            $data['countries'] = Country::all();
            return view('admin.states.create')->with($data);
        }
        else{
            flash(__('You are not authorized to Create State'))->error();
            return view('admin.states.index');
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
            ''
        ]);
        $state = new State;
        $state->name = trim($request->name);
        $state->description = trim($request->description);
        $state->slug = str_slug($state['name'], '-');
        do {
            $validatedSlug = State::where('slug', $state->slug)->first();
            if ($validatedSlug) {
                $state->slug = str_slug($state->slug . ' ' . rand());
            }
        } while ($validatedSlug);
        $state->keywords = implode(',', $this->extractKeyWords($state['description']));
        $state->meta_description = str_limit(trim($state['description']), '100');
        $state->country_id = $request->country_id;
        $state->user_id = auth()->id();
        $state->save();
        flash('State name saved successfully')->success();
        return redirect()->action('StateController@create');


    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(auth()->user()->hasPermissionTo('view state')){
            $data['state'] = State::find($id);
            return view('admin.states.view')->with($data);
        }
        else{
            flash(__('you are not authorized to view State Details'));
            return view('admin.states.index');
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
        if(auth()->user()->hasPermissionTo('edit state')){
            $data['country'] = Country::find($id);
            $data['state'] = State::find($id);
            return view('admin.states.edit')->with($data);
        }
        else{
            flash(__('you are not authorized to view edit Details'));
            return view('admin.states.index');
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
        $state = State::find($id);
        $state->name = trim($request->name);
        $state->description = trim($request->description);
        $state->slug = $request->slug;
        $state->keywords = trim(($request->keywords));
        $state->meta_description = str_limit(trim($request->meta_description, 200));
        $state->country_id = $request->country_id;
        $state->save();
        flash('State Name Edited Successfully')->success();
        return redirect()->action("StateController@index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (auth()->user()->hasPermissionTo('delete state')) {
            $state = State::find($id);
            $dist = $state->district->all();
            if (!$state) {
                flash(__('Unable to Find State'))->error();
                return response()->json([
                    "error" => true,
                    "message" => 'State does not exist'
                ], 400);
            } elseif (!empty($dist)) {
                flash(__('Cannot delete State. District Exist!!'))->error();
                return response()->json([
                    "error" => true,
                    "message" => 'State can not be deleted. District Exist!!'
                ], 400);
            }
            $delete = $state->delete();
            if ($delete) {
                flash(__('State Deleted Successfully'))->success();
                return response()->json([
                    'error' => false,
                    "message" => 'Deleted Successfully'
                ], 200);

            } else {
                flash('State cannot be Deleted')->error();
                return response()->json([
                    'error' => true,
                    'message' => "State cannot be deleted"
                ], 400);
            }
        }
        else{
            flash(__('you are not authorized to delete State Details'));
            return view('admin.states.index');
        }
    }
}
