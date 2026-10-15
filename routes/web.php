<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\LokasiController;
use Illuminate\Support\Facades\Route;

// ==========================================
// 1. HALAMAN UTAMA DIUBAH LANGSUNG KE DASHBOARD
// ==========================================
// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [DashboardController::class, 'index']);

// Redirect langsung /dashboard ke /admin/dashboard
Route::redirect('/dashboard', '/admin/dashboard');


// ==========================================
// 2. ROUTE TERPROTEKSI (AUTH DINONAKTIFKAN SEMENTARA)
// ==========================================
// Route::middleware('auth')->group(function () {

    // Area Admin (/admin/...)
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('roles', RoleController::class)->names('role');
        Route::resource('kategori', KategoriController::class)->names('kategori');
        Route::resource('lokasi', LokasiController::class)->names('lokasi');
        Route::resource('users', UserController::class)->names('users');
    });
    
    // Route::middleware(['auth'])->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile/photo', [ProfileController::class, 'deletePhoto'])->name('profile.delete-photo');
    // });

// });


// ==========================================
// 3. ROUTE OTENTIKASI (LOGIN/REGISTER DI-DISABLE)
// ==========================================
require __DIR__ . '/auth.php';