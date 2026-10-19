
<?php

use Illuminate\Support\Facades\Route;

// ==========================================
// IMPORT CONTROLLER
// ==========================================

// Controller Admin
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\LokasiController;

// Controller Petugas
use App\Http\Controllers\Petugas\DashboardController as PetugasDashboardController;


// ==========================================
// 1. HALAMAN UTAMA / WELCOME
// ==========================================

// AKTIF UNTUK PRESENTASI:
// Saat website dibuka melalui http://127.0.0.1:8000/
// halaman welcome akan ditampilkan.
Route::view('/', 'welcome')->name('welcome');

// AKTIFKAN KEMBALI JIKA INGIN HALAMAN UTAMA
// LANGSUNG MENUJU DASHBOARD ADMIN:
// Route::get('/', [DashboardController::class, 'index']);


// ==========================================
// 2. REDIRECT DASHBOARD
// ==========================================

// Dashboard tetap memerlukan login karena diarahkan
// ke dashboard admin yang dilindungi middleware auth.
Route::redirect('/dashboard', '/admin/dashboard');


// ==========================================
// 3. ROUTE ADMIN
// ==========================================

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard Admin
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Manajemen Role
    Route::resource('roles', RoleController::class)
        ->names('role');

    // Manajemen Kategori
    Route::resource('kategori', KategoriController::class)
        ->names('kategori');

    // Manajemen Lokasi dan Ruangan
    Route::resource('lokasi', LokasiController::class)
        ->names('lokasi');

    // Manajemen Pengguna
    Route::resource('users', UserController::class)
        ->names('users');
});


// ==========================================
// 4. ROUTE PETUGAS
// ==========================================

Route::middleware(['auth'])->prefix('petugas')->name('petugas.')->group(function () {

    // Dashboard Petugas
    Route::get('/dashboard', [PetugasDashboardController::class, 'index'])
        ->name('dashboard');

    // Tambahkan route khusus petugas di sini.
});


// ==========================================
// 5. ROUTE PROFIL PENGGUNA
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
// 6. ROUTE AUTENTIKASI
// ==========================================

// AKTIF UNTUK PRESENTASI:
// Mengaktifkan route login, logout, dan route autentikasi
// lain yang didefinisikan dalam routes/auth.php.
require __DIR__ . '/auth.php';

// JANGAN NONAKTIFKAN BAGIAN DI ATAS JIKA LOGIN
// DAN LOGOUT MASIH INGIN DIGUNAKAN.
