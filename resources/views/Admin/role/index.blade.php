@extends('layouts.app')

@section('content')
<div x-data="{ 
    editModalOpen: false, 
    deleteModalOpen: false,
    editData: { id: null, nama: '', keterangan: '' },
    deleteUrl: '',
    
    openEdit(role) {
        this.editData = { ...role };
        this.editModalOpen = true;
    },
    openDelete(url) {
        this.deleteUrl = url;
        this.deleteModalOpen = true;
    }
}">

    <!-- Header & Breadcrumb -->
    <div class="mb-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-800 tracking-tight">Manajemen Role</h1>
            <p class="text-sm text-slate-500 mt-1">Kelola hak akses dan tingkat pengguna sistem inventaris.</p>
        </div>
        <div class="flex items-center space-x-2 text-sm text-slate-500">
            <span class="hover:text-slate-700">Master Data</span>
            <i class="fa-solid fa-chevron-right text-xs text-slate-400"></i>
            <span class="font-semibold text-indigo-600">Role</span>
        </div>
    </div>

    <!-- Alert Flash Message -->
    @if(session('success'))
        <div class="mb-6 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 flex items-center justify-between text-emerald-800 shadow-sm"
             x-data="{ show: true }" x-show="show" x-transition>
            <div class="flex items-center space-x-3">
                <div class="w-8 h-8 rounded-xl bg-emerald-500 text-white flex items-center justify-center shrink-0">
                    <i class="fa-solid fa-circle-check text-sm"></i>
                </div>
                <p class="text-sm font-semibold">{{ session('success') }}</p>
            </div>
            <button @click="show = false" class="text-emerald-500 hover:text-emerald-700 p-1 rounded-lg">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>
        </div>
    @endif

    <!-- Content Grid: Form (Kiri) & Tabel (Kanan) -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

        <!-- ================= FORM TAMBAH (KIRI) ================= -->
        <div class="lg:col-span-4">
            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-5 sm:p-6 sticky top-20">
                <div class="flex items-center space-x-3 pb-4 mb-5 border-b border-slate-100">
                    <div class="w-9 h-9 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center shrink-0 font-bold">
                        <i class="fa-solid fa-plus text-sm"></i>
                    </div>
                    <div>
                        <h2 class="text-base font-bold text-slate-800">Tambah Role Baru</h2>
                        <p class="text-xs text-slate-400">Isi formulir untuk membuat role baru</p>
                    </div>
                </div>

                <form action="{{ route('admin.role.store') }}" method="POST" class="space-y-4">
                    @csrf
                    
                    <!-- Nama Role -->
                    <div>
                        <label for="nama" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                            Nama Role <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" name="nama" id="nama" value="{{ old('nama') }}" required
                               placeholder="Contoh: Admin, Guru, Siswa"
                               class="w-full px-3.5 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition @error('nama') border-rose-500 @enderror">
                        @error('nama')
                            <p class="mt-1 text-xs text-rose-500 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Keterangan -->
                    <div>
                        <label for="keterangan" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                            Keterangan
                        </label>
                        <textarea name="keterangan" id="keterangan" rows="3"
                                  placeholder="Penjelasan hak akses role..."
                                  class="w-full px-3.5 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition @error('keterangan') border-rose-500 @enderror">{{ old('keterangan') }}</textarea>
                        @error('keterangan')
                            <p class="mt-1 text-xs text-rose-500 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" 
                            class="w-full py-2.5 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-sm rounded-xl shadow-md shadow-indigo-200 hover:shadow-lg hover:shadow-indigo-300 transition flex items-center justify-center space-x-2">
                        <i class="fa-solid fa-floppy-disk text-sm"></i>
                        <span>Simpan Role</span>
                    </button>
                </form>
            </div>
        </div>

        <!-- ================= TABEL DAFTAR ROLE (KANAN) ================= -->
        <div class="lg:col-span-8">
            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
                <div class="p-5 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
                    <div class="flex items-center space-x-3">
                        <div class="w-9 h-9 rounded-xl bg-indigo-100 text-indigo-700 flex items-center justify-center font-bold">
                            <i class="fa-solid fa-user-shield text-sm"></i>
                        </div>
                        <div>
                            <h2 class="text-base font-bold text-slate-800">Daftar Role</h2>
                            <p class="text-xs text-slate-400">Total {{ $roles->total() }} role terdaftar</p>
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-slate-100 text-[11px] font-bold text-slate-400 uppercase tracking-wider bg-slate-50/80">
                                <th class="py-3.5 px-4 sm:px-6 w-16 text-center">No</th>
                                <th class="py-3.5 px-4">Nama Role</th>
                                <th class="py-3.5 px-4">Keterangan</th>
                                <th class="py-3.5 px-4 sm:px-6 text-center w-28">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-sm">
                            @forelse($roles as $index => $role)
                                <tr class="hover:bg-slate-50/80 transition">
                                    <td class="py-4 px-4 sm:px-6 text-center font-medium text-slate-400">
                                        {{ $roles->firstItem() + $index }}
                                    </td>
                                    <td class="py-4 px-4 font-semibold text-slate-800">
                                        <div class="flex items-center space-x-2">
                                            <span class="w-2 h-2 rounded-full bg-indigo-600"></span>
                                            <span>{{ $role->nama }}</span>
                                        </div>
                                    </td>
                                    <td class="py-4 px-4 text-slate-500 max-w-xs truncate">
                                        {{ $role->keterangan ?? '-' }}
                                    </td>
                                    <td class="py-4 px-4 sm:px-6 text-center">
                                        <div class="flex items-center justify-center space-x-1.5">
                                            <!-- Edit Modal Trigger -->
                                            <button type="button" 
                                                    @click="openEdit({{ json_encode($role) }})" 
                                                    title="Edit Role"
                                                    class="p-2 text-amber-600 hover:bg-amber-50 rounded-xl transition">
                                                <i class="fa-solid fa-pen-to-square text-sm"></i>
                                            </button>

                                            <!-- Delete Modal Trigger -->
                                            <button type="button" 
                                                    @click="openDelete('{{ route('admin.role.destroy', $role->id) }}')" 
                                                    title="Hapus Role"
                                                    class="p-2 text-rose-500 hover:bg-rose-50 rounded-xl transition">
                                                <i class="fa-solid fa-trash-can text-sm"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-12 text-center text-slate-400">
                                        <i class="fa-solid fa-folder-open text-4xl mb-3 text-slate-300"></i>
                                        <p class="font-semibold text-sm">Belum ada data role</p>
                                        <p class="text-xs text-slate-400 mt-0.5">Tambahkan role baru menggunakan form di sebelah kiri.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination Footer -->
                @if($roles->hasPages())
                    <div class="p-4 border-t border-slate-100 bg-slate-50/50">
                        {{ $roles->links() }}
                    </div>
                @endif
            </div>
        </div>

    </div>

    <!-- ================= MODAL EDIT ROLE ================= -->
    <div x-show="editModalOpen" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/40 backdrop-blur-sm"
         style="display: none;">
        
        <div @click.away="editModalOpen = false" 
             class="bg-white rounded-2xl border border-slate-100 shadow-2xl max-w-md w-full overflow-hidden">
            
            <div class="p-5 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
                <div class="flex items-center space-x-3">
                    <div class="w-9 h-9 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center font-bold">
                        <i class="fa-solid fa-pen-to-square text-sm"></i>
                    </div>
                    <h3 class="text-base font-bold text-slate-800">Edit Data Role</h3>
                </div>
                <button @click="editModalOpen = false" class="text-slate-400 hover:text-slate-600 p-1 rounded-lg">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>

            <form :action="'/admin/roles/' + editData.id" method="POST" class="p-5 space-y-4">
                @csrf
                @method('PUT')

                <!-- Nama Role -->
                <div>
                    <label for="edit_nama" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                        Nama Role <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" name="nama" id="edit_nama" x-model="editData.nama" required
                           class="w-full px-3.5 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition">
                </div>

                <!-- Keterangan -->
                <div>
                    <label for="edit_keterangan" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                        Keterangan
                    </label>
                    <textarea name="keterangan" id="edit_keterangan" rows="3" x-model="editData.keterangan"
                              class="w-full px-3.5 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition"></textarea>
                </div>

                <!-- Actions Button -->
                <div class="flex items-center justify-end space-x-3 pt-3 border-t border-slate-100">
                    <button type="button" @click="editModalOpen = false" 
                            class="px-4 py-2.5 text-sm font-semibold text-slate-600 hover:bg-slate-100 rounded-xl transition">
                        Batal
                    </button>
                    <button type="submit" 
                            class="px-5 py-2.5 text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 rounded-xl shadow-md shadow-indigo-200 transition">
                        Perbarui Role
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- ================= MODAL KONFIRMASI HAPUS ================= -->
    <div x-show="deleteModalOpen" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/40 backdrop-blur-sm"
         style="display: none;">
        
        <div @click.away="deleteModalOpen = false" 
             class="bg-white rounded-2xl border border-slate-100 shadow-2xl max-w-sm w-full p-6 text-center">
            
            <div class="w-12 h-12 rounded-2xl bg-rose-100 text-rose-600 flex items-center justify-center mx-auto mb-4">
                <i class="fa-solid fa-triangle-exclamation text-xl"></i>
            </div>

            <h3 class="text-base font-bold text-slate-800 mb-1">Hapus Role Ini?</h3>
            <p class="text-xs text-slate-500 mb-6">Tindakan ini tidak dapat dibatalkan. Role akan dihapus secara permanen dari database.</p>

            <form :action="deleteUrl" method="POST" class="flex items-center space-x-3">
                @csrf
                @method('DELETE')

                <button type="button" @click="deleteModalOpen = false" 
                        class="w-1/2 py-2.5 text-sm font-semibold text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl transition">
                    Batal
                </button>
                <button type="submit" 
                        class="w-1/2 py-2.5 text-sm font-semibold text-white bg-rose-600 hover:bg-rose-700 rounded-xl shadow-md shadow-rose-200 transition">
                    Ya, Hapus
                </button>
            </form>
        </div>
    </div>

</div>
@endsection