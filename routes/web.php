<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'login')->name('login');
    Route::post('/login', 'CheckUser')->name('login-user');
    Route::post('/logout', 'logout')->name('logout');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/', [CertificateController::class, 'index'])->name('home');
    Route::get('/data', [CertificateController::class, 'getData'])->name('certificates.data');
    Route::post('/store', [CertificateController::class, 'store'])->name('certificates.store');
    Route::get('/show/{id}', [CertificateController::class, 'show'])->name('certificates.show');
    Route::put('/update/{id}', [CertificateController::class, 'update'])->name('certificates.update');
    Route::delete('/delete/{id}', [CertificateController::class, 'destroy'])->name('certificates.destroy');

    Route::prefix('peserta')->group(function () {
        Route::get('/', [PesertaController::class, 'index'])->name('peserta.index');
        Route::get('/data', [PesertaController::class, 'getData'])->name('peserta.data');
    });

    Route::prefix('event')->group(function () {
        Route::get('/', [EventController::class, 'index'])->name('event.index');
        Route::get('/data', [EventController::class, 'getData'])->name('event.data');
        Route::post('/store', [EventController::class, 'store'])->name('event.store');
        Route::post('/{id}', [EventController::class, 'update'])->name('event.update');
        Route::delete('/{id}', [EventController::class, 'destroy'])->name('event.destroy');
    });
});
