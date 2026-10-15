@extends('layouts.app')

@section('content')
<!-- Header & Breadcrumb -->
<div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between">
    <div>
        <h1 class="text-2xl font-bold text-slate-800">Tambah Lokasi Baru</h1>
        <p class="text-sm text-slate-500 mt-1">Isi formulir di bawah ini untuk menambahkan data lokasi/ruangan baru.</p>
    </div>
    <div class="mt-3 sm:mt-0 text-sm text-slate-500 flex items-center space-x-2">
        <a href="{{ route('admin.lokasi.index') }}" class="hover:text-brand-600 transition-colors">Data Lokasi</a>
        <span>></span>
        <span class="text-slate-700 font-medium">Tambah Lokasi</span>
    </div>
</div>

<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8">
        <div class="flex items-center space-x-3 mb-6 pb-4 border-b border-slate-100">
            <div class="w-10 h-10 rounded-xl bg-brand-50 text-brand-500 flex items-center justify-center font-bold">
                <i class="fa-solid fa-location-dot text-base"></i>
            </div>
            <div>
                <h2 class="text-base font-bold text-slate-800">Formulir Lokasi</h2>
                <p class="text-xs text-slate-400">Pastikan data yang diinputkan sudah sesuai</p>
            </div>
        </div>

        <form action="{{ route('admin.lokasi.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mb-5">
                <!-- Kode Ruangan (Otomatis terisi, bisa diedit) -->
                <div>
                    <label for="kode" class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">
                        KODE RUANGAN <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="text" id="kode" name="kode" 
                               value="{{ old('kode', $kodeOtomatis ?? '') }}" required 
                               placeholder="Contoh: LOK-001"
                               class="w-full px-4 py-2.5 bg-slate-50 border @error('kode') border-red-300 @else border-slate-200 @enderror rounded-xl text-sm text-slate-700 focus:outline-none focus:border-brand-500 focus:bg-white transition-all">
                    </div>
                    <p class="mt-1 text-[11px] text-slate-400">Kode tergenerate otomatis, namun tetap dapat Anda ubah.</p>
                    @error('kode')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Nama Ruangan -->
                <div>
                    <label for="ruangan" class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">
                        NAMA RUANGAN / LOKASI <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="ruangan" name="ruangan" value="{{ old('ruangan') }}" required 
                           placeholder="Contoh: Lab Komputer 1, Gudang Utama..." 
                           class="w-full px-4 py-2.5 bg-slate-50 border @error('ruangan') border-red-300 @else border-slate-200 @enderror rounded-xl text-sm text-slate-700 focus:outline-none focus:border-brand-500 focus:bg-white transition-all">
                    @error('ruangan')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Penanggung Jawab -->
            <div class="mb-5">
                <label for="penanggung_jawab" class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">
                    PENANGGUNG JAWAB <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <input type="text" id="penanggung_jawab" name="penanggung_jawab" value="{{ old('penanggung_jawab') }}" required 
                           placeholder="Contoh: Drs. Ahmad Dahlan" 
                           class="w-full px-4 py-2.5 bg-slate-50 border @error('penanggung_jawab') border-red-300 @else border-slate-200 @enderror rounded-xl text-sm text-slate-700 focus:outline-none focus:border-brand-500 focus:bg-white transition-all">
                </div>
                @error('penanggung_jawab')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Keterangan -->
            <div class="mb-8">
                <label for="keterangan" class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">
                    KETERANGAN (OPSIONAL)
                </label>
                <textarea id="keterangan" name="keterangan" rows="3" 
                          placeholder="Penjelasan singkat lokasi atau fasilitas ruangan..." 
                          class="w-full px-4 py-2.5 bg-slate-50 border @error('keterangan') border-red-300 @else border-slate-200 @enderror rounded-xl text-sm text-slate-700 focus:outline-none focus:border-brand-500 focus:bg-white transition-all">{{ old('keterangan') }}</textarea>
                @error('keterangan')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tombol Action -->
            <div class="flex items-center justify-end space-x-3 pt-4 border-t border-slate-100">
                <a href="{{ route('admin.lokasi.index') }}" 
                   class="px-5 py-2.5 rounded-xl border border-slate-200 text-sm font-medium text-slate-600 hover:bg-slate-100 transition-colors">
                    Batal
                </a>
                <button type="submit" 
                        class="px-6 py-2.5 bg-brand-600 hover:bg-brand-700 text-white font-medium text-sm rounded-xl shadow-lg shadow-brand-500/25 transition-all flex items-center space-x-2">
                    <i class="fa-solid fa-floppy-disk text-xs"></i>
                    <span>Simpan Lokasi</span>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection