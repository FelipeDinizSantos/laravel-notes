<?php

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

Route::redirect('/', 'index');

Route::get('/index', function (Request $request) {
    return response()->json([
        'message' => 'hello, world!',
        'success' => true
    ]);
});

