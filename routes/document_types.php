<?php

use App\Http\Controllers\GasConnectionController;
use App\Http\Controllers\HeatConnectionController;
use App\Http\Controllers\WaterConnectionController;
use App\Http\Controllers\ConstructionPermitController;
use App\Http\Controllers\CommissioningPermitController;
use App\Http\Controllers\LandLeaseApplicationController;
use App\Http\Controllers\LandAuctionApplicationController;
    use Illuminate\Support\Facades\Route;

    use App\Http\Controllers\AreaGet\AreaGetController;
    use App\Http\Controllers\AreaGet\AreaGetEditController;


    Route::middleware('auth')->prefix('lend_lease')->group(function () {
        Route::get('/', [LandLeaseApplicationController::class, 'index'])->name('lend_lease.index');
        Route::get('/edit/{id}', [LandLeaseApplicationController::class, 'edit'])->name('lend_lease.edit');
        Route::get('/create', [LandLeaseApplicationController::class, 'create'])->name('lend_lease.create');
    });

    Route::middleware('auth')->prefix('lend_auction')->group(function () {
        Route::get('/', [LandAuctionApplicationController::class, 'index'])->name('lend_auction.index');
        Route::get('/edit/{id}', [LandAuctionApplicationController::class, 'edit'])->name('lend_auction.edit');
        Route::get('/create', [LandAuctionApplicationController::class, 'create'])->name('lend_auction.create');
    });

    Route::middleware('auth')->prefix('construction_permit')->group(function () {
        Route::get('/', [ConstructionPermitController::class, 'index'])->name('construction_permit.index');
        Route::get('/edit/{id}', [ConstructionPermitController::class, 'edit'])->name('construction_permit.edit');
        Route::get('/create', [ConstructionPermitController::class, 'create'])->name('construction_permit.create');
    });

    Route::middleware('auth')->prefix('gas_connection')->group(function () {
        Route::get('/', [GasConnectionController::class, 'index'])->name('gas_connection.index');
        Route::get('/edit/{id}', [GasConnectionController::class, 'edit'])->name('gas_connection.edit');
        Route::get('/create', [GasConnectionController::class, 'create'])->name('gas_connection.create');
    });

    Route::middleware('auth')->prefix('heat_connection')->group(function () {
        Route::get('/', [HeatConnectionController::class, 'index'])->name('heat_connection.index');
        Route::get('/edit/{id}', [HeatConnectionController::class, 'edit'])->name('heat_connection.edit');
        Route::get('/create', [HeatConnectionController::class, 'create'])->name('heat_connection.create');
    });

    Route::middleware('auth')->prefix('water_connection')->group(function () {
        Route::get('/', [WaterConnectionController::class, 'index'])->name('water_connection.index');
        Route::get('/edit/{id}', [WaterConnectionController::class, 'edit'])->name('water_connection.edit');
        Route::get('/create', [WaterConnectionController::class, 'create'])->name('water_connection.create');
    });

    Route::middleware('auth')->prefix('commissioning_permit')->group(function () {
        Route::get('/', [CommissioningPermitController::class, 'index'])->name('commissioning_permit.index');
        Route::get('/edit/{id}', [CommissioningPermitController::class, 'edit'])->name('commissioning_permit.edit');
        Route::get('/create', [CommissioningPermitController::class, 'create'])->name('commissioning_permit.create');
    });
