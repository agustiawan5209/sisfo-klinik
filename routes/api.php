<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiModelController;
use App\Http\Controllers\Api\GrafikController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('get-jadwal-data', [ApiModelController::class, 'getJadwal'])->name('api.jadwal.getJadwal');
Route::get('get-layanan-data/{id}', [ApiModelController::class, 'getLayanan'])->name('api.get.Layanan');
Route::get('get-pendaftaran/{id}', [ApiModelController::class, 'getPendaftaran'])->name('api.get.Pendaftaran');
Route::get('get-pengguna-data/{tahun}', [ApiModelController::class, 'getJumlahPengguna'])->name('api.pengguna.jumlah');


Route::get('antrian-grafik', [GrafikController::class,'allAntrian'])->name('grafik.antrian');
