<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

Route::prefix('/login')->group(function () {
    Route::get('/', [AuthController::class, 'create']);
    Route::post('/', [AuthController::class, 'store']);
});

// Route::get('/logout', [AuthController::class, 'logout']);