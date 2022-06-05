<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/get_all_product',[ProductController::class,'index']);
Route::post('/add_product',[ProductController::class,'store']);
Route::get('/get_ediy_product/{id}',[ProductController::class,'show']);
Route::post('/update_product/{id}',[ProductController::class,'update']);
Route::post('/delete_product/{id}',[ProductController::class,'deletebyid']);
