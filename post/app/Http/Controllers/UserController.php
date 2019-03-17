<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Models\Users;
use App\Helpers\Response;

class UserController extends Controller
{
  public function postLogin(Request $request)
    {
      $this->validate($request, [
        'email'    => 'required|email',
        'password' => 'required',
      ]);
      try {
        if (! $token = $this->jwt->attempt($request->only('email', 'password'))) {
          return response()->json(['user_not_found'], 404);
        }
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['token_expired'], 500);
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['token_invalid'], 500);
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['token_absent' => $e->getMessage()], 500);
        }
  return response()->json(compact('token'));
}

 public function create(Request $request)// Validator create user  i validate request , plus errors
  {
    $validator = Validator::make($this->request->all(), [
        'email'   => 'required|unique:users|email',
        'password'   => 'required',
        'name'      => 'required'
    ]);
    if ($validator->errors()->count()) {
        return response()->json()->badRequest($validator->errors());
    }
    $user = $this->users->createUser($this->request);
    if ($user) {
        return response()->json()->created($user);
    } else{
    return response()->json()->internalError('Unable to create the user');
    }
  } 

  public function getUserPosts($id) //get all user posts
    {
      $user = $this->users->getUser($id);
      if(!$user) {
        return Response::notFound('User not found');
        }
        return $user->posts;
    }

  public function getUserComments($id) //get all user comments
    {
      $user = $this->users->getUser($id);
        if(!$user) {
          return Response::notFound('User not found');
        }
        return $user->comments;
    }
  
  public function getUserComment($id, $commentId) //get user single comment by id "route usere/id/comment/id"
  {
    $user = $this->users->getUser($id);
      if(!$user) {
      return Response::notFound('User not found');
      }
      return $user->comments()->find($commentId);
  }
  public function getUser($id) //get user by id
  {
    $user = $this->users->getUser($id);
    if(!$user) {
      return Response::notFound('User not found');
    }
      return Response::json($user);
  }
}
