
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
use App\Http\Controllers\Admin\PenanggungJawabController;

// Controller Petugas
use App\Http\Controllers\Petugas\DashboardController as PetugasDashboardController;


// ==========================================
// 1. HALAMAN UTAMA / WELCOME
// ==========================================
// Route welcome dinonaktifkan sementara.
// Aktifkan kembali jika ingin menampilkan halaman welcome.
// Route::view('/', 'welcome')->name('welcome');


// ==========================================
// 1. HALAMAN UTAMA
// ==========================================
// Halaman utama langsung menuju login.
Route::redirect('/', '/login');


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

    // Manajemen Penanggung Jawab
    Route::resource('penanggung_jawab', PenanggungJawabController::class)
        ->names('penanggung_jawab');

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

// Mengaktifkan route login, logout, dan route autentikasi
// lain yang didefinisikan dalam routes/auth.php.
require __DIR__ . '/auth.php';
