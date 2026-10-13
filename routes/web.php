<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\KategoriController;
use Illuminate\Support\Facades\Route;

// Halaman Depan / Landing Page
Route::get('/', function () {
    return view('welcome');
});

// Redirect langsung /dashboard ke /admin/dashboard
Route::redirect('/dashboard', '/admin/dashboard');

// Route Terproteksi (Harus Login)
Route::middleware('auth')->group(function () {

    // Area Admin (/admin/...)
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('roles', RoleController::class)->names('role');
        Route::resource('kategori', KategoriController::class)->names('kategori');
    });
    
    Route::middleware(['auth'])->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile/photo', [ProfileController::class, 'deletePhoto'])->name('profile.delete-photo');
    });
});

// Route Otentikasi (Login, Register, Logout)
require __DIR__ . '/auth.php';
