<?php

use Illuminate\Http\Request;
use App\Helper\ResponseHelper;
use App\Http\Controllers\Api\Authcontroller;
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
