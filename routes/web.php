<?php

use App\Http\Controllers\AntrianUserController;
use App\Http\Controllers\DaftarLayananController;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PemeriksaanController;
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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('home');


Route::get('/validate-user', [DashboardController::class, 'validate'])->middleware(['auth', 'verified'])->name('validate');
// Dashboard
Route::get('/dashboard', [DashboardController::class, 'dashboard'])->middleware(['auth', 'verified', 'role:Admin'])->name('dashboard');
Route::get('/dashboard/pasien', [DashboardController::class, 'dashboardPengguna'])->middleware(['auth', 'verified', 'role:Pasien'])->name('dashboard.pengguna');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::middleware(['auth', 'verified',])->group(function () {

    // User
    // Layanan
    // Router Pasien
    Route::group(['as' => "User.",], function () {
        Route::group(['prefix' => 'layanan', 'as' => "Layanan.",], function () {
            Route::controller(DaftarLayananController::class)->group(function () {
                Route::get('/daftar', 'index')->name('index');
                Route::get('/success', 'success')->name('success');
                Route::get('/tambah-daftar-layanan', 'create')->name('create');
                Route::get('/ubah-daftar-layanan', 'edit')->name('edit');
                Route::get('/detail-daftar-layanan', 'show')->name('show');
                Route::post('/store-daftar-layanan', 'store')->name('store');
                Route::put('/update-daftar-layanan', 'update')->name('update');
                Route::delete('/hapus-daftar-layanan', 'destroy')->name('destroy');

            });
        });
        Route::group(['prefix' => 'antrian', 'as' => "Antrian.",], function () {
            Route::controller(AntrianUserController::class)->group(function () {
                Route::get('/daftar', 'index')->name('index');

            });
        });
    });


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
});
