<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Ecxeptions\JWTException;
use Tymon\JWTAuth\JWTAuth;
use App\User;

class AuthController extends Controller
{
    /**
     * @var \Tymon\JWTAuth\JWTAuth
     */
    protected $jwt;

    public function __construct(JWTAuth $jwt)
    {
        $this->jwt = $jwt;
    }
    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'email'    => 'required|email',
            'password' => 'required'
        ]);
        //we pass these in attempt so JWT can create token
        $credentials = $request->only('email','password');
        try {
            // pokusaj da napravis token,u koliko ne catach exception
            if( !$token = $this->jwt->attempt($credentials)) {
                return response()->json([
                    'error' => 'Invalid Credentials'
                ],401);
            }
        }catch(JWTException $e) {
            return response()->json([
                'error' =>'Could not create token!'
            ],500);
        }
        return response()->json([
            'token' => $token,
            'user' => $this->guard()->user()
        ]);
    }
    public function postRegister(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        $hasher = app()->make('hash');
        $request['password']= $hasher->make($request->input('password'));
        $user = User::create($request->all());

        return response()->json($user);
    }

    public function logout(){
        auth('api')->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }
    public function me()
    {
        return response()->json(auth('api')->user());
    }
    public function guard()
    {
        return \Auth::Guard('api');
    }
}
