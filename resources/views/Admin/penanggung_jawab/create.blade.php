@extends('layouts.app')

@section('title', 'Tambah Penanggung Jawab')

@section('content')
<div class="mx-auto max-w-4xl space-y-6">

    {{-- Header --}}
    <div>
        <a href="{{ route('admin.penanggung_jawab.index') }}"
           class="mb-3 inline-flex items-center gap-2 text-sm font-medium text-slate-500 transition hover:text-indigo-600">
            <i class="fa-solid fa-arrow-left"></i>
            Kembali ke Data Penanggung Jawab
        </a>

        <h1 class="text-2xl font-bold text-slate-800">
            Tambah Penanggung Jawab
        </h1>
        <p class="mt-1 text-sm text-slate-500">
            Isi formulir berikut untuk menambahkan penanggung jawab baru.
        </p>
    </div>

    {{-- Form --}}
    <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-8">
        <form action="{{ route('admin.penanggung_jawab.store') }}"
              method="POST"
              class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">

                {{-- NIP/NUTPK --}}
                <div>
                    <label for="nip_nutpk" class="mb-2 block text-sm font-semibold text-slate-700">
                        NIP/NUTPK <span class="font-normal text-slate-400">(Opsional)</span>
                    </label>
                    <input type="text"
                           id="nip_nutpk"
                           name="nip_nutpk"
                           value="{{ old('nip_nutpk') }}"
                           placeholder="Masukkan NIP/NUTPK"
                           class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">
                    @error('nip_nutpk')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Nama --}}
                <div>
                    <label for="nama_lengkap" class="mb-2 block text-sm font-semibold text-slate-700">
                        Nama Lengkap <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                           id="nama_lengkap"
                           name="nama_lengkap"
                           value="{{ old('nama_lengkap') }}"
                           placeholder="Masukkan nama lengkap"
                           required
                           class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">
                    @error('nama_lengkap')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Jabatan --}}
                <div>
                    <label for="jabatan" class="mb-2 block text-sm font-semibold text-slate-700">
                        Jabatan <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                           id="jabatan"
                           name="jabatan"
                           value="{{ old('jabatan') }}"
                           placeholder="Contoh: Kepala Laboratorium"
                           required
                           class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">
                    @error('jabatan')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Lokasi --}}
                <div>
                    <label for="id_lokasi" class="mb-2 block text-sm font-semibold text-slate-700">
                        Lokasi / Ruangan <span class="text-red-500">*</span>
                    </label>
                    <select id="id_lokasi"
                            name="id_lokasi"
                            required
                            class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">
                        <option value="">-- Pilih Lokasi --</option>
                        @foreach ($lokasis as $lokasi)
                            <option value="{{ $lokasi->id }}"
                                {{ old('id_lokasi') == $lokasi->id ? 'selected' : '' }}>
                                {{ $lokasi->ruangan }}
                                {{ $lokasi->kode ? '(' . $lokasi->kode . ')' : '' }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_lokasi')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Telepon --}}
                <div>
                    <label for="no_telepon" class="mb-2 block text-sm font-semibold text-slate-700">
                        Nomor Telepon <span class="font-normal text-slate-400">(Opsional)</span>
                    </label>
                    <input type="text"
                           id="no_telepon"
                           name="no_telepon"
                           value="{{ old('no_telepon') }}"
                           placeholder="Contoh: 08xxxxxxxxxx"
                           class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">
                    @error('no_telepon')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="mb-2 block text-sm font-semibold text-slate-700">
                        Email <span class="font-normal text-slate-400">(Opsional)</span>
                    </label>
                    <input type="email"
                           id="email"
                           name="email"
                           value="{{ old('email') }}"
                           placeholder="nama@sekolah.sch.id"
                           class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Status --}}
                <div class="sm:col-span-2">
                    <label for="status" class="mb-2 block text-sm font-semibold text-slate-700">
                        Status <span class="text-red-500">*</span>
                    </label>
                    <select id="status"
                            name="status"
                            required
                            class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">
                        <option value="aktif" {{ old('status', 'aktif') === 'aktif' ? 'selected' : '' }}>
                            Aktif
                        </option>
                        <option value="tidak" {{ old('status') === 'tidak' ? 'selected' : '' }}>
                            Tidak Aktif
                        </option>
                    </select>
                    @error('status')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            {{-- Tombol --}}
            <div class="flex flex-col-reverse gap-3 border-t border-slate-100 pt-5 sm:flex-row sm:justify-end">
                <a href="{{ route('admin.penanggung_jawab.index') }}"
                   class="rounded-xl border border-slate-300 px-5 py-3 text-center text-sm font-semibold text-slate-600 transition hover:bg-slate-50">
                    Batal
                </a>

                <button type="submit"
                        class="rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-indigo-700">
                    <i class="fa-solid fa-floppy-disk mr-2"></i>
                    Simpan Data
                </button>
            </div>

        </form>
    </div>
</div>
@endsection