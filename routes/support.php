<?php
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\GossSupportController;



    Route::middleware('auth')->group(function () {

        Route::get('/support', [GossSupportController::class, "index"])->name('support');
        Route::get('/support/select', [GossSupportController::class, "select"])->name('support_select');
        Route::get('/support/status/{id}', [GossSupportController::class, "status"])->name('support_status');
        Route::get('/support/create', [GossSupportController::class, "create"])->name('support_create');
        Route::get('/support/edit/{id}', [GossSupportController::class, "edit"])->name('support_edit');
        Route::get('/support/print/{id}', [GossSupportController::class, "print"])->name('support_print');
        Route::get('/support/signe/{id}', [GossSupportController::class, "signe"])->name('support_signe');

    });
