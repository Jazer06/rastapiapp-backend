<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
// Регистрация
Route::post('/register', [AuthController::class, 'register']);

// Авторизация
Route::post('/login', [AuthController::class, 'login']);

// Выход
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

// Заявки
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/orders', [OrderController::class, 'store']);
    Route::get('/orders', [OrderController::class, 'index']);
});