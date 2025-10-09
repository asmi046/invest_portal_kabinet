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
        Route::post('/save', [LandLeaseApplicationController::class, "save"])->name('lend_lease.save');
        Route::get('/delete/{id}', [LandLeaseApplicationController::class, "delete"])->name('lend_lease.delete');
        Route::get('/print/{id}', [LandLeaseApplicationController::class, "print"])->name('lend_lease.print');
    });

    Route::middleware('auth')->prefix('lend_auction')->group(function () {
        Route::get('/', [LandAuctionApplicationController::class, 'index'])->name('lend_auction.index');
        Route::get('/edit/{id}', [LandAuctionApplicationController::class, 'edit'])->name('lend_auction.edit');
        Route::get('/create', [LandAuctionApplicationController::class, 'create'])->name('lend_auction.create');
        Route::post('/save', [LandAuctionApplicationController::class, "save"])->name('lend_auction.save');
        Route::get('/delete/{id}', [LandAuctionApplicationController::class, "delete"])->name('lend_auction.delete');
        Route::get('/print/{id}', [LandAuctionApplicationController::class, "print"])->name('lend_auction.print');
    });

    Route::middleware('auth')->prefix('construction_permit')->group(function () {
        Route::get('/', [ConstructionPermitController::class, 'index'])->name('construction_permit.index');
        Route::get('/edit/{id}', [ConstructionPermitController::class, 'edit'])->name('construction_permit.edit');
        Route::get('/create', [ConstructionPermitController::class, 'create'])->name('construction_permit.create');
        Route::post('/save', [ConstructionPermitController::class, "save"])->name('construction_permit.save');
        Route::get('/delete/{id}', [ConstructionPermitController::class, "delete"])->name('construction_permit.delete');
        Route::get('/print/{id}', [ConstructionPermitController::class, "print"])->name('construction_permit.print');
    });

    Route::middleware('auth')->prefix('gas_connection')->group(function () {
        Route::get('/', [GasConnectionController::class, 'index'])->name('gas_connection.index');
        Route::get('/edit/{id}', [GasConnectionController::class, 'edit'])->name('gas_connection.edit');
        Route::get('/create', [GasConnectionController::class, 'create'])->name('gas_connection.create');
        Route::post('/save', [GasConnectionController::class, "save"])->name('gas_connection.save');
        Route::get('/delete/{id}', [GasConnectionController::class, "delete"])->name('gas_connection.delete');
        Route::get('/print/{id}', [GasConnectionController::class, "print"])->name('gas_connection.print');
    });

    Route::middleware('auth')->prefix('heat_connection')->group(function () {
        Route::get('/', [HeatConnectionController::class, 'index'])->name('heat_connection.index');
        Route::get('/edit/{id}', [HeatConnectionController::class, 'edit'])->name('heat_connection.edit');
        Route::get('/create', [HeatConnectionController::class, 'create'])->name('heat_connection.create');
        Route::post('/save', [HeatConnectionController::class, "save"])->name('heat_connection.save');
        Route::get('/delete/{id}', [HeatConnectionController::class, "delete"])->name('heat_connection.delete');
        Route::get('/print/{id}', [HeatConnectionController::class, "print"])->name('heat_connection.print');
    });

    Route::middleware('auth')->prefix('water_connection')->group(function () {
        Route::get('/', [WaterConnectionController::class, 'index'])->name('water_connection.index');
        Route::get('/edit/{id}', [WaterConnectionController::class, 'edit'])->name('water_connection.edit');
        Route::get('/create', [WaterConnectionController::class, 'create'])->name('water_connection.create');
        Route::post('/save', [WaterConnectionController::class, "save"])->name('water_connection.save');
        Route::get('/delete/{id}', [WaterConnectionController::class, "delete"])->name('water_connection.delete');
        Route::get('/print/{id}', [WaterConnectionController::class, "print"])->name('water_connection.print');
    });

    Route::middleware('auth')->prefix('commissioning_permit')->group(function () {
        Route::get('/', [CommissioningPermitController::class, 'index'])->name('commissioning_permit.index');
        Route::get('/edit/{id}', [CommissioningPermitController::class, 'edit'])->name('commissioning_permit.edit');
        Route::get('/create', [CommissioningPermitController::class, 'create'])->name('commissioning_permit.create');
        Route::post('/save', [CommissioningPermitController::class, "save"])->name('commissioning_permit.save');
        Route::get('/delete/{id}', [CommissioningPermitController::class, "delete"])->name('commissioning_permit.delete');
        Route::get('/print/{id}', [CommissioningPermitController::class, "print"])->name('commissioning_permit.print');
    });
