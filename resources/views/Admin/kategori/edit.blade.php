@extends('layouts.app')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-slate-800">Edit Kategori</h1>
    <p class="text-sm text-slate-500 mt-1">Perbarui informasi data kategori inventaris.</p>
</div>

<div class="max-w-xl">
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
        <form action="{{ route('admin.kategori.update', $kategori->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="nama" class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">NAMA KATEGORI <span class="text-red-500">*</span></label>
                <input type="text" id="nama" name="nama" value="{{ old('nama', $kategori->nama) }}" required 
                       class="w-full px-4 py-2.5 bg-slate-50 border @error('nama') border-red-300 @else border-slate-200 @enderror rounded-xl text-sm text-slate-700 focus:outline-none focus:border-brand-500 focus:bg-white transition-all">
                @error('nama')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="keterangan" class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">KETERANGAN</label>
                <textarea id="keterangan" name="keterangan" rows="3" 
                          class="w-full px-4 py-2.5 bg-slate-50 border @error('keterangan') border-red-300 @else border-slate-200 @enderror rounded-xl text-sm text-slate-700 focus:outline-none focus:border-brand-500 focus:bg-white transition-all">{{ old('keterangan', $kategori->keterangan) }}</textarea>
                @error('keterangan')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-end space-x-3">
                <a href="{{ route('admin.kategori.index') }}" class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-600 text-sm font-medium rounded-xl transition-all">
                    Batal
                </a>
                <button type="submit" class="px-5 py-2.5 bg-brand-600 hover:bg-brand-700 text-white text-sm font-medium rounded-xl shadow-lg shadow-brand-500/25 transition-all">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection