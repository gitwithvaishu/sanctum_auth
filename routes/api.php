<?php

use Illuminate\Http\Request;
use App\Http\Requests\CheckAuthRequest;
use App\Http\Requests\DairyRegisterRequest;
use App\Http\Requests\DairyLoginRequest;
use App\Http\Requests\DairyTaskRequest;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CheckController;
use App\Http\Controllers\DairyController;
use App\Http\Controllers\DairyTaskController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register',[CheckController::class,'register']);
Route::post('/login',[CheckController::class,'login']);
// Route::middleware('auth:sanctum')->post('/logout',[CheckController::class,'logout']);

Route::group(['middleware' => ['auth:sanctum']],function()
{
    Route::post('logout',[CheckController::class,'logout']);
    Route::post('dlogout',[DairyController::class,'dlogout']);
    Route::resource('/thought',DairyTaskController::class);
});


Route::post('dregister',[DairyController::class,'dregister']);
Route::post('dlogin',[DairyController::class,'dlogin']);
// Route::middleware('auth:sanctum')->post('blogout',[DairyController::class,'dlogout']);
