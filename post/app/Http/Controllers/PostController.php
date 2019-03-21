<?php

namespace App\Http\Controllers;

use Validator;
use Auth;
use Illuminate\Http\Request;
use App\Post;
use App\Comment;
use App\Helpers\Response;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::with('user')->orderBy('created_at', 'desc')->get();
        return response()->json($posts);
    }

    public function show($id)
    {
        $post = Post::with('user')->find($id);
        return response()->json($post);
    }

    public function create(Request $request)
    {
        $this->validate($request , [
            'title'=>'required',
            'body' =>'required',
            'user_id'=>'required'
        ]);
        $post = Post::create($request->all());
        $post->save();
        return response()->json($post, 201);
    }

    public function update(Request $request,$id)
    {
        $loggeduserID = Auth::guard('api')->user()->id;
        $post = Post::findOrFail($id);
        
        if(!$post) {
            return response()->json(404,'Post not found');
        }else {
            $author = $post->user_id;

            if($author == $loggeduserID) {
                $this->validate($request,[
                    'title'=>'required',
                    'body' =>'required',
                ]);
                $post->title = $request->input('title');
                $post->body = $request->input('body');
                $post->save();
            } else {
                return response()->json('Only author can edit the post');
            }
        }
    }
    public function delete($id)
    {
        $loggeduserID = Auth::guard('api')->user()->id;
        $post = Post::find($id);
        
        if (!$post) {
            return response()->json('Post not found',40);
        } else {
            $author = $post->user_id;
            if ($author != $loggeduserID) {
                return response()->json("Only author can delete this post!",401);
            } else { 
                $post->comments()->delete();
                $post->delete();
                return response()->json('Post deleted successfully',200);
            }
        }
    }
}
