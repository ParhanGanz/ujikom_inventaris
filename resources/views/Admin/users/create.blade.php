@extends('layouts.app')

@section('content')
<!-- Header & Breadcrumb -->
<div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div>
        <h1 class="text-2xl font-bold text-slate-800">Tambah Pengguna Baru</h1>
        <p class="text-sm text-slate-500 mt-1">Lengkapi formulir di bawah ini untuk membuat akun baru.</p>
    </div>
    <div class="text-sm text-slate-500 flex items-center space-x-2">
        <a href="{{ route('admin.users.index') }}" class="hover:text-brand-600 transition-colors">Pengguna</a>
        <span>></span>
        <span class="text-slate-700 font-medium">Tambah</span>
    </div>
</div>

<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8">
        <div class="flex items-center space-x-3 mb-6 pb-4 border-b border-slate-100">
            <div class="w-10 h-10 rounded-xl bg-brand-50 text-brand-600 flex items-center justify-center font-bold">
                <i class="fa-solid fa-user-plus text-base"></i>
            </div>
            <div>
                <h2 class="text-base font-bold text-slate-800">Formulir Pengguna</h2>
                <p class="text-xs text-slate-400">Isi data akun dengan benar</p>
            </div>
        </div>

        <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Grid Data Utama -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mb-5">
                <!-- Nama Lengkap -->
                <div>
                    <label for="nama_lengkap" class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">
                        NAMA LENGKAP <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required placeholder="Contoh: Ahmad Subagja" 
                           class="w-full px-4 py-2.5 bg-slate-50 border @error('nama_lengkap') border-rose-400 @else border-slate-200 @enderror rounded-xl text-sm text-slate-700 focus:outline-none focus:border-brand-500 focus:bg-white transition-all">
                    @error('nama_lengkap')
                        <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Username -->
                <div>
                    <label for="username" class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">
                        USERNAME <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" id="username" name="username" value="{{ old('username') }}" required placeholder="Contoh: ahmad_subagja" 
                           class="w-full px-4 py-2.5 bg-slate-50 border @error('username') border-rose-400 @else border-slate-200 @enderror rounded-xl text-sm text-slate-700 focus:outline-none focus:border-brand-500 focus:bg-white transition-all">
                    @error('username')
                        <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">
                        ALAMAT EMAIL <span class="text-rose-500">*</span>
                    </label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="ahmad@smkn1.sch.id" 
                           class="w-full px-4 py-2.5 bg-slate-50 border @error('email') border-rose-400 @else border-slate-200 @enderror rounded-xl text-sm text-slate-700 focus:outline-none focus:border-brand-500 focus:bg-white transition-all">
                    @error('email')
                        <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- WhatsApp -->
                <div>
                    <label for="no_whatsapp" class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">
                        NO. WHATSAPP
                    </label>
                    <input type="text" id="no_whatsapp" name="no_whatsapp" value="{{ old('no_whatsapp') }}" placeholder="081234567890" 
                           class="w-full px-4 py-2.5 bg-slate-50 border @error('no_whatsapp') border-rose-400 @else border-slate-200 @enderror rounded-xl text-sm text-slate-700 focus:outline-none focus:border-brand-500 focus:bg-white transition-all">
                    @error('no_whatsapp')
                        <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">
                        PASSWORD <span class="text-rose-500">*</span>
                    </label>
                    <input type="password" id="password" name="password" required placeholder="Minimal 8 karakter" 
                           class="w-full px-4 py-2.5 bg-slate-50 border @error('password') border-rose-400 @else border-slate-200 @enderror rounded-xl text-sm text-slate-700 focus:outline-none focus:border-brand-500 focus:bg-white transition-all">
                    @error('password')
                        <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Role -->
                <div>
                    <label for="role_id" class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">
                        ROLE HAK AKSES <span class="text-rose-500">*</span>
                    </label>
                    <select id="role_id" name="role_id" required 
                            class="w-full px-4 py-2.5 bg-slate-50 border @error('role_id') border-rose-400 @else border-slate-200 @enderror rounded-xl text-sm text-slate-700 focus:outline-none focus:border-brand-500 focus:bg-white transition-all">
                        <option value="">-- Pilih Role --</option>
                        @foreach($roles as $r)
                            <option value="{{ $r->id }}" {{ old('role_id') == $r->id ? 'selected' : '' }}>{{ $r->nama }}</option>
                        @endforeach
                    </select>
                    @error('role_id')
                        <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Status Aktif & Foto -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mb-8">
                <!-- Status -->
                <div>
                    <label for="status" class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">
                        STATUS AKUN <span class="text-rose-500">*</span>
                    </label>
                    <select id="status" name="status" required 
                            class="w-full px-4 py-2.5 bg-slate-50 border @error('status') border-rose-400 @else border-slate-200 @enderror rounded-xl text-sm text-slate-700 focus:outline-none focus:border-brand-500 focus:bg-white transition-all">
                        <option value="aktif" {{ old('status', 'aktif') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="nonaktif" {{ old('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                    @error('status')
                        <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Foto Upload -->
                <div>
                    <label for="foto" class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">
                        FOTO PROFIL (OPSIONAL)
                    </label>
                    <input type="file" id="foto" name="foto" accept="image/*" 
                           class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-500 file:mr-4 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-brand-50 file:text-brand-600 hover:file:bg-brand-100 transition-all">
                    @error('foto')
                        <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex items-center justify-end space-x-3 pt-4 border-t border-slate-100">
                <a href="{{ route('admin.users.index') }}" 
                   class="px-5 py-2.5 rounded-xl border border-slate-200 text-sm font-medium text-slate-600 hover:bg-slate-100 transition-colors">
                    Batal
                </a>
                <button type="submit" 
                        class="px-6 py-2.5 bg-brand-600 hover:bg-brand-700 text-white font-medium text-sm rounded-xl shadow-lg shadow-brand-500/25 transition-all flex items-center space-x-2">
                    <i class="fa-solid fa-floppy-disk text-xs"></i>
                    <span>Simpan Pengguna</span>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection