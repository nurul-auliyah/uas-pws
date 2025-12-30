<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\FakultasController;
use App\Http\Controllers\Api\ProdiController;

Route::get('/fakultas', [FakultasController::class, 'index']);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
});

// Route::middleware('auth:api')->group(function () {
//     Route::get('/fakultas', [FakultasController::class, 'index']);
// });
Route::middleware('auth:api')->group(function () {
    Route::get('/fakultas', [FakultasController::class, 'index']);
    Route::post('/fakultas', [FakultasController::class, 'store']);
    Route::get('/fakultas/{id}', [FakultasController::class, 'show']);
    Route::put('/fakultas/{id}', [FakultasController::class, 'update']);
    Route::patch('/fakultas/{id}', [FakultasController::class, 'update']);
    Route::delete('/fakultas/{id}', [FakultasController::class, 'destroy']);
});


Route::middleware('auth:api')->group(function () {

    // CRUD Prodi
    Route::get('/prodi', [ProdiController::class, 'index']);
    Route::post('/prodi', [ProdiController::class, 'store']);
    Route::get('/prodi/{id}', [ProdiController::class, 'show']);
    Route::put('/prodi/{id}', [ProdiController::class, 'update']);
    Route::patch('/prodi/{id}', [ProdiController::class, 'patch']);
    Route::delete('/prodi/{id}', [ProdiController::class, 'destroy']);

    // Prodi by Fakultas
    Route::get('/fakultas/{fakultas_id}/prodi', [ProdiController::class, 'byFakultas']);
});


