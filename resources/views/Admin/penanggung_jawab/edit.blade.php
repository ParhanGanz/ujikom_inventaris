@extends('layouts.app')

@section('title', 'Edit Penanggung Jawab')

@section('content')
    <div class="space-y-6">

        {{-- Header --}}
        <div>
            <div class="mb-2 flex items-center gap-2 text-xs font-medium text-slate-500">
                <i class="fa-solid fa-database"></i>
                <span>Master Data</span>
                <i class="fa-solid fa-chevron-right text-[10px]"></i>
                <a href="{{ route('admin.penanggung_jawab.index') }}"
                    class="transition hover:text-slate-800">
                    Penanggung Jawab
                </a>
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

        {{-- Error Validasi --}}
        @if ($errors->any())
            <div class="flex items-start gap-3 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                <i class="fa-solid fa-circle-exclamation mt-0.5 text-lg"></i>
                <div>
                    <p class="font-semibold">Periksa kembali data yang dimasukkan.</p>
                    <ul class="mt-2 list-inside list-disc space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        {{-- Form Edit --}}
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-200 px-6 py-5">
                <div class="flex items-center gap-3">
                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-amber-50 text-amber-600">
                        <i class="fa-solid fa-user-pen text-lg"></i>
                    </div>

                    <div>
                        <h2 class="font-semibold text-slate-800">
                            Informasi Penanggung Jawab
                        </h2>
                        <p class="mt-1 text-sm text-slate-500">
                            Ubah data sesuai informasi terbaru.
                        </p>
                    </div>
                </div>
            </div>

            <form action="{{ route('admin.penanggung_jawab.update', $penanggung_jawab->id) }}"
                method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 gap-5 p-6 md:grid-cols-2">

                    {{-- Nama Lengkap --}}
                    <div>
                        <label for="nama_lengkap"
                            class="mb-2 block text-sm font-medium text-slate-700">
                            Nama Lengkap <span class="text-red-500">*</span>
                        </label>

                        <input type="text" id="nama_lengkap" name="nama_lengkap"
                            value="{{ old('nama_lengkap', $penanggung_jawab->nama_lengkap) }}"
                            required maxlength="255" autocomplete="name"
                            placeholder="Masukkan nama lengkap"
                            class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none transition placeholder:text-slate-400 focus:border-brand-500 focus:ring-2 focus:ring-brand-100">

                        @error('nama_lengkap')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- NIP / NUPTK --}}
                    <div>
                        <label for="nip_nutpk"
                            class="mb-2 block text-sm font-medium text-slate-700">
                            NIP/NUPTK
                        </label>

                        <input type="text" id="nip_nutpk" name="nip_nutpk"
                            value="{{ old('nip_nutpk', $penanggung_jawab->nip_nutpk) }}"
                            maxlength="50" placeholder="Masukkan NIP/NUPTK jika ada"
                            class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none transition placeholder:text-slate-400 focus:border-brand-500 focus:ring-2 focus:ring-brand-100">

                        @error('nip_nutpk')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Jabatan --}}
                    <div>
                        <label for="jabatan"
                            class="mb-2 block text-sm font-medium text-slate-700">
                            Jabatan <span class="text-red-500">*</span>
                        </label>

                        <input type="text" id="jabatan" name="jabatan"
                            value="{{ old('jabatan', $penanggung_jawab->jabatan) }}"
                            required maxlength="100" placeholder="Contoh: Guru, Kepala Lab"
                            class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none transition placeholder:text-slate-400 focus:border-brand-500 focus:ring-2 focus:ring-brand-100">

                        @error('jabatan')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div>
                        <label for="email"
                            class="mb-2 block text-sm font-medium text-slate-700">
                            Email
                        </label>

                        <input type="email" id="email" name="email"
                            value="{{ old('email', $penanggung_jawab->email) }}"
                            maxlength="255" autocomplete="email"
                            placeholder="contoh@email.com"
                            class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none transition placeholder:text-slate-400 focus:border-brand-500 focus:ring-2 focus:ring-brand-100">

                        @error('email')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Nomor Telepon --}}
                    <div>
                        <label for="no_telepon"
                            class="mb-2 block text-sm font-medium text-slate-700">
                            Nomor Telepon
                        </label>

                        <input type="text" id="no_telepon" name="no_telepon"
                            value="{{ old('no_telepon', $penanggung_jawab->no_telepon) }}"
                            maxlength="20" autocomplete="tel"
                            placeholder="Masukkan nomor telepon"
                            class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none transition placeholder:text-slate-400 focus:border-brand-500 focus:ring-2 focus:ring-brand-100">

                        @error('no_telepon')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Status --}}
                    <div>
                        <label for="status"
                            class="mb-2 block text-sm font-medium text-slate-700">
                            Status <span class="text-red-500">*</span>
                        </label>

                        <select id="status" name="status" required
                            class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none transition focus:border-brand-500 focus:ring-2 focus:ring-brand-100">
                            <option value="aktif"
                                {{ old('status', $penanggung_jawab->status) === 'aktif' ? 'selected' : '' }}>
                                Aktif
                            </option>
                            <option value="tidak"
                                {{ old('status', $penanggung_jawab->status) === 'tidak' ? 'selected' : '' }}>
                                Tidak Aktif
                            </option>
                        </select>

                        @error('status')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                {{-- Tombol --}}
                <div class="flex flex-col-reverse gap-3 border-t border-slate-200 bg-slate-50 px-6 py-5 sm:flex-row sm:justify-end">

                    <a href="{{ route('admin.penanggung_jawab.index') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-5 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-100">
                        <i class="fa-solid fa-arrow-left"></i>
                        Kembali
                    </a>

                    <button type="submit"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-brand-600 px-5 py-2.5 text-sm font-semibold text-white shadow-lg shadow-brand-500/25 transition hover:bg-brand-700">
                        <i class="fa-solid fa-floppy-disk"></i>
                        Simpan Perubahan
                    </button>

                </div>
            </form>
        </div>
    </div>
@endsection