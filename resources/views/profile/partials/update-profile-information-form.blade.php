<section x-data="{ photoPreview: null }">
    <header class="mb-6">
        <h2 class="text-lg font-bold text-slate-900">
            {{ __('Informasi Profil') }}
        </h2>
        <p class="mt-1 text-xs sm:text-sm text-slate-500">
            {{ __('Perbarui foto profil, nama lengkap, username, email, dan nomor WhatsApp akun Anda.') }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-5">
        @csrf
        @method('patch')

        <!-- Foto Profil -->
        <div>
            <label class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-2">
                {{ __('Foto Profil') }}
            </label>
            <div class="flex items-center gap-4">
                <!-- Current Photo / Preview -->
                <div class="relative w-16 h-16 sm:w-20 sm:h-20 shrink-0">
                    <template x-if="!photoPreview">
                        <img src="{{ $user->foto ? asset('storage/' . $user->foto) : 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&q=80&w=256' }}" 
                             alt="Avatar" class="w-full h-full rounded-2xl object-cover ring-2 ring-slate-200 shadow-sm">
                    </template>
                    <template x-if="photoPreview">
                        <img :src="photoPreview" class="w-full h-full rounded-2xl object-cover ring-2 ring-indigo-500 shadow-sm">
                    </template>
                </div>

                <div>
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
                            class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold text-xs rounded-xl transition cursor-pointer flex items-center gap-2">
                        <i class="fa-solid fa-camera text-slate-500"></i>
                        <span>Pilih Foto Baru</span>
                    </button>
                    <p class="text-[11px] text-slate-400 mt-1.5">Format JPG, PNG, atau WEBP (Maksimal 2MB)</p>
                    <x-input-error class="mt-1" :messages="$errors->get('foto')" />
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <!-- Nama Lengkap -->
            <div>
                <label for="nama_lengkap" class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1">
                    {{ __('Nama Lengkap') }}
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <i class="fa-solid fa-id-card text-sm"></i>
                    </span>
                    <input id="nama_lengkap" name="nama_lengkap" type="text" 
                           class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-300 text-slate-900 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition shadow-sm" 
                           value="{{ old('nama_lengkap', $user->nama_lengkap) }}" required autofocus autocomplete="name" />
                </div>
                <x-input-error class="mt-1" :messages="$errors->get('nama_lengkap')" />
            </div>

            <!-- Username -->
            <div>
                <label for="username" class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1">
                    {{ __('Username') }}
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <i class="fa-solid fa-at text-sm"></i>
                    </span>
                    <input id="username" name="username" type="text" 
                           class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-300 text-slate-900 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition shadow-sm" 
                           value="{{ old('username', $user->username) }}" required autocomplete="username" />
                </div>
                <x-input-error class="mt-1" :messages="$errors->get('username')" />
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <!-- Email -->
            <div>
                <label for="email" class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1">
                    {{ __('Email') }}
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <i class="fa-solid fa-envelope text-sm"></i>
                    </span>
                    <input id="email" name="email" type="email" 
                           class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-300 text-slate-900 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition shadow-sm" 
                           value="{{ old('email', $user->email) }}" required autocomplete="username" />
                </div>
                <x-input-error class="mt-1" :messages="$errors->get('email')" />

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div class="mt-2">
                        <p class="text-xs text-amber-600">
                            {{ __('Alamat email Anda belum diverifikasi.') }}
                            <button form="send-verification" class="underline text-xs text-slate-600 hover:text-slate-900 font-medium">
                                {{ __('Klik di sini untuk mengirim ulang email verifikasi.') }}
                            </button>
                        </p>
                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-1 text-xs font-medium text-emerald-600">
                                {{ __('Tautan verifikasi baru telah dikirim ke alamat email Anda.') }}
                            </p>
                        @endif
                    </div>
                @endif
            </div>

            <!-- No WhatsApp -->
            <div>
                <label for="no_whatsapp" class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1">
                    {{ __('No WhatsApp') }}
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <i class="fa-brands fa-whatsapp text-sm"></i>
                    </span>
                    <input id="no_whatsapp" name="no_whatsapp" type="text" 
                           class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-300 text-slate-900 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition shadow-sm" 
                           value="{{ old('no_whatsapp', $user->no_whatsapp) }}" placeholder="Contoh: 081234567890" />
                </div>
                <x-input-error class="mt-1" :messages="$errors->get('no_whatsapp')" />
            </div>
        </div>

        <!-- Submit Button -->
        <div class="flex items-center gap-4 pt-2">
            <button type="submit" 
                    class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 active:bg-indigo-800 text-white font-bold text-xs sm:text-sm rounded-xl shadow-lg shadow-indigo-500/25 transition flex items-center gap-2 cursor-pointer">
                <i class="fa-solid fa-floppy-disk"></i>
                <span>{{ __('Simpan Perubahan') }}</span>
            </button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)" 
                   class="text-xs font-semibold text-emerald-600 flex items-center gap-1.5">
                    <i class="fa-solid fa-circle-check"></i>
                    <span>{{ __('Berhasil disimpan.') }}</span>
                </p>
            @endif
        </div>
    </form>
</section>