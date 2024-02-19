<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Esia\EsiaController;

Route::get('/esia_get_auth_lnk', [EsiaController::class, "esia_get_auth_lnk"])->name('esia_get_auth_lnk');
Route::get('/esia_get_token', [EsiaController::class, "esia_get_token"])->name('esia_get_token');
Route::get('/esia_callbac', [EsiaController::class, "esia_callbac"])->name('esia_callbac');
