<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/task', [TaskController::class, 'index']);
    Route::post('/storetask', [TaskController::class, 'store']);
    Route::put('/updatetask/{id}', [TaskController::class, 'update']);
    Route::delete('/deletetask/{id}', [TaskController::class, 'destroy']);
    Route::get('/findtask/{id}',[TaskController::class, 'show']);
});

//User
Route::get('/api/user', [UserController::class, 'index']);
Route::post('/api/storeuser', [UserController::class, 'store']);
Route::put('/api/updateuser/{id}', [UserController::class, 'update']);
Route::delete('/api/deleteuser/{id}', [UserController::class, 'destroy']);
Route::get('/api/finduser/{id}',[UserController::class, 'show']);

//Producto
Route::get('/api/product', [ProductController::class, 'index']);
Route::get('/products', [ProductController::class, 'index']);
Route::post('/api/storeproduct', [ProductController::class, 'store']);
Route::put('/api/updateproduct/{id}', [ProductController::class, 'update']);
Route::delete('/api/deleteproduct/{id}', [ProductController::class, 'destroy']);
Route::get('/api/finduproduct/{id}',[ProductController::class, 'show']);
Route::get('/api/searchproduct',[ProductController::class, 'search'])->name('product.search');;

