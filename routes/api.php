<?php

use Illuminate\Http\Request;
use App\Helper\ResponseHelper;
use App\Http\Controllers\Api\Authcontroller;
use App\Http\Controllers\Api\ProfileController;
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
});