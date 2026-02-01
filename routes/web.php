<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KinerjaController;
use App\Http\Controllers\Admin\DashboardAsetController;
use App\Http\Controllers\Admin\KinerjaBMNController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Authenticated Routes
Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // User Routes (View Only)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/kinerja', [KinerjaController::class, 'index'])->name('kinerja');

    // Admin Routes
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::resource('dashboard-aset', DashboardAsetController::class);
        Route::resource('kinerja-bmn', KinerjaBMNController::class);
    });
});

require __DIR__.'/auth.php';
