<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\ProductController;

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


$prefix = "/v1/";
Route::post($prefix . 'addProduct', [ProductController::class, 'addProduct']);
Route::post($prefix . 'updateProduct', [ProductController::class, 'updateProduct']);
Route::post($prefix . 'uploadProductImage', [ProductController::class, 'uploadProductImage']);
Route::get($prefix . 'getProducts', [ProductController::class, 'getProducts']);
Route::get($prefix . 'getProduct/{id}', [ProductController::class, 'getProduct']);
Route::get($prefix . 'deleteProduct/{id}', [ProductController::class, 'deleteProduct']);

Route::post($prefix . 'addProductToUser', [ProductController::class, 'addProductToUser']);
Route::post($prefix . 'removeProductToUser', [ProductController::class, 'removeProductToUser']);
Route::get($prefix . 'getProductsForUser/{id}', [ProductController::class, 'getProductsForUser']);

