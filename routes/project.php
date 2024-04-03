<?php
    use Illuminate\Support\Facades\Route;

    use App\Http\Controllers\ProjectController;


    Route::middleware('auth')->group(function () {

        Route::get('/projects', [ProjectController::class, "index"])->name('projects');
        Route::get('/projects/status/{id}', [ProjectController::class, "status"])->name('project_status');
        Route::get('/projects/create', [ProjectController::class, "create"])->name('project_create');
        Route::get('/projects/edit/{id}', [ProjectController::class, "edit"])->name('project_edit');
        Route::get('/projects/print/{id}', [ProjectController::class, "print"])->name('project_print');
        Route::get('/projects/signe/{id}', [ProjectController::class, "signe"])->name('project_signe');
    });
