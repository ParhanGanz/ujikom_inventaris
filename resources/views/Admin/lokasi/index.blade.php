@extends('layouts.app')

@section('content')

{{-- HEADER & BREADCRUMB --}}
<div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between">
    <div>
        <h1 class="text-2xl font-bold text-slate-800">Manajemen Lokasi</h1>
        <p class="mt-1 text-sm text-slate-500">
            Kelola data lokasi dan penanggung jawab ruangan sekolah.
        </p>
    </div>

    <div class="mt-3 text-sm text-slate-500 sm:mt-0">
        <span class="hover:text-brand-600">Master Data</span>
        <span class="mx-2">&gt;</span>
        <span class="font-medium text-slate-700">Lokasi Ruangan</span>
    </div>
</div>

{{-- NOTIFIKASI SUKSES --}}
@if (session('success'))
    <div class="mb-6 flex items-center justify-between rounded-xl
                border border-emerald-200 bg-emerald-50 p-4
                text-emerald-700 shadow-sm">
        <div class="flex items-center space-x-2">
            <i class="fa-solid fa-circle-check text-emerald-500"></i>
            <span class="text-sm font-medium">
                {{ session('success') }}
            </span>
        </div>

        <button type="button"
                onclick="this.parentElement.remove()"
                class="text-emerald-400 hover:text-emerald-600">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>
@endif

{{-- NOTIFIKASI VALIDASI --}}
@if ($errors->any())
    <div class="mb-6 rounded-xl border border-red-200
                bg-red-50 p-4 text-red-700">
        <div class="mb-2 flex items-center space-x-2">
            <i class="fa-solid fa-circle-exclamation"></i>
            <span class="text-sm font-bold">
                Terdapat kesalahan pada input:
            </span>
        </div>

        <ul class="list-inside list-disc space-y-1 text-sm">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- GRID UTAMA --}}
<div class="grid grid-cols-1 gap-6">

    {{-- TABEL DAFTAR LOKASI --}}
    <div class="min-w-0">
        <div class="overflow-hidden rounded-2xl border border-slate-200
                    bg-white shadow-sm">

            {{-- HEADER TABEL --}}
            <div class="flex flex-col gap-4 border-b border-slate-100
                        p-6 sm:flex-row sm:items-center
                        sm:justify-between">

                <div class="flex items-center space-x-3">
                    <div class="flex h-10 w-10 items-center justify-center
                                rounded-xl bg-indigo-50 font-bold
                                text-brand-600">
                        <i class="fa-solid fa-door-open text-base"></i>
                    </div>

                    <div>
                        <h2 class="text-base font-bold text-slate-800">
                            Daftar Lokasi Ruangan
                        </h2>
                        <p class="mt-1 text-xs text-slate-400">
                            Total {{ $lokasi->count() }} lokasi terdaftar
                        </p>
                    </div>
                </div>

                <div class="flex flex-col gap-3 sm:flex-row">
                    {{-- PENCARIAN --}}
                    <div class="relative">
                        <i class="fa-solid fa-magnifying-glass
                                  absolute left-3 top-1/2
                                  -translate-y-1/2 text-slate-400"></i>

                        <input
                            type="text"
                            id="searchLokasi"
                            placeholder="Cari Lokasi Ruangan . . ."
                            class="w-full rounded-xl border border-slate-200
                                   bg-slate-50 py-2.5 pl-9 pr-4 text-sm
                                   text-slate-700 transition-all
                                   focus:border-brand-500 focus:bg-white
                                   focus:outline-none sm:w-56"
                        >
                    </div>

                    {{-- TOMBOL TAMBAH --}}
                    <button
                        type="button"
                        onclick="openCreateModal()"
                        class="flex items-center justify-center space-x-2
                               rounded-xl bg-brand-600 px-4 py-2.5
                               text-sm font-medium text-white
                               shadow-lg shadow-brand-500/25
                               transition-all hover:bg-brand-700"
                    >
                        <i class="fa-solid fa-plus text-xs"></i>
                        <span>Tambah Lokasi</span>
                    </button>
                </div>
            </div>

            {{-- TABEL --}}
            <div class="overflow-x-auto">
                <table class="w-full border-collapse text-left">
                    <thead>
                        <tr class="border-b border-slate-100
                                   bg-slate-50/75 text-[11px]
                                   font-bold uppercase tracking-wider
                                   text-slate-400">
                            <th class="w-12 px-4 py-3.5 text-center">
                                No
                            </th>
                            <th class="px-4 py-3.5">Kode Lokasi</th>
                            <th class="px-4 py-3.5">Nama Ruangan</th>
                            <th class="px-4 py-3.5">Penanggung Jawab</th>
                            <th class="px-4 py-3.5">Keterangan</th>
                            <th class="w-24 px-4 py-3.5 text-center">
                                Aksi
                            </th>
                        </tr>
                    </thead>

                    <tbody id="tabelLokasi"
                           class="divide-y divide-slate-100 text-sm">

                        @forelse ($lokasi as $item)
                            <tr class="baris-lokasi transition-colors
                                       hover:bg-slate-50/50">

                                {{-- NOMOR --}}
                                <td class="px-4 py-4 text-center
                                           font-medium text-slate-500">
                                    {{ $loop->iteration }}
                                </td>

                                {{-- KODE --}}
                                <td class="px-4 py-4">
                                    <span class="inline-flex rounded-lg
                                                 bg-blue-50 px-2.5 py-1
                                                 font-mono text-xs
                                                 font-semibold text-blue-600">
                                        {{ $item->kode }}
                                    </span>
                                </td>

                                {{-- RUANGAN --}}
                                <td class="px-4 py-4">
                                    <div class="flex items-center space-x-2">
                                        <span class="inline-block h-2 w-2
                                                     rounded-full bg-brand-500">
                                        </span>

                                        <span class="font-semibold
                                                     text-slate-800">
                                            {{ $item->ruangan }}
                                        </span>
                                    </div>
                                </td>

                                {{-- PENANGGUNG JAWAB --}}
                                <td class="px-4 py-4">
                                    <div class="flex items-center space-x-2">
                                        <div class="flex h-8 w-8 shrink-0
                                                    items-center justify-center
                                                    rounded-lg bg-indigo-50
                                                    text-indigo-500">
                                            <i class="fa-solid fa-user text-xs"></i>
                                        </div>

                                        <span class="text-slate-600">
                                            {{ $item->penanggungJawab->nama_lengkap
                                                ?? 'Belum tersedia' }}
                                        </span>
                                    </div>
                                </td>

                                {{-- KETERANGAN --}}
                                <td class="max-w-xs px-4 py-4 text-xs
                                           text-slate-500">
                                    {{ $item->keterangan ?: '-' }}
                                </td>

                                {{-- AKSI --}}
                                <td class="px-4 py-4 text-center">
                                    <div class="flex items-center
                                                justify-center space-x-2">

                                        {{-- EDIT --}}
                                        <button
                                            type="button"
                                            onclick="openEditModal(
                                                @js($item->id),
                                                @js($item->kode),
                                                @js($item->ruangan),
                                                @js((string) $item->id_penanggung_jawab),
                                                @js($item->keterangan ?? '')
                                            )"
                                            class="flex h-8 w-8 items-center
                                                   justify-center rounded-lg
                                                   bg-amber-50 text-amber-600
                                                   transition-colors
                                                   hover:bg-amber-100"
                                            title="Edit lokasi"
                                        >
                                            <i class="fa-solid
                                                      fa-pen-to-square text-xs">
                                            </i>
                                        </button>

                                        {{-- HAPUS --}}
                                        <button
                                            type="button"
                                            onclick="openDeleteModal(
                                                @js($item->id),
                                                @js($item->ruangan)
                                            )"
                                            class="flex h-8 w-8 items-center
                                                   justify-center rounded-lg
                                                   bg-red-50 text-red-600
                                                   transition-colors
                                                   hover:bg-red-100"
                                            title="Hapus lokasi"
                                        >
                                            <i class="fa-solid
                                                      fa-trash-can text-xs">
                                            </i>
                                        </button>

                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6"
                                    class="px-4 py-10 text-center
                                           text-sm text-slate-400">
                                    <div class="flex flex-col items-center
                                                justify-center space-y-2">
                                        <i class="fa-solid fa-door-open
                                                  text-3xl text-slate-300"></i>
                                        <p>Belum ada data lokasi terdaftar.</p>
                                        <p class="text-xs">
                                            Klik Tambah Lokasi untuk memulai.
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse

                        {{-- HASIL PENCARIAN KOSONG --}}
                        <tr id="hasilTidakDitemukan" class="hidden">
                            <td colspan="6"
                                class="px-4 py-8 text-center
                                       text-sm text-slate-400">
                                <i class="fa-solid fa-magnifying-glass
                                          mb-2 block text-2xl text-slate-300">
                                </i>
                                Lokasi yang dicari tidak ditemukan.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            {{-- FOOTER TABEL --}}
            @if ($lokasi->isNotEmpty())
                <div class="border-t border-slate-100 bg-slate-50/50
                            px-6 py-3">
                    <p class="text-xs text-slate-400">
                        Menampilkan
                        <span id="jumlahLokasi"
                              class="font-semibold text-slate-600">
                            {{ $lokasi->count() }}
                        </span>
                        lokasi ruangan.
                    </p>
                </div>
            @endif
        </div>
    </div>
</div>


{{-- ================================================= --}}
{{-- MODAL TAMBAH LOKASI                               --}}
{{-- ================================================= --}}
<div id="modalCreate"
     class="fixed inset-0 z-50 hidden overflow-y-auto"
     aria-labelledby="modal-create-title"
     role="dialog"
     aria-modal="true">

    <div class="flex min-h-screen items-center justify-center
                px-4 pb-20 pt-4 text-center sm:block sm:p-0">

        {{-- BACKDROP --}}
        <div class="fixed inset-0 bg-slate-900/40
                    backdrop-blur-sm transition-opacity"
             onclick="closeCreateModal()">
        </div>

        <span class="hidden sm:inline-block sm:h-screen
                     sm:align-middle"
              aria-hidden="true">&#8203;</span>

        {{-- PANEL MODAL --}}
        <div class="inline-block w-full max-w-lg transform
                    overflow-hidden rounded-2xl border border-slate-100
                    bg-white text-left align-bottom shadow-2xl
                    transition-all sm:my-8 sm:align-middle">

            {{-- HEADER MODAL --}}
            <div class="flex items-center justify-between
                        border-b border-slate-100 p-6">

                <div class="flex items-center space-x-3">
                    <div class="flex h-10 w-10 items-center justify-center
                                rounded-xl bg-brand-50 font-bold
                                text-brand-500">
                        <i class="fa-solid fa-plus text-base"></i>
                    </div>

                    <div>
                        <h3 id="modal-create-title"
                            class="text-base font-bold text-slate-800">
                            Tambah Lokasi Baru
                        </h3>
                        <p class="text-xs text-slate-400">
                            Isi informasi lokasi ruangan.
                        </p>
                    </div>
                </div>

                <button type="button"
                        onclick="closeCreateModal()"
                        class="flex h-8 w-8 items-center justify-center
                               rounded-lg bg-slate-100 text-slate-400
                               transition-colors hover:bg-slate-200
                               hover:text-slate-600">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            {{-- FORM TAMBAH --}}
            <form id="formCreateLokasi"
                  action="{{ route('admin.lokasi.store') }}"
                  method="POST">

                @csrf

                <div class="max-h-[65vh] space-y-4 overflow-y-auto p-6">

                    {{-- KODE LOKASI --}}
                    <div>
                        <label for="create_kode"
                               class="mb-2 block text-xs font-bold
                                      uppercase tracking-wider text-slate-600">
                            Kode Lokasi <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="text"
                            id="create_kode"
                            name="kode"
                            value="{{ old('kode', $kodeBaru) }}"
                            required
                            maxlength="255"
                            placeholder="Contoh: LOK-001"
                            class="w-full rounded-xl border
                                   border-slate-200 bg-slate-50
                                   px-4 py-2.5 text-sm text-slate-700
                                   transition-all focus:border-brand-500
                                   focus:bg-white focus:outline-none"
                        >

                        <p class="mt-1 text-xs text-slate-400">
                            Kode terisi otomatis dan dapat diubah.
                        </p>
                    </div>

                    {{-- NAMA RUANGAN --}}
                    <div>
                        <label for="create_ruangan"
                               class="mb-2 block text-xs font-bold
                                      uppercase tracking-wider text-slate-600">
                            Nama Ruangan <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="text"
                            id="create_ruangan"
                            name="ruangan"
                            value="{{ old('ruangan') }}"
                            required
                            maxlength="255"
                            placeholder="Contoh: Laboratorium Komputer"
                            class="w-full rounded-xl border
                                   border-slate-200 bg-slate-50
                                   px-4 py-2.5 text-sm text-slate-700
                                   transition-all focus:border-brand-500
                                   focus:bg-white focus:outline-none"
                        >
                    </div>

                    {{-- PENANGGUNG JAWAB --}}
                    <div>
                        <label for="create_pj"
                               class="mb-2 block text-xs font-bold
                                      uppercase tracking-wider text-slate-600">
                            Penanggung Jawab
                            <span class="text-red-500">*</span>
                        </label>

                        <select
                            id="create_pj"
                            name="id_penanggung_jawab"
                            required
                            class="w-full rounded-xl border
                                   border-slate-200 bg-slate-50
                                   px-4 py-2.5 text-sm text-slate-700
                                   transition-all focus:border-brand-500
                                   focus:bg-white focus:outline-none"
                        >
                            <option value="">
                                Pilih penanggung jawab
                            </option>

                            @foreach ($penanggungJawabs as $pj)
                                <option
                                    value="{{ $pj->id }}"
                                    @selected(
                                        old('id_penanggung_jawab') == $pj->id
                                    )
                                >
                                    {{ $pj->nama_lengkap }}
                                </option>
                            @endforeach
                        </select>

                        @if ($penanggungJawabs->isEmpty())
                            <p class="mt-2 text-xs text-red-500">
                                Belum ada penanggung jawab aktif.
                                Tambahkan data penanggung jawab terlebih dahulu.
                            </p>
                        @endif
                    </div>

                    {{-- KETERANGAN --}}
                    <div>
                        <label for="create_keterangan"
                               class="mb-2 block text-xs font-bold
                                      uppercase tracking-wider text-slate-600">
                            Keterangan
                        </label>

                        <textarea
                            id="create_keterangan"
                            name="keterangan"
                            rows="3"
                            placeholder="Penjelasan mengenai lokasi..."
                            class="w-full rounded-xl border
                                   border-slate-200 bg-slate-50
                                   px-4 py-2.5 text-sm text-slate-700
                                   transition-all focus:border-brand-500
                                   focus:bg-white focus:outline-none"
                        >{{ old('keterangan') }}</textarea>
                    </div>
                </div>

                {{-- FOOTER MODAL --}}
                <div class="flex items-center justify-end space-x-3
                            border-t border-slate-100 bg-slate-50/50 p-6">

                    <button
                        type="button"
                        onclick="closeCreateModal()"
                        class="rounded-xl border border-slate-200
                               px-5 py-2.5 text-sm font-medium
                               text-slate-600 transition-colors
                               hover:bg-slate-100"
                    >
                        Batal
                    </button>

                    <button
                        type="submit"
                        @disabled($penanggungJawabs->isEmpty())
                        class="flex items-center space-x-2 rounded-xl
                               bg-brand-600 px-5 py-2.5 text-sm
                               font-medium text-white shadow-lg
                               shadow-brand-500/25 transition-all
                               hover:bg-brand-700
                               disabled:cursor-not-allowed
                               disabled:opacity-50"
                    >
                        <i class="fa-solid fa-floppy-disk text-xs"></i>
                        <span>Simpan Lokasi</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


{{-- ================================================= --}}
{{-- MODAL EDIT LOKASI                                 --}}
{{-- ================================================= --}}
<div id="modalEdit"
     class="fixed inset-0 z-50 hidden overflow-y-auto"
     aria-labelledby="modal-edit-title"
     role="dialog"
     aria-modal="true">

    <div class="flex min-h-screen items-center justify-center
                px-4 pb-20 pt-4 text-center sm:block sm:p-0">

        {{-- BACKDROP --}}
        <div class="fixed inset-0 bg-slate-900/40
                    backdrop-blur-sm transition-opacity"
             onclick="closeEditModal()">
        </div>

        <span class="hidden sm:inline-block sm:h-screen
                     sm:align-middle"
              aria-hidden="true">&#8203;</span>

        {{-- PANEL MODAL --}}
        <div class="inline-block w-full max-w-lg transform
                    overflow-hidden rounded-2xl border border-slate-100
                    bg-white text-left align-bottom shadow-2xl
                    transition-all sm:my-8 sm:align-middle">

            {{-- HEADER --}}
            <div class="flex items-center justify-between
                        border-b border-slate-100 p-6">

                <div class="flex items-center space-x-3">
                    <div class="flex h-10 w-10 items-center justify-center
                                rounded-xl bg-amber-50 font-bold
                                text-amber-500">
                        <i class="fa-solid fa-pen-to-square text-base"></i>
                    </div>

                    <div>
                        <h3 id="modal-edit-title"
                            class="text-base font-bold text-slate-800">
                            Edit Lokasi
                        </h3>
                        <p class="text-xs text-slate-400">
                            Ubah rincian informasi lokasi.
                        </p>
                    </div>
                </div>

                <button type="button"
                        onclick="closeEditModal()"
                        class="flex h-8 w-8 items-center justify-center
                               rounded-lg bg-slate-100 text-slate-400
                               transition-colors hover:bg-slate-200
                               hover:text-slate-600">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            {{-- FORM EDIT --}}
            <form id="formEditLokasi" method="POST">
                @csrf
                @method('PUT')

                <div class="max-h-[65vh] space-y-4 overflow-y-auto p-6">

                    {{-- KODE --}}
                    <div>
                        <label for="edit_kode"
                               class="mb-2 block text-xs font-bold
                                      uppercase tracking-wider text-slate-600">
                            Kode Lokasi <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="text"
                            id="edit_kode"
                            name="kode"
                            required
                            maxlength="255"
                            placeholder="Contoh: LOK-001"
                            class="w-full rounded-xl border
                                   border-slate-200 bg-slate-50
                                   px-4 py-2.5 text-sm text-slate-700
                                   transition-all focus:border-brand-500
                                   focus:bg-white focus:outline-none"
                        >
                        <p class="mt-1 text-xs text-slate-400">
                            Kode lokasi dapat diubah selama belum digunakan
                            oleh lokasi lain.
                        </p>
                    </div>

                    {{-- RUANGAN --}}
                    <div>
                        <label for="edit_ruangan"
                               class="mb-2 block text-xs font-bold
                                      uppercase tracking-wider text-slate-600">
                            Nama Ruangan <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="text"
                            id="edit_ruangan"
                            name="ruangan"
                            required
                            maxlength="255"
                            placeholder="Nama ruangan"
                            class="w-full rounded-xl border
                                   border-slate-200 bg-slate-50
                                   px-4 py-2.5 text-sm text-slate-700
                                   transition-all focus:border-brand-500
                                   focus:bg-white focus:outline-none"
                        >
                    </div>

                    {{-- PENANGGUNG JAWAB --}}
                    <div>
                        <label for="edit_pj"
                               class="mb-2 block text-xs font-bold
                                      uppercase tracking-wider text-slate-600">
                            Penanggung Jawab
                            <span class="text-red-500">*</span>
                        </label>

                        <select
                            id="edit_pj"
                            name="id_penanggung_jawab"
                            required
                            class="w-full rounded-xl border
                                   border-slate-200 bg-slate-50
                                   px-4 py-2.5 text-sm text-slate-700
                                   transition-all focus:border-brand-500
                                   focus:bg-white focus:outline-none"
                        >
                            <option value="">
                                Pilih penanggung jawab
                            </option>

                            @foreach ($penanggungJawabs as $pj)
                                <option value="{{ $pj->id }}">
                                    {{ $pj->nama_lengkap }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- KETERANGAN --}}
                    <div>
                        <label for="edit_keterangan"
                               class="mb-2 block text-xs font-bold
                                      uppercase tracking-wider text-slate-600">
                            Keterangan
                        </label>

                        <textarea
                            id="edit_keterangan"
                            name="keterangan"
                            rows="3"
                            placeholder="Penjelasan mengenai lokasi..."
                            class="w-full rounded-xl border
                                   border-slate-200 bg-slate-50
                                   px-4 py-2.5 text-sm text-slate-700
                                   transition-all focus:border-brand-500
                                   focus:bg-white focus:outline-none"
                        ></textarea>
                    </div>
                </div>

                {{-- FOOTER --}}
                <div class="flex items-center justify-end space-x-3
                            border-t border-slate-100 bg-slate-50/50 p-6">

                    <button
                        type="button"
                        onclick="closeEditModal()"
                        class="rounded-xl border border-slate-200
                               px-5 py-2.5 text-sm font-medium
                               text-slate-600 transition-colors
                               hover:bg-slate-100"
                    >
                        Batal
                    </button>

                    <button
                        type="submit"
                        @disabled($penanggungJawabs->isEmpty())
                        class="flex items-center space-x-2 rounded-xl
                               bg-brand-600 px-5 py-2.5 text-sm
                               font-medium text-white shadow-lg
                               shadow-brand-500/25 transition-all
                               hover:bg-brand-700
                               disabled:cursor-not-allowed
                               disabled:opacity-50"
                    >
                        <i class="fa-solid fa-floppy-disk text-xs"></i>
                        <span>Simpan Perubahan</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


{{-- ================================================= --}}
{{-- MODAL HAPUS LOKASI                                --}}
{{-- ================================================= --}}
<div id="modalDelete"
     class="fixed inset-0 z-50 hidden overflow-y-auto"
     aria-labelledby="modal-delete-title"
     role="dialog"
     aria-modal="true">

    <div class="flex min-h-screen items-center justify-center
                px-4 pb-20 pt-4 text-center sm:block sm:p-0">

        {{-- BACKDROP --}}
        <div class="fixed inset-0 bg-slate-900/40
                    backdrop-blur-sm transition-opacity"
             onclick="closeDeleteModal()">
        </div>

        <span class="hidden sm:inline-block sm:h-screen
                     sm:align-middle"
              aria-hidden="true">&#8203;</span>

        {{-- PANEL MODAL --}}
        <div class="inline-block w-full max-w-md transform
                    overflow-hidden rounded-2xl border border-slate-100
                    bg-white text-left align-bottom shadow-2xl
                    transition-all sm:my-8 sm:align-middle">

            <div class="p-6 text-center">

                <div class="mx-auto mb-4 flex h-14 w-14
                            items-center justify-center rounded-2xl
                            bg-red-50 text-xl text-red-500">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                </div>

                <h3 id="modal-delete-title"
                    class="mb-2 text-lg font-bold text-slate-800">
                    Hapus Lokasi?
                </h3>

                <p class="mb-1 text-sm text-slate-500">
                    Apakah kamu yakin ingin menghapus lokasi
                    <span id="deleteNamaLokasi"
                          class="font-semibold text-slate-700"></span>?
                </p>

                <p class="text-xs text-slate-400">
                    Tindakan ini tidak dapat dibatalkan.
                </p>
            </div>

            {{-- FORM HAPUS --}}
            <form id="formDeleteLokasi"
                  method="POST"
                  class="flex items-center justify-center space-x-3
                         border-t border-slate-100 bg-slate-50/50 p-6">

                @csrf
                @method('DELETE')

                <button
                    type="button"
                    onclick="closeDeleteModal()"
                    class="w-1/2 rounded-xl border border-slate-200
                           py-2.5 text-sm font-medium text-slate-600
                           transition-colors hover:bg-slate-100"
                >
                    Batal
                </button>

                <button
                    type="submit"
                    class="flex w-1/2 items-center justify-center
                           space-x-2 rounded-xl bg-red-600 py-2.5
                           text-sm font-medium text-white
                           shadow-lg shadow-red-500/25
                           transition-all hover:bg-red-700"
                >
                    <i class="fa-solid fa-trash-can text-xs"></i>
                    <span>Ya, Hapus</span>
                </button>
            </form>
        </div>
    </div>
</div>


{{-- ================================================= --}}
{{-- JAVASCRIPT MODAL & PENCARIAN                      --}}
{{-- ================================================= --}}
<script>
    // Pola URL dari resource route Laravel.
    const updateRoutePattern =
        @json(route('admin.lokasi.update', ['lokasi' => '__ID__']));

    const destroyRoutePattern =
        @json(route('admin.lokasi.destroy', ['lokasi' => '__ID__']));

    // Ganti placeholder ID dengan ID lokasi yang dipilih.
    function buildRoute(pattern, id) {
        return pattern.replace('__ID__', encodeURIComponent(id));
    }

    // ==============================
    // MODAL TAMBAH
    // ==============================
    function openCreateModal() {
        document.getElementById('modalCreate')
            .classList.remove('hidden');
    }

    function closeCreateModal() {
        document.getElementById('modalCreate')
            .classList.add('hidden');
    }

    // ==============================
    // MODAL EDIT
    // ==============================
    function openEditModal(id, kode, ruangan, idPenanggungJawab, keterangan) {
        const form = document.getElementById('formEditLokasi');

        form.action = buildRoute(updateRoutePattern, id);

        document.getElementById('edit_kode').value = kode ?? '';
        document.getElementById('edit_ruangan').value = ruangan ?? '';
        document.getElementById('edit_pj').value =
            String(idPenanggungJawab ?? '');
        document.getElementById('edit_keterangan').value =
            keterangan ?? '';

        document.getElementById('modalEdit')
            .classList.remove('hidden');
    }

    function closeEditModal() {
        document.getElementById('modalEdit')
            .classList.add('hidden');
    }

    // ==============================
    // MODAL HAPUS
    // ==============================
    function openDeleteModal(id, ruangan) {
        const form = document.getElementById('formDeleteLokasi');

        form.action = buildRoute(destroyRoutePattern, id);

        document.getElementById('deleteNamaLokasi').textContent =
            '"' + (ruangan ?? '') + '"';

        document.getElementById('modalDelete')
            .classList.remove('hidden');
    }

    function closeDeleteModal() {
        document.getElementById('modalDelete')
            .classList.add('hidden');
    }

    // ==============================
    // TUTUP MODAL DENGAN ESCAPE
    // ==============================
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeCreateModal();
            closeEditModal();
            closeDeleteModal();
        }
    });

    // ==============================
    // PENCARIAN LOKASI
    // ==============================
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchLokasi');
        const rows = Array.from(
            document.querySelectorAll('.baris-lokasi')
        );
        const emptyResult = document.getElementById('hasilTidakDitemukan');
        const countLabel = document.getElementById('jumlahLokasi');

        if (!searchInput) return;

        function filterLokasi() {
            const keyword = searchInput.value
                .toLowerCase()
                .trim();

            let visibleCount = 0;

            rows.forEach(function(row) {
                const cocok = row.textContent
                    .toLowerCase()
                    .includes(keyword);

                row.classList.toggle('hidden', !cocok);

                if (cocok) visibleCount++;
            });

            if (emptyResult) {
                emptyResult.classList.toggle(
                    'hidden',
                    visibleCount !== 0 || rows.length === 0
                );
            }

            if (countLabel) {
                countLabel.textContent = visibleCount;
            }
        }

        searchInput.addEventListener('input', filterLokasi);
    });
</script>

{{-- BUKA KEMBALI MODAL TAMBAH JIKA VALIDASI CREATE GAGAL --}}
@if ($errors->any() && old('_token') && !old('_method'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            openCreateModal();
        });
    </script>
@endif

@endsection