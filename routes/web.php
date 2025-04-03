<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\WorkOrderController;
use App\Models\Workorder;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

// Auth Routes
// Route untuk tamu (belum login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::prefix('manajemen-operator')->middleware('auth')->group(function () {
    Route::get('/', [OperatorController::class, 'index'])
        ->name('operator.index');
    Route::get('/create', [OperatorController::class, 'create'])
        ->name('operator.create');
});

Route::prefix('manajemen-workorder')->middleware('auth')->group(function () {
    Route::get('/', [WorkOrderController::class, 'index'])
        ->name('workorder.index');
    Route::get('/create', [WorkOrderController::class, 'create'])
        ->name('workorder.create');
    Route::post('/store', [WorkOrderController::class, 'store'])
        ->name('workorder.store');
    Route::get('/filter', [WorkOrderController::class, 'filterByStatus'])->name('workorder.filter');
    Route::get('/edit/{workorder}', [WorkOrderController::class, 'edit'])->name('workorder.edit');
    Route::get('/delete/{workorder}', [WorkOrderController::class, 'delete'])->name('workorder.delete');
    Route::put('/update/{workorder}', [WorkOrderController::class, 'update'])->name('workorder.update');
    Route::get('/milestone/{workorder}', [WorkOrderController::class, 'milestone'])->name('workorder.milestone');
    Route::get('/exportPdf/{status?}', [WorkOrderController::class, 'exportPdf'])->name('workorder.exportPdf');
});

ROute::prefix('manajemen-operator')->middleware('auth')->group(function () {
    Route::get('/', [OperatorController::class, 'index'])
        ->name('operator.index');
    Route::get('/create', [OperatorController::class, 'create'])
        ->name('operator.create');
    Route::post('/store', [OperatorController::class, 'store'])
        ->name('operator.store');
    Route::get('/edit/{operator}', [OperatorController::class, 'edit'])
        ->name('operator.edit');
    Route::put('/update/{operator}', [OperatorController::class, 'update'])
        ->name('operator.update');
    Route::get('/delete/{operator}', [OperatorController::class, 'delete'])
        ->name('operator.delete');
});