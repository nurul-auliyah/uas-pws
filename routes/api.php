<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\KelasController;
use App\Http\Controllers\Api\KelasMahasiswaController;
use App\Http\Controllers\Api\MengajarController;
use App\Http\Controllers\Api\FakultasController;
use App\Http\Controllers\Api\ProdiController;
use App\Http\Controllers\Api\DosenController;
use App\Http\Controllers\Api\MahasiswaController;
use App\Http\Controllers\Api\MataKuliahController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);

    //fakultas//   
    Route::get('/fakultas', [FakultasController::class, 'index']);
    Route::post('/fakultas', [FakultasController::class, 'store']);
    Route::get('/fakultas/{id}', [FakultasController::class, 'show']);
    Route::put('/fakultas/{id}', [FakultasController::class, 'update']);
    Route::patch('/fakultas/{id}', [FakultasController::class, 'update']);
    Route::delete('/fakultas/{id}', [FakultasController::class, 'destroy']);

    // CRUD Prodi
    Route::get('/prodi', [ProdiController::class, 'index']);
    Route::post('/prodi', [ProdiController::class, 'store']);
    Route::get('/prodi/{id}', [ProdiController::class, 'show']);
    Route::put('/prodi/{id}', [ProdiController::class, 'update']);
    Route::patch('/prodi/{id}', [ProdiController::class, 'patch']);
    Route::delete('/prodi/{id}', [ProdiController::class, 'destroy']);
    // Prodi by Fakultas
    Route::get('/fakultas/{fakultas_id}/prodi', [ProdiController::class, 'byFakultas']);

    //Kelas//
    Route::get('/', [KelasController::class, 'index']);
    Route::post('/', [KelasController::class, 'store']);
    Route::get('/{id}', [KelasController::class, 'show']);
    Route::put('/{id}', [KelasController::class, 'update']);
    Route::delete('/{id}', [KelasController::class, 'destroy']);

    //Kelas mahasiswa//
    Route::get('/', [KelasMahasiswaController::class, 'index']);
    Route::post('/', [KelasMahasiswaController::class, 'store']);
    Route::get('/{id}', [KelasMahasiswaController::class, 'show']);
    Route::put('/{id}', [KelasMahasiswaController::class, 'update']);
    Route::delete('/{id}', [KelasMahasiswaController::class, 'destroy']);

    //mengajar//
    Route::get('/', [MengajarController::class, 'index']);
    Route::post('/', [MengajarController::class, 'store']);
    Route::get('/{id}', [MengajarController::class, 'show']);
    Route::put('/{id}', [MengajarController::class, 'update']);
    Route::delete('/{id}', [MengajarController::class, 'destroy']);

    //Dosen//
    Route::get('/dosen', [DosenController::class, 'index']);
    Route::post('/dosen', [DosenController::class, 'store']);
    Route::get('/dosen/{id}', [DosenController::class, 'show']);
    Route::put('/dosen/{id}', [DosenController::class, 'update']);
    Route::delete('/dosen/{id}', [DosenController::class, 'destroy']);

    //Mahasiswa//
    Route::get('/mahasiswa', [MahasiswaController::class, 'index']);
    Route::post('/mahasiswa', [MahasiswaController::class, 'store']);
    Route::get('/mahasiswa/{id}', [MahasiswaController::class, 'show']);
    Route::put('/mahasiswa/{id}', [MahasiswaController::class, 'update']);
    Route::delete('/mahasiswa/{id}', [MahasiswaController::class, 'destroy']);

    //Mata Kuliah//
    Route::get('/mata-kuliah', [MataKuliahController::class, 'index']);
    Route::post('/mata-kuliah', [MataKuliahController::class, 'store']);
    Route::get('/mata-kuliah/{id}', [MataKuliahController::class, 'show']);
    Route::put('/mata-kuliah/{id}', [MataKuliahController::class, 'update']);
    Route::delete('/mata-kuliah/{id}', [MataKuliahController::class, 'destroy']);
});
