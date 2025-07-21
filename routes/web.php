<?php

use Illuminate\Support\Facades\Route;

// routes/web.php

use App\Http\Controllers\BlowfishController;

Route::get('/', [BlowfishController::class, 'index']);
Route::post('/encrypt-text', [BlowfishController::class, 'encryptText']);
Route::post('/decrypt-text', [BlowfishController::class, 'decryptText']);
Route::post('/encrypt-file', [BlowfishController::class, 'encryptFile']);
Route::post('/decrypt-file', [BlowfishController::class, 'decryptFile']);


