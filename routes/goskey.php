<?php

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\GoskeySignController;

    use Illuminate\Support\Facades\Route;

    Route::middleware('auth')->group(function () {
        Route::get('/goskey/ukep_info', [GoskeySignController::class, "ukep_info"])->name("ukep_info");
        Route::get('/goskey/ukep_info_ul', [GoskeySignController::class, "ukep_info_ul"])->name("ukep_info_ul");
        Route::get('/goskey/sign_fl', [GoskeySignController::class, "sign_fl"])->name("sign_fl");
        Route::get('/goskey/sign_ul', [GoskeySignController::class, "sign_ul"])->name("sign_ul");
        Route::get('/goskey/get_sign_state', [GoskeySignController::class, "get_sign_state"])->name("get_sign_state");


    });

    Route::get('/goskey/download/{filename}', [GoskeySignController::class, "download"])->middleware('auth.either')->name("sign_download")->where('filename', '.*');

