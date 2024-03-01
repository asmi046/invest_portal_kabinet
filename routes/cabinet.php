<?php
    use Illuminate\Support\Facades\Route;

    use App\Http\Controllers\ProjectController;
    use App\Http\Controllers\TechnicalConnectController;
    use App\Http\Controllers\GossSupportController;
    use App\Http\Controllers\IndexController;
    use App\Http\Controllers\EventController;


    Route::middleware('auth')->group(function () {
        Route::get('/', [IndexController::class, "index"])->name('home');
        Route::get('/events', [EventController::class, "index"])->name('events');

        Route::get('/projects', [ProjectController::class, "index"])->name('projects');
        Route::get('/projects/status/{id}', [ProjectController::class, "status"])->name('project_status');
        Route::get('/projects/create', [ProjectController::class, "create"])->name('project_create');
        Route::get('/projects/edit/{id}', [ProjectController::class, "edit"])->name('project_edit');
        Route::get('/projects/print/{id}', [ProjectController::class, "print"])->name('project_print');
        Route::get('/projects/signe/{id}', [ProjectController::class, "signe"])->name('project_signe');


        Route::get('/support', [GossSupportController::class, "index"])->name('support');
        Route::get('/support/select', [GossSupportController::class, "select"])->name('support_select');
        Route::get('/support/status/{id}', [GossSupportController::class, "status"])->name('support_status');
        Route::get('/support/create', [GossSupportController::class, "create"])->name('support_create');
        Route::get('/support/edit/{id}', [GossSupportController::class, "edit"])->name('support_edit');
        Route::get('/support/print/{id}', [GossSupportController::class, "print"])->name('support_print');
        Route::get('/support/signe/{id}', [GossSupportController::class, "signe"])->name('support_signe');

        Route::get('/technical_connect', [TechnicalConnectController::class, "index"])->name('technical_connect');
        Route::get('/technical_connect_algoritm', [TechnicalConnectController::class, "algoritm"])->name('technical_connect_algoritm');
        Route::get('/technical_connect_org_list', [TechnicalConnectController::class, "org_list"])->name('technical_connect_org_list');
        Route::get('/technical_connect/status/{id}', [GossSupportController::class, "status"])->name('technical_connect_status');
        Route::get('/technical_connect/create', [TechnicalConnectController::class, "create"])->name('technical_connect_create');
        Route::get('/technical_connect/edit/{id}', [TechnicalConnectController::class, "edit"])->name('technical_connect_edit');
        Route::get('/technical_connect/print/{id}', [TechnicalConnectController::class, "print"])->name('technical_connect_print');
        Route::get('/technical_connect/signe/{id}', [TechnicalConnectController::class, "signe"])->name('technical_connect_signe');
    });
