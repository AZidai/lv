<?php

namespace App\Http\Controllers;

use App\Label;
use Illuminate\Http\Request;

class LabelController extends Controller
{

    public function index()
    {
        return response()->json(Label::all());
    }

    public function show($id)
    {
        return response()->json(Label::find($id));
    }

    public function create(Request $request)
    {
        $label = Label::create($request->all());
        return response()->json($label, 201);
    }

    public function update($id, Request $request)
    {
        $label = Label::findOrFail($id);
        $label->update($request->all());

        return response()->json($label, 200);
    }

    public function delete($id)
    {
        Label::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }
}
