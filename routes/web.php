<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Middleware\CheckIsLogged;
use App\Http\Middleware\CheckIsNotLogged;
use Illuminate\Support\Facades\Route;

Route::middleware([CheckIsNotLogged::class])->group(function () {
    Route::prefix('login')->group(function () {
        Route::get('/', [AuthController::class, 'create'])->name('login');
        Route::post('/', [AuthController::class, 'store']);
    });
});

Route::middleware([CheckIsLogged::class])->group(function () {
    Route::get('/', [MainController::class, 'index'])->name('home');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::prefix('notas')->group(function () {
        Route::get('/criar', [MainController::class, 'createNote'])->name('new');
    });
});
