<header
    class="sticky top-0 z-30 flex h-16 w-full items-center justify-between border-b border-slate-200 bg-white/95 px-4 shadow-sm backdrop-blur sm:px-6"
    x-data="{
        dropdownOpen: false,
        timeString: '',
        dateString: '',
        updateClock() {
            const now = new Date();

            this.dateString = now.toLocaleDateString('id-ID', {
                weekday: 'long',
                day: 'numeric',
                month: 'short',
                year: 'numeric'
            });

            this.timeString = now.toLocaleTimeString('id-ID', {
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: false
            }).replace(/\./g, ':');
        }
    }"
    x-init="updateClock(); setInterval(() => updateClock(), 1000)"
>
    <!-- LEFT SECTION -->
    <div class="flex min-w-0 items-center gap-3 sm:gap-4">

        <!-- Sidebar Toggle: tampilan saja -->
        <button
            type="button"
            aria-label="Menu navigasi"
            title="Menu navigasi"
            class="shrink-0 rounded-xl p-2 text-slate-500 transition hover:bg-indigo-50 hover:text-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500/30"
        >
            <i class="fa-solid fa-bars text-lg"></i>
        </button>

        <!-- Search Bar -->
        <div class="relative w-36 sm:w-52 lg:w-72">
            <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                <i class="fa-solid fa-magnifying-glass text-sm"></i>
            </span>

            <input
                type="search"
                placeholder="Cari sesuatu..."
                aria-label="Cari sesuatu"
                class="w-full rounded-xl border border-slate-200 bg-slate-50 py-2 pl-10 pr-3 text-xs text-slate-700 transition placeholder:text-slate-400 focus:border-indigo-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-indigo-500/10 sm:text-sm"
            >
        </div>

        <!-- Realtime Clock -->
        <div class="hidden items-center gap-2.5 border-l border-slate-200 pl-4 lg:flex">
            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600">
                <i class="fa-regular fa-clock text-base"></i>
            </div>

            <div class="flex flex-col">
                <span
                    class="text-xs font-bold tracking-wide text-slate-800"
                    x-text="timeString"
                >00:00:00</span>

                <span
                    class="text-[10px] font-medium capitalize text-slate-400"
                    x-text="dateString"
                >Senin, 19 Okt 2026</span>
            </div>
        </div>
    </div>

    <!-- RIGHT SECTION -->
    <div class="ml-2 flex shrink-0 items-center gap-1 sm:gap-3">

        <!-- Theme Button: tampilan saja -->
        <button
            type="button"
            aria-label="Tema tampilan"
            title="Tema tampilan"
            class="hidden rounded-xl p-2.5 text-slate-500 transition hover:bg-slate-100 hover:text-indigo-600 sm:block"
        >
            <i class="fa-regular fa-moon text-lg"></i>
        </button>

        <!-- Notification Button: tampilan saja -->
        <button
            type="button"
            aria-label="Notifikasi"
            title="Notifikasi"
            class="relative rounded-xl p-2.5 text-slate-500 transition hover:bg-slate-100 hover:text-indigo-600"
        >
            <i class="fa-regular fa-bell text-lg"></i>

            <span class="absolute right-2 top-2 h-2 w-2 rounded-full bg-amber-500 ring-2 ring-white"></span>
        </button>

        <!-- PROFILE DROPDOWN -->
        <div
            class="relative ml-1 border-l border-slate-200 pl-2 sm:pl-3"
            @click.outside="dropdownOpen = false"
            @keydown.escape.window="dropdownOpen = false"
        >
            <button
                type="button"
                @click="dropdownOpen = !dropdownOpen"
                :aria-expanded="dropdownOpen.toString()"
                aria-haspopup="true"
                class="group flex items-center gap-2 rounded-xl p-1.5 transition hover:bg-slate-100 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 sm:gap-3"
            >
                <!-- User Information -->
                <div class="hidden text-right sm:block">
                    <p class="max-w-36 truncate text-xs font-bold text-slate-800 transition group-hover:text-indigo-600 sm:text-sm">
                        {{ Auth::user()->nama_lengkap ?? Auth::user()->username ?? Auth::user()->name ?? 'Pengguna' }}
                    </p>

                    <p class="mt-0.5 text-[10px] font-semibold uppercase tracking-wider text-slate-400">
                        @php
                            $userRole = Auth::user()->role;
                            $roleName = is_object($userRole)
                                ? ($userRole->name ?? $userRole->nama_role ?? 'Pengguna')
                                : ($userRole ?: 'Pengguna');
                        @endphp

                        {{ $roleName }}
                    </p>
                </div>

                <!-- Avatar -->
                <div class="relative shrink-0">
                    @if (
                        Auth::user()->foto &&
                        \Illuminate\Support\Facades\Storage::disk('public')->exists(Auth::user()->foto)
                    )
                        <img
                            src="{{ asset('storage/' . Auth::user()->foto) }}"
                            alt="Foto profil"
                            class="h-9 w-9 rounded-full object-cover ring-2 ring-slate-200 transition group-hover:ring-indigo-400 sm:h-10 sm:w-10"
                        >
                    @else
                        <div class="flex h-9 w-9 items-center justify-center rounded-full bg-gradient-to-br from-indigo-600 to-violet-500 text-sm font-bold text-white shadow-sm ring-2 ring-slate-200 transition group-hover:ring-indigo-400 sm:h-10 sm:w-10">
                            {{ strtoupper(substr(Auth::user()->nama_lengkap ?? Auth::user()->username ?? Auth::user()->name ?? 'U', 0, 1)) }}
                        </div>
                    @endif

                    <!-- Online Indicator -->
                    <span class="absolute bottom-0 right-0 h-2.5 w-2.5 rounded-full border-2 border-white bg-emerald-500"></span>
                </div>

                <!-- Chevron -->
                <i
                    class="fa-solid fa-chevron-down hidden text-[10px] text-slate-400 transition duration-200 group-hover:text-indigo-600 sm:block"
                    :class="dropdownOpen ? 'rotate-180' : ''"
                ></i>
            </button>

            <!-- Dropdown Menu -->
            <div
                x-cloak
                x-show="dropdownOpen"
                x-transition:enter="transition ease-out duration-150"
                x-transition:enter-start="translate-y-1 opacity-0 scale-95"
                x-transition:enter-end="translate-y-0 opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-100"
                x-transition:leave-start="translate-y-0 opacity-100 scale-100"
                x-transition:leave-end="translate-y-1 opacity-0 scale-95"
                class="absolute right-0 z-50 mt-3 w-56 origin-top-right rounded-2xl border border-slate-100 bg-white py-2 shadow-xl shadow-slate-900/10"
            >
                <!-- Mobile User Information -->
                <div class="border-b border-slate-100 px-4 py-3 sm:hidden">
                    <p class="truncate text-sm font-bold text-slate-800">
                        {{ Auth::user()->nama_lengkap ?? Auth::user()->username ?? Auth::user()->name ?? 'Pengguna' }}
                    </p>

                    <p class="mt-1 text-xs font-medium text-slate-400">
                        {{ $roleName }}
                    </p>
                </div>

                <!-- Profile Link -->
                <div class="px-2">
                    <a
                        href="{{ route('profile.edit') }}"
                        class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium text-slate-600 transition hover:bg-indigo-50 hover:text-indigo-600"
                    >
                        <i class="fa-regular fa-user w-5 text-center text-base"></i>
                        <span>Edit Profil</span>
                    </a>
                </div>

                <!-- Divider -->
                <div class="my-1 border-t border-slate-100"></div>

                <!-- Logout -->
                <div class="px-2">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button
                            type="submit"
                            class="flex w-full items-center gap-3 rounded-xl px-3 py-2.5 text-left text-sm font-semibold text-rose-600 transition hover:bg-rose-50"
                        >
                            <i class="fa-solid fa-arrow-right-from-bracket w-5 text-center text-base"></i>
                            <span>Keluar dari Akun</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Prevent Alpine elements from flashing before initialization -->
<style>
    [x-cloak] {
        display: none !important;
    }
</style>