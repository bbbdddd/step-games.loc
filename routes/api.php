<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/me', \App\Http\Controllers\MeController::class)->middleware('auth:sanctum');
Route::post('/registration', \App\Http\Controllers\RegisterController::class);
Route::group(['prefix'=>'auth'], function(){
   Route::post('/registration', \App\Http\Controllers\RegisterController::class);
   Route::post('/login', \App\Http\Controllers\LoginController::class);
});

Route::resource('/rooms', \App\Http\Controllers\RoomController::class)->middleware('auth:sanctum');
Route::get('/list', [\App\Http\Controllers\RoomController::class, 'index'])->middleware('auth:sanctum');
