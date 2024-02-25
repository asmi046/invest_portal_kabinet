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
    });
