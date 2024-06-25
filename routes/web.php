<?php

use App\Http\Controllers\PasienController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['auth', 'verified',])->group(function () {

    // Router Orang Tua
    Route::group(['prefix' => 'pasien', 'as' => "Pasien.", ], function () {
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
});
