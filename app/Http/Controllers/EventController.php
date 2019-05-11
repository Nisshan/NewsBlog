<?php

namespace App\Http\Controllers;

use App\Event;
use App\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getEvents()
    {
        return Datatables::of(Event::query())->addColumn('action', function ($event) {
            return '

               <div class="btn-group">
                    <button type="button" data-toggle="dropdown" class="btn btn-default dropdown-toggle"><label>Action</label><span class="caret"></span></button>
                <ul class="dropdown-menu">
                    <li><a type="button" href="' . route('events.show', [$event->id]) . '" >View</a></li>
                    <li><a href="' . route('events.edit', [$event->id]) . '">Edit</a></li>
                    <li class="divider"></li>
                    <li><a class="delete" href="' . route('events.destroy', [$event->id]) . '">Delete</a></li>
                </ul>
             </div>
            ';

        })
            ->make(true);
    }
    public function index()
    {
        $user = auth()->user()->getAllPermissions()->count();
        if ($user > 0) {
            $data['events'] = Event::all();
            return view('admin.events.index')->with($data);
        }
        else {
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
//        if (auth()->user()->hasPermissionTo('create event')) {

            $data['posts'] = Post::all();
        return view('admin.events.create')->with($data);
//    }
//    else {
//        flash(__('You are not authorized to Create Event'))->error();
//        return view('admin.events.index');
//    }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fdate= $request->date;
        $formateddate = Carbon::parse($fdate)->format('y-m-d');


        $event = new Event;
        $event->name = $request->name;
        $event->description = trim($request->description);
        $event->eventdate =$formateddate;
        $event->save();
        $post = Post::find($request->post_id);
        $event->post()->attach($post);

        return view('admin.events.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (auth()->user()->hasPermissionTo('show event')) {

        $data['events'] = Event::findorFail($id);
        return view('admin.events.show')->with($data);
        }
        else {
            flash(__('You are not authorized to view Event'))->error();
            return view('admin.events.index');
        }


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
//        if (auth()->user()->hasPermissionTo('edit event')) {
        $data['event'] = Event::findorFail($id);
        $data['posts'] = Event::find($id)->post()->pluck('title');
        return view('admin.events.edit')->with($data);
//        }
//        else {
//                flash(__('You are not authorized to edit Event'))->error();
//                return view('admin.events.index');
//            }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $fdate= $request->date;
        $formateddate = Carbon::parse($fdate)->format('y-m-d');

        $event = Event::find($id);
        $event->name = $request->name;
        $event->description = $request->description;
        $event->eventdate =$formateddate;
        $event->save();

        $post = Post::find($request->post_id);
        $event->post()->sync($post);

        return redirect()->action("EventController@index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (auth()->user()->hasPermissionTO('delete event')) {
            $event = Event::find($id);
            if (!$event) {
                flash(__('Unable to Find Event'))->error();
                return response()->json([
                    "error" => true,
                    "message" => 'Event does not exist'
                ], 400);
            }
            $delete = $event->delete();
            if ($delete) {
                flash(__('Event Deleted Successfully'))->success();
                return response()->json([
                    'error' => false,
                    "message" => 'Deleted Successfully'
                ], 200);

            } else {
                flash('Event cannot be Deleted')->error();
                return response()->json([
                    'error' => true,
                    'message' => "Event cannot be deleted"
                ], 400);

            }
        } else {
            flash(__('you are not authorized to delete Gallery'));
            return redirect()->action("EventController@index");
        }
    }
}
