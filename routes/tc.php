<?php

    use App\Http\Controllers\TechnicalConnect\TechnicalConnectEditController;
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\TechnicalConnect\TechnicalConnectController;

    Route::middleware('auth')->group(function () {
        Route::get('/technical_connect', [TechnicalConnectController::class, "index"])->name('technical_connect');
        Route::get('/technical_connect_algoritm', [TechnicalConnectController::class, "algoritm"])->name('technical_connect_algoritm');
        Route::get('/technical_connect_org_list', [TechnicalConnectController::class, "org_list"])->name('technical_connect_org_list');
        Route::get('/technical_connect/status/{id}', [GossSupportController::class, "status"])->name('technical_connect_status');
        Route::get('/technical_connect/create', [TechnicalConnectController::class, "create"])->name('technical_connect_create');
        Route::get('/technical_connect/edit/{id}', [TechnicalConnectController::class, "edit"])->name('technical_connect_edit');
        Route::get('/technical_connect/print/{id}', [TechnicalConnectController::class, "print"])->name('technical_connect_print');
        Route::get('/technical_connect/signe/{id}', [TechnicalConnectController::class, "signe"])->name('technical_connect_signe');

        Route::post('/technical_connect/save', [TechnicalConnectEditController::class, "save"])->name('technical_connect_save');
        Route::get('/technical_connect/delete/{id}', [TechnicalConnectEditController::class, "delete"])->name('technical_connect_delete');
    });
