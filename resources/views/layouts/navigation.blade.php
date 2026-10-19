<header class="bg-white border-b border-slate-200 h-16 flex items-center justify-between px-4 sm:px-6 z-20 sticky top-0"
    x-data="{ 
            dropdownOpen: false, 
            timeString: '', 
            dateString: '',
            updateClock() {
                const now = new Date();
                const optionsDate = { weekday: 'long', day: 'numeric', month: 'short', year: 'numeric' };
                this.dateString = now.toLocaleDateString('id-ID', optionsDate);
                this.timeString = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' }).replace(/\./g, ':');
            }
        }"
    x-init="updateClock(); setInterval(() => updateClock(), 1000)">

    <!-- Left Section: Collapse Toggle, Search Bar & Realtime Clock -->
    <div class="flex items-center space-x-3 sm:space-x-4">
        <!-- Sidebar Toggle Button -->
        <button class="p-2 text-slate-400 hover:text-slate-600 rounded-lg hover:bg-slate-50 transition cursor-pointer">
            <i class="fa-solid fa-bars text-lg"></i>
        </button>

        <!-- Search Bar -->
        <div class="relative w-44 sm:w-64 lg:w-80">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                <i class="fa-solid fa-magnifying-glass text-sm"></i>
            </span>
            <input type="text" placeholder="Search or type command..."
                class="w-full pl-10 pr-10 py-1.5 text-xs sm:text-sm rounded-xl border border-slate-200 bg-slate-50 text-slate-800 placeholder-slate-400 focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 focus:outline-none transition">
            <span class="absolute inset-y-0 right-0 hidden md:flex items-center pr-3">
                <kbd class="px-1.5 py-0.5 text-[10px] font-semibold text-slate-400 bg-slate-200/60 border border-slate-300/60 rounded-md">⌘K</kbd>
            </span>
        </div>

        <!-- Realtime Clock Widget (Disebelah Kanan Search Bar) -->
        <div class="hidden lg:flex items-center space-x-2.5 pl-3 border-l border-slate-200 text-slate-600">
            <div class="w-8 h-8 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center">
                <i class="fa-regular fa-clock text-sm"></i>
            </div>
            <div class="flex flex-col">
                <span class="text-xs font-bold text-slate-800 leading-tight tracking-wider" x-text="timeString">00:00:00</span>
                <span class="text-[10px] font-medium text-slate-400 leading-tight" x-text="dateString">Senin, 1 Jan 2026</span>
            </div>
        </div>
    </div>

    <!-- Right Section: Actions & User Profile Dropdown -->
    <div class="flex items-center space-x-2 sm:space-x-4">
        <!-- Theme Switcher Icon -->
        <button class="p-2 text-slate-400 hover:text-slate-600 rounded-full hover:bg-slate-100 transition cursor-pointer">
            <i class="fa-regular fa-moon text-lg"></i>
        </button>

        <!-- Notification Bell -->
        <button class="relative p-2 text-slate-400 hover:text-slate-600 rounded-full hover:bg-slate-100 transition cursor-pointer">
            <i class="fa-regular fa-bell text-lg"></i>
            <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-amber-500 rounded-full ring-2 ring-white"></span>
        </button>

        <!-- Profile Section with Dropdown -->
        <div class="relative pl-2 border-l border-slate-200" @click.outside="dropdownOpen = false">
            <button @click="dropdownOpen = !dropdownOpen"
                class="flex items-center space-x-2.5 sm:space-x-3 p-1.5 rounded-2xl hover:bg-slate-100/80 active:bg-slate-200/60 transition duration-150 cursor-pointer focus:outline-none group">

                <!-- Informasi Nama & Role (Tampilan Lebih Elegan & Rapi) -->
                <div class="text-right hidden sm:block">
                    <p class="text-xs sm:text-sm font-semibold text-slate-800 group-hover:text-indigo-600 leading-snug tracking-tight transition-colors">
                        {{ Auth::user()->nama_lengkap ?? Auth::user()->username }}
                    </p>
                    <p class="text-[10px] sm:text-[11px] font-medium text-slate-400 leading-none mt-0.5 tracking-wide uppercase">
                        {{ Auth::user()->role->name ?? 'Administrator' }}
                    </p>
                </div>

                <!-- Avatar Foto Profile dari Database / Storage -->
                <div class="relative shrink-0">
                    @if (Auth::user()->foto && Storage::disk('public')->exists(Auth::user()->foto))
                    <img class="w-8 h-8 sm:w-9 sm:h-9 rounded-full object-cover ring-2 ring-slate-200 group-hover:ring-indigo-500/50 transition shadow-sm"
                        src="{{ asset('storage/' . Auth::user()->foto) }}"
                        alt="{{ Auth::user()->nama_lengkap }}">
                    @else
                    <!-- Fallback Inisial / Default Avatar jika belum upload foto -->
                    <div class="w-8 h-8 sm:w-9 sm:h-9 rounded-full bg-gradient-to-tr from-indigo-600 to-indigo-500 text-white font-bold text-xs sm:text-sm flex items-center justify-center ring-2 ring-slate-200 group-hover:ring-indigo-500/50 shadow-sm transition">
                        {{ strtoupper(substr(Auth::user()->nama_lengkap ?? Auth::user()->username ?? 'U', 0, 1)) }}
                    </div>
                    @endif

                    <!-- Indicator Status Online (Hijau) -->
                    <span class="absolute bottom-0 right-0 w-2.5 h-2.5 bg-emerald-500 rounded-full ring-2 ring-white"></span>
                </div>

                <!-- Icon Chevron -->
                <i class="fa-solid fa-chevron-down text-[11px] text-slate-400 group-hover:text-slate-600 transition-transform duration-200"
                    :class="dropdownOpen ? 'rotate-180' : ''"></i>
            </button>

            <!-- Dropdown Menu -->
            <div x-show="dropdownOpen"
                x-cloak
                x-transition:enter="transition ease-out duration-200 transform"
                x-transition:enter-start="opacity-0 scale-95 -translate-y-2"
                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                x-transition:leave="transition ease-in duration-150 transform"
                x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                x-transition:leave-end="opacity-0 scale-95 -translate-y-2"
                class="absolute right-0 mt-2 w-48 sm:w-56 bg-white rounded-2xl shadow-xl border border-slate-100 py-2 z-50">

                <!-- Detail Pengguna di Mobile -->
                <div class="px-4 py-2.5 border-b border-slate-100 sm:hidden">
                    <p class="text-xs font-bold text-slate-800 truncate">
                        {{ Auth::user()->nama_lengkap ?? Auth::user()->name ?? 'Musharof' }}
                    </p>
                    <p class="text-[10px] text-slate-400 font-medium">
                        {{ Auth::user()->role ?? 'Administrator' }}
                    </p>
                </div>

                <div class="px-1 space-y-0.5">
                    <!-- Edit Profile -->
                    <a href="{{ route('profile.edit') }}"
                        class="flex items-center gap-2.5 px-3 py-2 text-xs font-semibold text-slate-600 hover:text-indigo-600 hover:bg-indigo-50/60 rounded-xl transition">
                        <i class="fa-regular fa-user-circle text-base text-slate-400"></i>
                        <span>Edit Profil</span>
                    </a>
                </div>

                <div class="border-t border-slate-100 my-1"></div>

                <!-- Logout Form -->
                <div class="px-1">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="w-full flex items-center gap-2.5 px-3 py-2 text-xs font-semibold text-rose-600 hover:bg-rose-50/80 rounded-xl transition cursor-pointer">
                            <i class="fa-solid fa-arrow-right-from-bracket text-base text-rose-500"></i>
                            <span>Keluar (Logout)</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>