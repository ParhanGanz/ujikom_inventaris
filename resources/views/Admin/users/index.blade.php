@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-7xl space-y-6 px-4 py-6 sm:px-6 lg:px-8">

    {{-- Header --}}
    <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Direktori Pengguna</h1>
            <p class="mt-1 text-sm text-gray-500">
                Kelola akun admin dan petugas sistem inventaris.
            </p>
        </div>

        <a href="{{ route('admin.users.create') }}"
           class="inline-flex items-center justify-center gap-2 rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-700">
            <i class="fa-solid fa-user-plus"></i>
            Tambah Pengguna
        </a>
    </div>

    {{-- Notifikasi --}}
    @if (session('success'))
        <div class="rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
            <i class="fa-solid fa-circle-check mr-2"></i>
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
            <i class="fa-solid fa-circle-exclamation mr-2"></i>
            {{ session('error') }}
        </div>
    @endif

    {{-- Pencarian dan Filter --}}
    <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm">
        <form action="{{ route('admin.users.index') }}" method="GET"
              class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-4">

            <div class="xl:col-span-2">
                <label for="search" class="mb-2 block text-sm font-medium text-gray-700">
                    Cari Pengguna
                </label>
                <div class="relative">
                    <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    <input
                        type="text"
                        id="search"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Nama, username, atau email..."
                        class="w-full rounded-lg border border-gray-300 py-2.5 pl-10 pr-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                </div>
            </div>

            <div>
                <label for="role" class="mb-2 block text-sm font-medium text-gray-700">
                    Role
                </label>
                <select id="role" name="role"
                        class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                    <option value="">Semua Role</option>
                    <option value="admin" @selected(request('role') === 'admin')>
                        Admin
                    </option>
                    <option value="petugas" @selected(request('role') === 'petugas')>
                        Petugas
                    </option>
                </select>
            </div>

            <div>
                <label for="status" class="mb-2 block text-sm font-medium text-gray-700">
                    Status
                </label>
                <select id="status" name="status"
                        class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                    <option value="">Semua Status</option>
                    <option value="aktif" @selected(request('status') === 'aktif')>
                        Aktif
                    </option>
                    <option value="nonaktif" @selected(request('status') === 'nonaktif')>
                        Nonaktif
                    </option>
                </select>
            </div>

            <div class="flex flex-wrap gap-2 md:col-span-2 xl:col-span-4">
                <button type="submit"
                        class="rounded-lg bg-gray-800 px-4 py-2 text-sm font-semibold text-white transition hover:bg-gray-700">
                    <i class="fa-solid fa-filter mr-1"></i>
                    Terapkan Filter
                </button>

                <a href="{{ route('admin.users.index') }}"
                   class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-semibold text-gray-600 transition hover:bg-gray-50">
                    Reset
                </a>
            </div>
        </form>
    </div>

    {{-- Tabel Pengguna --}}
    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
        <div class="flex items-center justify-between border-b border-gray-200 px-5 py-4">
            <h2 class="font-semibold text-gray-800">Daftar Pengguna</h2>
            <span class="text-sm text-gray-500">
                {{ $users->total() }} pengguna
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full min-w-[850px] text-left text-sm">
                <thead class="bg-gray-50 text-xs uppercase tracking-wider text-gray-500">
                    <tr>
                        <th class="px-5 py-4">Pengguna</th>
                        <th class="px-5 py-4">Username</th>
                        <th class="px-5 py-4">Kontak</th>
                        <th class="px-5 py-4">Role</th>
                        <th class="px-5 py-4">Status</th>
                        <th class="px-5 py-4 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">
                    @forelse ($users as $user)
                        <tr class="transition hover:bg-gray-50">
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-3">
                                    @if ($user->foto)
                                        <img
                                            src="{{ \Illuminate\Support\Facades\Storage::url($user->foto) }}"
                                            alt="Foto {{ $user->nama_lengkap }}"
                                            class="h-10 w-10 rounded-full border border-gray-200 object-cover">
                                    @else
                                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-100 font-bold text-blue-700">
                                            {{ strtoupper(substr($user->nama_lengkap, 0, 1)) }}
                                        </div>
                                    @endif

                                    <div>
                                        <p class="font-semibold text-gray-800">
                                            {{ $user->nama_lengkap }}
                                        </p>
                                        <p class="text-xs text-gray-500">
                                            {{ $user->email }}
                                        </p>
                                    </div>
                                </div>
                            </td>

                            <td class="px-5 py-4 text-gray-600">
                                {{ $user->username }}
                            </td>

                            <td class="px-5 py-4 text-gray-600">
                                {{ $user->no_whatsapp ?: '-' }}
                            </td>

                            <td class="px-5 py-4">
                                @if ($user->role === 'admin')
                                    <span class="rounded-full bg-purple-100 px-3 py-1 text-xs font-semibold text-purple-700">
                                        Admin
                                    </span>
                                @else
                                    <span class="rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700">
                                        Petugas
                                    </span>
                                @endif
                            </td>

                            <td class="px-5 py-4">
                                @if ($user->status === 'aktif')
                                    <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                        Aktif
                                    </span>
                                @else
                                    <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                                        Nonaktif
                                    </span>
                                @endif
                            </td>

                            <td class="px-5 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.users.edit', $user) }}"
                                       title="Edit pengguna"
                                       class="rounded-lg border border-amber-200 p-2 text-amber-600 transition hover:bg-amber-50">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>

                                    @if (auth()->id() !== $user->id)
                                        <form action="{{ route('admin.users.destroy', $user) }}"
                                              method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus pengguna ini?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    title="Hapus pengguna"
                                                    class="rounded-lg border border-red-200 p-2 text-red-600 transition hover:bg-red-50">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    @else
                                        <span title="Akun yang sedang digunakan tidak dapat dihapus"
                                              class="cursor-not-allowed rounded-lg border border-gray-200 p-2 text-gray-300">
                                            <i class="fa-solid fa-lock"></i>
                                        </span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-5 py-12 text-center">
                                <i class="fa-solid fa-users mb-3 text-3xl text-gray-300"></i>
                                <p class="font-medium text-gray-600">Pengguna tidak ditemukan</p>
                                <p class="mt-1 text-sm text-gray-400">
                                    Coba ubah kata pencarian atau filter.
                                </p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="border-t border-gray-200 px-5 py-4">
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection