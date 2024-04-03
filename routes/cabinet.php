<?php
    use Illuminate\Support\Facades\Route;

    use App\Http\Controllers\IndexController;
    use App\Http\Controllers\EventController;


    Route::middleware('auth')->group(function () {
        Route::get('/', [IndexController::class, "index"])->name('home');
        Route::get('/events', [EventController::class, "index"])->name('events');
    });
