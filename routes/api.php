<?php

use Illuminate\Http\Request;
use App\Http\Requests\CheckAuthRequest;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CheckController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register',[CheckController::class,'register']);
Route::post('/login',[CheckController::class,'login']);
Route::post('/logout',[CheckController::class,'logout']);
