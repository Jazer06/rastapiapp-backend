<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\AuthController;

// Регистрация
Route::post('/register', [AuthController::class, 'register']);

// Авторизация
Route::post('/login', [AuthController::class, 'login']);

// Выход
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

// Тестовый эндпоинт
Route::get('/test', function () {
    return response()->json(['status' => 'ok']);
});
Route::get('/', function () {
    return view('welcome');
});
