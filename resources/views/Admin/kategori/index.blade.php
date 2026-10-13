@extends('layouts.app')

@section('content')
<!-- Header & Breadcrumb -->
<div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between">
    <div>
        <h1 class="text-2xl font-bold text-slate-800">Manajemen Kategori</h1>
        <p class="text-sm text-slate-500 mt-1">Kelola data kategori barang inventaris sekolah.</p>
    </div>
    <div class="mt-3 sm:mt-0 text-sm text-slate-500">
        <span class="hover:text-brand-600 cursor-pointer">Master Data</span>
        <span class="mx-2">></span>
        <span class="text-slate-700 font-medium">Kategori</span>
    </div>
</div>

<!-- Notifikasi Sukses -->
@if (session('success'))
    <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl flex items-center justify-between shadow-sm">
        <div class="flex items-center space-x-2">
            <i class="fa-solid fa-circle-check text-emerald-500"></i>
            <span class="text-sm font-medium">{{ session('success') }}</span>
        </div>
        <button type="button" onclick="this.parentElement.remove()" class="text-emerald-400 hover:text-emerald-600">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>
@endif

<!-- Grid Layout (Form Kiri & Tabel Kanan) -->
<div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
    
    <!-- Kolom Kiri: Form Tambah Kategori -->
    <div class="lg:col-span-5">
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
            <div class="flex items-center space-x-3 mb-5">
                <div class="w-10 h-10 rounded-xl bg-brand-50 text-brand-500 flex items-center justify-center font-bold">
                    <i class="fa-solid fa-plus text-base"></i>
                </div>
                <div>
                    <h2 class="text-base font-bold text-slate-800">Tambah Kategori Baru</h2>
                    <p class="text-xs text-slate-400">Isi formulir untuk membuat kategori baru</p>
                </div>
            </div>

            <form action="{{ route('admin.kategori.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="nama" class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">NAMA KATEGORI <span class="text-red-500">*</span></label>
                    <input type="text" id="nama" name="nama" value="{{ old('nama') }}" required placeholder="Contoh: Elektronik, Furniture..." 
                           class="w-full px-4 py-2.5 bg-slate-50 border @error('nama') border-red-300 @else border-slate-200 @enderror rounded-xl text-sm text-slate-700 focus:outline-none focus:border-brand-500 focus:bg-white transition-all">
                    @error('nama')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="keterangan" class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">KETERANGAN</label>
                    <textarea id="keterangan" name="keterangan" rows="3" placeholder="Penjelasan mengenai kategori..." 
                              class="w-full px-4 py-2.5 bg-slate-50 border @error('keterangan') border-red-300 @else border-slate-200 @enderror rounded-xl text-sm text-slate-700 focus:outline-none focus:border-brand-500 focus:bg-white transition-all">{{ old('keterangan') }}</textarea>
                    @error('keterangan')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="w-full py-3 bg-brand-600 hover:bg-brand-700 text-white font-medium rounded-xl shadow-lg shadow-brand-500/25 transition-all flex items-center justify-center space-x-2">
                    <i class="fa-solid fa-floppy-disk text-sm"></i>
                    <span>Simpan Kategori</span>
                </button>
            </form>
        </div>
    </div>

    <!-- Kolom Kanan: Tabel Daftar Kategori -->
    <div class="lg:col-span-7">
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-slate-100 flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-xl bg-indigo-50 text-brand-600 flex items-center justify-center font-bold">
                        <i class="fa-solid fa-layer-group text-base"></i>
                    </div>
                    <div>
                        <h2 class="text-base font-bold text-slate-800">Daftar Kategori</h2>
                        <p class="text-xs text-slate-400">Total {{ $kategori->count() }} kategori terdaftar</p>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/75 border-b border-slate-100 text-[11px] font-bold text-slate-400 uppercase tracking-wider">
                            <th class="py-3.5 px-4 text-center w-12">No</th>
                            <th class="py-3.5 px-4">Nama Kategori</th>
                            <th class="py-3.5 px-4">Keterangan</th>
                            <th class="py-3.5 px-4 text-center w-24">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @forelse ($kategori as $item)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="py-4 px-4 text-center text-slate-500 font-medium">{{ $loop->iteration }}</td>
                                <td class="py-4 px-4 font-semibold text-slate-800 flex items-center space-x-2">
                                    <span class="w-2 h-2 rounded-full bg-brand-500 inline-block"></span>
                                    <span>{{ $item->nama }}</span>
                                </td>
                                <td class="py-4 px-4 text-slate-500 text-xs">{{ $item->keterangan ?? '-' }}</td>
                                <td class="py-4 px-4 text-center">
                                    <div class="flex items-center justify-center space-x-2">
                                        <a href="{{ route('admin.kategori.edit', $item->id) }}" class="w-8 h-8 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center hover:bg-amber-100 transition-colors" title="Edit">
                                            <i class="fa-solid fa-pen-to-square text-xs"></i>
                                        </a>
                                        <form action="{{ route('admin.kategori.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus kategori ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-8 h-8 rounded-lg bg-red-50 text-red-600 flex items-center justify-center hover:bg-red-100 transition-colors" title="Hapus">
                                                <i class="fa-solid fa-trash-can text-xs"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-8 text-center text-slate-400 text-sm">
                                    <div class="flex flex-col items-center justify-center space-y-2">
                                        <i class="fa-solid fa-folder-open text-3xl text-slate-300"></i>
                                        <p>Belum ada data kategori terdaftar.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection