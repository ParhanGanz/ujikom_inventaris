@extends('layouts.app')

@section('content')
<!-- Header & Breadcrumb -->
<div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between">
    <div>
        <h1 class="text-2xl font-bold text-slate-800">Manajemen Lokasi & Ruangan</h1>
        <p class="text-sm text-slate-500 mt-1">Kelola data lokasi dan ruangan tempat penyimpanan barang inventaris.</p>
    </div>
    <div class="mt-3 sm:mt-0 text-sm text-slate-500">
        <span class="hover:text-brand-600 cursor-pointer">Master Data</span>
        <span class="mx-2">></span>
        <span class="text-slate-700 font-medium">Lokasi</span>
    </div>
</div>

<!-- Notifikasi Sukses -->
@if (session('success'))
    <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl flex items-center justify-between shadow-sm">
        <div class="flex items-center space-x-2">
            <i class="fa-solid fa-circle-check text-emerald-500"></i>
            <span class="text-sm font-medium">{{ session('success') }}</span>
        </div>
        <button type="button" onclick="this.parentElement.remove()" class="text-emerald-400 hover:text-emerald-600">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>
@endif

<!-- Tabel Daftar Lokasi -->
<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
    <div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 rounded-xl bg-indigo-50 text-brand-600 flex items-center justify-center font-bold">
                <i class="fa-solid fa-building text-base"></i>
            </div>
            <div>
                <h2 class="text-base font-bold text-slate-800">Daftar Lokasi</h2>
                <p class="text-xs text-slate-400">Total {{ $lokasi->count() }} ruangan terdaftar</p>
            </div>
        </div>
        <a href="{{ route('admin.lokasi.create') }}" 
           class="px-4 py-2.5 bg-brand-600 hover:bg-brand-700 text-white font-medium rounded-xl text-sm shadow-lg shadow-brand-500/25 transition-all flex items-center justify-center space-x-2">
            <i class="fa-solid fa-plus text-xs"></i>
            <span>Tambah Lokasi</span>
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50/75 border-b border-slate-100 text-[11px] font-bold text-slate-400 uppercase tracking-wider">
                    <th class="py-3.5 px-4 text-center w-12">No</th>
                    <th class="py-3.5 px-4">Kode Ruangan</th>
                    <th class="py-3.5 px-4">Nama Ruangan</th>
                    <th class="py-3.5 px-4">Penanggung Jawab</th>
                    <th class="py-3.5 px-4">Keterangan</th>
                    <th class="py-3.5 px-4 text-center w-28">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-sm">
                @forelse ($lokasi as $item)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="py-4 px-4 text-center text-slate-500 font-medium">{{ $loop->iteration }}</td>
                        <td class="py-4 px-4 font-mono text-xs font-semibold text-brand-600">
                            <span class="px-2.5 py-1 bg-brand-50 rounded-lg border border-brand-100">
                                {{ $item->kode }}
                            </span>
                        </td>
                        <td class="py-4 px-4 font-semibold text-slate-800">
                            {{ $item->ruangan }}
                        </td>
                        <td class="py-4 px-4 text-slate-600 text-xs font-medium">
                            <i class="fa-solid fa-user-tie text-slate-400 mr-1.5"></i>{{ $item->penanggung_jawab }}
                        </td>
                        <td class="py-4 px-4 text-slate-500 text-xs">{{ $item->keterangan ?? '-' }}</td>
                        <td class="py-4 px-4 text-center">
                            <div class="flex items-center justify-center space-x-2">
                                <!-- Tombol Trigger Modal Edit -->
                                <button type="button" 
                                        onclick="openEditModal({{ $item->id }}, '{{ addslashes($item->kode) }}', '{{ addslashes($item->ruangan) }}', '{{ addslashes($item->penanggung_jawab) }}', '{{ addslashes($item->keterangan ?? '') }}')" 
                                        class="w-8 h-8 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center hover:bg-amber-100 transition-colors" 
                                        title="Edit">
                                    <i class="fa-solid fa-pen-to-square text-xs"></i>
                                </button>
                                <!-- Tombol Trigger Modal Delete -->
                                <button type="button" 
                                        onclick="openDeleteModal({{ $item->id }}, '{{ addslashes($item->ruangan) }}')" 
                                        class="w-8 h-8 rounded-lg bg-red-50 text-red-600 flex items-center justify-center hover:bg-red-100 transition-colors" 
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
                                <i class="fa-solid fa-building-circle-xmark text-3xl text-slate-300"></i>
                                <p>Belum ada data lokasi/ruangan terdaftar.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Pop-Up Edit Lokasi -->
<div id="modalEdit" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Backdrop -->
        <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm transition-opacity" onclick="closeEditModal()"></div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <!-- Panel Modal -->
        <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full border border-slate-100">
            <div class="p-6 border-b border-slate-100 flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-500 flex items-center justify-center font-bold">
                        <i class="fa-solid fa-pen-to-square text-base"></i>
                    </div>
                    <div>
                        <h3 class="text-base font-bold text-slate-800">Edit Lokasi</h3>
                        <p class="text-xs text-slate-400">Ubah rincian informasi lokasi ruangan</p>
                    </div>
                </div>
                <button type="button" onclick="closeEditModal()" class="w-8 h-8 rounded-lg bg-slate-100 text-slate-400 hover:text-slate-600 hover:bg-slate-200 flex items-center justify-center transition-colors">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <form id="formEditLokasi" method="POST">
                @csrf
                @method('PUT')
                <div class="p-6 space-y-4">
                    <div>
                        <label for="edit_kode" class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">KODE RUANGAN <span class="text-red-500">*</span></label>
                        <input type="text" id="edit_kode" name="kode" required 
                               class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-700 focus:outline-none focus:border-brand-500 focus:bg-white transition-all">
                    </div>

                    <div>
                        <label for="edit_ruangan" class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">NAMA RUANGAN <span class="text-red-500">*</span></label>
                        <input type="text" id="edit_ruangan" name="ruangan" required 
                               class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-700 focus:outline-none focus:border-brand-500 focus:bg-white transition-all">
                    </div>

                    <div>
                        <label for="edit_penanggung_jawab" class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">PENANGGUNG JAWAB <span class="text-red-500">*</span></label>
                        <input type="text" id="edit_penanggung_jawab" name="penanggung_jawab" required 
                               class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-700 focus:outline-none focus:border-brand-500 focus:bg-white transition-all">
                    </div>

                    <div>
                        <label for="edit_keterangan" class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">KETERANGAN</label>
                        <textarea id="edit_keterangan" name="keterangan" rows="3" 
                                  class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-700 focus:outline-none focus:border-brand-500 focus:bg-white transition-all"></textarea>
                    </div>
                </div>

                <div class="p-6 bg-slate-50/50 border-t border-slate-100 flex items-center justify-end space-x-3">
                    <button type="button" onclick="closeEditModal()" class="px-5 py-2.5 rounded-xl border border-slate-200 text-sm font-medium text-slate-600 hover:bg-slate-100 transition-colors">
                        Batal
                    </button>
                    <button type="submit" class="px-5 py-2.5 rounded-xl bg-brand-600 hover:bg-brand-700 text-white text-sm font-medium shadow-lg shadow-brand-500/25 transition-all flex items-center space-x-2">
                        <i class="fa-solid fa-floppy-disk text-xs"></i>
                        <span>Simpan Perubahan</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Pop-Up Delete Lokasi -->
<div id="modalDelete" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Backdrop -->
        <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm transition-opacity" onclick="closeDeleteModal()"></div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <!-- Panel Modal -->
        <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md sm:w-full border border-slate-100">
            <div class="p-6 text-center">
                <div class="w-14 h-14 rounded-2xl bg-red-50 text-red-500 flex items-center justify-center mx-auto mb-4 text-xl">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-800 mb-2">Hapus Lokasi?</h3>
                <p class="text-sm text-slate-500 mb-1">Apakah Anda yakin ingin menghapus lokasi <span id="deleteNamaRuangan" class="font-semibold text-slate-700"></span>?</p>
                <p class="text-xs text-slate-400">Tindakan ini tidak dapat dibatalkan.</p>
            </div>

            <form id="formDeleteLokasi" method="POST" class="p-6 bg-slate-50/50 border-t border-slate-100 flex items-center justify-center space-x-3">
                @csrf
                @method('DELETE')
                <button type="button" onclick="closeDeleteModal()" class="w-1/2 py-2.5 rounded-xl border border-slate-200 text-sm font-medium text-slate-600 hover:bg-slate-100 transition-colors">
                    Batal
                </button>
                <button type="submit" class="w-1/2 py-2.5 rounded-xl bg-red-600 hover:bg-red-700 text-white text-sm font-medium shadow-lg shadow-red-500/25 transition-all flex items-center justify-center space-x-2">
                    <i class="fa-solid fa-trash-can text-xs"></i>
                    <span>Ya, Hapus</span>
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    const updateRoutePattern = "{{ route('admin.lokasi.update', ':id') }}";
    const destroyRoutePattern = "{{ route('admin.lokasi.destroy', ':id') }}";

    function openEditModal(id, kode, ruangan, penanggung_jawab, keterangan) {
        const form = document.getElementById('formEditLokasi');
        form.action = updateRoutePattern.replace(':id', id);
        
        document.getElementById('edit_kode').value = kode;
        document.getElementById('edit_ruangan').value = ruangan;
        document.getElementById('edit_penanggung_jawab').value = penanggung_jawab;
        document.getElementById('edit_keterangan').value = keterangan;
        
        document.getElementById('modalEdit').classList.remove('hidden');
    }

    function closeEditModal() {
        document.getElementById('modalEdit').classList.add('hidden');
    }

    function openDeleteModal(id, ruangan) {
        const form = document.getElementById('formDeleteLokasi');
        form.action = destroyRoutePattern.replace(':id', id);
        
        document.getElementById('deleteNamaRuangan').textContent = '"' + ruangan + '"';
        
        document.getElementById('modalDelete').classList.remove('hidden');
    }

    function closeDeleteModal() {
        document.getElementById('modalDelete').classList.add('hidden');
    }

    // Menutup modal saat menekan tombol Escape
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeEditModal();
            closeDeleteModal();
        }
    });
</script>
@endsection