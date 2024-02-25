<?php
    use Illuminate\Support\Facades\Route;

    use App\Http\Controllers\ProjectController;
    use App\Http\Controllers\TechnicalConnectController;
    use App\Http\Controllers\GossSupportController;
    use App\Http\Controllers\IndexController;


    Route::middleware('auth')->group(function () {
        Route::get('/', [IndexController::class, "index"])->name('home');

        Route::get('/projects', [ProjectController::class, "index"])->name('projects');
        Route::get('/projects/create', [ProjectController::class, "index"])->name('project_create');
        Route::get('/projects/edit/{id}', [ProjectController::class, "index"])->name('project_edit');

        Route::get('/support', [GossSupportController::class, "index"])->name('support');
        Route::get('/support/create', [GossSupportController::class, "create"])->name('support_create');
        Route::get('/support/edit/{id}', [GossSupportController::class, "edit"])->name('support_edit');

        Route::get('/technical_connect', [TechnicalConnectController::class, "index"])->name('technical_connect');
        Route::get('/technical_connect/select', [TechnicalConnectController::class, "select"])->name('technical_connect_select');
        Route::get('/technical_connect/create', [TechnicalConnectController::class, "create"])->name('technical_connect_create');
        Route::get('/technical_connect/edit/{id}', [TechnicalConnectController::class, "edit"])->name('technical_connect_edit');
    });
