<?php

namespace App\Http\Controllers;

use Validator;
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
        return response()->json(Post::find($id));
    }

    public function create(Request $request)
    {
        $post = Post::create($request->all());

        return response()->json($post, 201);
        
    }

    public function update($id)
    {
        $post = Post::findOrFail($id);
        if(!$post) {
            return Response::notFound('Post not found');
        }
        $validator = Validator::make($this->request->all(),[
            'title'=>'required',
            'body' =>'required'
        ]);

        if($validator->errors()->count()) {
            return Response::badRequest($validator->errors());
        }
        $post = $this->post->updatePost($id,$this->request->all());
        if($post) {
            return Response::json($post);
        }
        return Response::internalError('Unable to update the post');
    }

    public function delete($id)
    {
        $post=$this->post->find($id);
        if(!$post) {
            return Response::notFound('Post not found');
        }
        if(!$post->delete()) {
            return Response::internalError('Unable to delete the post');
        }
        return Response::deleted();
    }
}
