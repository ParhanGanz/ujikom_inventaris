<x-guest-layout>
    <div class="w-full max-w-sm sm:max-w-md mx-auto px-4 sm:px-0">
        <!-- Header / Logo -->
        <div class="mb-6 text-center">
            <div class="inline-flex items-center justify-center w-12 h-12 sm:w-14 sm:h-14 bg-indigo-600 text-white rounded-2xl shadow-lg shadow-indigo-500/30 mb-3">
                <i class="fa-solid fa-user-plus text-xl sm:text-2xl"></i>
            </div>
            <h2 class="text-xl sm:text-2xl font-extrabold text-gray-900 tracking-tight">Buat Akun Baru</h2>
            <p class="text-xs sm:text-sm text-gray-500 mt-1">Registrasi Akun Pengguna Inventaris SMAKNIS</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-4 sm:space-y-5">
            @csrf

            <!-- Nama Lengkap -->
            <div>
                <label for="nama_lengkap" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">
                    Nama Lengkap
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                        <i class="fa-solid fa-id-card text-sm"></i>
                    </div>
                    <input id="nama_lengkap" type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required autofocus
                        class="w-full pl-10 pr-4 py-2.5 sm:py-3 bg-gray-50 border border-gray-300 text-gray-900 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition shadow-sm"
                        placeholder="Contoh: Budi Santoso">
                </div>
                <x-input-error :messages="$errors->get('nama_lengkap')" class="mt-1" />
            </div>

            <!-- Username -->
            <div>
                <label for="username" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">
                    Username
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                        <i class="fa-solid fa-at text-sm"></i>
                    </div>
                    <input id="username" type="text" name="username" value="{{ old('username') }}" required
                        class="w-full pl-10 pr-4 py-2.5 sm:py-3 bg-gray-50 border border-gray-300 text-gray-900 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition shadow-sm"
                        placeholder="budisantoso">
                </div>
                <x-input-error :messages="$errors->get('username')" class="mt-1" />
            </div>

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">
                    Email
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                        <i class="fa-solid fa-envelope text-sm"></i>
                    </div>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required
                        class="w-full pl-10 pr-4 py-2.5 sm:py-3 bg-gray-50 border border-gray-300 text-gray-900 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition shadow-sm"
                        placeholder="budi@smaknis.sch.id">
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-1" />
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">
                    Kata Sandi
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                        <i class="fa-solid fa-lock text-sm"></i>
                    </div>
                    <input id="password" type="password" name="password" required
                        class="w-full pl-10 pr-4 py-2.5 sm:py-3 bg-gray-50 border border-gray-300 text-gray-900 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition shadow-sm"
                        placeholder="Masukkan Password Minimal 8 Karakter">
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-1" />
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">
                    Konfirmasi Kata Sandi
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                        <i class="fa-solid fa-lock text-sm"></i>
                    </div>
                    <input id="password_confirmation" type="password" name="password_confirmation" required
                        class="w-full pl-10 pr-4 py-2.5 sm:py-3 bg-gray-50 border border-gray-300 text-gray-900 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition shadow-sm"
                        placeholder="Konfirmasi Password">
                </div>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
            </div>

            <!-- Submit Button -->
            <button type="submit"
                class="w-full py-2.5 sm:py-3 px-4 bg-indigo-600 hover:bg-indigo-700 active:bg-indigo-800 text-white font-bold text-sm rounded-xl shadow-lg shadow-indigo-500/25 transition duration-150 ease-in-out flex items-center justify-center gap-2 cursor-pointer">
                <i class="fa-solid fa-user-plus"></i> Daftar Akun
            </button>

            <div class="text-center pt-3 border-t border-gray-100">
                <p class="text-xs sm:text-sm text-gray-500">
                    Sudah punya akun? 
                    <a href="{{ route('login') }}" class="font-bold text-indigo-600 hover:text-indigo-700 hover:underline transition">
                        Masuk di sini
                    </a>
                </p>
            </div>
        </form>
    </div>
</x-guest-layout>