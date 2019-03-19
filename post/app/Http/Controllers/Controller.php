<?php

namespace App\Http\Controllers;
use App\User;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function responsejson($status, $data, $message='') {
        return response()->json([
            'message' => $message,
            'status' => $status,
            'data' => $data
        ]);
    }
}
