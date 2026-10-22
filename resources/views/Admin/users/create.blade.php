@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-4xl space-y-6 px-4 py-6 sm:px-6 lg:px-8">

    <div>
        <a href="{{ route('admin.users.index') }}"
           class="mb-3 inline-flex items-center gap-2 text-sm text-gray-500 hover:text-blue-600">
            <i class="fa-solid fa-arrow-left"></i>
            Kembali ke Direktori Pengguna
        </a>

        <h1 class="text-2xl font-bold text-gray-800">Tambah Pengguna</h1>
        <p class="mt-1 text-sm text-gray-500">
            Isi informasi untuk membuat akun pengguna baru.
        </p>
    </div>

    @if ($errors->any())
        <div class="rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-700">
            <p class="mb-2 font-semibold">Periksa kembali data berikut:</p>
            <ul class="list-inside list-disc space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.users.store') }}"
          method="POST"
          enctype="multipart/form-data"
          class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
        @csrf

        <div class="border-b border-gray-200 px-6 py-4">
            <h2 class="font-semibold text-gray-800">Informasi Akun</h2>
            <p class="mt-1 text-sm text-gray-500">
                Kolom bertanda * wajib diisi.
            </p>
        </div>

        <div class="grid grid-cols-1 gap-5 p-6 md:grid-cols-2">

            <div class="md:col-span-2">
                <label for="nama_lengkap" class="mb-2 block text-sm font-medium text-gray-700">
                    Nama Lengkap *
                </label>
                <input type="text" id="nama_lengkap" name="nama_lengkap"
                       value="{{ old('nama_lengkap') }}" required
                       class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                @error('nama_lengkap')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="username" class="mb-2 block text-sm font-medium text-gray-700">
                    Username *
                </label>
                <input type="text" id="username" name="username"
                       value="{{ old('username') }}" required
                       autocomplete="username"
                       class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                <p class="mt-1 text-xs text-gray-400">Gunakan huruf, angka, tanda hubung, atau garis bawah.</p>
                @error('username')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="mb-2 block text-sm font-medium text-gray-700">
                    Email *
                </label>
                <input type="email" id="email" name="email"
                       value="{{ old('email') }}" required
                       autocomplete="email"
                       class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                @error('email')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="no_whatsapp" class="mb-2 block text-sm font-medium text-gray-700">
                    Nomor WhatsApp
                </label>
                <input type="text" id="no_whatsapp" name="no_whatsapp"
                       value="{{ old('no_whatsapp') }}"
                       placeholder="Contoh: 081234567890"
                       class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                @error('no_whatsapp')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="role" class="mb-2 block text-sm font-medium text-gray-700">
                    Role Pengguna *
                </label>
                <select id="role" name="role" required
                        class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                    <option value="petugas" @selected(old('role', 'petugas') === 'petugas')>
                        Petugas
                    </option>
                    <option value="admin" @selected(old('role') === 'admin')>
                        Admin
                    </option>
                </select>
                @error('role')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="status" class="mb-2 block text-sm font-medium text-gray-700">
                    Status Akun *
                </label>
                <select id="status" name="status" required
                        class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                    <option value="aktif" @selected(old('status', 'aktif') === 'aktif')>
                        Aktif
                    </option>
                    <option value="nonaktif" @selected(old('status') === 'nonaktif')>
                        Nonaktif
                    </option>
                </select>
                @error('status')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="mb-2 block text-sm font-medium text-gray-700">
                    Password *
                </label>
                <input type="password" id="password" name="password"
                       required minlength="8" autocomplete="new-password"
                       class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                <p class="mt-1 text-xs text-gray-400">Minimal 8 karakter.</p>
                @error('password')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="mb-2 block text-sm font-medium text-gray-700">
                    Konfirmasi Password *
                </label>
                <input type="password" id="password_confirmation"
                       name="password_confirmation" required minlength="8"
                       autocomplete="new-password"
                       class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
            </div>

            <div class="md:col-span-2">
                <label for="foto" class="mb-2 block text-sm font-medium text-gray-700">
                    Foto Profil
                </label>
                <input type="file" id="foto" name="foto" accept=".jpg,.jpeg,.png,.webp"
                       class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm file:mr-4 file:rounded-md file:border-0 file:bg-blue-50 file:px-3 file:py-2 file:font-medium file:text-blue-700 hover:file:bg-blue-100">
                <p class="mt-1 text-xs text-gray-400">Format JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.</p>
                @error('foto')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="flex flex-col-reverse gap-3 border-t border-gray-200 bg-gray-50 px-6 py-4 sm:flex-row sm:justify-end">
            <a href="{{ route('admin.users.index') }}"
               class="rounded-lg border border-gray-300 bg-white px-5 py-2.5 text-center text-sm font-semibold text-gray-600 hover:bg-gray-100">
                Batal
            </a>
            <button type="submit"
                    class="rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-700">
                <i class="fa-solid fa-floppy-disk mr-2"></i>
                Simpan Pengguna
            </button>
        </div>
    </form>
</div>
@endsection