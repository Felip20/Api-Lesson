<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Helper\ResponseHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class Authcontroller extends Controller
{
    public function register(Request $request){
        
        $request->validate([
            'name'=>'required|max:200',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:8|max:30'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        $token = $user->createToken('Blog')->accessToken;

        return ResponseHelper::win([
            'access_token'=>$token
        ]);
    }
}
