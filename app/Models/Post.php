<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Category;
use App\Models\User;
use App\Models\Media;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function username(){
       return $this->belongsTo(User::class,'user_id','id');
    }
    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }
    public function image(){
        return $this->morphOne(Media::class,'model');
    }
}
