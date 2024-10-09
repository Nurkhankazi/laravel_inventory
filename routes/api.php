<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\OrderController;
// use App\Http\Controllers\Api\DesignationController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::controller(AuthController::class)->group(function(){
    Route::post('register','_register');
    Route::post('login','_login');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// Route::controller(DesignationController::class)->group(function(){
//     Route::get('designation','index');
//     Route::get('designation/{designation}','show');
//     Route::put('designation/{designation}','update');
//     Route::delete('designation/{designation}','destroy');
//     Route::post('designation/create','store');
// });

Route::controller(ProductController::class)->group(function(){
    Route::get('addproduct','index');
    Route::post('addproduct/create','store');
    Route::get('addproduct/{addProduct}','show');
    Route::post('addproduct/edit/{id}','update');
    Route::delete('addproduct/{addProduct}','destroy');
});
Route::controller(OrderController::class)->group(function(){
    Route::get('order','index');
    Route::post('order/create','store');
    Route::get('order/{order}','show');
    Route::post('order/edit/{id}','update');
    Route::delete('order/{order}','destroy');
});
