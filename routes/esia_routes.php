<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Esia\EsiaController;

Route::get('/esia_get_auth_info', [EsiaController::class, "esia_get_auth_info"])->name('esia_get_auth_info');
Route::get('/esia_error', [EsiaController::class, "esia_error"])->name('esia_error');
