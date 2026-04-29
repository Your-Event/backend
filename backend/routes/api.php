<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\HomePageController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login'])->name('api.auth.login');
Route::post('/register', [AuthController::class, 'register'])->name('api.auth.register');
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/home', [HomePageController::class, 'index'])->name('api.home.index');
    Route::get('/user', [AuthController::class, 'user']);
});
