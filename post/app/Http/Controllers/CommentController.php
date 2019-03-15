<?php

namespace App\Http\Controllers;

use App\Comment;
use App\User;
use Illuminate\Http\Request;


class CommentController extends Controller
{
    public function index()
    {
        return response()->json(Comment::all());
    }

    public function show($id)
    {
        $comment = $this->comment->getComment($id);
        if(!$comment) {
            return Response::notFound('Comment not found');
        }else{ 
            return Response::json($comment);
        }
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
