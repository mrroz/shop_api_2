<?php

use App\Http\Controllers\V1\Admin\BrandController;
use App\Http\Controllers\V1\Admin\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::apiResource('V1/brands', BrandController::class);

Route::apiResource('V1/category', CategoryController::class);


