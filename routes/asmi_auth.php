<?php
    use Illuminate\Support\Facades\Route;

    use App\Http\Controllers\Auth\AuthController;

    Route::middleware('auth')->group(function () {
        Route::get('/logout', [AuthController::class, "logout"])->name("logout");
    });

    Route::middleware('guest')->group(function () {
        Route::get('/login', [AuthController::class, "show_login_form"])->name("login");
        Route::post('/login_do', [AuthController::class, "login"])->name("login_do");

        Route::get('/password-recovery', [AuthController::class, "show_passrec_form"])->name("passrec");
        Route::post('/pass_rec_do', [AuthController::class, "pass_req"])->name("pass_rec_do");

        Route::post('/register_do', [AuthController::class, "register"])->name("register_do");
        Route::get('/register', [AuthController::class, "show_register_form"])->name("register");
    });
