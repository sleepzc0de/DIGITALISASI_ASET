<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KinerjaController;
use App\Http\Controllers\AplikasiBMNController;

// Manajemen BMN Controllers - User
use App\Http\Controllers\ManajemenBMN\PerencanaanBMNController;
use App\Http\Controllers\ManajemenBMN\PemanfaatanBMNController;
use App\Http\Controllers\ManajemenBMN\PemindahtangananBMNController;
use App\Http\Controllers\ManajemenBMN\PenghapusanBMNController;
use App\Http\Controllers\ManajemenBMN\PenatausahaanBMNController;
use App\Http\Controllers\ManajemenBMN\WasdalBMNController;

// Admin Controllers
use App\Http\Controllers\Admin\DashboardAsetController;
use App\Http\Controllers\Admin\KinerjaBMNController;
use App\Http\Controllers\Auth\SsoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// SSO Routes
Route::get('sso/login', [SsoController::class, 'redirectToSSO'])->name('sso.login');
Route::get('sso/callback/login', [SSOController::class, 'handleCallback'])->name('sso.callback');
Route::post('sso/logout', [SSOController::class, 'logout'])->name('sso.logout');
Route::get('sso/logout', [SSOController::class, 'logout']); // Support GET method juga

// Authenticated Routes
Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // User Routes (View Only)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/kinerja', [KinerjaController::class, 'index'])->name('kinerja');

    // Aplikasi BMN Routes (User)
    Route::get('/aplikasi-bmn', [AplikasiBMNController::class, 'index'])->name('aplikasi-bmn.index');
    Route::get('/aplikasi-bmn/{aplikasiBmn}', [AplikasiBMNController::class, 'show'])->name('aplikasi-bmn.show');

    // === MANAJEMEN BMN ROUTES (USER - VIEW ONLY) ===

    // 1. Perencanaan BMN (RP4 & RKBMN)
    Route::prefix('manajemen-bmn/perencanaan')->name('manajemen-bmn.perencanaan.')->group(function () {
        Route::get('/', [PerencanaanBMNController::class, 'index'])->name('index');
        Route::get('/{perencanaan}', [PerencanaanBMNController::class, 'show'])->name('show');
    });

    // 2. Pemanfaatan BMN (SK Sewa, Izin Penghunian, Peta)
    Route::prefix('manajemen-bmn/pemanfaatan')->name('manajemen-bmn.pemanfaatan.')->group(function () {
        Route::get('/', [PemanfaatanBMNController::class, 'index'])->name('index');
        Route::get('/peta', [PemanfaatanBMNController::class, 'peta'])->name('peta');
        Route::get('/{pemanfaatan}', [PemanfaatanBMNController::class, 'show'])->name('show');
    });

    // 3. Pemindahtanganan BMN (Laporan PNBP)
    Route::prefix('manajemen-bmn/pemindahtanganan')->name('manajemen-bmn.pemindahtanganan.')->group(function () {
        Route::get('/', [PemindahtangananBMNController::class, 'index'])->name('index');
        Route::get('/{pemindahtanganan}', [PemindahtangananBMNController::class, 'show'])->name('show');
    });

    // 4. Penghapusan BMN (SK Penghapusan)
    Route::prefix('manajemen-bmn/penghapusan')->name('manajemen-bmn.penghapusan.')->group(function () {
        Route::get('/', [PenghapusanBMNController::class, 'index'])->name('index');
        Route::get('/{penghapusan}', [PenghapusanBMNController::class, 'show'])->name('show');
    });

    // 5. Penatausahaan BMN (Data BMN)
    Route::prefix('manajemen-bmn/penatausahaan')->name('manajemen-bmn.penatausahaan.')->group(function () {
        Route::get('/', [PenatausahaanBMNController::class, 'index'])->name('index');
        Route::get('/{penatausahaan}', [PenatausahaanBMNController::class, 'show'])->name('show');
    });

    // 6. Wasdal BMN (Pelaporan & Sensus BMN)
    Route::prefix('manajemen-bmn/wasdal')->name('manajemen-bmn.wasdal.')->group(function () {
        Route::get('/', [WasdalBMNController::class, 'index'])->name('index');
        Route::get('/{wasdal}', [WasdalBMNController::class, 'show'])->name('show');
    });

    // === ADMIN ROUTES ===
    Route::middleware(['admin','super_admin'])->prefix('admin')->name('admin.')->group(function () {
        // Dashboard & Kinerja
        Route::resource('dashboard-aset', DashboardAsetController::class);
        Route::resource('kinerja-bmn', KinerjaBMNController::class);
        Route::resource('aplikasi-bmn', \App\Http\Controllers\Admin\AplikasiBMNController::class);

         // User Management
         Route::resource('users', \App\Http\Controllers\Admin\UserController::class);

        // === ADMIN MANAJEMEN BMN ROUTES ===
        Route::prefix('manajemen-bmn')->name('manajemen-bmn.')->group(function () {
            // Perencanaan BMN
            Route::resource('perencanaan', \App\Http\Controllers\Admin\ManajemenBMN\PerencanaanBMNController::class);

            // Pemanfaatan BMN
            Route::resource('pemanfaatan', \App\Http\Controllers\Admin\ManajemenBMN\PemanfaatanBMNController::class);

            // Pemindahtanganan BMN
            Route::resource('pemindahtanganan', \App\Http\Controllers\Admin\ManajemenBMN\PemindahtangananBMNController::class);

            // Penghapusan BMN
            Route::resource('penghapusan', \App\Http\Controllers\Admin\ManajemenBMN\PenghapusanBMNController::class);

            // Penatausahaan BMN
            Route::resource('penatausahaan', \App\Http\Controllers\Admin\ManajemenBMN\PenatausahaanBMNController::class);

            // Wasdal BMN
            Route::resource('wasdal', \App\Http\Controllers\Admin\ManajemenBMN\WasdalBMNController::class);
        });
    });
});

require __DIR__.'/auth.php';
