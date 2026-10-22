<?php

use Illuminate\Support\Facades\Route;

// Controller Admin
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\LokasiController;
use App\Http\Controllers\Admin\PenanggungJawabController;

// Controller Petugas
use App\Http\Controllers\Petugas\DashboardController as PetugasDashboardController;

// ==========================================
// 1. HALAMAN UTAMA
// ==========================================

Route::redirect('/', '/login');

// ==========================================
// 2. ROUTE ADMIN
// ==========================================

// Middleware role dinonaktifkan sementara.
// Aktifkan kembali setelah CheckRole siap digunakan.
Route::middleware(['auth'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard Admin
        Route::view('/dashboard', 'admin.dashboard')
            ->name('dashboard');

        // Manajemen Pengguna
        Route::resource('users', UserController::class)
            ->names(['users']);

        // Manajemen Kategori
        Route::resource('kategori', KategoriController::class)
            ->names('kategori');

        // Manajemen Lokasi dan Ruangan
        Route::resource('lokasi', LokasiController::class)
            ->names('lokasi');

        // Manajemen Penanggung Jawab
        Route::resource(
            'penanggung_jawab',
            PenanggungJawabController::class
        )->names('penanggung_jawab');
    });

// ==========================================
// 3. ROUTE PETUGAS
// ==========================================

Route::middleware(['auth'])
    ->prefix('petugas')
    ->name('petugas.')
    ->group(function () {

        Route::view('/dashboard', 'petugas.dashboard')
            ->name('dashboard');

        // Tambahkan route khusus petugas di sini.
    });

// ==========================================
// 4. ROUTE PROFIL PENGGUNA
// ==========================================

Route::middleware(['auth'])->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::put('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile/photo', [ProfileController::class, 'deletePhoto'])
        ->name('profile.delete-photo');
});

// ==========================================
// 5. ROUTE AUTENTIKASI
// ==========================================

require __DIR__ . '/auth.php';
