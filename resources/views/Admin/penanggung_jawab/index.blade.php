@extends('layouts.app')

@section('title', 'Data Penanggung Jawab')

@section('content')
    <div class="space-y-6">

        {{-- Header --}}
        <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
            <div>
                <div class="mb-2 flex items-center gap-2 text-xs font-medium text-slate-500">
                    <i class="fa-solid fa-database"></i>
                    <span>Master Data</span>
                    <i class="fa-solid fa-chevron-right text-[10px]"></i>
                    <span class="text-slate-700">Penanggung Jawab</span>
                </div>

                <h1 class="text-2xl font-bold text-slate-800">
                    Data Penanggung Jawab
                </h1>
                <p class="mt-1 text-sm text-slate-500">
                    Kelola data penanggung jawab inventaris sekolah.
                </p>
            </div>

            <a href="{{ route('admin.penanggung_jawab.create') }}"
                class="inline-flex items-center justify-center gap-2 rounded-xl bg-brand-600 px-4 py-2.5
                               text-sm font-medium text-white
                               shadow-lg shadow-brand-500/25
                               transition-all hover:bg-brand-700">
                <i class="fa-solid fa-plus"></i>
                Tambah Penanggung Jawab
            </a>
        </div>

        {{-- Notifikasi --}}
        @if (session('success'))
            <div
                class="flex items-start gap-3 rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-700">
                <i class="fa-solid fa-circle-check mt-0.5 text-lg"></i>
                <div class="flex-1">{{ session('success') }}</div>
            </div>
        @endif

        @if (session('error'))
            <div class="flex items-start gap-3 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                <i class="fa-solid fa-circle-exclamation mt-0.5 text-lg"></i>
                <div class="flex-1">{{ session('error') }}</div>
            </div>
        @endif

        {{-- Statistik --}}
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <p class="text-sm text-slate-500">Total Data</p>
                        <p class="mt-2 text-2xl font-bold text-slate-800">
                            {{ $penanggungJawabs->total() }}
                        </p>
                    </div>
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-slate-100 text-slate-600">
                        <i class="fa-solid fa-users text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <p class="text-sm text-slate-500">Status Aktif</p>
                        <p class="mt-2 text-2xl font-bold text-emerald-600">
                            {{ \App\Models\PenanggungJawab::where('status', 'aktif')->count() }}
                        </p>
                    </div>
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                        <i class="fa-solid fa-user-check text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <p class="text-sm text-slate-500">Tidak Aktif</p>
                        <p class="mt-2 text-2xl font-bold text-red-600">
                            {{ \App\Models\PenanggungJawab::where('status', 'tidak')->count() }}
                        </p>
                    </div>
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-red-50 text-red-600">
                        <i class="fa-solid fa-user-xmark text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tabel --}}
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

            {{-- Pencarian --}}
            <div class="border-b border-slate-200 p-5">
                <form action="{{ route('admin.penanggung_jawab.index') }}" method="GET"
                    class="flex flex-col gap-3 sm:flex-row">

                    <div class="relative flex-1">
                        <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                        <input type="text" name="search" value="{{ $search ?? '' }}"
                            placeholder="Cari nama, NIP/NUPTK, jabatan, atau email..."
                            class="w-full rounded-xl border border-slate-200 py-3 pl-11 pr-4 text-sm outline-none transition placeholder:text-slate-400 focus:border-slate-400 focus:ring-2 focus:ring-slate-100">
                    </div>

                    <button type="submit"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-brand-600 px-4 py-2.5
                               text-sm font-medium text-white
                               shadow-lg shadow-brand-500/25
                               transition-all hover:bg-brand-700">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        Cari
                    </button>

                    @if (!empty($search))
                        <a href="{{ route('admin.penanggung_jawab.index') }}"
                            class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 px-5 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-50">
                            <i class="fa-solid fa-rotate-left"></i>
                            Reset
                        </a>
                    @endif
                </form>
            </div>

            {{-- Informasi tabel --}}
            <div class="flex flex-col gap-1 px-5 py-4 sm:flex-row sm:items-center sm:justify-between">
                <p class="text-sm font-semibold text-slate-700">Daftar Penanggung Jawab</p>
                <p class="text-xs text-slate-500">
                    Menampilkan {{ $penanggungJawabs->count() }} dari {{ $penanggungJawabs->total() }} data
                </p>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full min-w-[850px] text-left text-sm">
                    <thead class="bg-slate-50 text-xs uppercase tracking-wider text-slate-500">
                        <tr>
                            <th class="px-6 py-4 font-semibold">No.</th>
                            <th class="px-6 py-4 font-semibold">Penanggung Jawab</th>
                            <th class="px-6 py-4 font-semibold">NIP/NUPTK</th>
                            <th class="px-6 py-4 font-semibold">Jabatan</th>
                            <th class="px-6 py-4 font-semibold">Kontak</th>
                            <th class="px-6 py-4 font-semibold">Status</th>
                            <th class="px-6 py-4 text-center font-semibold">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100">
                        @forelse ($penanggungJawabs as $pj)
                            <tr class="transition hover:bg-slate-50/80">
                                <td class="px-6 py-4 text-slate-500">
                                    {{ $penanggungJawabs->firstItem() + $loop->index }}
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-slate-100 text-slate-600">
                                            <i class="fa-solid fa-user"></i>
                                        </div>
                                        <div>
                                            <p class="font-semibold text-slate-800">
                                                {{ $pj->nama_lengkap }}
                                            </p>
                                            <p class="mt-1 text-xs text-slate-400">
                                                {{ $pj->email ?: 'Email belum diisi' }}
                                            </p>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4 text-slate-600">
                                    {{ $pj->nip_nutpk ?: '-' }}
                                </td>

                                <td class="px-6 py-4 text-slate-600">
                                    {{ $pj->jabatan }}
                                </td>

                                <td class="px-6 py-4 text-slate-600">
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-phone text-xs text-slate-400"></i>
                                        {{ $pj->no_telepon ?: '-' }}
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    @if ($pj->status === 'aktif')
                                        <span
                                            class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700">
                                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                            Aktif
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center gap-1.5 rounded-full bg-red-50 px-3 py-1 text-xs font-semibold text-red-700">
                                            <span class="h-1.5 w-1.5 rounded-full bg-red-500"></span>
                                            Tidak Aktif
                                        </span>
                                    @endif
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('admin.penanggung_jawab.edit', $pj->id) }}" title="Edit data"
                                            class="flex h-9 w-9 items-center justify-center rounded-lg bg-amber-50 text-amber-600 transition hover:bg-amber-100">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>

                                        <form action="{{ route('admin.penanggung_jawab.destroy', $pj->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus data penanggung jawab ini?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" title="Hapus data"
                                                class="flex h-9 w-9 items-center justify-center rounded-lg bg-red-50 text-red-600 transition hover:bg-red-100">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-14 text-center">
                                    <div
                                        class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-100 text-slate-400">
                                        <i class="fa-solid fa-users text-2xl"></i>
                                    </div>
                                    <p class="mt-4 font-semibold text-slate-700">
                                        Data penanggung jawab belum tersedia
                                    </p>
                                    <p class="mt-1 text-sm text-slate-400">
                                        @if (!empty($search))
                                            Tidak ada data yang cocok dengan pencarianmu.
                                        @else
                                            Silakan tambahkan data penanggung jawab baru.
                                        @endif
                                    </p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if ($penanggungJawabs->hasPages())
                <div class="border-t border-slate-200 p-5">
                    {{ $penanggungJawabs->withQueryString()->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
