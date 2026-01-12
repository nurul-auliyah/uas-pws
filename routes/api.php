<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\FakultasController;
use App\Http\Controllers\Api\ProdiController;
use App\Http\Controllers\Api\KelasController;
use App\Http\Controllers\Api\KelasMahasiswaController;
use App\Http\Controllers\Api\MengajarController;
use App\Http\Controllers\Api\DosenController;
use App\Http\Controllers\Api\MahasiswaController;
use App\Http\Controllers\Api\MataKuliahController;

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

/*
|--------------------------------------------------------------------------
| PROTECTED ROUTES (JWT)
|--------------------------------------------------------------------------
*/
Route::middleware('auth:api')->group(function () {

    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);

    /*
    |--------------------------------------------------------------------------
    | FAKULTAS
    |--------------------------------------------------------------------------
    */
    Route::get('/fakultas', [FakultasController::class, 'index']);
    Route::post('/fakultas', [FakultasController::class, 'store']);
    Route::get('/fakultas/{id}', [FakultasController::class, 'show']);
    Route::put('/fakultas/{id}', [FakultasController::class, 'update']);
    Route::patch('/fakultas/{id}', [FakultasController::class, 'update']);
    Route::delete('/fakultas/{id}', [FakultasController::class, 'destroy']);

    /*
    |--------------------------------------------------------------------------
    | PRODI
    |--------------------------------------------------------------------------
    */
    Route::get('/prodi', [ProdiController::class, 'index']);
    Route::post('/prodi', [ProdiController::class, 'store']);
    Route::get('/prodi/{id}', [ProdiController::class, 'show']);
    Route::put('/prodi/{id}', [ProdiController::class, 'update']);
    Route::patch('/prodi/{id}', [ProdiController::class, 'update']);
    Route::delete('/prodi/{id}', [ProdiController::class, 'destroy']);
    Route::get('/fakultas/{fakultas_id}/prodi', [ProdiController::class, 'byFakultas']);

    /*
    |--------------------------------------------------------------------------
    | KELAS
    |--------------------------------------------------------------------------
    */
    Route::get('/kelas', [KelasController::class, 'index']);
    Route::post('/kelas', [KelasController::class, 'store']);
    Route::get('/kelas/{id}', [KelasController::class, 'show']);
    Route::put('/kelas/{id}', [KelasController::class, 'update']);
    Route::patch('/kelas/{id}', [KelasController::class, 'update']);
    Route::delete('/kelas/{id}', [KelasController::class, 'destroy']);

    /*
    |--------------------------------------------------------------------------
    | KELAS MAHASISWA
    |--------------------------------------------------------------------------
    */
    Route::get('/kelas-mahasiswa', [KelasMahasiswaController::class, 'index']);
    Route::post('/kelas-mahasiswa', [KelasMahasiswaController::class, 'store']);
    Route::get('/kelas-mahasiswa/{id}', [KelasMahasiswaController::class, 'show']);
    Route::put('/kelas-mahasiswa/{id}', [KelasMahasiswaController::class, 'update']);
    Route::patch('/kelas-mahasiswa/{id}', [KelasMahasiswaController::class, 'update']);
    Route::delete('/kelas-mahasiswa/{id}', [KelasMahasiswaController::class, 'destroy']);

    /*
    |--------------------------------------------------------------------------
    | MENGAJAR
    |--------------------------------------------------------------------------
    */
    Route::get('/mengajar', [MengajarController::class, 'index']);
    Route::post('/mengajar', [MengajarController::class, 'store']);
    Route::get('/mengajar/{id}', [MengajarController::class, 'show']);
    Route::put('/mengajar/{id}', [MengajarController::class, 'update']);
    Route::patch('/mengajar/{id}', [MengajarController::class, 'update']);
    Route::delete('/mengajar/{id}', [MengajarController::class, 'destroy']);

    /*
    |--------------------------------------------------------------------------
    | DOSEN
    |--------------------------------------------------------------------------
    */
    Route::get('/dosen', [DosenController::class, 'index']);
    Route::post('/dosen', [DosenController::class, 'store']);
    Route::get('/dosen/{id}', [DosenController::class, 'show']);
    Route::put('/dosen/{id}', [DosenController::class, 'update']);
    Route::patch('/dosen/{id}', [DosenController::class, 'update']);
    Route::delete('/dosen/{id}', [DosenController::class, 'destroy']);

    /*
    |--------------------------------------------------------------------------
    | MAHASISWA
    |--------------------------------------------------------------------------
    */
    Route::get('/mahasiswa', [MahasiswaController::class, 'index']);
    Route::post('/mahasiswa', [MahasiswaController::class, 'store']);
    Route::get('/mahasiswa/{id}', [MahasiswaController::class, 'show']);
    Route::put('/mahasiswa/{id}', [MahasiswaController::class, 'update']);
    Route::patch('/mahasiswa/{id}', [MahasiswaController::class, 'update']);
    Route::delete('/mahasiswa/{id}', [MahasiswaController::class, 'destroy']);

    /*
    |--------------------------------------------------------------------------
    | MATA KULIAH
    |--------------------------------------------------------------------------
    */
    Route::get('/mata-kuliah', [MataKuliahController::class, 'index']);
    Route::post('/mata-kuliah', [MataKuliahController::class, 'store']);
    Route::get('/mata-kuliah/{id}', [MataKuliahController::class, 'show']);
    Route::put('/mata-kuliah/{id}', [MataKuliahController::class, 'update']);
    Route::patch('/mata-kuliah/{id}', [MataKuliahController::class, 'update']);
    Route::delete('/mata-kuliah/{id}', [MataKuliahController::class, 'destroy']);
});
