<?php

use Illuminate\Http\Request;
use App\Helper\ResponseHelper;
use App\Http\Controllers\Api\Authcontroller;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\PostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('test',function(){
    return ResponseHelper::win('hello minster','i know it');
});

Route::post('register',[Authcontroller::class,'register']);
Route::post('login',[Authcontroller::class,'login']);

Route::middleware(['auth:api'])->group(function () {
    Route::get('profile',[ProfileController::class,'profile']);
    Route::get('profile-posts',[ProfileController::class,'posts']);

    Route::post('logout',[Authcontroller::class,'logout']);

    Route::get('category',[CategoryController::class,'index']);

    Route::get('post',[PostController::class,'index']);
    Route::post('post',[PostController::class,'create']);
    Route::get('post/{id}',[PostController::class,'show']);
});