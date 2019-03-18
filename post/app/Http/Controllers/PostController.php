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
        $post = Post::find($id)->with('comments')->orderBy('created_at', 'desc')->get();
        return response()->json($post);
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
            return response()->json('Post not found');
        }
        if ($post){
            if( Auth::id == $this.post()->user_id ){
                $post->comments()->delete();
                $post->delete();
            }
        }
    }
}
