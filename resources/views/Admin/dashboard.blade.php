











































































































































































































































@extends('layouts.app')

@section('content')
<div class="space-y-6">

    <!-- Header & Status Role -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-slate-800 flex items-center gap-2">
                <i class="fa-solid fa-gauge-high text-indigo-600"></i> Dashboard Inventaris
            </h2>
            <p class="text-sm text-slate-500 mt-0.5">
                Selamat datang kembali, <span class="font-semibold text-slate-700">{{ Auth::user()->name ?? 'MUHAMMAD PARHAN PADILAH' }}</span>!
            </p>
        </div>
    </div>

    <!-- Main Banner Info (Light Mode) -->
    <div class="relative overflow-hidden bg-gradient-to-r from-indigo-600 to-blue-600 rounded-2xl p-6 sm:p-8 text-white shadow-lg shadow-indigo-100">
        <div class="relative z-10 max-w-2xl">
            <h3 class="text-xl sm:text-2xl font-bold tracking-tight">
                Sistem Informasi Inventaris SMAKNIS
            </h3>
            <p class="text-sm text-indigo-100 mt-2 leading-relaxed">
                Kelola data barang, peminjaman, serta hak akses pengguna dengan lebih cepat dan terorganisir dalam satu panel utama.
            </p>
            <div class="flex flex-wrap items-center gap-3 mt-6">
                <a href="#" class="inline-flex items-center px-4 py-2 rounded-xl text-xs font-bold bg-white text-indigo-600 hover:bg-slate-50 transition shadow-sm">
                    <i class="fa-solid fa-user-gear mr-2"></i> Kelola Role
                </a>
                <a href="#" class="inline-flex items-center px-4 py-2 rounded-xl text-xs font-bold bg-indigo-700/60 text-white hover:bg-indigo-700 transition border border-indigo-400/30">
                    <i class="fa-solid fa-id-card mr-2"></i> Profil Saya
                </a>
            </div>
        </div>
        <!-- Decorative Background Watermark Icon -->
        <i class="fa-solid fa-boxes-stacked absolute -bottom-6 -right-6 text-9xl text-white/10 pointer-events-none"></i>
    </div>

    <!-- 4 Key Stat Cards (Light Theme) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

        <!-- Card 1: Total Barang -->
        <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm flex items-center justify-between transition hover:shadow-md">
            <div>
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">TOTAL BARANG</span>
                <h3 class="text-3xl font-extrabold text-slate-800 mt-1">128</h3>
                <span class="inline-flex items-center text-xs font-semibold text-emerald-600 mt-2">
                    <i class="fa-solid fa-arrow-trend-up text-[10px] mr-1"></i> +12% bulan ini
                </span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-xl shadow-inner">
                <i class="fa-solid fa-box-archive"></i>
            </div>
        </div>

        <!-- Card 2: Sedang Dipinjam -->
        <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm flex items-center justify-between transition hover:shadow-md">
            <div>
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">SEDANG DIPINJAM</span>
                <h3 class="text-3xl font-extrabold text-slate-800 mt-1">24</h3>
                <span class="inline-flex items-center text-xs font-semibold text-amber-600 mt-2">
                    <i class="fa-solid fa-clock text-[10px] mr-1"></i> Membutuhkan konfirmasi
                </span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center text-xl shadow-inner">
                <i class="fa-solid fa-hand-holding"></i>
            </div>
        </div>

        <!-- Card 3: Total Pengguna -->
        <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm flex items-center justify-between transition hover:shadow-md">
            <div>
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">TOTAL PENGGUNA</span>
                <h3 class="text-3xl font-extrabold text-slate-800 mt-1">45</h3>
                <span class="inline-flex items-center text-xs font-semibold text-indigo-600 mt-2">
                    <i class="fa-solid fa-user-check text-[10px] mr-1"></i> Aktif di sistem
                </span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center text-xl shadow-inner">
                <i class="fa-solid fa-users"></i>
            </div>
        </div>

        <!-- Card 4: Kondisi Rusak -->
        <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm flex items-center justify-between transition hover:shadow-md">
            <div>
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">KONDISI RUSAK</span>
                <h3 class="text-3xl font-extrabold text-slate-800 mt-1">5</h3>
                <span class="inline-flex items-center text-xs font-semibold text-rose-600 mt-2">
                    <i class="fa-solid fa-triangle-exclamation text-[10px] mr-1"></i> Perlu perbaikan
                </span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-rose-50 text-rose-600 flex items-center justify-center text-xl shadow-inner">
                <i class="fa-solid fa-screwdriver-wrench"></i>
            </div>
        </div>

    </div>

    <!-- Login Session Information Card (Light Mode) -->
    <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm space-y-4">
        <div class="flex items-center space-x-2 text-indigo-600">
            <i class="fa-solid fa-circle-info text-base"></i>
            <h4 class="text-sm font-bold text-slate-800 uppercase tracking-wider">Informasi Sesi Login</h4>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <!-- Username -->
            <div class="bg-slate-50 p-4 rounded-xl border border-slate-200/60">
                <span class="text-xs font-medium text-slate-400 block">Username / Identifier</span>
                <span class="text-sm font-bold text-slate-800 mt-1 block">{{ Auth::user()->username ?? 'Parhanzz' }}</span>
            </div>

            <!-- Email -->
            <div class="bg-slate-50 p-4 rounded-xl border border-slate-200/60">
                <span class="text-xs font-medium text-slate-400 block">Email Terdaftar</span>
                <span class="text-sm font-bold text-slate-800 mt-1 block">{{ Auth::user()->email ?? 'parhan@gmail.com' }}</span>
            </div>

            <!-- Account Status -->
            <div class="bg-slate-50 p-4 rounded-xl border border-slate-200/60 flex flex-col justify-center">
                <span class="text-xs font-medium text-slate-400 block">Status Akun</span>
                <div class="mt-1 flex items-center space-x-2">
                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                    <span class="text-sm font-bold text-emerald-600">Aktif</span>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection