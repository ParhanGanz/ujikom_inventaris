<aside class="w-64 bg-white border-r border-slate-200 flex flex-col h-screen shrink-0 z-20 sticky top-0">
    <!-- Brand Header -->
    <div class="h-16 flex items-center px-6 border-b border-slate-100/80 justify-between bg-white shrink-0">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 group">
            <!-- Logo Icon dengan Soft Glow Effect -->
            <div class="relative flex items-center justify-center">
                <div class="absolute -inset-1 bg-gradient-to-r from-indigo-600 to-violet-600 rounded-2xl blur-sm opacity-40 group-hover:opacity-75 transition duration-300"></div>
                <div class="relative w-10 h-10 rounded-xl bg-gradient-to-tr from-indigo-600 via-indigo-500 to-violet-500 flex items-center justify-center text-white shadow-md shadow-indigo-500/20 group-hover:scale-105 transition duration-200">
                    <i class="fa-solid fa-boxes-packing text-lg"></i>
                </div>
            </div>

            <!-- Brand Title & Tagline/Badge -->
            <div class="flex flex-col">
                <div class="flex items-center gap-2">
                    <span class="text-xl font-extrabold tracking-tight text-slate-900 group-hover:text-indigo-600 transition-colors">
                        SMAKNIS
                    </span>
                    <span class="px-1.5 py-0.5 text-[10px] font-bold uppercase tracking-wider bg-indigo-50 text-indigo-600 rounded-md border border-indigo-100">
                        INV
                    </span>
                </div>
                <span class="text-[10px] font-semibold text-slate-400 tracking-wider uppercase leading-none">
                    Sistem Inventaris
                </span>
            </div>
        </a>
    </div>

    <!-- Navigation Links -->
    <nav class="flex-1 px-3.5 py-5 space-y-6 overflow-y-auto custom-scrollbar">
        <!-- MENU UTAMA -->
        <div>
            <p class="px-3 text-[10px] font-extrabold text-slate-400 uppercase tracking-widest mb-2">MENU UTAMA</p>
            <div class="space-y-1">
                @php $isActive = request()->routeIs('admin.dashboard', 'dashboard'); @endphp
                <a href="{{ route('admin.dashboard') }}" 
                   class="relative group flex items-center justify-between px-3.5 py-2.5 text-xs sm:text-sm font-bold rounded-2xl transition-all duration-200 {{ $isActive ? 'bg-gradient-to-r from-indigo-600 to-indigo-500 text-white shadow-lg shadow-indigo-500/25' : 'text-slate-600 hover:bg-slate-100/80 hover:text-slate-900 hover:translate-x-1' }}">
                    <div class="flex items-center space-x-3">
                        <div class="w-7 h-7 rounded-xl flex items-center justify-center {{ $isActive ? 'bg-white/20 text-white' : 'bg-slate-100 text-slate-500 group-hover:bg-indigo-50 group-hover:text-indigo-600' }} transition-colors">
                            <i class="fa-solid fa-border-all text-sm"></i>
                        </div>
                        <span>Dashboard</span>
                    </div>
                    @if($isActive)
                        <span class="w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span>
                    @endif
                </a>
            </div>
        </div>

        <!-- MASTER DATA (DROPDOWN) -->
        <div x-data="{ open: {{ request()->routeIs('barang.*', 'kategori.*', 'role.*', 'lokasi.*', 'suplier.*', 'unit.*', 'admin.role.*') ? 'true' : 'false' }} }">
            <button @click="open = !open" 
                    type="button"
                    class="w-full flex items-center justify-between px-3 text-[10px] font-extrabold text-slate-400 uppercase tracking-widest mb-2 group cursor-pointer">
                <span>MASTER DATA</span>
                <i class="fa-solid fa-chevron-down text-[10px] text-slate-400 group-hover:text-slate-600 transition-transform duration-200" :class="open ? 'rotate-180' : ''"></i>
            </button>
            
            <div x-show="open" 
                 x-collapse
                 class="space-y-1 pl-1 border-l-2 border-slate-100 ml-3">
                
                <!-- Data Barang -->
                @php $isBarang = request()->routeIs('barang.*'); @endphp
                <a href="" 
                   class="flex items-center space-x-3 px-3 py-2 text-xs sm:text-sm font-semibold rounded-xl transition-all duration-150 {{ $isBarang ? 'bg-indigo-50 text-indigo-600 font-bold' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 hover:translate-x-0.5' }}">
                    <i class="fa-solid fa-box-archive w-4 text-center {{ $isBarang ? 'text-indigo-600' : 'text-slate-400' }}"></i>
                    <span>Data Barang</span>
                </a>

                <!-- Kategori Barang -->
                @php $isKategori = request()->routeIs('admin.kategori.*', 'kategori.*'); @endphp
                <a href="{{ route('admin.kategori.index') }}" 
                   class="flex items-center space-x-3 px-3 py-2 text-xs sm:text-sm font-semibold rounded-xl transition-all duration-150 {{ $isKategori ? 'bg-indigo-50 text-indigo-600 font-bold' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 hover:translate-x-0.5' }}">
                    <i class="fa-solid fa-tags w-4 text-center {{ $isKategori ? 'text-indigo-600' : 'text-slate-400' }}"></i>
                    <span>Kategori</span>
                </a>

                <!-- Role -->
                @php $isRole = request()->routeIs('admin.role.*', 'role.*'); @endphp
                <a href="{{ route('admin.role.index') }}" 
                   class="flex items-center space-x-3 px-3 py-2 text-xs sm:text-sm font-semibold rounded-xl transition-all duration-150 {{ $isRole ? 'bg-indigo-50 text-indigo-600 font-bold' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 hover:translate-x-0.5' }}">
                    <i class="fa-solid fa-user-shield w-4 text-center {{ $isRole ? 'text-indigo-600' : 'text-slate-400' }}"></i>
                    <span>Role & Hak Akses</span>
                </a>

                <!-- Lokasi -->
                @php $isLokasi = request()->routeIs('lokasi.*'); @endphp
                <a href="" 
                   class="flex items-center space-x-3 px-3 py-2 text-xs sm:text-sm font-semibold rounded-xl transition-all duration-150 {{ $isLokasi ? 'bg-indigo-50 text-indigo-600 font-bold' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 hover:translate-x-0.5' }}">
                    <i class="fa-solid fa-location-dot w-4 text-center {{ $isLokasi ? 'text-indigo-600' : 'text-slate-400' }}"></i>
                    <span>Lokasi Ruang</span>
                </a>

                <!-- Suplier -->
                @php $isSuplier = request()->routeIs('suplier.*'); @endphp
                <a href="" 
                   class="flex items-center space-x-3 px-3 py-2 text-xs sm:text-sm font-semibold rounded-xl transition-all duration-150 {{ $isSuplier ? 'bg-indigo-50 text-indigo-600 font-bold' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 hover:translate-x-0.5' }}">
                    <i class="fa-solid fa-truck-field w-4 text-center {{ $isSuplier ? 'text-indigo-600' : 'text-slate-400' }}"></i>
                    <span>Supplier</span>
                </a>

                <!-- Unit -->
                @php $isUnit = request()->routeIs('unit.*'); @endphp
                <a href="" 
                   class="flex items-center space-x-3 px-3 py-2 text-xs sm:text-sm font-semibold rounded-xl transition-all duration-150 {{ $isUnit ? 'bg-indigo-50 text-indigo-600 font-bold' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 hover:translate-x-0.5' }}">
                    <i class="fa-solid fa-layer-group w-4 text-center {{ $isUnit ? 'text-indigo-600' : 'text-slate-400' }}"></i>
                    <span>Satuan Unit</span>
                </a>
            </div>
        </div>

        <!-- TRANSAKSI -->
        <div>
            <p class="px-3 text-[10px] font-extrabold text-slate-400 uppercase tracking-widest mb-2">TRANSAKSI</p>
            <div class="space-y-1">
                @php $isPeminjaman = request()->routeIs('peminjaman.*'); @endphp
                <a href="" 
                   class="group flex items-center justify-between px-3.5 py-2.5 text-xs sm:text-sm font-semibold rounded-2xl transition-all duration-200 {{ $isPeminjaman ? 'bg-gradient-to-r from-indigo-600 to-indigo-500 text-white shadow-lg shadow-indigo-500/25' : 'text-slate-600 hover:bg-slate-100/80 hover:text-slate-900 hover:translate-x-1' }}">
                    <div class="flex items-center space-x-3">
                        <div class="w-7 h-7 rounded-xl flex items-center justify-center {{ $isPeminjaman ? 'bg-white/20 text-white' : 'bg-slate-100 text-slate-500 group-hover:bg-indigo-50 group-hover:text-indigo-600' }} transition-colors">
                            <i class="fa-solid fa-right-left text-xs"></i>
                        </div>
                        <span>Peminjaman</span>
                    </div>
                </a>

                @php $isPengembalian = request()->routeIs('pengembalian.*'); @endphp
                <a href="" 
                   class="group flex items-center justify-between px-3.5 py-2.5 text-xs sm:text-sm font-semibold rounded-2xl transition-all duration-200 {{ $isPengembalian ? 'bg-gradient-to-r from-indigo-600 to-indigo-500 text-white shadow-lg shadow-indigo-500/25' : 'text-slate-600 hover:bg-slate-100/80 hover:text-slate-900 hover:translate-x-1' }}">
                    <div class="flex items-center space-x-3">
                        <div class="w-7 h-7 rounded-xl flex items-center justify-center {{ $isPengembalian ? 'bg-white/20 text-white' : 'bg-slate-100 text-slate-500 group-hover:bg-indigo-50 group-hover:text-indigo-600' }} transition-colors">
                            <i class="fa-solid fa-rotate-left text-xs"></i>
                        </div>
                        <span>Pengembalian</span>
                    </div>
                </a>

                @php $isPemeliharaan = request()->routeIs('pemeliharaan.*'); @endphp
                <a href="" 
                   class="group flex items-center justify-between px-3.5 py-2.5 text-xs sm:text-sm font-semibold rounded-2xl transition-all duration-200 {{ $isPemeliharaan ? 'bg-gradient-to-r from-indigo-600 to-indigo-500 text-white shadow-lg shadow-indigo-500/25' : 'text-slate-600 hover:bg-slate-100/80 hover:text-slate-900 hover:translate-x-1' }}">
                    <div class="flex items-center space-x-3">
                        <div class="w-7 h-7 rounded-xl flex items-center justify-center {{ $isPemeliharaan ? 'bg-white/20 text-white' : 'bg-slate-100 text-slate-500 group-hover:bg-indigo-50 group-hover:text-indigo-600' }} transition-colors">
                            <i class="fa-solid fa-screwdriver-wrench text-xs"></i>
                        </div>
                        <span>Pemeliharaan</span>
                    </div>
                </a>
            </div>
        </div>

        <!-- LAPORAN & PENGGUNA -->
        <div>
            <p class="px-3 text-[10px] font-extrabold text-slate-400 uppercase tracking-widest mb-2">LAPORAN & AKUN</p>
            <div class="space-y-1">
                @php $isLaporan = request()->routeIs('laporan.*'); @endphp
                <a href="" 
                   class="group flex items-center justify-between px-3.5 py-2.5 text-xs sm:text-sm font-semibold rounded-2xl transition-all duration-200 {{ $isLaporan ? 'bg-gradient-to-r from-indigo-600 to-indigo-500 text-white shadow-lg shadow-indigo-500/25' : 'text-slate-600 hover:bg-slate-100/80 hover:text-slate-900 hover:translate-x-1' }}">
                    <div class="flex items-center space-x-3">
                        <div class="w-7 h-7 rounded-xl flex items-center justify-center {{ $isLaporan ? 'bg-white/20 text-white' : 'bg-slate-100 text-slate-500 group-hover:bg-indigo-50 group-hover:text-indigo-600' }} transition-colors">
                            <i class="fa-solid fa-file-lines text-xs"></i>
                        </div>
                        <span>Laporan Rekap</span>
                    </div>
                </a>

                @php $isUsers = request()->routeIs('users.*'); @endphp
                <a href="" 
                   class="group flex items-center justify-between px-3.5 py-2.5 text-xs sm:text-sm font-semibold rounded-2xl transition-all duration-200 {{ $isUsers ? 'bg-gradient-to-r from-indigo-600 to-indigo-500 text-white shadow-lg shadow-indigo-500/25' : 'text-slate-600 hover:bg-slate-100/80 hover:text-slate-900 hover:translate-x-1' }}">
                    <div class="flex items-center space-x-3">
                        <div class="w-7 h-7 rounded-xl flex items-center justify-center {{ $isUsers ? 'bg-white/20 text-white' : 'bg-slate-100 text-slate-500 group-hover:bg-indigo-50 group-hover:text-indigo-600' }} transition-colors">
                            <i class="fa-solid fa-users text-xs"></i>
                        </div>
                        <span>Kelola Pengguna</span>
                    </div>
                </a>
            </div>
        </div>
    </nav>

  <!-- Bottom Widget: Buka File Panduan PDF di Tab Baru -->
<div class="p-3.5 border-t border-slate-100 shrink-0">
    <a href="{{ asset('docs/panduan-inventaris.docx') }}" 
       target="_blank"
       rel="noopener noreferrer"
       class="w-full py-2.5 px-3.5 bg-indigo-50 hover:bg-indigo-100/80 active:bg-indigo-200/60 text-indigo-600 font-bold text-xs rounded-xl transition flex items-center justify-between group border border-indigo-100/80 cursor-pointer">
        <div class="flex items-center gap-2.5">
            <div class="w-6 h-6 rounded-lg bg-indigo-600 text-white flex items-center justify-center text-[11px] shadow-xs group-hover:scale-105 transition">
                <i class="fa-solid fa-book-open"></i>
            </div>
            <span>Panduan Penggunaan</span>
        </div>
        <i class="fa-solid fa-arrow-up-right-from-square text-[10px] text-indigo-400 group-hover:text-indigo-600 transition"></i>
    </a>
</div>
</aside>