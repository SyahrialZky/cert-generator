<?php

use App\Http\Controllers\CertificateController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Route::apiResource('certificates', CertificateController::class);
// Route::apiResource('templates', TemplateController::class);

// Route::post('/generate-certificate', [CertificateController::class, 'generateCertificate']);
Route::post('/generate-certificate', [CertificateController::class, 'generateCertificate']);
// Route::apiResource('certificates', CertificateController::class);
// Route::apiResource('templates', TemplateController::class);
