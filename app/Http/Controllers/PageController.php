<?php

namespace App\Http\Controllers;

use App\Category;
use App\Page;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPages()
    {
        return Datatables::of(Page::query())->addColumn('action', function ($page) {
            return '
                <div class="btn-group">
                    <button type="button" data-toggle="dropdown" class="btn btn-default dropdown-toggle">Action <span class="caret"></span></button>
                <ul class="dropdown-menu">
                    <li><a type="button" href="' . route('pages.show', [$page->id]) . '" >View</a></li>
                    <li><a href="' . route('pages.edit', [$page->id]) . '">Edit</a></li>
                    <li class="divider"></li>
                    <li ><a class="delete" href="' . route('pages.destroy', [$page->id]) . '">Delete</a></li>
                </ul>
             </div>
            ';
        })
            ->make(true);
    }
    public function index()
    {
        $data['pages'] = Page::all();
        return view('admin.pages.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['categories'] = Category::all();
        return view('admin.pages.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $image = explode(",", $request->images);
        $imageList = [];
        foreach ($image as $i) {
            $imageList[] = parse_url($i)['path'];
        }
        $request->validate([
            'name' =>'bail|required|min:3',
            'description' => 'required|min:20|'
        ]);
        $page = new Page;
        $page->name = $request->name;
        $page->description = $request->description;
        $page->slug = str_slug($page['name'], '-');
        do {
            $validatedSlug = Page::where('slug', $page->slug)->first();
            if ($validatedSlug) {
                $page->slug = str_slug($page->slug . ' ' . rand());
            }
        } while ($validatedSlug);
        $page->save();

        $imageModel = [];
        foreach ($imageList as $image) {
            $imageModel[] = [
                "page_id" => $page->id,
                "url" => $image
            ];
        }
        $page->photo()->createMany($imageModel);
        $category = Category::find($request);
        $page->category()->attach($category);

        return redirect()->action('PageController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
//        $data['page'] = Page::find($id);
//        return view('admin.pages.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['images'] = [];
         $data['photo'] = Page::with('photo')->find($id);
        $images = $data['photo']->photo;
        foreach ($images as $image) {
            array_push($data['images'], $image->url);
        }
         $data['images'] = implode(',', $data['images']);
//
//        $data['photos'] = [];
//        return $data['photo'] = Page::with('photo')->find($id);

        $data['categories'] = Category::all();
        return $data['category'] = Page::find($id)->category()->get();
        $data['page'] = Page::find($id);
        return view('admin.pages.edit')->with($data);
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
        $page = Page::find($id);
        foreach ($page->photo as $image) {
            $image->delete();
        }
        $image = explode(",", $request->images);
        $imageList = [];
        foreach ($image as $i) {
            $imageList[] = parse_url($i)['path'];
        }
        $request->validate([
            'name' =>'bail|required|min:3',
            'description' => 'required|min:20|'
        ]);
        $page->name = $request->name;
        $page->description = $request->description;
        $page->save();

        $imageModel = [];
        foreach ($imageList as $image) {
            $imageModel[] = [
                "page_id" => $page->id,
                "url" => $image
            ];
        }

        $page->photo()->createMany($imageModel);
        $category = Category::find($request);
        $page->category()->sync($category);

        return redirect()->action('PageController@index');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $page = Page::find($id);
        $delete = $page->delete();

        if($delete){
            flash(__('Page Deleted Successfully'))->success();
        }
        else{
            flash(__('Error in Deletion'))->error();
        }
    }
}
