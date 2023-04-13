<?php

use App\Http\Controllers\SanctumTokenController;
use App\Http\Controllers\SeriesApiController;
use App\Http\Controllers\VideosApiController;
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

Route::get('/videos/{id}',[VideosApiController::class,'show']);
Route::get('/videos',[VideosApiController::class,'index']);

Route::get('/series', [ SeriesApiController::class,'index']);
Route::get('/series/{id}', [ SeriesApiController::class,'show']);

Route::middleware(['auth:sanctum','verified'])->group(function (){
    Route::post('/videos',[VideosApiController::class,'store'])->middleware('can:videos_manage_create');
    Route::put('/videos/{id}',[VideosApiController::class,'update'])->middleware('can:videos_manage_update');
    Route::delete('/videos/{id}',[VideosApiController::class,'destroy'])->middleware('can:videos_manage_destroy');

});

Route::post('/sanctum/token',SanctumTokenController::class);

