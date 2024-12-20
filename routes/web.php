<?php

use App\Http\Controllers\JamPelayananController;
use App\Http\Controllers\AntrianController;
use App\Http\Controllers\AntrianUserController;
use App\Http\Controllers\DaftarLayananController;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PemeriksaanController;
use App\Http\Controllers\User\PemeriksaanController as UserPemeriksaanController;
use App\Http\Controllers\User\ProfileController as UserProfileController;
use App\Models\DaftarLayanan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'dashboard'])->middleware(['auth', 'verified', 'role:Admin|Klinik'])->name('dashboard');
Route::get('/dashboard/pasien', [DashboardController::class, 'dashboardPengguna'])->middleware(['auth', 'verified', 'role:Pasien'])->name('dashboard.pengguna');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::post('/store-daftar-layanan', [DaftarLayananController::class, 'store'])
    ->middleware('savePendaftaranIfNotAuthenticated')
    ->name('User.Layanan.store');

Route::middleware(['auth', 'verified', 'role:Admin|Pasien|Klinik'])->group(function () {

    // User
    // Layanan
    // Router User/Pasien
    Route::group(['as' => "User.", 'middleware' => ['role:Pasien']], function () {
        Route::group(['prefix' => 'layanan', 'as' => "Layanan.",], function () {
            Route::controller(DaftarLayananController::class)->group(function () {
                Route::get('/daftar', 'index')->name('index');
                Route::get('/success', 'success')->name('success');
                Route::get('/tambah-daftar-layanan', 'create')->name('create');
                Route::get('/ubah-daftar-layanan', 'edit')->name('edit');
                Route::get('/detail-daftar-layanan', 'show')->name('show');
                Route::put('/update-daftar-layanan', 'update')->name('update');
                Route::delete('/hapus-daftar-layanan', 'destroy')->name('destroy');
            });
        });
        Route::group(['prefix' => 'antrian', 'as' => "Antrian.",], function () {
            Route::controller(AntrianUserController::class)->group(function () {
                Route::get('/data', 'index')->name('index');
                Route::get('/cetak-antrian/{id}', 'cetakAntrian')->name('cetak');
            });
        });
        Route::group(['prefix' => 'pemeriksaan', 'as' => "Pemeriksaan.",], function () {
            Route::controller(UserPemeriksaanController::class)->group(function () {
                Route::get('/data', 'index')->name('index');
                Route::get('/detail-pemeriksaan', 'show')->name('show');
            });
        });
    });

    Route::group(['prefix' => 'user', 'as' => 'User.'], function () {
        Route::get('/profile', [UserProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [UserProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [UserProfileController::class, 'destroy'])->name('profile.destroy');
    });
    Route::middleware('role:Admin|Klinik')->group(function () {
        // Router Pasien
        Route::group(['prefix' => 'pasien', 'as' => "Pasien.",], function () {
            Route::controller(PasienController::class)->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/tambah-data-pasien', 'create')->name('create');
                Route::get('/ubah-data-pasien', 'edit')->name('edit');
                Route::get('/detail-data-pasien', 'show')->name('show');
                Route::post('/store-data-pasien', 'store')->name('store');
                Route::put('/update-data-pasien', 'update')->name('update');
                Route::delete('/hapus-data-pasien', 'destroy')->name('destroy');
                Route::get('/cetak', 'cetakPDF')->name('cetak');

                // reset password

                Route::get('/reset-password-pasien', 'resetpassword')->middleware(['auth', 'password.confirm'])->name('reset.password');
                Route::post('/reset-password-pasien', 'resetpasswordUpdate')->name('reset.password');
            });
        });

        // Router Layanan
        Route::group(['prefix' => 'layanan', 'as' => "Layanan.",], function () {
            Route::controller(LayananController::class)->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/tambah-data-layanan', 'create')->name('create');
                Route::get('/ubah-data-layanan', 'edit')->name('edit');
                Route::get('/detail-data-layanan', 'show')->name('show');
                Route::post('/store-data-layanan', 'store')->name('store');
                Route::put('/update-data-layanan', 'update')->name('update');
                Route::delete('/hapus-data-layanan', 'destroy')->name('destroy');
            });
        });
        // Router Layanan
        Route::group(['prefix' => 'antrian', 'as' => "Admin.Antrian.",], function () {
            Route::controller(AntrianController::class)->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/ubah-data-antrian', 'edit')->name('edit');
                Route::get('/detail-data-antrian', 'show')->name('show');
                Route::put('/update-data-antrian', 'update')->name('update');
            });
        });

        // Router Layanan
        Route::group(['prefix' => 'pemeriksaan', 'as' => "Pemeriksaan.",], function () {
            Route::controller(PemeriksaanController::class)->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/tambah-data-pemeriksaan', 'create')->name('create');
                Route::get('/ubah-data-pemeriksaan', 'edit')->name('edit');
                Route::get('/detail-data-pemeriksaan', 'show')->name('show');
                Route::post('/store-data-pemeriksaan', 'store')->name('store');
                Route::put('/update-data-pemeriksaan', 'update')->name('update');
                Route::delete('/hapus-data-pemeriksaan', 'destroy')->name('destroy');
            });
        });

        Route::group(['prefix' => 'laporan', 'as' => "Laporan."], function () {
            Route::controller(LaporanController::class)->group(function () {
                Route::get('/q', 'index')->name('index');
                Route::get('/cetak', 'cetakPDF')->name('cetak');
            });
        });




        // Router Tahun Ajar
        Route::group(['prefix' => 'jam-pelayanan', 'as' => "JamPelayanan."], function () {
            Route::controller(JamPelayananController::class)->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/tambah-data/jam-pelayanan', 'create')->name('create');
                Route::get('/edit-data/jam-pelayanan', 'edit')->name('edit');
                Route::get('/detail-data/jam-pelayanan', 'show')->name('show');
                Route::post('/store-data/jam-pelayanan', 'store')->name('store');
                Route::put('/update-data/jam-pelayanan', 'update')->name('update');
                Route::delete('/hapus-data/jam-pelayanan', 'destroy')->name('destroy');
            });
        });
    });
});
