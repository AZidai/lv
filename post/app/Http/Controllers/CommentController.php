<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;


class CommentController extends Controller
{
    protected->comment = $comment;
    protected->request = $request;

    public funtion __contruct(Comment $comment,Request $request)
    {
        $this->comment=$comment;
        $this->request=$request;
    }

    //elloquent relationships
    public function post(){
        return $this->belongsTo('App/Post');
    }

    public function user(){
        return $this->belongsTo('App/User');
    }


    public function index()
    {
        return response()->json(Comment::all());
    }

    public function show($id)
    {
        $comment = $this->comment->getComment($id);
        if(!$comment) {
            return Response::notFound('Comment not found');
        }
            return Response::json($comment);
    }
        

    public function create()
    {
        $comment = Comment::create($request->all());

        return response()->json($comment, 201);
    }

    public function update($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->update($request->all());
        return response()->json($comment, 200);
    }

    public function delete($id)
    {
        Comment::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }
}
