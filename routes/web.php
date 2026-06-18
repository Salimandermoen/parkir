<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\VehicleTypeController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ReportController;

Route::get('/', function () {
    return redirect()->route('transactions.index');
});

// Location Routes
Route::resource('locations', LocationController::class);

// Vehicle Type Routes
Route::resource('vehicle_types', VehicleTypeController::class);

// Transaction Routes
Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
Route::post('/transactions/store', [TransactionController::class, 'store'])->name('transactions.store');
Route::post('/transactions/exit', [TransactionController::class, 'exit'])->name('transactions.exit');
Route::get('/transactions/{transaction}/ticket', [TransactionController::class, 'ticket'])->name('transactions.ticket');
Route::get('/transactions/all', [TransactionController::class, 'allTransactions'])->name('transactions.all');

// Report Routes
Route::get('/reports/location', [ReportController::class, 'location'])->name('reports.location');
Route::get('/reports/transaction', [ReportController::class, 'transaction'])->name('reports.transaction');
