<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TemplateController;
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

// Route::get('/', function () {
//     return view('index');
// })->middleware(['auth'])->name('home');

Route::get('/', function () {
    return view('pages.checker.index');
})->name('home');


Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'login')->name('login');
    Route::post('/login', 'CheckUser')->name('login-user');
    Route::post('/logout', 'logout')->name('logout');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/certificate', [CertificateController::class, 'index'])->name('certificate.index');
    Route::get('/template', [TemplateController::class, 'index'])->name('template.index');
    Route::get('/peserta', [PesertaController::class, 'index'])->name('peserta.index');
    Route::get('/event', [EventController::class, 'index'])->name('event.index');
    Route::get('/event/{id}/peserta', [EventController::class, 'viewPeserta'])->name('event.peserta');
});
