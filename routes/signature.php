<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SignatureController;


Route::middleware('auth')->group(function () {
    Route::get('/signe/{file_id}', [SignatureController::class, "signe"])->name('signe');
    Route::post('/load_signed_file', [SignatureController::class, "load_signed_file"])->name('load_signed_file');
});

