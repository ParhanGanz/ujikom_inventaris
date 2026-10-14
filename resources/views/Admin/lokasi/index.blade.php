@extends('layouts.app') {{-- Sesuaikan dengan layout utama aplikasi kamu --}}

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Daftar Lokasi</h1>
        <a href="{{ route('admin.lokasi.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Tambah Lokasi</a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-white shadow-md rounded">
        <table class="min-w-full border-collapse">
            <thead>
                <tr class="bg-gray-200 text-left">
                    <th class="py-3 px-4 border-b">No</th>
                    <th class="py-3 px-4 border-b">Kode</th>
                    <th class="py-3 px-4 border-b">Ruangan</th>
                    <th class="py-3 px-4 border-b">Penanggung Jawab</th>
                    <th class="py-3 px-4 border-b">Keterangan</th>
                    <th class="py-3 px-4 border-b">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($lokasi as $item)
                <tr class="border-b hover:bg-gray-50">
                    <td class="py-3 px-4">{{ $loop->iteration }}</td>
                    <td class="py-3 px-4">{{ $item->kode }}</td>
                    <td class="py-3 px-4">{{ $item->ruangan }}</td>
                    <td class="py-3 px-4">{{ $item->penanggung_jawab }}</td>
                    <td class="py-3 px-4">{{ $item->keterangan ?? '-' }}</td>
                    <td class="py-3 px-4 flex space-x-2">
                        <a href="{{ route('admin.lokasi.edit', $item->id) }}" class="text-yellow-600 hover:underline">Edit</a>
                        <form action="{{ route('admin.lokasi.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="py-4 text-center text-gray-500">Belum ada data lokasi.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection