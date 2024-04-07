<?php

use App\Http\Controllers\AlgorithmController;
use App\Http\Controllers\OrganizationContactController;

use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
        Route::get('/technical_connect_algoritm', [AlgorithmController::class, "index"])->name('information_algoritm');
        Route::get('/technical_connect_org_list', [OrganizationContactController::class, "index"])->name('information_org_list');
});
