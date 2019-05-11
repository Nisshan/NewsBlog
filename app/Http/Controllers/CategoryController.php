<?php

namespace App\Http\Controllers;

use App\Category;
use App\Country;
use App\District;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCategory()
    {
        return Datatables::of(Category::orderBy("position", "ASC")->get())->addColumn('action', function ($category) {
            return '
               <div class="btn-group">
                    <button type="button" data-toggle="dropdown" class="btn btn-default dropdown-toggle"><label>Action</label><span class="caret"></span></button>
                <ul class="dropdown-menu">
                    <li><a type="button" href="' . route('categories.show', [$category->id]) . '" >View</a></li>
                    <li><a href="' . route('categories.edit', [$category->id]) . '">Edit</a></li>
                    <li class="divider"></li>
                    <li><a class="delete" href="' . route('categories.destroy', [$category->id]) . '">Delete</a></li>
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
            $data['categories'] = Category::orderBy('position','ASC')->get();
            return view('admin.categories.index')->with($data);
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
        if (auth()->user()->hasPermissionTo('create categories')) {

            $data['categories'] = Category::all();
            return view('admin.categories.create')->with($data);
        } else {
            flash(__('You are not authorized to create Category'))->error();
            return view('admin.categories.index');
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
        $validData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|min:100'
        ]);
        $category = new Category;
        $category->name = trim($request->name);
        $category->description = trim($request->description);
        $category->slug = str_slug($category['name'], '-');
        do {
            $validatedSlug = Category::where('slug', $category->slug)->first();
            if ($validatedSlug) {
                $category->slug = str_slug($category->slug . ' ' . rand());
            }
        } while ($validatedSlug);
        $category->keywords = strip_tags(implode(',', $this->extractKeyWords($category['description'])));
        $category->meta_description = strip_tags(str_limit(trim($category['description']), 200));
        $category->parent_id = $request->parent_id;
        $category->user_id = auth()->id();
        $category->save();
        flash('Category successfully created');
        return redirect()->action('CategoryController@create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (auth()->user()->hasPermissionTo('view categories')) {
            $data['category'] = Category::find($id);
            return view('admin.categories.view')->with($data);
        } else {
            flash(__('You are not authorized to view Category'))->error();
            return view('admin.categories.index');
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
        if (auth()->user()->hasPermissionTo('edit categories')) {
            $data['category'] = Category::find($id);
            return view('admin.categories.edit')->with($data);
        } else {
            flash(__('You are not authorized to edit Category'))->error();
            return view('admin.categories.index');
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
        $validData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|min:100'
        ]);
        $category = Category::find($id);
        $category->name = trim($request->name);
        $category->description = trim($request->description);
//        $category->slug = $request->slug;
        $category->keywords = strip_tags($request->keywords);
        $category->user_id = auth()->id();
        $category->meta_description = str_slug(trim($request->meta_description));
        $category->status = Input::get('status') == 'true' ? 1 : 0;
        $category->save();
        flash('Category successfully updated')->success();
        return redirect()->action('CategoryController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (auth()->user()->hasPermissionTo('delete categories')) {
            $category = Category::find($id);
            $post = $category->posts->all();
            $cat = $category->children->all();
            if (!empty($cat)) {
                flash(__('Unable to Delete category. SubCategory exist!!! '))->error();
                return response()->json([
                    "error" => true,
                    "message" => 'category can not be deleted'
                ], 400);
            }
            if (!$category) {
                flash(__('Unable to Find category'))->error();
                return response()->json([
                    "error" => true,
                    "message" => 'category does not exist'
                ], 400);
            } elseif (!empty($post)) {
                flash(__('Cannot delete category. Post Exist!!'))->error();
                return response()->json([
                    "error" => true,
                    "message" => 'Cannot delete category. Post Exist!!'
                ], 400);
            } else {
                $delete = $category->delete();
                if ($delete) {
                    flash(__('category Deleted Successfully'))->success();
                    return response()->json([
                        'error' => false,
                        "message" => 'Deleted Successfully'
                    ], 200);

                } else {
                    flash('category cannot be Deleted')->error();
                    return response()->json([
                        'error' => true,
                        'message' => "category cannot be deleted"
                    ], 400);

                }

            }
        } else {
            flash(__('You are not authorized to delete Category'))->error();
            return view('admin.categories.index');
        }


    }
    //this is for changing position from ajax request into the table
    public function updateOrder(Request $request)
    {
        $categories = Category::all();

        foreach ($categories as $category) {
            $category->timestamps = false; // To disable update_at field update
            $id = $category->id;

            foreach ($request->position as $pos) {
                if ($pos['id'] == $id) {
                    $category->update(['position' => $pos['order']]);
                }
            }
        }

        return response('Update Successfully.', 200);
    }

}
