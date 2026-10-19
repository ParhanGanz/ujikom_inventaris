@extends('layouts.app')

@section('title', 'Manajemen Lokasi')

@section('content')
<div class="space-y-6">

    {{-- Header halaman --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <p class="text-sm font-semibold text-indigo-600 mb-1">
                MASTER DATA
            </p>
            <h1 class="text-2xl font-bold text-slate-800">
                Manajemen Lokasi & Ruangan
            </h1>
            <p class="text-sm text-slate-500 mt-1">
                Kelola data lokasi penyimpanan inventaris sekolah.
            </p>
        </div>

        <a href="{{ route('admin.lokasi.create') }}"
           class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-indigo-600 text-white text-sm font-semibold hover:bg-indigo-700 transition shadow-lg shadow-indigo-100">
            <i class="fa-solid fa-plus"></i>
            Tambah Lokasi
        </a>
    </div>

    {{-- Notifikasi --}}
    @if (session('success'))
        <div class="flex items-start gap-3 p-4 rounded-xl border border-emerald-200 bg-emerald-50 text-emerald-700">
            <i class="fa-solid fa-circle-check mt-0.5"></i>
            <p class="text-sm font-medium">{{ session('success') }}</p>
        </div>
    @endif

    @if ($errors->any())
        <div class="p-4 rounded-xl border border-red-200 bg-red-50 text-red-700">
            <p class="font-semibold text-sm mb-2">Data belum berhasil diproses:</p>
            <ul class="list-disc pl-5 text-sm space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Ringkasan --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div class="bg-white border border-slate-200 rounded-2xl p-5 flex items-center gap-4 shadow-sm">
            <div class="w-12 h-12 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center">
                <i class="fa-solid fa-door-open text-xl"></i>
            </div>
            <div>
                <p class="text-sm text-slate-500">Total Ruangan</p>
                <p class="text-2xl font-bold text-slate-800">
                    {{ $lokasi->count() }}
                </p>
            </div>
        </div>

        <div class="bg-white border border-slate-200 rounded-2xl p-5 flex items-center gap-4 shadow-sm">
            <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                <i class="fa-solid fa-database text-xl"></i>
            </div>
            <div>
                <p class="text-sm text-slate-500">Data Tersimpan</p>
                <p class="text-2xl font-bold text-slate-800">
                    {{ $lokasi->count() }}
                </p>
            </div>
        </div>
    </div>

    {{-- Tabel lokasi --}}
    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
        <div class="p-5 border-b border-slate-100">
            <h2 class="font-bold text-slate-800">Daftar Lokasi</h2>
            <p class="text-xs text-slate-500 mt-1">
                Data kode, nama ruangan, dan keterangan lokasi.
            </p>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-slate-50 text-slate-500 text-xs uppercase tracking-wider">
                    <tr>
                        <th class="px-5 py-4 font-bold">No.</th>
                        <th class="px-5 py-4 font-bold">Kode Lokasi</th>
                        <th class="px-5 py-4 font-bold">Nama Ruangan</th>
                        <th class="px-5 py-4 font-bold">Keterangan</th>
                        <th class="px-5 py-4 font-bold text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">
                    @forelse ($lokasi as $item)
                        <tr class="hover:bg-slate-50/70 transition">
                            <td class="px-5 py-4 text-sm text-slate-500">
                                {{ $loop->iteration }}
                            </td>

                            <td class="px-5 py-4">
                                <span class="inline-flex items-center px-3 py-1.5 rounded-lg bg-indigo-50 text-indigo-700 text-xs font-bold">
                                    {{ $item->kode }}
                                </span>
                            </td>

                            <td class="px-5 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-slate-100 text-slate-600 flex items-center justify-center shrink-0">
                                        <i class="fa-solid fa-door-open"></i>
                                    </div>
                                    <span class="text-sm font-semibold text-slate-700">
                                        {{ $item->ruangan }}
                                    </span>
                                </div>
                            </td>

                            <td class="px-5 py-4 text-sm text-slate-500">
                                {{ $item->keterangan ?: 'Tidak ada keterangan' }}
                            </td>

                            <td class="px-5 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    {{-- Tombol membuka modal edit --}}
                                    <button type="button"
                                        data-id="{{ $item->id }}"
                                        data-kode="{{ $item->kode }}"
                                        data-ruangan="{{ $item->ruangan }}"
                                        data-keterangan="{{ $item->keterangan ?? '' }}"
                                        onclick="openEditModal(this)"
                                        class="w-9 h-9 rounded-lg bg-amber-50 text-amber-600 hover:bg-amber-100 transition"
                                        title="Edit lokasi">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>

                                    {{-- Tombol membuka modal hapus --}}
                                    <button type="button"
                                        data-id="{{ $item->id }}"
                                        data-ruangan="{{ $item->ruangan }}"
                                        onclick="openDeleteModal(this)"
                                        class="w-9 h-9 rounded-lg bg-red-50 text-red-600 hover:bg-red-100 transition"
                                        title="Hapus lokasi">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-5 py-14 text-center">
                                <div class="w-14 h-14 mx-auto mb-3 rounded-2xl bg-slate-100 text-slate-400 flex items-center justify-center">
                                    <i class="fa-solid fa-folder-open text-2xl"></i>
                                </div>
                                <p class="font-semibold text-slate-700">
                                    Belum ada data lokasi
                                </p>
                                <p class="text-sm text-slate-400 mt-1">
                                    Klik tombol Tambah Lokasi untuk memulai.
                                </p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-5 py-4 border-t border-slate-100 text-xs text-slate-400">
            Menampilkan {{ $lokasi->count() }} data lokasi.
        </div>
    </div>
</div>


{{-- ==========================================
     MODAL EDIT LOKASI
========================================== --}}
<div id="modalEdit"
     class="hidden fixed inset-0 z-50 items-center justify-center p-4">

    <button type="button" onclick="closeEditModal()"
        class="absolute inset-0 bg-slate-900/50 backdrop-blur-sm"
        aria-label="Tutup modal"></button>

    <div class="relative w-full max-w-lg bg-white rounded-2xl shadow-2xl overflow-hidden">
        <div class="flex items-center justify-between p-5 border-b border-slate-100">
            <div>
                <h2 class="text-lg font-bold text-slate-800">Edit Lokasi</h2>
                <p class="text-xs text-slate-500 mt-1">Perbarui informasi ruangan.</p>
            </div>

            <button type="button" onclick="closeEditModal()"
                class="w-9 h-9 rounded-xl text-slate-400 hover:bg-slate-100 hover:text-slate-700">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>
        </div>

        <form id="formEditLokasi" method="POST">
            @csrf
            @method('PUT')

            <div class="p-5 space-y-5">
                <div>
                    <label for="edit_kode"
                        class="block text-sm font-semibold text-slate-700 mb-2">
                        Kode Lokasi
                    </label>
                    <input id="edit_kode" type="text" readonly
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-100 text-slate-500 text-sm">
                </div>

                <div>
                    <label for="edit_ruangan"
                        class="block text-sm font-semibold text-slate-700 mb-2">
                        Nama Ruangan <span class="text-red-500">*</span>
                    </label>
                    <input id="edit_ruangan" name="ruangan" type="text"
                        maxlength="255" required
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-100 focus:border-indigo-500"
                        placeholder="Contoh: Laboratorium Komputer">
                </div>

                <div>
                    <label for="edit_keterangan"
                        class="block text-sm font-semibold text-slate-700 mb-2">
                        Keterangan
                    </label>
                    <textarea id="edit_keterangan" name="keterangan" rows="3"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-100 focus:border-indigo-500"
                        placeholder="Keterangan tambahan (opsional)"></textarea>
                </div>
            </div>

            <div class="flex justify-end gap-3 p-5 bg-slate-50 border-t border-slate-100">
                <button type="button" onclick="closeEditModal()"
                    class="px-4 py-2.5 rounded-xl border border-slate-200 bg-white text-slate-600 text-sm font-semibold hover:bg-slate-100">
                    Batal
                </button>

                <button type="submit"
                    class="px-5 py-2.5 rounded-xl bg-indigo-600 text-white text-sm font-semibold hover:bg-indigo-700">
                    <i class="fa-solid fa-floppy-disk mr-1"></i>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>


{{-- ==========================================
     MODAL HAPUS LOKASI
========================================== --}}
<div id="modalDelete"
     class="hidden fixed inset-0 z-50 items-center justify-center p-4">

    <button type="button" onclick="closeDeleteModal()"
        class="absolute inset-0 bg-slate-900/50 backdrop-blur-sm"
        aria-label="Tutup modal"></button>

    <div class="relative w-full max-w-md bg-white rounded-2xl shadow-2xl p-6 text-center">
        <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-red-50 text-red-500 flex items-center justify-center">
            <i class="fa-solid fa-trash-can text-2xl"></i>
        </div>

        <h2 class="text-xl font-bold text-slate-800">Hapus Lokasi?</h2>

        <p class="text-sm text-slate-500 mt-2">
            Kamu yakin ingin menghapus lokasi
            <span id="deleteNamaRuangan" class="font-bold text-slate-700"></span>?
            Tindakan ini tidak dapat dibatalkan.
        </p>

        <form id="formDeleteLokasi" method="POST" class="mt-6">
            @csrf
            @method('DELETE')

            <div class="flex justify-center gap-3">
                <button type="button" onclick="closeDeleteModal()"
                    class="px-5 py-2.5 rounded-xl border border-slate-200 text-slate-600 text-sm font-semibold hover:bg-slate-50">
                    Batal
                </button>

                <button type="submit"
                    class="px-5 py-2.5 rounded-xl bg-red-600 text-white text-sm font-semibold hover:bg-red-700">
                    Ya, Hapus
                </button>
            </div>
        </form>
    </div>
</div>


{{-- JavaScript modal --}}
<script>
    const updateRoutePattern = @json(route('admin.lokasi.update', ['lokasi' => '__ID__']));
    const deleteRoutePattern = @json(route('admin.lokasi.destroy', ['lokasi' => '__ID__']));

    function openEditModal(button) {
        const id = button.dataset.id;

        document.getElementById('formEditLokasi').action =
            updateRoutePattern.replace('__ID__', encodeURIComponent(id));

        document.getElementById('edit_kode').value = button.dataset.kode || '';
        document.getElementById('edit_ruangan').value = button.dataset.ruangan || '';
        document.getElementById('edit_keterangan').value = button.dataset.keterangan || '';

        const modal = document.getElementById('modalEdit');
        modal.classList.remove('hidden');
        modal.classList.add('flex');

        setTimeout(() => {
            document.getElementById('edit_ruangan').focus();
        }, 50);
    }

    function closeEditModal() {
        const modal = document.getElementById('modalEdit');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    function openDeleteModal(button) {
        const id = button.dataset.id;

        document.getElementById('formDeleteLokasi').action =
            deleteRoutePattern.replace('__ID__', encodeURIComponent(id));

        document.getElementById('deleteNamaRuangan').textContent =
            '"' + (button.dataset.ruangan || '') + '"';

        const modal = document.getElementById('modalDelete');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeDeleteModal() {
        const modal = document.getElementById('modalDelete');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    // Tutup modal dengan tombol Escape.
    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            closeEditModal();
            closeDeleteModal();
        }
    });
</script>
@endsection