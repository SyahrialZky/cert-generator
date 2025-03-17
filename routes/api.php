<?php

use App\Http\Controllers\CertificateController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\TemplateController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->group(function () {
// });

Route::get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('')->group(function () {
    Route::get('/data', [CertificateController::class, 'getData']);
    Route::post('/store', [CertificateController::class, 'store']);
    Route::get('/show/{id}', [CertificateController::class, 'show']);
    Route::put('/update/{id}', [CertificateController::class, 'update']);
    Route::delete('/delete/{id}', [CertificateController::class, 'destroy']);
    Route::post('/generate-certificate', [CertificateController::class, 'generateCertificate']);
    Route::post('/check-certificate-number', [CertificateController::class, 'checkCertificateNumber']);
});

Route::prefix('peserta')->group(function () {
    Route::get('/data', [PesertaController::class, 'getData']);
    Route::post('/store', [PesertaController::class, 'store']);
    Route::put('/{id}', [PesertaController::class, 'update']);
    Route::get('/{id}', [PesertaController::class, 'show']);
    Route::delete('/{id}', [PesertaController::class, 'destroy']);
    Route::post('/import', [PesertaController::class, 'importFile']);
});

Route::prefix('event')->group(function () {
    Route::get('/data', [EventController::class, 'getData']);
    Route::post('/store', [EventController::class, 'store']);
    Route::put('/{id}', [EventController::class, 'update']);
    Route::get('/{id}', [EventController::class, 'show']);
    Route::delete('/{id}', [EventController::class, 'destroy']);
    Route::get('/{id}/peserta', [PesertaController::class, 'dataPeserta']);
});

Route::prefix('template')->group(function () {
    Route::get('/data', [TemplateController::class, 'getData']);
    Route::post('/store', [TemplateController::class, 'store']);
    Route::put('/{id}', [TemplateController::class, 'update']);
    Route::get('/{id}', [TemplateController::class, 'show']);
    Route::delete('/{id}', [TemplateController::class, 'destroy']);
});
