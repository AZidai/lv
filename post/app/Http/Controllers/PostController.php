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
        $validator = Validator::make($this->request->all(),[
            'title'=>'required',
            'body' =>'required',
            'user_id'=>'required'
        ]);
        $post = Post::create($request->all());

        return response()->json($post, 201);
        
    }

    public function update($id)
    {
        $post = Post::findOrFail($id);
        if(!$post) {
            return response()->json()->notFound(404,'Post not found');
        }
        $validator = Validator::make($this->request->all(),[
            'title'=>'required',
            'body' =>'required',
            'user_id'=>'required'
        ]);

        if($validator->errors()->count()) {
            return Response::badRequest($validator->errors());
        }
        $post = $this->post->updatePost($id,$this->request->all());
        if($post) {
            return Response::json($post);
        }
        return reponse()->json()->internalError('Unable to update the post');
    }

    public function delete($id)
    {
        $post = Post::find($id);

        if(!$post) {
            return messageJson(404,$post,'Post not found');
        }
        if ($post){
            $post->comments()->delete();
            $post->delete();
        }
    }
}
