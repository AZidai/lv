<?php

namespace App\Http\Controllers;

use App\Comment;
use App\User;
use App\Post;
use Auth;
use Illuminate\Http\Request;


class CommentController extends Controller
{
    public function create(Request $request)
    {

        $this->validate($request, [
            'body' =>'required',
            'post_id'=>'required',
            'user_id'=>'required'
        ]);

        $comment = Comment::create($request->all());
        $comment->save();
        return response()->json($comment, 201);
    }

    public function update(Request $request , $id)
    {
        $loggeduserID = Auth::guard('api')->user()->id;
        $comment = Comment::findOrFail($id);

        if(!$comment) {
            return response()->json(404,'Comment not found');
        } else {
            $author = $comment->user_id;
            if($author == $loggeduserID) {
                $this->validate($request,[
                    'body' =>'required',
                ]);
                $comment->body = $request->input('body');
                $comment->save();

            } else {
                return response()->json('Only author can edit the comment');
            }
        }
    }
    public function getCommentsbyPostId($id)
    {
        // $comment = Comments::with('user')->where('post_id',$id);
        $comment = Comment::with('user')->where('post_id', '=', $id)->orderBy('created_at','desc')->get();
        return response()->json($comment);
    }

    public function delete($id)
    {
        $loggeduserID = Auth::guard('api')->user()->id;
        $comment = Comment::find($id);
        
        if (!$comment) {
            return response()->json('Comment not found',40);
        } else {
            $author = $comment->user_id;
            if ($author != $loggeduserID) {
                return response()->json("Only author can delete this comment!",401);
            } else {
                $comment->delete();
                return response()->json('Comment deleted successfully',200);
            }
        }
    }
}
