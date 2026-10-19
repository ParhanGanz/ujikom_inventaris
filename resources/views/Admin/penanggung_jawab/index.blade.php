@extends('layouts.app')

@section('title', 'Data Penanggung Jawab')

@section('content')
<div class="space-y-6">

    {{-- Header --}}
    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">
                Data Penanggung Jawab
            </h1>
            <p class="mt-1 text-sm text-slate-500">
                Kelola data penanggung jawab inventaris sekolah.
            </p>
        </div>

        <a href="{{ route('admin.penanggung_jawab.create') }}"
           class="inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700">
            <i class="fa-solid fa-plus"></i>
            Tambah Penanggung Jawab
        </a>
    </div>

    {{-- Pesan sukses --}}
    @if (session('success'))
        <div class="rounded-xl border border-green-200 bg-green-50 p-4 text-sm text-green-700">
            <i class="fa-solid fa-circle-check mr-2"></i>
            {{ session('success') }}
        </div>
    @endif

    {{-- Pesan error --}}
    @if ($errors->any())
        <div class="rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
            {{ $errors->first() }}
        </div>
    @endif

    {{-- Tabel --}}
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

        {{-- Pencarian --}}
        <div class="border-b border-slate-200 p-4">
            <form action="{{ route('admin.penanggung_jawab.index') }}"
                  method="GET"
                  class="flex flex-col gap-3 sm:flex-row">

                <div class="relative flex-1">
                    <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>
                    <input
                        type="text"
                        name="search"
                        value="{{ $search ?? '' }}"
                        placeholder="Cari nama, NIP/NUTPK, jabatan, atau email..."
                        class="w-full rounded-xl border border-slate-300 py-2.5 pl-10 pr-4 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">
                </div>

                <button type="submit"
                        class="rounded-xl bg-slate-800 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-slate-700">
                    Cari
                </button>

                @if (!empty($search))
                    <a href="{{ route('admin.penanggung_jawab.index') }}"
                       class="rounded-xl border border-slate-300 px-5 py-2.5 text-center text-sm font-semibold text-slate-600 transition hover:bg-slate-50">
                        Reset
                    </a>
                @endif
            </form>
        </div>

        {{-- Tabel responsif --}}
        <div class="overflow-x-auto">
            <table class="w-full min-w-[1000px] text-left text-sm">
                <thead class="bg-slate-50 text-xs uppercase tracking-wider text-slate-500">
                    <tr>
                        <th class="px-5 py-4">No.</th>
                        <th class="px-5 py-4">Penanggung Jawab</th>
                        <th class="px-5 py-4">NIP/NUTPK</th>
                        <th class="px-5 py-4">Jabatan</th>
                        <th class="px-5 py-4">Lokasi</th>
                        <th class="px-5 py-4">Kontak</th>
                        <th class="px-5 py-4">Status</th>
                        <th class="px-5 py-4 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">
                    @forelse ($penanggungJawabs as $item)
                        <tr class="transition hover:bg-slate-50">
                            <td class="px-5 py-4 text-slate-500">
                                {{ $penanggungJawabs->firstItem() + $loop->index }}
                            </td>

                            <td class="px-5 py-4">
                                <div class="font-semibold text-slate-800">
                                    {{ $item->nama_lengkap }}
                                </div>
                                <div class="mt-1 text-xs text-slate-500">
                                    {{ $item->email ?: 'Email belum diisi' }}
                                </div>
                            </td>

                            <td class="px-5 py-4 text-slate-600">
                                {{ $item->nip_nutpk ?: '-' }}
                            </td>

                            <td class="px-5 py-4 text-slate-600">
                                {{ $item->jabatan }}
                            </td>

                            <td class="px-5 py-4">
                                <div class="font-medium text-slate-700">
                                    {{ $item->lokasi->ruangan ?? '-' }}
                                </div>
                                @if ($item->lokasi)
                                    <div class="mt-1 text-xs text-slate-500">
                                        {{ $item->lokasi->kode ?? '' }}
                                    </div>
                                @endif
                            </td>

                            <td class="px-5 py-4 text-slate-600">
                                {{ $item->no_telepon ?: '-' }}
                            </td>

                            <td class="px-5 py-4">
                                @if ($item->status === 'aktif')
                                    <span class="inline-flex rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                        Aktif
                                    </span>
                                @else
                                    <span class="inline-flex rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-600">
                                        Tidak Aktif
                                    </span>
                                @endif
                            </td>

                            <td class="px-5 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.penanggung_jawab.edit', $item->id) }}"
                                       title="Edit"
                                       class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-amber-200 bg-amber-50 text-amber-600 transition hover:bg-amber-100">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>

                                    <form action="{{ route('admin.penanggung_jawab.destroy', $item->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus data penanggung jawab ini?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                title="Hapus"
                                                class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-red-200 bg-red-50 text-red-600 transition hover:bg-red-100">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-5 py-12 text-center">
                                <i class="fa-solid fa-users mb-3 text-3xl text-slate-300"></i>
                                <p class="font-semibold text-slate-600">
                                    Data penanggung jawab belum tersedia
                                </p>
                                <p class="mt-1 text-sm text-slate-400">
                                    Tambahkan data baru melalui tombol di atas.
                                </p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if ($penanggungJawabs->hasPages())
            <div class="border-t border-slate-200 p-4">
                {{ $penanggungJawabs->links() }}
            </div>
        @endif

    </div>
</div>
@endsection