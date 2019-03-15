<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function messagejson($status, $data, $message=''){
        return response()->json([
            'message' => $message,
            'status' => $status,
            'data' => $data
        ]);
    }
}
