<?php

use App\Http\Controllers\GoskeySignController;

    use Illuminate\Support\Facades\Route;

    Route::middleware('auth')->group(function () {
        Route::get('/goskey/sign_fl', [GoskeySignController::class, "sign_fl"])->name("sign_fl");
        Route::get('/goskey/sign_ul', [GoskeySignController::class, "sign_ul"])->name("sign_ul");
    });
