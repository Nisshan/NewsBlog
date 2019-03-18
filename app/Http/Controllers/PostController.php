<?php

namespace App\Http\Controllers;

use App\Category;
use App\Country;
use App\District;
use App\Post;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPosts()
    {
        return Datatables::of(Post::query())->addColumn('action', function ($post) {
            return '
                <div class="btn-group  btn-octonary">
                    <a type="button" href="'.route('posts.show',[$post->id]).'" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                    <a class="btn btn-success" href="'.route('posts.edit',[$post->id]).'"><i class="fa fa-edit"></i></a>
                    <a href="'.route('posts.destroy', [$post->id]).'" class="delete btn btn-danger"><i class="fa fa-remove"></i></a>
                </div>
            ';
        })
            ->make(true);
    }

    public function index()
    {
        $data['posts'] = Post::all();
        return view('admin.posts.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(auth()->user()->hasPermissionTo('create post')) {
            $data['districts'] = District::all();
            $data['categories'] = Category::all();
            return view('admin.posts.create')->with($data);
        }
        else{
            flash(__('you are not authorized to create post'));
            return view('admin.posts.index');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
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
        $image = explode(",", $request->images);
        $imageList = [];
        foreach ($image as $i) {
            $imageList[] = parse_url($i)['path'];
        }
        $images = implode(',',$imageList);
        $covers = explode(',', $request->cover);
        $coverlist = [];
        foreach ($covers as $c) {
            $coverlist[] = parse_url($c)['path'];

        }

        $validateData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required|min:100'
        ]);
        $post = new Post;
        $post->cover = parse_url($c)['path'];
        $post->image = $images;
        $post->title = trim($request->title);
        $post->description = trim($request->description);
        $post->slug =str_slug($post['title'], '-');
        do {
            $validatedSlug = Post::where('slug', $post->slug)->first();
            if ($validatedSlug) {
                $post->slug = str_slug($post->slug . ' ' . rand());
            }
        } while ($validatedSlug);
        $post->keywords = implode(',', $this->extractKeyWords($post['description']));
        $post->meta_description = str_limit(trim($post['description']), 200);
        $post->district_id=implode(',',$request->district_id);
        $post->user_id = auth()->id();
        $post->save();

        $category = Category::find($request->category_id);
        $post->category()->attach($category);

        $imageModel = [];
        foreach ($imageList as $image) {
            $imageModel[] = [
                "post_id" => $post->id,
                "image" => $image
            ];
        }
        $post->image()->createMany($imageModel);

        flash('Post Created Successfully')->success();
        return redirect()->action('PostController@create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(auth()->user()->hasPermissionTo('view post')) {

            $data['images']=[];
            $data['post'] = Post::with('images')->find($id);
            $images = $data['post']->images;
            foreach($images as $image){
                array_push($data['images'],$image->image);
            }
            $data['images']=implode(',',$data['images']);
            $data['category'] = Category::all();
            return view('admin.posts.view')->with($data);
        }
        else{
            flash(__('you are not authorized to view post Details'));
            return view('admin.posts.index');
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
        if(auth()->user()->hasPermissionTo('edit post')) {
            $data['images']=[];
            $data['post'] = Post::with('images')->find($id);
            $images = $data['post']->images;
            foreach($images as $image){
                array_push($data['images'],$image->image);
            }
            $data['images']=implode(',',$data['images']);
            $data['categories'] = Category::all();
            $data['district'] = District::all();
            return view('admin.posts.edit')->with($data);
        }
        else{
            flash(__('you are not authorized to edit post'));
            return view('admin.posts.index');
        }

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
        $image = explode(",", $request->images);
        $imageList = [];
        foreach ($image as $i) {
            $imageList[] = parse_url($i)['path'];
        }
        $images = implode(',',$imageList);
        $covers = explode(',', $request->cover);
        $coverlist = [];
        foreach ($covers as $c) {
            $coverlist[] = parse_url($c)['path'];

        }
        $post= Post::find($id);
        foreach ($post->image as $image){
            $image->delete();
        }
        $post->cover = parse_url($c)['path'];
        $post->image = $images;
        $post->title = trim($request->title);
        $post->description = trim($request->description);
        $post->slug =$request->slug;
        $post->keywords = implode(',', $this->extractKeyWords($post['description']));
        $post->meta_description = str_limit(trim($post['description']), 200);
        $post->save();

        $category = Category::find($request);
        $post->category()->sync($category);

        $imageModel = [];
        foreach ($imageList as $image) {
            $imageModel[] = [
                "post_id" => $post->id,
                "image" => $image
            ];
        }
        $post->image()->createMany($imageModel);

        flash('Post Created Successfully')->success();
        return redirect()->action('PostController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (auth()->user()->hasPermissionTo('delete post')) {
            $post = Post::find($id);
            if (!$post) {
                flash('Unable to Find Post')->error();
                return response()->json([
                    "error" => true,
                    "message" => 'Post does not exist'
                ], 400);
            }
            $delete = $post->delete();
            if ($delete) {
                flash('Post Deleted Successfully')->success();
                return response()->json([
                    'error' => false,
                    "message" => 'Deleted Successfully'
                ], 200);

            } else {
                flash('Post cannot be Deleted')->error();
                return response()->json([
                    'error' => true,
                    'message' => "Post cannot be deleted"
                ], 400);

            }
        }
        else{
            flash(__('you are not authorized to Delete Post'));
            return view('admin.posts.index');
        }
    }
}
