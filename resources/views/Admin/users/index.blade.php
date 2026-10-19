@extends('layouts.app')

@section('content')
    <!-- Header & Breadcrumb -->
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-800 flex items-center gap-2">
                <i class="fa-solid fa-users-gear text-brand-600"></i> Kelola Pengguna
            </h1>
            <p class="text-sm text-slate-500 mt-1">Manajemen akun pengguna dan hak akses sistem inventaris.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.users.create') }}"
                class="px-4 py-2.5 bg-brand-600 hover:bg-brand-700 text-white font-medium rounded-xl text-sm shadow-lg shadow-brand-500/25 transition-all flex items-center gap-2">
                <i class="fa-solid fa-user-plus text-xs"></i>
                <span>Tambah Pengguna</span>
            </a>
        </div>
    </div>

    <!-- Notifikasi Sukses / Error -->
    @if (session('success'))
        <div
            class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl flex items-center justify-between shadow-sm">
            <div class="flex items-center space-x-2">
                <i class="fa-solid fa-circle-check text-emerald-500"></i>
                <span class="text-sm font-medium">{{ session('success') }}</span>
            </div>
            <button type="button" onclick="this.parentElement.remove()" class="text-emerald-400 hover:text-emerald-600">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
    @endif

    @if (session('error'))
        <div
            class="mb-6 p-4 bg-rose-50 border border-rose-200 text-rose-700 rounded-xl flex items-center justify-between shadow-sm">
            <div class="flex items-center space-x-2">
                <i class="fa-solid fa-triangle-exclamation text-rose-500"></i>
                <span class="text-sm font-medium">{{ session('error') }}</span>
            </div>
            <button type="button" onclick="this.parentElement.remove()" class="text-rose-400 hover:text-rose-600">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
    @endif

    <!-- Filter & Search Bar -->
    <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm mb-6">
        <form method="GET" action="{{ route('admin.users.index') }}" class="grid grid-cols-1 sm:grid-cols-12 gap-3">
            <div class="sm:col-span-5">
                <div class="relative">
                    <i
                        class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari nama, username, email..."
                        class="w-full pl-9 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-700 focus:outline-none focus:border-brand-500 focus:bg-white transition-all">
                </div>
            </div>

            <div class="sm:col-span-4">
                <select name="role_id"
                    class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-700 focus:outline-none focus:border-brand-500 focus:bg-white transition-all">
                    <option value="">-- Semua Role --</option>
                    @foreach ($roles as $r)
                        <option value="{{ $r->id }}" {{ request('role_id') == $r->id ? 'selected' : '' }}>
                            {{ $r->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="sm:col-span-3 flex items-center gap-2">
                <button type="submit"
                    class="w-full py-2.5 bg-slate-800 hover:bg-slate-900 text-white rounded-xl text-sm font-medium transition-all flex items-center justify-center gap-2">
                    <i class="fa-solid fa-filter text-xs"></i>
                    <span>Filter</span>
                </button>
                <a href="{{ route('admin.users.index') }}"
                    class="px-4 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-xl text-sm font-medium transition-all"
                    title="Reset Filter">
                    <i class="fa-solid fa-rotate-left"></i>
                </a>
            </div>
        </form>
    </div>

    <!-- Tabel Daftar Pengguna -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-slate-100 flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 rounded-xl bg-brand-50 text-brand-600 flex items-center justify-center font-bold">
                    <i class="fa-solid fa-users text-base"></i>
                </div>
                <div>
                    <h2 class="text-base font-bold text-slate-800">Daftar Pengguna</h2>
                    <p class="text-xs text-slate-400">Total {{ $users->total() }} akun terdaftar</p>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr
                        class="bg-slate-50/75 border-b border-slate-100 text-[11px] font-bold text-slate-400 uppercase tracking-wider">
                        <th class="py-3.5 px-6">User</th>
                        <th class="py-3.5 px-6">Username</th>
                        <th class="py-3.5 px-6">Role</th>
                        <th class="py-3.5 px-6">WhatsApp</th>
                        <th class="py-3.5 px-6">Status</th>
                        <th class="py-3.5 px-6 text-center w-28">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100 text-sm">
                    @php
                        $roleSebelumnya = null;
                    @endphp

                    @forelse ($users as $u)
                        @php
                            $roleNama = strtolower($u->role->nama ?? 'lainnya');
                        @endphp

                        {{-- Pemisah setiap kelompok role --}}
                        @if ($roleNama !== $roleSebelumnya)
                            <tr class="bg-slate-100 border-y border-slate-200">
                                <td colspan="6" class="px-6 py-3">
                                    <div class="flex items-center gap-2">
                                        @if ($roleNama === 'admin')
                                            <i class="fa-solid fa-shield-halved text-violet-600"></i>
                                        @elseif ($roleNama === 'petugas')
                                            <i class="fa-solid fa-user-gear text-blue-600"></i>
                                        @elseif ($roleNama === 'guru')
                                            <i class="fa-solid fa-graduation-cap text-amber-600"></i>
                                        @elseif ($roleNama === 'siswa')
                                            <i class="fa-solid fa-user-graduate text-emerald-600"></i>
                                        @else
                                            <i class="fa-solid fa-users text-slate-500"></i>
                                        @endif

                                        <span class="font-bold text-slate-700 uppercase tracking-wide">
                                            Role {{ ucfirst($u->role->nama ?? 'Lainnya') }}
                                        </span>

                                        <span class="text-xs text-slate-400">
                                            — Kelompok Pengguna
                                        </span>
                                    </div>
                                </td>
                            </tr>

                            @php
                                $roleSebelumnya = $roleNama;
                            @endphp
                        @endif

                        <tr class="hover:bg-slate-50/70 transition-colors">
                            {{-- Data pengguna --}}
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-3">
                                    <img src="{{ $u->foto_url }}" alt="Foto"
                                        class="w-10 h-10 rounded-full object-cover border border-slate-200 shadow-sm">

                                    <div>
                                        <p class="font-bold text-slate-800">
                                            {{ $u->nama_lengkap }}
                                        </p>
                                        <p class="text-xs text-slate-400">
                                            {{ $u->email }}
                                        </p>
                                    </div>
                                </div>
                            </td>

                            {{-- Username --}}
                            <td class="py-4 px-6 font-mono text-xs font-semibold text-slate-600">
                                {{ $u->username }}
                            </td>

                            {{-- Role --}}
                            <td class="py-4 px-6">
                                <span
                                    class="px-2.5 py-1 bg-brand-50 text-brand-600 rounded-lg text-xs font-semibold border border-brand-100">
                                    {{ $u->role->nama ?? '-' }}
                                </span>
                            </td>

                            {{-- WhatsApp --}}
                            <td class="py-4 px-6 text-slate-600 text-xs">
                                @if ($u->no_whatsapp)
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $u->no_whatsapp) }}"
                                        target="_blank" rel="noopener noreferrer"
                                        class="hover:text-emerald-600 flex items-center gap-1">
                                        <i class="fa-brands fa-whatsapp text-emerald-500"></i>
                                        {{ $u->no_whatsapp }}
                                    </a>
                                @else
                                    <span class="text-slate-400">-</span>
                                @endif
                            </td>

                            {{-- Status --}}
                            <td class="py-4 px-6">
                                @if ($u->status == 'aktif')
                                    <span
                                        class="inline-flex items-center gap-1 text-xs font-semibold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-full border border-emerald-200">
                                        <i class="fa-solid fa-circle text-[6px]"></i>
                                        Aktif
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center gap-1 text-xs font-semibold text-rose-600 bg-rose-50 px-2.5 py-1 rounded-full border border-rose-200">
                                        <i class="fa-solid fa-circle text-[6px]"></i>
                                        Nonaktif
                                    </span>
                                @endif
                            </td>

                            {{-- Aksi --}}
                            <td class="py-4 px-6 text-center">
                                <div class="flex items-center justify-center space-x-2">
                                    <a href="{{ route('admin.users.edit', $u->id) }}"
                                        class="w-8 h-8 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center hover:bg-amber-100 transition-colors"
                                        title="Edit">
                                        <i class="fa-solid fa-pen-to-square text-xs"></i>
                                    </a>

                                    <button type="button"
                                        onclick="openDeleteModal({{ $u->id }}, {{ Js::from($u->nama_lengkap) }})"
                                        class="w-8 h-8 rounded-lg bg-rose-50 text-rose-600 flex items-center justify-center hover:bg-rose-100 transition-colors"
                                        title="Hapus">
                                        <i class="fa-solid fa-trash-can text-xs"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="6" class="py-8 text-center text-slate-400 text-sm">
                                <div class="flex flex-col items-center justify-center space-y-2">
                                    <i class="fa-solid fa-user-slash text-3xl text-slate-300"></i>
                                    <p>Belum ada data pengguna ditemukan.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

        @if ($users->hasPages())
            <div class="p-4 border-t border-slate-100 bg-slate-50/50">
                {{ $users->links() }}
            </div>
        @endif
    </div>

    <!-- Modal Pop-Up Delete User -->
    <div id="modalDelete" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm transition-opacity" onclick="closeDeleteModal()">
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div
                class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md sm:w-full border border-slate-100">
                <div class="p-6 text-center">
                    <div
                        class="w-14 h-14 rounded-2xl bg-rose-50 text-rose-500 flex items-center justify-center mx-auto mb-4 text-xl">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-800 mb-2">Hapus Pengguna?</h3>
                    <p class="text-sm text-slate-500 mb-1">Apakah Anda yakin ingin menghapus akun <span
                            id="deleteNamaUser" class="font-semibold text-slate-700"></span>?</p>
                    <p class="text-xs text-slate-400">Tindakan ini tidak dapat dibatalkan.</p>
                </div>

                <form id="formDeleteUser" method="POST"
                    class="p-6 bg-slate-50/50 border-t border-slate-100 flex items-center justify-center space-x-3">
                    @csrf
                    @method('DELETE')
                    <button type="button" onclick="closeDeleteModal()"
                        class="w-1/2 py-2.5 rounded-xl border border-slate-200 text-sm font-medium text-slate-600 hover:bg-slate-100 transition-colors">
                        Batal
                    </button>
                    <button type="submit"
                        class="w-1/2 py-2.5 rounded-xl bg-rose-600 hover:bg-rose-700 text-white text-sm font-medium shadow-lg shadow-rose-500/25 transition-all flex items-center justify-center space-x-2">
                        <i class="fa-solid fa-trash-can text-xs"></i>
                        <span>Ya, Hapus</span>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        const destroyRoutePattern = "{{ route('admin.users.destroy', ':id') }}";

        function openDeleteModal(id, nama) {
            const form = document.getElementById('formDeleteUser');
            form.action = destroyRoutePattern.replace(':id', id);
            document.getElementById('deleteNamaUser').textContent = '"' + nama + '"';
            document.getElementById('modalDelete').classList.remove('hidden');
        }

        function closeDeleteModal() {
            document.getElementById('modalDelete').classList.add('hidden');
        }

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeDeleteModal();
            }
        });
    </script>
@endsection
