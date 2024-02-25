<?php
    use Illuminate\Support\Facades\Route;

    use App\Http\Controllers\ProjectController;
    use App\Http\Controllers\TechnicalConnectController;
    use App\Http\Controllers\GossSupportController;
    use App\Http\Controllers\IndexController;


    Route::middleware('auth')->group(function () {
        Route::get('/', [IndexController::class, "index"])->name('home');
    });
