<x-guest-layout>
    <!-- Container Utama dengan Perspektif 3D -->
    <div class="w-full max-w-sm sm:max-w-md perspective-1000 mx-auto" x-data="{ isFlipped: false }">
        
        <!-- Kartu 3D Outer (Menerima Rotasi) -->
        <div class="relative w-full transition-transform duration-700 transform-style-3d shadow-xl sm:shadow-2xl rounded-2xl sm:rounded-3xl bg-white border border-slate-200/80"
             :class="isFlipped ? 'rotate-y-180' : ''">

            <!-- ================= SIDE DEPAN: FORM LOGIN ================= -->
            <div class="w-full p-6 sm:p-8 backface-hidden">
                <div class="mb-6 text-center">
                    <div class="inline-flex items-center justify-center w-12 h-12 sm:w-14 sm:h-14 bg-indigo-600 text-white rounded-2xl shadow-lg shadow-indigo-500/30 mb-3">
                        <i class="fa-solid fa-boxes-stacked text-xl sm:text-2xl"></i>
                    </div>
                    <h2 class="text-xl sm:text-2xl font-extrabold text-gray-900 tracking-tight">Masuk ke Sistem</h2>
                    <p class="text-xs sm:text-sm text-gray-500 mt-1">Sistem Informasi Inventaris SMAKNIS</p>
                </div>

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-4 sm:space-y-5">
                    @csrf

                    <!-- Username / Email -->
                    <div>
                        <label for="login" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">
                            Username atau Email
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                                <i class="fa-solid fa-user text-sm"></i>
                            </div>
                            <input id="login" type="text" name="login" value="{{ old('login') }}" required autofocus
                                class="w-full pl-10 pr-4 py-2.5 sm:py-3 bg-gray-50 border border-gray-300 text-gray-900 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition shadow-sm"
                                placeholder="Masukkan username atau email">
                        </div>
                        <x-input-error :messages="$errors->get('login')" class="mt-1" />
                    </div>

                    <!-- Password -->
                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <label for="password" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Kata Sandi
                            </label>
                            @if (Route::has('password.request'))
                                <a class="text-xs text-indigo-600 hover:text-indigo-700 hover:underline font-medium transition" href="{{ route('password.request') }}">
                                    Lupa kata sandi?
                                </a>
                            @endif
                        </div>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                                <i class="fa-solid fa-lock text-sm"></i>
                            </div>
                            <input id="password" type="password" name="password" required
                                class="w-full pl-10 pr-4 py-2.5 sm:py-3 bg-gray-50 border border-gray-300 text-gray-900 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition shadow-sm"
                                placeholder="Masukkan password">
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-1" />
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center justify-between pt-1">
                        <label for="remember_me" class="inline-flex items-center cursor-pointer select-none">
                            <input id="remember_me" type="checkbox" class="w-4 h-4 rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 cursor-pointer" name="remember">
                            <span class="ms-2 text-xs sm:text-sm text-gray-600">Ingat Saya</span>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                        class="w-full py-2.5 sm:py-3 px-4 bg-indigo-600 hover:bg-indigo-700 active:bg-indigo-800 text-white font-bold text-sm rounded-xl shadow-lg shadow-indigo-500/25 transition duration-150 ease-in-out flex items-center justify-center gap-2 cursor-pointer">
                        <i class="fa-solid fa-right-to-bracket"></i> Masuk Sekarang
                    </button>

                    <!-- Switch to Register -->
                    <div class="text-center pt-3 border-t border-gray-100">
                        <p class="text-xs sm:text-sm text-gray-500">
                            Belum punya akun? 
                            <button type="button" @click="isFlipped = true" class="font-bold text-indigo-600 hover:text-indigo-700 hover:underline transition bg-transparent border-0 cursor-pointer">
                                Daftar di sini
                            </button>
                        </p>
                    </div>
                </form>
            </div>


            <!-- ================= SIDE BELAKANG: FORM REGISTER ================= -->
            <div class="w-full p-6 sm:p-8 backface-hidden rotate-y-180 absolute top-0 left-0 bg-white rounded-2xl sm:rounded-3xl h-full flex flex-col justify-between overflow-y-auto">
                <div>
                    <div class="mb-5 text-center">
                        <div class="inline-flex items-center justify-center w-12 h-12 sm:w-14 sm:h-14 bg-indigo-600 text-white rounded-2xl shadow-lg shadow-indigo-500/30 mb-2">
                            <i class="fa-solid fa-user-plus text-xl sm:text-2xl"></i>
                        </div>
                        <h2 class="text-xl sm:text-2xl font-extrabold text-gray-900 tracking-tight">Buat Akun Baru</h2>
                        <p class="text-xs sm:text-sm text-gray-500 mt-1">Registrasi Akun Inventaris SMAKNIS</p>
                    </div>

                    <form method="POST" action="{{ route('register') }}" class="space-y-3.5 sm:space-y-4">
                        @csrf

                        <!-- Nama Lengkap -->
                        <div>
                            <label for="nama_lengkap" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">Nama Lengkap</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                                    <i class="fa-solid fa-id-card text-sm"></i>
                                </div>
                                <input id="nama_lengkap" type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required
                                    class="w-full pl-10 pr-4 py-2 sm:py-2.5 bg-gray-50 border border-gray-300 text-gray-900 rounded-xl text-xs sm:text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition shadow-sm"
                                    placeholder="Contoh: Budi Santoso">
                            </div>
                            <x-input-error :messages="$errors->get('nama_lengkap')" class="mt-1" />
                        </div>

                        <!-- Username -->
                        <div>
                            <label for="username" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">Username</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                                    <i class="fa-solid fa-at text-sm"></i>
                                </div>
                                <input id="username" type="text" name="username" value="{{ old('username') }}" required
                                    class="w-full pl-10 pr-4 py-2 sm:py-2.5 bg-gray-50 border border-gray-300 text-gray-900 rounded-xl text-xs sm:text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition shadow-sm"
                                    placeholder="budisantoso">
                            </div>
                            <x-input-error :messages="$errors->get('username')" class="mt-1" />
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">Email</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                                    <i class="fa-solid fa-envelope text-sm"></i>
                                </div>
                                <input id="email" type="email" name="email" value="{{ old('email') }}" required
                                    class="w-full pl-10 pr-4 py-2 sm:py-2.5 bg-gray-50 border border-gray-300 text-gray-900 rounded-xl text-xs sm:text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition shadow-sm"
                                    placeholder="budi@smaknis.sch.id">
                            </div>
                            <x-input-error :messages="$errors->get('email')" class="mt-1" />
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password_reg" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">Kata Sandi</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                                    <i class="fa-solid fa-lock text-sm"></i>
                                </div>
                                <input id="password_reg" type="password" name="password" required
                                    class="w-full pl-10 pr-4 py-2 sm:py-2.5 bg-gray-50 border border-gray-300 text-gray-900 rounded-xl text-xs sm:text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition shadow-sm"
                                    placeholder="Minimal 8 karakter">
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-1" />
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label for="password_confirmation" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">Konfirmasi Kata Sandi</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                                    <i class="fa-solid fa-lock text-sm"></i>
                                </div>
                                <input id="password_confirmation" type="password" name="password_confirmation" required
                                    class="w-full pl-10 pr-4 py-2 sm:py-2.5 bg-gray-50 border border-gray-300 text-gray-900 rounded-xl text-xs sm:text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition shadow-sm"
                                    placeholder="Konfirmasi Password">
                            </div>
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
                        </div>

                        <!-- Submit Button -->
                        <button type="submit"
                            class="w-full py-2.5 sm:py-3 px-4 bg-indigo-600 hover:bg-indigo-700 active:bg-indigo-800 text-white font-bold text-sm rounded-xl shadow-lg shadow-indigo-500/25 transition duration-150 ease-in-out flex items-center justify-center gap-2 cursor-pointer mt-3">
                            <i class="fa-solid fa-user-plus"></i> Daftar Akun
                        </button>
                    </form>
                </div>

                <!-- Switch to Login & Padding Bawah -->
                <div class="text-center pt-3 pb-2 border-t border-gray-100 mt-4">
                    <p class="text-xs sm:text-sm text-gray-500">
                        Sudah punya akun? 
                        <button type="button" @click="isFlipped = false" class="font-bold text-indigo-600 hover:text-indigo-700 hover:underline transition bg-transparent border-0 cursor-pointer">
                            Masuk di sini
                        </button>
                    </p>
                </div>
            </div>

        </div>
    </div>
</x-guest-layout>