@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header / Banner Welcome -->
    <div class="bg-gradient-to-r from-brand-600 to-brand-700 rounded-2xl p-6 sm:p-8 text-white shadow-lg relative overflow-hidden">
        <div class="relative z-10">
            <h1 class="text-2xl sm:text-3xl font-bold tracking-tight">Selamat Datang, Petugas! 👋</h1>
            <p class="mt-2 text-brand-100 text-sm sm:text-base max-w-2xl">
                Kelola pendaftaran barang, verifikasi permohonan peminjaman, dan pantau pengembalian inventaris sekolah secara efisien.
            </p>
        </div>
        <!-- Decorative background icon -->
        <i class="fa-solid fa-clipboard-check absolute right-4 -bottom-4 text-9xl text-white/10 pointer-events-none"></i>
    </div>

    <!-- Ringkasan Kartu Statistik -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        <!-- Card 1: Total Barang -->
        <div class="bg-white rounded-xl p-5 shadow-sm border border-slate-200/80 flex items-center justify-between transition hover:shadow-md">
            <div>
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Total Barang</p>
                <h3 class="text-2xl font-bold text-slate-800 mt-1">{{ $stats['total_barang'] ?? 0 }}</h3>
                <span class="inline-block mt-2 text-xs font-medium text-slate-500">Tersedia di sistem</span>
            </div>
            <div class="w-12 h-12 bg-brand-50 text-brand-600 rounded-xl flex items-center justify-center text-xl shadow-inner">
                <i class="fa-solid fa-boxes-stacked"></i>
            </div>
        </div>

        <!-- Card 2: Peminjaman Aktif -->
        <div class="bg-white rounded-xl p-5 shadow-sm border border-slate-200/80 flex items-center justify-between transition hover:shadow-md">
            <div>
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Peminjaman Aktif</p>
                <h3 class="text-2xl font-bold text-slate-800 mt-1">{{ $stats['total_pinjam'] ?? 0 }}</h3>
                <span class="inline-block mt-2 text-xs font-medium text-amber-600">Sedang dipinjam</span>
            </div>
            <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center text-xl shadow-inner">
                <i class="fa-solid fa-hand-holding"></i>
            </div>
        </div>

        <!-- Card 3: Perlu Diproses -->
        <div class="bg-white rounded-xl p-5 shadow-sm border border-slate-200/80 flex items-center justify-between transition hover:shadow-md">
            <div>
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Perlu Verifikasi</p>
                <h3 class="text-2xl font-bold text-slate-800 mt-1">{{ $stats['perlu_proses'] ?? 0 }}</h3>
                <span class="inline-block mt-2 text-xs font-medium text-rose-500">Menunggu persetujuan</span>
            </div>
            <div class="w-12 h-12 bg-rose-50 text-rose-600 rounded-xl flex items-center justify-center text-xl shadow-inner">
                <i class="fa-solid fa-clock-rotate-left"></i>
            </div>
        </div>

        <!-- Card 4: Selesai -->
        <div class="bg-white rounded-xl p-5 shadow-sm border border-slate-200/80 flex items-center justify-between transition hover:shadow-md">
            <div>
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Pengembalian</p>
                <h3 class="text-2xl font-bold text-slate-800 mt-1">{{ $stats['selesai'] ?? 0 }}</h3>
                <span class="inline-block mt-2 text-xs font-medium text-emerald-600">Transaksi selesai</span>
            </div>
            <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center text-xl shadow-inner">
                <i class="fa-solid fa-circle-check"></i>
            </div>
        </div>
    </div>

    <!-- Tabel Permohonan / Permintaan Terbaru -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200/80 overflow-hidden">
        <div class="p-5 sm:p-6 border-b border-slate-100 flex items-center justify-between">
            <div>
                <h2 class="text-lg font-bold text-slate-800">Permohonan Peminjaman Terbaru</h2>
                <p class="text-xs text-slate-500 mt-0.5">Daftar transaksi yang perlu segera ditindaklanjuti</p>
            </div>
            <a href="#" class="inline-flex items-center text-xs font-semibold text-brand-600 hover:text-brand-700 gap-1 transition">
                <span>Lihat Semua</span>
                <i class="fa-solid fa-arrow-right text-[10px]"></i>
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-600">
                <thead class="bg-slate-50 text-slate-500 font-semibold text-xs uppercase tracking-wider border-b border-slate-100">
                    <tr>
                        <th class="px-6 py-3.5">Kode / Peminjam</th>
                        <th class="px-6 py-3.5">Barang</th>
                        <th class="px-6 py-3.5">Tanggal Pinjam</th>
                        <th class="px-6 py-3.5">Status</th>
                        <th class="px-6 py-3.5 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-medium">
                    <tr class="hover:bg-slate-50/80 transition">
                        <td class="px-6 py-4">
                            <div class="font-semibold text-slate-800">REQ-001</div>
                            <div class="text-xs text-slate-400">Ahmad Dahlan (Siswa)</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-slate-700">Laptop Asus ProBook</div>
                            <div class="text-xs text-slate-400">Jumlah: 1 Unit</div>
                        </td>
                        <td class="px-6 py-4 text-xs text-slate-500">
                            15 Okt 2026
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 text-xs font-semibold text-amber-700 bg-amber-50 rounded-full border border-amber-200/60">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                Menunggu
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center space-x-1">
                            <button title="Setujui" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 hover:bg-emerald-600 hover:text-white transition">
                                <i class="fa-solid fa-check text-xs"></i>
                            </button>
                            <button title="Tolak" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-600 hover:text-white transition">
                                <i class="fa-solid fa-xmark text-xs"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection