@extends('layouts.app')

@section('title', 'Tambah Lokasi')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

    {{-- Header --}}
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.lokasi.index') }}"
           class="w-11 h-11 rounded-xl border border-slate-200 bg-white text-slate-600 flex items-center justify-center hover:bg-slate-50 transition">
            <i class="fa-solid fa-arrow-left"></i>
        </a>

        <div>
            <p class="text-sm font-semibold text-indigo-600 mb-1">MASTER DATA</p>
            <h1 class="text-2xl font-bold text-slate-800">Tambah Lokasi</h1>
            <p class="text-sm text-slate-500 mt-1">
                Masukkan informasi lokasi atau ruangan baru.
            </p>
        </div>
    </div>

    {{-- Pesan validasi --}}
    @if ($errors->any())
        <div class="p-4 rounded-xl border border-red-200 bg-red-50 text-red-700">
            <p class="font-semibold text-sm mb-2">
                Periksa kembali data yang kamu masukkan:
            </p>

            <ul class="list-disc pl-5 text-sm space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form --}}
    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
        <div class="p-6 border-b border-slate-100">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center">
                    <i class="fa-solid fa-door-open text-xl"></i>
                </div>

                <div>
                    <h2 class="font-bold text-slate-800">Informasi Ruangan</h2>
                    <p class="text-xs text-slate-500 mt-1">
                        Kolom bertanda <span class="text-red-500">*</span> wajib diisi.
                    </p>
                </div>
            </div>
        </div>

        <form action="{{ route('admin.lokasi.store') }}" method="POST">
            @csrf

            <div class="p-6 space-y-5">

                {{-- Kode otomatis --}}
                <div>
                    <label for="kode"
                           class="block text-sm font-semibold text-slate-700 mb-2">
                        Kode Lokasi
                    </label>

                    <div class="relative">
                        <i class="fa-solid fa-barcode absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>

                        <input type="text" id="kode" value="{{ $kodeBaru }}"
                               readonly
                               class="w-full pl-11 pr-4 py-3 rounded-xl border border-slate-200 bg-slate-100 text-slate-500 text-sm">
                    </div>

                    <p class="text-xs text-slate-400 mt-2">
                        Kode akan dibuat otomatis oleh sistem saat data disimpan.
                    </p>
                </div>

                {{-- Nama ruangan --}}
                <div>
                    <label for="ruangan"
                           class="block text-sm font-semibold text-slate-700 mb-2">
                        Nama Ruangan <span class="text-red-500">*</span>
                    </label>

                    <input type="text" id="ruangan" name="ruangan"
                           value="{{ old('ruangan') }}"
                           maxlength="255" required autofocus
                           placeholder="Contoh: Laboratorium Komputer"
                           class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-100 focus:border-indigo-500">

                    @error('ruangan')
                        <p class="text-xs text-red-500 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Keterangan --}}
                <div>
                    <label for="keterangan"
                           class="block text-sm font-semibold text-slate-700 mb-2">
                        Keterangan
                    </label>

                    <textarea id="keterangan" name="keterangan" rows="4"
                              placeholder="Masukkan keterangan tambahan jika diperlukan..."
                              class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-100 focus:border-indigo-500">{{ old('keterangan') }}</textarea>

                    @error('keterangan')
                        <p class="text-xs text-red-500 mt-2">{{ $message }}</p>
                    @enderror

                    <p class="text-xs text-slate-400 mt-2">
                        Contoh: Ruangan untuk kegiatan belajar praktik siswa.
                    </p>
                </div>
            </div>

            {{-- Tombol --}}
            <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3 p-6 bg-slate-50 border-t border-slate-100">
                <a href="{{ route('admin.lokasi.index') }}"
                   class="inline-flex items-center justify-center px-5 py-3 rounded-xl border border-slate-200 bg-white text-slate-600 text-sm font-semibold hover:bg-slate-100 transition">
                    Batal
                </a>

                <button type="submit"
                        class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-indigo-600 text-white text-sm font-semibold hover:bg-indigo-700 transition shadow-lg shadow-indigo-100">
                    <i class="fa-solid fa-floppy-disk"></i>
                    Simpan Lokasi
                </button>
            </div>
        </form>
    </div>
</div>
@endsection