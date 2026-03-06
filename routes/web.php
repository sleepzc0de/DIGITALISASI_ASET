<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KinerjaController;
use App\Http\Controllers\AplikasiBMNController;
use App\Http\Controllers\ManajemenBMN\PerencanaanBMNController;
use App\Http\Controllers\ManajemenBMN\PemanfaatanBMNController;
use App\Http\Controllers\ManajemenBMN\PemindahtangananBMNController;
use App\Http\Controllers\ManajemenBMN\PenghapusanBMNController;
use App\Http\Controllers\ManajemenBMN\PenatausahaanBMNController;
use App\Http\Controllers\ManajemenBMN\WasdalBMNController;
use App\Http\Controllers\Admin\DashboardAsetController;
use App\Http\Controllers\Admin\KinerjaBMNController;
use App\Http\Controllers\Auth\SsoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// ── SSO Routes ───────────────────────────────────────────────────
Route::get('sso/login', [SsoController::class, 'redirectToSSO'])->name('sso.login');
Route::get('sso/callback/login', [SsoController::class, 'handleCallback'])->name('sso.callback');
Route::post('sso/logout', [SsoController::class, 'logout'])->name('sso.logout');
Route::get('sso/logout', [SsoController::class, 'logout']);

// ── Captcha Routes (harus di luar middleware auth) ───────────────
// Route ini sudah disediakan otomatis oleh mews/captcha setelah publish,
// tapi kita tambahkan endpoint refresh manual untuk AJAX
// Captcha refresh endpoint
Route::get('/captcha-refresh', function () {
    try {
        // Gunakan 'login' preset, parameter kedua `true` = return array
        $captcha = app('captcha')->create('login', true);

        // Log untuk debug — hapus setelah fix
        \Log::info('Captcha response keys: ' . implode(', ', array_keys($captcha)));
        \Log::info('Captcha img value (50 chars): ' . substr($captcha['img'] ?? 'NULL', 0, 50));

        return response()->json([
            'success' => true,
            'img'     => $captcha['img'],
        ]);
    } catch (\Exception $e) {
        \Log::error('Captcha error: ' . $e->getMessage());
        return response()->json([
            'success' => false,
            'message' => $e->getMessage(),
        ], 500);
    }
})->name('captcha.refresh');

// ── Authenticated Routes ─────────────────────────────────────────
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/kinerja', [KinerjaController::class, 'index'])->name('kinerja');

    Route::get('/aplikasi-bmn', [AplikasiBMNController::class, 'index'])->name('aplikasi-bmn.index');
    Route::get('/aplikasi-bmn/{aplikasiBmn}', [AplikasiBMNController::class, 'show'])->name('aplikasi-bmn.show');

    Route::prefix('manajemen-bmn/perencanaan')->name('manajemen-bmn.perencanaan.')->group(function () {
        Route::get('/', [PerencanaanBMNController::class, 'index'])->name('index');
        Route::get('/{perencanaan}', [PerencanaanBMNController::class, 'show'])->name('show');
    });

    Route::prefix('manajemen-bmn/pemanfaatan')->name('manajemen-bmn.pemanfaatan.')->group(function () {
        Route::get('/', [PemanfaatanBMNController::class, 'index'])->name('index');
        Route::get('/peta', [PemanfaatanBMNController::class, 'peta'])->name('peta');
        Route::get('/{pemanfaatan}', [PemanfaatanBMNController::class, 'show'])->name('show');
    });

    Route::prefix('manajemen-bmn/pemindahtanganan')->name('manajemen-bmn.pemindahtanganan.')->group(function () {
        Route::get('/', [PemindahtangananBMNController::class, 'index'])->name('index');
        Route::get('/{pemindahtanganan}', [PemindahtangananBMNController::class, 'show'])->name('show');
    });

    Route::prefix('manajemen-bmn/penghapusan')->name('manajemen-bmn.penghapusan.')->group(function () {
        Route::get('/', [PenghapusanBMNController::class, 'index'])->name('index');
        Route::get('/{penghapusan}', [PenghapusanBMNController::class, 'show'])->name('show');
    });

    Route::prefix('manajemen-bmn/penatausahaan')->name('manajemen-bmn.penatausahaan.')->group(function () {
        Route::get('/', [PenatausahaanBMNController::class, 'index'])->name('index');
        Route::get('/{penatausahaan}', [PenatausahaanBMNController::class, 'show'])->name('show');
    });

    Route::prefix('manajemen-bmn/wasdal')->name('manajemen-bmn.wasdal.')->group(function () {
        Route::get('/', [WasdalBMNController::class, 'index'])->name('index');
        Route::get('/{wasdal}', [WasdalBMNController::class, 'show'])->name('show');
    });

    Route::middleware(['admin', 'super_admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::resource('dashboard-aset', DashboardAsetController::class);
        Route::resource('kinerja-bmn', KinerjaBMNController::class);
        Route::resource('aplikasi-bmn', \App\Http\Controllers\Admin\AplikasiBMNController::class);
        Route::resource('users', \App\Http\Controllers\Admin\UserController::class);

        Route::prefix('manajemen-bmn')->name('manajemen-bmn.')->group(function () {
            Route::resource('perencanaan', \App\Http\Controllers\Admin\ManajemenBMN\PerencanaanBMNController::class);
            Route::resource('pemanfaatan', \App\Http\Controllers\Admin\ManajemenBMN\PemanfaatanBMNController::class);
            Route::resource('pemindahtanganan', \App\Http\Controllers\Admin\ManajemenBMN\PemindahtangananBMNController::class);
            Route::resource('penghapusan', \App\Http\Controllers\Admin\ManajemenBMN\PenghapusanBMNController::class);
            Route::resource('penatausahaan', \App\Http\Controllers\Admin\ManajemenBMN\PenatausahaanBMNController::class);
            Route::resource('wasdal', \App\Http\Controllers\Admin\ManajemenBMN\WasdalBMNController::class);
        });
    });
});

require __DIR__ . '/auth.php';
