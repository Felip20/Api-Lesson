<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProfileResource;
use App\Helper\ResponseHelper;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function profile(){
        $user = auth()->guard()->user();
        $data =  new ProfileResource($user);
        return ResponseHelper::win([
            'profile'=>$data
        ]);
    }
}
