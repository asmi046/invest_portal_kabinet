<?php
    use Illuminate\Support\Facades\Route;

    use App\Http\Controllers\Auth\AuthController;
    use Illuminate\Foundation\Auth\EmailVerificationRequest;

    Route::middleware('auth')->group(function () {
        Route::get('/logout', [AuthController::class, "logout"])->name("logout");

        Route::get('/welcom', [AuthController::class, "welcom"])->name("verification.notice");
        Route::post('/email/verification-notification', function (Request $request) {
            $request->user()->sendEmailVerificationNotification();

            return back()->with('message', 'Ссылка повторно отправлена!');
        })->middleware(['auth', 'throttle:6,1'])->name('verification.send');

        Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
            $request->fulfill();

            return redirect()->route('home');
        })->middleware(['auth', 'signed'])->name('verification.verify');

    });

    Route::middleware('guest')->group(function () {
        Route::get('/login', [AuthController::class, "show_login_form"])->name("login");
        Route::post('/login_do', [AuthController::class, "login"])->name("login_do");

        Route::get('/password-recovery', [AuthController::class, "show_passrec_form"])->name("passrec");
        Route::post('/pass_rec_do', [AuthController::class, "pass_req"])->name("pass_rec_do");

        Route::post('/register_do', [AuthController::class, "register"])->name("register_do");
        Route::get('/register', [AuthController::class, "show_register_form"])->name("register");
    });
