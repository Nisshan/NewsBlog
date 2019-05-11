<?php

namespace App\Http\Controllers\API;

use App\Comment;
use App\Http\Resources\CommentResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Comment::with('post')->orderBy('date')->paginate(5);
        return CommentResource::collection($data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return 'create comment';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $comment = Comment::create([
            'comment'=> $request->comment,
            'session_id' => $request->session_id,
            'user_id' => Auth()->id(),
            'ip' => Request::getClientIp(),
            'agent' =>  Request::header(),
            'post_id' =>$request->post_id,
        ]);
        return response()->json([
             'message'=>'Comment Updated successfully',
             'comment'=>new CommentResource($comment)
         ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comment = Comment::with('post')->findorFail($id);
        return new CommentResource($comment);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return 'edit comment';
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $comment = Comment::create([
            'comment'=> $request->comment,
            'session_id' => $request->session_id,
            'user_id' => Auth()->id(),
            'ip' => Request::getClientIp(),
            'agent' =>  Request::header(),
            'post_id' =>$request->post_id,
        ]);
        return response()->json([
            'message'=>'Comment Created successfully',
            'comment'=>new CommentResource($comment)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment ->delete();
        return response()->json([
            'message'=>'Event deleted successfully',
        ]);
    }
}
