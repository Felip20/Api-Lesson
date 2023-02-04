<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Http\Resources\ProfileResource;
use App\Http\Resources\PostResource;
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
    public function posts(Request $request){

        $query = Post::orderByDesc('created_at')->where('user_id',auth()->user()->id);
        
        if ($request->category_id) {
             $query->where('category_id',$request->category_id);
        }
        if ($request->search) {
             $query->where(function($query)use($request){
                 $query->where('name','like','%'.$request->search.'%')
                         ->orWhere('description','like','%'.$request->search.'%');
             });
        }
        $posts= $query->paginate(10);

        return PostResource::collection($posts)->additional(['message'=>'success']);
    }
}
