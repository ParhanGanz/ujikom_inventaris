@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Tambah Lokasi Baru</h1>

    <form action="{{ route('admin.lokasi.store') }}" method="POST" class="bg-white shadow-md rounded p-6">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Kode Ruangan</label>
            <input type="text" name="kode" value="{{ old('kode') }}" class="w-full border border-gray-300 p-2 rounded @error('kode') border-red-500 @enderror" required>
            @error('kode')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Nama Ruangan</label>
            <input type="text" name="ruangan" value="{{ old('ruangan') }}" class="w-full border border-gray-300 p-2 rounded @error('ruangan') border-red-500 @enderror" required>
            @error('ruangan')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Penanggung Jawab</label>
            <input type="text" name="penanggung_jawab" value="{{ old('penanggung_jawab') }}" class="w-full border border-gray-300 p-2 rounded @error('penanggung_jawab') border-red-500 @enderror" required>
            @error('penanggung_jawab')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Keterangan (Opsional)</label>
            <textarea name="keterangan" class="w-full border border-gray-300 p-2 rounded">{{ old('keterangan') }}</textarea>
        </div>

        <div class="flex justify-end space-x-4">
            <a href="{{ route('admin.lokasi.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Batal</a>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
        </div>
    </form>
</div>
@endsection