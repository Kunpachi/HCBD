<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HRTablesController;
use App\Http\Controllers\ImportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Struktur:
| - Guest: login & perform login
| - Auth: dashboard, import, HR metrics, logout
| - Root: redirect ke dashboard (akan dialihkan ke login oleh middleware jika belum auth)
|--------------------------------------------------------------------------
*/

// ROOT: arahkan ke dashboard (middleware auth akan mengarahkan ke login bila belum masuk)
Route::get('/', function () {
    return redirect()->route('dashboard');
})->name('root');

// Guest (belum login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.perform');
});

// Authenticated area
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Users (aktifkan jika perlu)
    // Route::get('/users', [UserController::class, 'index'])->name('users.index');

    // Import Pegawai
    Route::get('/import/pegawai', [ImportController::class, 'form'])->name('import.pegawai.form');
    // Route::post('/import/pegawai', [ImportController::class, 'pegawaiMasterImport'])->name('import.pegawai.import');
    Route::post('/import/pegawai', [ImportController::class, 'import'])->name('import.pegawai.import');
    // Jika method real di controller bernama import(), ubah baris POST:
    // Route::post('/import/pegawai', [ImportController::class, 'import'])->name('import.pegawai.import');

    // HR endpoints (prefix hr)
    Route::prefix('hr')->name('hr.')->group(function () {
        Route::get('/total', [HRTablesController::class, 'total'])->name('total');
        Route::get('/gender', [HRTablesController::class, 'gender'])->name('gender');
        Route::get('/gap', [HRTablesController::class, 'gap'])->name('gap');
        Route::get('/generation', [HRTablesController::class, 'generation'])->name('generation');
        Route::get('/education', [HRTablesController::class, 'education'])->name('education');
    });
});