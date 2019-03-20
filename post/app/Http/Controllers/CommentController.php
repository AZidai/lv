<?php

namespace App\Http\Controllers;

use App\Comment;
use App\User;
use App\Post;
use Illuminate\Http\Request;


class CommentController extends Controller
{
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
    public function getCommentsbyPostId($id)
    {
        // $comment = Comments::with('user')->where('post_id',$id);
        $comment = Comment::with('user')->where('post_id', '=', $id)->get();
        return response()->json($comment);
    }

    public function delete($id)
    {
        Comment::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }
}
