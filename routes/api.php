<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\SuppliersController;
use App\Http\Controllers\Api\PurchaseController;
use App\Http\Controllers\Api\PurchaseReturnController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\StockController;
use App\Http\Controllers\Api\SalesController;
use App\Http\Controllers\Api\SalesReturnController;
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
    Route::get('product','index');
    Route::post('product/create','store');
    Route::get('product/{product}','show');
    Route::post('product/edit/{id}','update');
    Route::delete('product/{product}','destroy');
});
Route::controller(SuppliersController::class)->group(function(){
        Route::get('suppliers','index');
        Route::get('suppliers/{suppliers}','show');
       Route::post('suppliers/edit/{id}','update');
        Route::delete('suppliers/{suppliers}','destroy');
        Route::post('suppliers/create','store');
});
Route::controller(PurchaseController::class)->group(function(){
    Route::get('purchase','index');
    Route::post('purchase/create','store');
    Route::get('purchase/{purchase}','show');
    Route::post('purchase/payment/{id}','payment');
    Route::delete('purchase/{purchase}','destroy');
});
Route::controller(PurchaseReturnController::class)->group(function(){
    Route::get('purchasereturn','index');
    Route::post('purchasereturn/create','store');
    Route::get('purchasereturn/{purchasereturn}','show');
    Route::post('purchasereturn/edit/{id}','update');
    Route::delete('purchasereturn/{purchasereturn}','destroy');
});
Route::controller(SalesController::class)->group(function(){
    Route::get('sales','index');
    Route::post('sales/create','store');
    Route::get('sales/{sales}','show');
    Route::post('sales/payment/{id}','payment');
    Route::delete('sales/{sales}','destroy');
});
Route::controller(SalesReturnController::class)->group(function(){
    Route::get('salesreturn','index');
    Route::post('salesreturn/create','store');
    Route::get('salesreturn/{salesreturn}','show');
    Route::post('salesreturn/payment/{id}','payment');
    Route::delete('salesreturn/{salesreturn}','destroy');
});
Route::controller(CustomerController::class)->group(function(){
    Route::get('customer','index');
    Route::post('customer/create','store');
    Route::get('customer/{customer}','show');
    Route::post('customer/edit/{id}','update');
    Route::delete('customer/{customer}','destroy');
});
Route::controller(CategoryController::class)->group(function(){
    Route::get('category','index');
    Route::post('category/create','store');
    Route::get('category/{category}','show');
    Route::post('category/edit/{id}','update');
    Route::delete('category/{category}','destroy');
});
Route::controller(StockController::class)->group(function(){
    Route::get('stock','index');
});
