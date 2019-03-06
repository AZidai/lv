<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

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
        $post = Post::create($request->all());

        return response()->json($post, 201);
    }

    public function update($id, Request $request)
    {
        $post = Post::findOrFail($id);
        $post->update($request->all());
        return response()->json($post, 200);
    }

    public function delete($id)
    {
        Post::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }
}
