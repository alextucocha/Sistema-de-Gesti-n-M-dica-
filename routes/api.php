<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Ruta de prueba
Route::get('/test', function () {
    return response()->json(['message' => '¡API funciona!']);
});

// Rutas del UserController
Route::apiResource('users', UserController::class);