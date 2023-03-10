<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Models\Media;
use App\Helper\ResponseHelper;
use App\Http\Resources\PostResource;
use App\Http\Resources\PostDetailResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::orderByDesc('created_at');
        
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
    public function create(Request $request)
    {
        $request->validate([
            'name'=>'required|string',
            'description'=>'required|string',
            'category_id'=>'required'
        ],[
            'category_id.required'=>'The category is required'
        ]);

        DB::beginTransaction();
        try {
            $file_name = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $file_name = uniqid().'_'.date('Y-m-d-H-i-s').'-'. $file->getClientOriginalExtension();
            Storage::put('media/'. $file_name, file_get_contents($file));
        }
        

        $post = new Post();
        $post->user_id = auth()->user()->id;
        $post->name = $request->name;
        $post->description = $request->description;
        $post->category_id = $request->category_id;
        $post->save();
        
        $media = new Media();
        $media->file_name = $file_name;
        $media->file_type = 'image';
        $media->model_id = $post->id;
        $media->model_type = Post::class;
        $media->save();

        DB::commit();
        return ResponseHelper::win([],'Success Post');
        } catch (Exception $e) {
            DB::rollback();
            return ResponseHelper::lose($e->getMessage());
        }
    }

    public function show($id)
    {
        $post = Post::where('id', $id)->firstOrFail();
        return ResponseHelper::win(new PostDetailResource($post));
    }
}
