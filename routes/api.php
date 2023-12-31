<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Authenticated Routes
Route::middleware('auth:sanctum')->group(function () {

    Route::get('/category', [ProductController::class, 'getCategory']);

    Route::get('/user', [AuthController::class, 'getUser']);

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::prefix('/product')->group(function () {
        Route::get('/list', [ProductController::class, 'index']);
        Route::get('/count', [ProductController::class, 'countProduct']);
        Route::get('/{id}', [ProductController::class, 'show']);
        Route::post('/create', [ProductController::class, 'store']);
        Route::post('/update/{id}', [ProductController::class, 'update']);
        Route::delete('/delete/{id}', [ProductController::class, 'delete']);
    });
    Route::get('/user/count', [AuthController::class, 'countUser']);
});

//Public Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
