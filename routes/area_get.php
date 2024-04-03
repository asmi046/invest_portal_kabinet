<?php
    use Illuminate\Support\Facades\Route;

    use App\Http\Controllers\AreaGet\AreaGetController;
    use App\Http\Controllers\AreaGet\AreaGetEditController;


    Route::middleware('auth')->group(function () {

        Route::get('/area_get', [AreaGetController::class, "index"])->name('area_get');
        Route::get('/area_get/status/{id}', [AreaGetController::class, "status"])->name('area_get_status');
        Route::get('/area_get/create', [AreaGetController::class, "create"])->name('area_get_create');
        Route::get('/area_get/edit/{id}', [AreaGetController::class, "edit"])->name('area_get_edit');
        Route::get('/area_get/print/{id}', [AreaGetController::class, "print"])->name('area_get_print');
        Route::get('/area_get/signe/{id}', [AreaGetController::class, "signe"])->name('area_get_signe');

        Route::post('/area_get/save', [AreaGetEditController::class, "save"])->name('area_get_save');
        Route::get('/area_get/delete/{id}', [AreaGetEditController::class, "delete"])->name('area_get_delete');
    });
