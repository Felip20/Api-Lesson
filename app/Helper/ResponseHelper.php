<?php

namespace App\Helper;

class ResponseHelper
{
    public static function win($data = [], $message='success'){
        return response()->json([
            'data'=>$data,
            'message'=>$message
        ],
        200);
    }
    public static function lose($message){
        return response()->json([
            'message'=>$message
        ],422);
    }
}