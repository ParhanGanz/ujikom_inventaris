@extends('layouts.app')

@section('title', 'Edit Penanggung Jawab')

@section('content')
<div class="mx-auto max-w-4xl space-y-6">

    {{-- Header --}}
    <div>
        <div class="mb-2 flex items-center gap-2 text-xs font-medium text-slate-500">
            <a href="{{ route('admin.penanggung_jawab.index') }}"
               class="transition hover:text-slate-800">
                Master Data
            </a>
            <i class="fa-solid fa-chevron-right text-[10px]"></i>
            <span>Penanggung Jawab</span>
            <i class="fa-solid fa-chevron-right text-[10px]"></i>
            <span class="text-slate-700">Edit</span>
        </div>

        <h1 class="text-2xl font-bold text-slate-800">
            Edit Penanggung Jawab
        </h1>
        <p class="mt-1 text-sm text-slate-500">
            Perbarui informasi penanggung jawab inventaris sekolah.
        </p>
    </div>

    {{-- Error validasi --}}
    @if ($errors->any())
        <div class="rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
            <div class="flex items-center gap-2 font-semibold">
                <i class="fa-solid fa-circle-exclamation"></i>
                Periksa kembali data yang kamu masukkan.
            </div>

            <ul class="mt-2 list-inside list-disc space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form --}}
    <form action="{{ route('admin.penanggung_jawab.update', $penanggungJawab->id) }}"
          method="POST"
          class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        @csrf
        @method('PUT')

        <div class="flex items-center gap-3 border-b border-slate-200 px-6 py-5">
            <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-amber-50 text-amber-600">
                <i class="fa-solid fa-user-pen text-lg"></i>
            </div>
            <div>
                <h2 class="font-semibold text-slate-800">Perbarui Informasi</h2>
                <p class="mt-1 text-xs text-slate-500">
                    Periksa kembali data sebelum menyimpan perubahan.
                </p>
            </div>
        </div>

        <div class="space-y-5 p-6">

            {{-- Nama lengkap --}}
            <div>
                <label for="nama_lengkap" class="mb-2 block text-sm font-semibold text-slate-700">
                    Nama Lengkap <span class="text-red-500">*</span>
                </label>
                <input
                    id="nama_lengkap"
                    name="nama_lengkap"
                    type="text"
                    value="{{ old('nama_lengkap', $penanggungJawab->nama_lengkap) }}"
                    required
                    maxlength="255"
                    placeholder="Masukkan nama lengkap"
                    class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none transition placeholder:text-slate-400 focus:border-slate-400 focus:ring-2 focus:ring-slate-100 @error('nama_lengkap') border-red-400 @enderror"
                >
                @error('nama_lengkap')
                    <p class="mt-2 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- NIP/NUPTK --}}
            <div>
                <label for="nip_nutpk" class="mb-2 block text-sm font-semibold text-slate-700">
                    NIP/NUPTK
                    <span class="font-normal text-slate-400">(Opsional)</span>
                </label>
                <input
                    id="nip_nutpk"
                    name="nip_nutpk"
                    type="text"
                    value="{{ old('nip_nutpk', $penanggungJawab->nip_nutpk) }}"
                    maxlength="255"
                    placeholder="Masukkan NIP atau NUPTK jika ada"
                    class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none transition placeholder:text-slate-400 focus:border-slate-400 focus:ring-2 focus:ring-slate-100 @error('nip_nutpk') border-red-400 @enderror"
                >
                @error('nip_nutpk')
                    <p class="mt-2 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Jabatan --}}
            <div>
                <label for="jabatan" class="mb-2 block text-sm font-semibold text-slate-700">
                    Jabatan <span class="text-red-500">*</span>
                </label>
                <input
                    id="jabatan"
                    name="jabatan"
                    type="text"
                    value="{{ old('jabatan', $penanggungJawab->jabatan) }}"
                    required
                    maxlength="255"
                    placeholder="Contoh: Kepala Laboratorium"
                    class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none transition placeholder:text-slate-400 focus:border-slate-400 focus:ring-2 focus:ring-slate-100 @error('jabatan') border-red-400 @enderror"
                >
                @error('jabatan')
                    <p class="mt-2 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email dan telepon --}}
            <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                <div>
                    <label for="email" class="mb-2 block text-sm font-semibold text-slate-700">
                        Email <span class="font-normal text-slate-400">(Opsional)</span>
                    </label>
                    <input
                        id="email"
                        name="email"
                        type="email"
                        value="{{ old('email', $penanggungJawab->email) }}"
                        maxlength="255"
                        placeholder="nama@sekolah.sch.id"
                        class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none transition placeholder:text-slate-400 focus:border-slate-400 focus:ring-2 focus:ring-slate-100 @error('email') border-red-400 @enderror"
                    >
                    @error('email')
                        <p class="mt-2 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="no_telepon" class="mb-2 block text-sm font-semibold text-slate-700">
                        Nomor Telepon <span class="font-normal text-slate-400">(Opsional)</span>
                    </label>
                    <input
                        id="no_telepon"
                        name="no_telepon"
                        type="text"
                        value="{{ old('no_telepon', $penanggungJawab->no_telepon) }}"
                        maxlength="20"
                        placeholder="Contoh: 081234567890"
                        class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none transition placeholder:text-slate-400 focus:border-slate-400 focus:ring-2 focus:ring-slate-100 @error('no_telepon') border-red-400 @enderror"
                    >
                    @error('no_telepon')
                        <p class="mt-2 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Status --}}
            <div>
                <label for="status" class="mb-2 block text-sm font-semibold text-slate-700">
                    Status <span class="text-red-500">*</span>
                </label>
                <select
                    id="status"
                    name="status"
                    required
                    class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none transition focus:border-slate-400 focus:ring-2 focus:ring-slate-100 @error('status') border-red-400 @enderror"
                >
                    <option value="aktif"
                        {{ old('status', $penanggungJawab->status) === 'aktif' ? 'selected' : '' }}>
                        Aktif
                    </option>
                    <option value="tidak"
                        {{ old('status', $penanggungJawab->status) === 'tidak' ? 'selected' : '' }}>
                        Tidak Aktif
                    </option>
                </select>
                @error('status')
                    <p class="mt-2 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- Footer --}}
        <div class="flex flex-col-reverse gap-3 border-t border-slate-200 bg-slate-50 px-6 py-4 sm:flex-row sm:justify-end">
            <a href="{{ route('admin.penanggung_jawab.index') }}"
               class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-100">
                <i class="fa-solid fa-arrow-left"></i>
                Kembali
            </a>

            <button type="submit"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-slate-800 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-700">
                <i class="fa-solid fa-floppy-disk"></i>
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection