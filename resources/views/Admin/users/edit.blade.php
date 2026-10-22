@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-4xl space-y-6 px-4 py-6 sm:px-6 lg:px-8">

    <div>
        <a href="{{ route('admin.users.index') }}"
           class="mb-3 inline-flex items-center gap-2 text-sm text-gray-500 hover:text-blue-600">
            <i class="fa-solid fa-arrow-left"></i>
            Kembali ke Direktori Pengguna
        </a>

        <h1 class="text-2xl font-bold text-gray-800">Edit Pengguna</h1>
        <p class="mt-1 text-sm text-gray-500">
            Perbarui informasi akun pengguna.
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

    <form action="{{ route('admin.users.update', $user) }}"
          method="POST"
          enctype="multipart/form-data"
          class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
        @csrf
        @method('PUT')

        <div class="border-b border-gray-200 px-6 py-4">
            <h2 class="font-semibold text-gray-800">Informasi Akun</h2>
            <p class="mt-1 text-sm text-gray-500">
                Perubahan akan diterapkan setelah disimpan.
            </p>
        </div>

        <div class="grid grid-cols-1 gap-5 p-6 md:grid-cols-2">

            <div class="md:col-span-2">
                <label class="mb-2 block text-sm font-medium text-gray-700">
                    Foto Profil Saat Ini
                </label>

                <div class="flex items-center gap-4">
                    @if ($user->foto)
                        <img src="{{ \Illuminate\Support\Facades\Storage::url($user->foto) }}"
                             alt="Foto {{ $user->nama_lengkap }}"
                             class="h-20 w-20 rounded-full border border-gray-200 object-cover">
                    @else
                        <div class="flex h-20 w-20 items-center justify-center rounded-full bg-blue-100 text-2xl font-bold text-blue-700">
                            {{ strtoupper(substr($user->nama_lengkap, 0, 1)) }}
                        </div>
                    @endif

                    <div>
                        <p class="font-semibold text-gray-800">{{ $user->nama_lengkap }}</p>
                        <p class="text-sm text-gray-500">{{ $user->email }}</p>
                    </div>
                </div>
            </div>

            <div class="md:col-span-2">
                <label for="nama_lengkap" class="mb-2 block text-sm font-medium text-gray-700">
                    Nama Lengkap *
                </label>
                <input type="text" id="nama_lengkap" name="nama_lengkap"
                       value="{{ old('nama_lengkap', $user->nama_lengkap) }}" required
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
                       value="{{ old('username', $user->username) }}" required
                       autocomplete="username"
                       class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                @error('username')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="mb-2 block text-sm font-medium text-gray-700">
                    Email *
                </label>
                <input type="email" id="email" name="email"
                       value="{{ old('email', $user->email) }}" required
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
                       value="{{ old('no_whatsapp', $user->no_whatsapp) }}"
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
                        @disabled(auth()->id() === $user->id)
                        class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100 disabled:cursor-not-allowed disabled:bg-gray-100 disabled:text-gray-500">
                    <option value="petugas" @selected(old('role', $user->role) === 'petugas')>
                        Petugas
                    </option>
                    <option value="admin" @selected(old('role', $user->role) === 'admin')>
                        Admin
                    </option>
                </select>
                @if (auth()->id() === $user->id)
                    <p class="mt-1 text-xs text-gray-400">
                        Role akun sendiri tidak dapat diubah dari halaman ini.
                    </p>
                @endif
                @error('role')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="status" class="mb-2 block text-sm font-medium text-gray-700">
                    Status Akun *
                </label>
                <select id="status" name="status" required
                        @disabled(auth()->id() === $user->id)
                        class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100 disabled:cursor-not-allowed disabled:bg-gray-100 disabled:text-gray-500">
                    <option value="aktif" @selected(old('status', $user->status) === 'aktif')>
                        Aktif
                    </option>
                    <option value="nonaktif" @selected(old('status', $user->status) === 'nonaktif')>
                        Nonaktif
                    </option>
                </select>
                @if (auth()->id() === $user->id)
                    <p class="mt-1 text-xs text-gray-400">
                        Status akun sendiri tidak dapat diubah dari halaman ini.
                    </p>
                @endif
                @error('status')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="mb-2 block text-sm font-medium text-gray-700">
                    Password Baru
                </label>
                <input type="password" id="password" name="password"
                       minlength="8" autocomplete="new-password"
                       placeholder="Kosongkan jika tidak diganti"
                       class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                <p class="mt-1 text-xs text-gray-400">Minimal 8 karakter jika ingin mengganti.</p>
                @error('password')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="mb-2 block text-sm font-medium text-gray-700">
                    Konfirmasi Password Baru
                </label>
                <input type="password" id="password_confirmation"
                       name="password_confirmation" minlength="8"
                       autocomplete="new-password"
                       placeholder="Ulangi password baru"
                       class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
            </div>

            <div class="md:col-span-2">
                <label for="foto" class="mb-2 block text-sm font-medium text-gray-700">
                    Ganti Foto Profil
                </label>
                <input type="file" id="foto" name="foto" accept=".jpg,.jpeg,.png,.webp"
                       class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm file:mr-4 file:rounded-md file:border-0 file:bg-blue-50 file:px-3 file:py-2 file:font-medium file:text-blue-700 hover:file:bg-blue-100">
                <p class="mt-1 text-xs text-gray-400">
                    JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB. Kosongkan jika tidak ingin mengganti foto.
                </p>
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
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection