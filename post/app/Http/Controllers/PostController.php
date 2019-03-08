<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Post;
use App\Helpers\Response;

class PostController extends Controller
{

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function addComment($body)
    {
        $this->comments()->create('body'=>$body);
    }
    

    public function index()
    {
        return response()->json(Post::all());
    }

    public function show($id)
    {
        return response()->json(Post::find($id));
    }

    public function create(Request $request)
    {
        $validator=Validator::make($this->request->all(),[
        'title'=>'requierd',
        'body'=>'requierd',
        'user_id'=>'requierd',
        ]);

        if($validator->errors()->count()) {
        return Response::badRequest($validator->errors());
        }
        $post = $this->post->createPost($this->request);
        if($post) {
        return Response::created($post);
        
        return Response::internalError('Unable to create Post');
        }
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
        $post=$this->post->find($id)
        if(!$post) {
            return Response::notFound('Post not found');
        }
        if(!$post->delete()) {
            return Response::internalError('Unable to delete the post');
        }
        return Response::deleted();
    }
}
