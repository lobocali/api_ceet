<?php

use App\Http\Controllers\Api\V1\ProductController;
use App\Http\Controllers\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('v1/products',ProductController::class)
    ->middleware('auth:sanctum');

Route::post('login',[
    LoginController::class,'login'
]);