<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\IndexController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('auth')->group(function () {
    Route::get('/my-project', [IndexController::class, "myProject"])->name('myProject');
    Route::get('/application-catalog', [IndexController::class, "applicationСatalog"])->name('applicationСatalog');
    Route::get('/statement', [IndexController::class, "statement"])->name('statement');

    Route::get('/auth', [IndexController::class, "auth"])->name('auth');
    Route::get('/registration', [IndexController::class, "registration"])->name('registration');
    Route::get('/password-recovery', [IndexController::class, "passwordRecovery"])->name('passwordRecovery');
    Route::get('/test', [IndexController::class, "test"])->name('test');

    Route::get('/signe/{file_id}', [IndexController::class, "signe"])->name('signe');
    Route::post('/load_signed_file', [IndexController::class, "load_signed_file"])->name('load_signed_file');

});

