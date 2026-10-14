@extends('layouts.app')

@section('title', 'Edit Profil')

@section('content')
<div class="py-6 sm:py-8 bg-slate-50 min-h-[calc(100vh-4rem)]" x-data="{ photoPreview: null }">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

        <!-- Header Title & Alert Success -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Pengaturan Profil</h1>
                <p class="text-xs sm:text-sm text-slate-500 mt-1">Kelola informasi pribadi, foto profil, dan kredensial akun Anda.</p>
            </div>

            <!-- Status Card Badge -->
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-bold bg-indigo-50 text-indigo-700 border border-indigo-100">
                    <i class="fa-solid fa-user-shield text-indigo-500"></i>
                    Role: {{ $user->role->name ?? 'Administrator' }}
                </span>
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-bold {{ $user->status === 'aktif' ? 'bg-emerald-50 text-emerald-700 border border-emerald-100' : 'bg-rose-50 text-rose-700 border border-rose-100' }}">
                    <span class="w-2 h-2 rounded-full {{ $user->status === 'aktif' ? 'bg-emerald-500' : 'bg-rose-500' }}"></span>
                    Status: {{ ucfirst($user->status) }}
                </span>
            </div>
        </div>

        <!-- Flash Message Notification -->
        @if (session('success'))
            <div x-data="{ show: true }" x-show="show" x-transition 
                 class="p-4 bg-emerald-50 border border-emerald-200 rounded-2xl flex items-center justify-between text-emerald-800 text-xs sm:text-sm shadow-sm">
                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-circle-check text-emerald-600 text-lg"></i>
                    <span class="font-semibold">{{ session('success') }}</span>
                </div>
                <button @click="show = false" class="text-emerald-500 hover:text-emerald-700 cursor-pointer">
                    <i class="fa-solid fa-xmark text-base"></i>
                </button>
            </div>
        @endif

        <!-- Form Edit Informasi Profil -->
        <div class="bg-white rounded-2xl sm:rounded-3xl border border-slate-200/80 shadow-sm p-6 sm:p-8">
            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Section: Foto Profil -->
                <div>
                    <label class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-3">
                        Foto Profil
                    </label>
                    <div class="flex flex-col sm:flex-row sm:items-center gap-4 sm:gap-6">
                        <!-- Preview Image -->
                        <div class="relative w-20 h-20 sm:w-24 sm:h-24 shrink-0">
                            <template x-if="!photoPreview">
                                <img src="{{ $user->foto ? asset('storage/' . $user->foto) : 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&q=80&w=256' }}" 
                                     alt="Avatar" class="w-full h-full rounded-2xl object-cover ring-4 ring-slate-100 shadow-sm">
                            </template>
                            <template x-if="photoPreview">
                                <img :src="photoPreview" class="w-full h-full rounded-2xl object-cover ring-4 ring-indigo-500/20 shadow-sm">
                            </template>
                        </div>

                        <!-- Action Buttons -->
                        <div class="space-y-2">
                            <div class="flex flex-wrap items-center gap-2">
                                <input type="file" name="foto" id="foto" class="hidden" accept="image/*"
                                       x-ref="foto"
                                       x-on:change="
                                            const file = $refs.foto.files[0];
                                            if (file) {
                                                const reader = new FileReader();
                                                reader.onload = (e) => { photoPreview = e.target.result; };
                                                reader.readAsDataURL(file);
                                            }
                                       ">
                                
                                <button type="button" @click="$refs.foto.click()" 
                                        class="px-4 py-2 bg-indigo-50 hover:bg-indigo-100 text-indigo-600 font-semibold text-xs rounded-xl transition flex items-center gap-2 cursor-pointer">
                                    <i class="fa-solid fa-camera"></i>
                                    <span>Pilih Foto Baru</span>
                                </button>

                                @if ($user->foto)
                                    <button type="button" 
                                            onclick="if(confirm('Yakin ingin menghapus foto profil?')) document.getElementById('delete-photo-form').submit();"
                                            class="px-4 py-2 bg-rose-50 hover:bg-rose-100 text-rose-600 font-semibold text-xs rounded-xl transition flex items-center gap-2 cursor-pointer">
                                        <i class="fa-solid fa-trash-can"></i>
                                        <span>Hapus Foto</span>
                                    </button>
                                @endif
                            </div>
                            <p class="text-[11px] text-slate-400">Format yang didukung: JPG, JPEG, PNG, WEBP. Ukuran maksimal: 2MB.</p>
                            @error('foto')
                                <p class="text-xs text-rose-600 font-medium mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <hr class="border-slate-100">

                <!-- Section: Inputs -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                    <!-- Nama Lengkap -->
                    <div>
                        <label for="nama_lengkap" class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1.5">
                            Nama Lengkap <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <i class="fa-solid fa-id-card text-sm"></i>
                            </span>
                            <input id="nama_lengkap" name="nama_lengkap" type="text" value="{{ old('nama_lengkap', $user->nama_lengkap) }}" required
                                   class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-300 text-slate-900 rounded-xl text-xs sm:text-sm focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition shadow-sm"
                                   placeholder="Contoh: Budi Santoso">
                        </div>
                        @error('nama_lengkap')
                            <p class="text-xs text-rose-600 font-medium mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Username -->
                    <div>
                        <label for="username" class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1.5">
                            Username <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <i class="fa-solid fa-at text-sm"></i>
                            </span>
                            <input id="username" name="username" type="text" value="{{ old('username', $user->username) }}" required
                                   class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-300 text-slate-900 rounded-xl text-xs sm:text-sm focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition shadow-sm"
                                   placeholder="budisantoso">
                        </div>
                        @error('username')
                            <p class="text-xs text-rose-600 font-medium mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1.5">
                            Alamat Email <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <i class="fa-solid fa-envelope text-sm"></i>
                            </span>
                            <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required
                                   class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-300 text-slate-900 rounded-xl text-xs sm:text-sm focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition shadow-sm"
                                   placeholder="budi@smaknis.sch.id">
                        </div>
                        @error('email')
                            <p class="text-xs text-rose-600 font-medium mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- No WhatsApp -->
                    <div>
                        <label for="no_whatsapp" class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1.5">
                            No WhatsApp
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <i class="fa-brands fa-whatsapp text-sm"></i>
                            </span>
                            <input id="no_whatsapp" name="no_whatsapp" type="text" value="{{ old('no_whatsapp', $user->no_whatsapp) }}"
                                   class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-300 text-slate-900 rounded-xl text-xs sm:text-sm focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition shadow-sm"
                                   placeholder="Contoh: 081234567890">
                        </div>
                        @error('no_whatsapp')
                            <p class="text-xs text-rose-600 font-medium mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Footer Submit Button -->
                <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                    <button type="submit" 
                            class="w-full sm:w-auto px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 active:bg-indigo-800 text-white font-bold text-xs sm:text-sm rounded-xl shadow-lg shadow-indigo-500/25 transition duration-150 ease-in-out flex items-center justify-center gap-2 cursor-pointer">
                        <i class="fa-solid fa-floppy-disk"></i>
                        <span>Simpan Perubahan</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Form Hidden khusus untuk menghapus Foto Profil -->
@if ($user->foto)
    <form id="delete-photo-form" action="{{ route('profile.delete-photo') }}" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>
@endif
@endsection