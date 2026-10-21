<aside
    class="fixed inset-y-0 left-0 z-40 flex h-screen w-64 flex-col
              overflow-hidden border-r border-slate-200/80 bg-white
              shadow-[8px_0_30px_rgba(15,23,42,0.04)]">

    {{-- DEKORASI --}}
    <div class="pointer-events-none absolute -right-16 -top-16 h-40 w-40 rounded-full bg-indigo-100/60 blur-3xl"></div>

    {{-- HEADER --}}
    <div class="relative shrink-0 border-b border-slate-100 px-5 py-5">
        <a href="{{ route('admin.dashboard') }}" class="group flex items-center gap-3">
            <div
                class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl
                        bg-gradient-to-br from-indigo-500 to-violet-700
                        shadow-lg shadow-indigo-200/70 transition duration-300
                        group-hover:scale-105 group-hover:-rotate-3">
                <i class="fa-solid fa-boxes-stacked text-lg text-white"></i>
            </div>

            <div class="min-w-0">
                <h1 class="truncate text-sm font-extrabold tracking-tight text-slate-800">
                    Inventaris <span class="text-indigo-600">SMAKNIS</span>
                </h1>
                <p class="mt-1 text-[9px] font-semibold uppercase tracking-[1.5px] text-slate-400">
                    School Asset Management
                </p>
            </div>
        </a>
    </div>

    {{-- MENU SCROLL --}}
    <nav class="relative flex-1 space-y-6 overflow-y-auto overscroll-contain px-3 py-5">

        {{-- DASHBOARD --}}
        <div>
            <p class="mb-2 px-3 text-[10px] font-bold uppercase tracking-[1.8px] text-slate-400">
                Menu Utama
            </p>

            <a href="{{ route('admin.dashboard') }}"
                class="group relative flex items-center gap-3 rounded-xl px-3 py-3 text-xs transition-all duration-200
               {{ request()->routeIs('admin.dashboard')
                   ? 'bg-gradient-to-r from-indigo-50 to-violet-50 font-bold text-indigo-700 shadow-sm'
                   : 'font-medium text-slate-500 hover:bg-slate-50 hover:text-indigo-600' }}">

                @if (request()->routeIs('admin.dashboard'))
                    <span class="absolute inset-y-2 left-0 w-1 rounded-r-full bg-indigo-600"></span>
                @endif

                <span
                    class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg
                    {{ request()->routeIs('admin.dashboard')
                        ? 'bg-indigo-600 text-white shadow-md shadow-indigo-200'
                        : 'bg-slate-100 text-slate-500 group-hover:bg-indigo-100 group-hover:text-indigo-600' }}">
                    <i class="fa-solid fa-house text-xs"></i>
                </span>

                <span class="flex-1">Dashboard</span>

                @if (request()->routeIs('admin.dashboard'))
                    <i class="fa-solid fa-circle text-[6px] text-indigo-500"></i>
                @endif
            </a>
        </div>

        {{-- MASTER DATA: SATU-SATUNYA DROPDOWN --}}
        <div x-data="{ open: {{ request()->routeIs(
            'admin.barang.*',
            'admin.kategori.*',
            'admin.role.*',
            'admin.lokasi.*',
            'admin.suplier.*',
            'admin.unit.*',
            'admin.penanggung_jawab.*',
        )
            ? 'true'
            : 'false' }} }">

            <button type="button" @click="open = !open"
                class="flex w-full items-center justify-between rounded-lg px-3 py-2 text-[10px] font-extrabold uppercase tracking-[1.6px] transition-colors
                    {{ request()->routeIs(
                        'admin.barang.*',
                        'admin.kategori.*',
                        'admin.role.*',
                        'admin.lokasi.*',
                        'admin.suplier.*',
                        'admin.unit.*',
                        'admin.penanggung_jawab.*',
                    )
                        ? 'text-indigo-600'
                        : 'text-slate-400 hover:text-slate-600' }}">

                <span class="flex items-center gap-2">
                    <i class="fa-solid fa-database text-[10px]"></i>
                    Master Data
                </span>

                <i class="fa-solid fa-chevron-down text-[9px] transition-transform duration-200"
                    :class="open ? 'rotate-180 text-indigo-500' : ''"></i>
            </button>

            <div x-show="open" x-collapse class="mt-1 space-y-1">

                {{-- DATA BARANG --}}
                <a href="#"
                    class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-xs font-medium text-slate-500 transition-all duration-200 hover:translate-x-0.5 hover:bg-slate-50 hover:text-indigo-600">
                    <i
                        class="fa-solid fa-box w-4 text-center text-[11px] text-slate-400 group-hover:text-indigo-500"></i>
                    <span class="flex-1">Data Barang</span>
                </a>

                {{-- KATEGORI --}}
                <a href="{{ route('admin.kategori.index') }}"
                    class="group relative flex items-center gap-3 rounded-xl px-3 py-2.5 text-xs transition-all duration-200
                   {{ request()->routeIs('admin.kategori.*')
                       ? 'bg-indigo-50 font-bold text-indigo-700'
                       : 'font-medium text-slate-500 hover:translate-x-0.5 hover:bg-slate-50 hover:text-indigo-600' }}">

                    @if (request()->routeIs('admin.kategori.*'))
                        <span class="absolute inset-y-2 left-0 w-1 rounded-r-full bg-indigo-600"></span>
                    @endif

                    <i
                        class="fa-solid fa-layer-group w-4 text-center text-[11px]
                        {{ request()->routeIs('admin.kategori.*') ? 'text-indigo-600' : 'text-slate-400 group-hover:text-indigo-500' }}"></i>

                    <span class="flex-1">Kategori</span>
                </a>

                {{-- ROLE --}}
                {{-- <a href="{{ route('admin.role.index') }}"
                    class="group relative flex items-center gap-3 rounded-xl px-3 py-2.5 text-xs transition-all duration-200
                   {{ request()->routeIs('admin.role.*')
                       ? 'bg-indigo-50 font-bold text-indigo-700'
                       : 'font-medium text-slate-500 hover:translate-x-0.5 hover:bg-slate-50 hover:text-indigo-600' }}">

                    @if (request()->routeIs('admin.role.*'))
                        <span class="absolute inset-y-2 left-0 w-1 rounded-r-full bg-indigo-600"></span>
                    @endif

                    <i
                        class="fa-solid fa-user-shield w-4 text-center text-[11px]
                        {{ request()->routeIs('admin.role.*') ? 'text-indigo-600' : 'text-slate-400 group-hover:text-indigo-500' }}"></i>

                    <span class="flex-1">Role</span>
                </a> --}}

                {{-- LOKASI RUANG --}}
                <a href="{{ route('admin.lokasi.index') }}"
                    class="group relative flex items-center gap-3 rounded-xl px-3 py-2.5 text-xs transition-all duration-200
                   {{ request()->routeIs('admin.lokasi.*')
                       ? 'bg-indigo-50 font-bold text-indigo-700'
                       : 'font-medium text-slate-500 hover:translate-x-0.5 hover:bg-slate-50 hover:text-indigo-600' }}">

                    @if (request()->routeIs('admin.lokasi.*'))
                        <span class="absolute inset-y-2 left-0 w-1 rounded-r-full bg-indigo-600"></span>
                    @endif

                    <i
                        class="fa-solid fa-location-dot w-4 text-center text-[11px]
                        {{ request()->routeIs('admin.lokasi.*') ? 'text-indigo-600' : 'text-slate-400 group-hover:text-indigo-500' }}"></i>

                    <span class="flex-1">Lokasi Ruang</span>
                </a>

                {{-- SUPPLIER --}}
                <a href="#"
                    class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-xs font-medium text-slate-500 transition-all duration-200 hover:translate-x-0.5 hover:bg-slate-50 hover:text-indigo-600">
                    <i
                        class="fa-solid fa-truck-field w-4 text-center text-[11px] text-slate-400 group-hover:text-indigo-500"></i>
                    <span class="flex-1">Supplier</span>
                </a>

                {{-- SATUAN UNIT --}}
                <a href="#"
                    class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-xs font-medium text-slate-500 transition-all duration-200 hover:translate-x-0.5 hover:bg-slate-50 hover:text-indigo-600">
                    <i
                        class="fa-solid fa-ruler-combined w-4 text-center text-[11px] text-slate-400 group-hover:text-indigo-500"></i>
                    <span class="flex-1">Satuan Unit</span>
                </a>

                {{-- Penanggung Jawab Ruangan --}}
                <a href="{{ route('admin.penanggung_jawab.index') }}"
                    class="group relative flex items-center gap-3 rounded-xl px-3 py-2.5 text-xs transition-all duration-200
                   {{ request()->routeIs('admin.penanggung_jawab.*')
                       ? 'bg-indigo-50 font-bold text-indigo-700'
                       : 'font-medium text-slate-500 hover:translate-x-0.5 hover:bg-slate-50 hover:text-indigo-600' }}">

                    @if (request()->routeIs('admin.penanggung_jawab.*'))
                        <span class="absolute inset-y-2 left-0 w-1 rounded-r-full bg-indigo-600"></span>
                    @endif

                    <i
                        class="fa-regular fa-circle-user w-4 text-center text-[11px]
                        {{ request()->routeIs('admin.penanggung_jawab.*') ? 'text-indigo-600' : 'text-slate-400 group-hover:text-indigo-500' }}"></i>

                    <span class="flex-1">Penanggung jawab Ruangan</span>
                </a>

            </div>
        </div>

        {{-- TRANSAKSI: TANPA DROPDOWN --}}
        <div>
            <p class="mb-2 px-3 text-[10px] font-extrabold uppercase tracking-[1.6px] text-slate-400">
                Transaksi
            </p>

            <div class="space-y-1">

                <a href="#"
                    class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-xs font-medium text-slate-500 transition-all hover:translate-x-0.5 hover:bg-slate-50 hover:text-indigo-600">
                    <i
                        class="fa-solid fa-arrow-right-to-bracket w-4 text-center text-[11px] text-slate-400 group-hover:text-indigo-500"></i>
                    <span>Barang Masuk</span>
                </a>

                <a href="#"
                    class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-xs font-medium text-slate-500 transition-all hover:translate-x-0.5 hover:bg-slate-50 hover:text-indigo-600">
                    <i
                        class="fa-solid fa-arrow-right-from-bracket w-4 text-center text-[11px] text-slate-400 group-hover:text-indigo-500"></i>
                    <span>Barang Keluar</span>
                </a>

                <a href="#"
                    class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-xs font-medium text-slate-500 transition-all hover:translate-x-0.5 hover:bg-slate-50 hover:text-indigo-600">
                    <i
                        class="fa-solid fa-hand-holding-hand w-4 text-center text-[11px] text-slate-400 group-hover:text-indigo-500"></i>
                    <span>Peminjaman</span>
                </a>

                <a href="#"
                    class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-xs font-medium text-slate-500 transition-all hover:translate-x-0.5 hover:bg-slate-50 hover:text-indigo-600">
                    <i
                        class="fa-solid fa-rotate-left w-4 text-center text-[11px] text-slate-400 group-hover:text-indigo-500"></i>
                    <span>Pengembalian</span>
                </a>

                <a href="#"
                    class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-xs font-medium text-slate-500 transition-all hover:translate-x-0.5 hover:bg-slate-50 hover:text-indigo-600">
                    <i
                        class="fa-solid fa-screwdriver-wrench w-4 text-center text-[11px] text-slate-400 group-hover:text-indigo-500"></i>
                    <span>Pemeliharaan</span>
                </a>
                <a href="#"
                    class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-xs font-medium text-slate-500 transition-all hover:translate-x-0.5 hover:bg-slate-50 hover:text-indigo-600">
                    <i
                        class="fa-solid fa-check-to-slot w-4 text-center text-[11px] text-slate-400 group-hover:text-indigo-500"></i>
                    <span>Rekomendasi Pengadaan Barang</span>
                </a>

            </div>
        </div>

        {{-- LAPORAN & AKUN: TANPA DROPDOWN --}}
        <div>
            <p class="mb-2 px-3 text-[10px] font-extrabold uppercase tracking-[1.6px] text-slate-400">
                Laporan &amp; Akun
            </p>

            <div class="space-y-1">

                <a href="#"
                    class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-xs font-medium text-slate-500 transition-all hover:translate-x-0.5 hover:bg-slate-50 hover:text-indigo-600">
                    <i
                        class="fa-solid fa-chart-column w-4 text-center text-[11px] text-slate-400 group-hover:text-indigo-500"></i>
                    <span>Laporan Rekap</span>
                </a>

                {{-- DIREKTORI PENGGUNA --}}
                <a href="{{ route('admin.users.index') }}"
                    class="group relative flex items-center gap-3 rounded-xl px-3 py-2.5 text-xs transition-all duration-200
                   {{ request()->routeIs('admin.users.*')
                       ? 'bg-indigo-50 font-bold text-indigo-700'
                       : 'font-medium text-slate-500 hover:translate-x-0.5 hover:bg-slate-50 hover:text-indigo-600' }}">

                    @if (request()->routeIs('admin.users.*'))
                        <span class="absolute inset-y-2 left-0 w-1 rounded-r-full bg-indigo-600"></span>
                    @endif

                    <i
                        class="fa-solid fa-users w-4 text-center text-[11px]
                        {{ request()->routeIs('admin.users.*') ? 'text-indigo-600' : 'text-slate-400 group-hover:text-indigo-500' }}"></i>

                    <span class="flex-1">Direktori Pengguna</span>
                </a>

            </div>
        </div>
    </nav>

    {{-- FOOTER / PANDUAN --}}
    <div class="relative shrink-0 border-t border-slate-100 bg-white p-3">
        <a href="{{ asset('docs/panduan-inventaris.docx') }}" target="_blank"
            class="group flex items-center gap-3 rounded-xl border border-indigo-100 bg-gradient-to-r from-indigo-50/80 to-violet-50/80 px-3 py-3 transition-all duration-200 hover:border-indigo-200 hover:shadow-md hover:shadow-indigo-100/60">

            <span
                class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-white text-indigo-600 shadow-sm transition-transform group-hover:scale-105">
                <i class="fa-regular fa-file-word text-sm"></i>
            </span>

            <span class="min-w-0 flex-1">
                <span class="block text-xs font-bold text-slate-700">Panduan Penggunaan</span>
                <span class="mt-0.5 block text-[10px] text-slate-400">Buka dokumentasi</span>
            </span>

            <i
                class="fa-solid fa-arrow-up-right-from-square text-[10px] text-slate-400 transition-colors group-hover:text-indigo-600"></i>
        </a>

        <p class="mt-3 text-center text-[9px] font-medium tracking-wide text-slate-400">
            © {{ date('Y') }} Inventaris SMAKNIS
        </p>
    </div>
</aside>
