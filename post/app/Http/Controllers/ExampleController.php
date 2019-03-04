<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExampleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function show(Request $request)
    {
        return response()->json(['message' => 'show - ExampleController']);
    }
    
    public function showAnother(Request $request)
    {
        return response()->json(['message' => 'showAnother - ExampleController']);
    }

}
