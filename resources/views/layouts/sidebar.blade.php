@php
    // Menu utama
    $menuUtama = [
        [
            'nama' => 'Dashboard',
            'route' => 'admin.dashboard',
            'aktif' => 'admin.dashboard',
            'ikon' => 'fa-border-all',
        ],
    ];

    // Master Data
    $masterData = [
        ['nama' => 'Data Barang', 'route' => 'admin.barang.index', 'aktif' => 'admin.barang.*', 'ikon' => 'fa-box-archive'],
        ['nama' => 'Kategori', 'route' => 'admin.kategori.index', 'aktif' => 'admin.kategori.*', 'ikon' => 'fa-tags'],
        ['nama' => 'Role', 'route' => 'admin.role.index', 'aktif' => 'admin.role.*', 'ikon' => 'fa-user-shield'],
        ['nama' => 'Lokasi Ruang', 'route' => 'admin.lokasi.index', 'aktif' => 'admin.lokasi.*', 'ikon' => 'fa-location-dot'],
        ['nama' => 'Supplier', 'route' => 'admin.suplier.index', 'aktif' => 'admin.suplier.*', 'ikon' => 'fa-truck-field'],
        ['nama' => 'Satuan Unit', 'route' => 'admin.unit.index', 'aktif' => 'admin.unit.*', 'ikon' => 'fa-layer-group'],
        ['nama' => 'Penanggung Jawab', 'route' => 'admin.penanggung-jawab.index', 'aktif' => 'admin.penanggung-jawab.*', 'ikon' => 'fa-user-check'],
    ];

    // Transaksi
    $transaksi = [
        ['nama' => 'Barang Masuk', 'route' => 'admin.barang-masuk.index', 'aktif' => 'admin.barang-masuk.*', 'ikon' => 'fa-box-open'],
        ['nama' => 'Barang Keluar', 'route' => 'admin.barang-keluar.index', 'aktif' => 'admin.barang-keluar.*', 'ikon' => 'fa-dolly'],
        ['nama' => 'Peminjaman', 'route' => 'admin.peminjaman.index', 'aktif' => 'admin.peminjaman.*', 'ikon' => 'fa-right-left'],
        ['nama' => 'Pengembalian', 'route' => 'admin.pengembalian.index', 'aktif' => 'admin.pengembalian.*', 'ikon' => 'fa-rotate-left'],
        ['nama' => 'Pemeliharaan', 'route' => 'admin.pemeliharaan.index', 'aktif' => 'admin.pemeliharaan.*', 'ikon' => 'fa-screwdriver-wrench'],
    ];

    // Laporan dan akun
    $menuLain = [
        ['nama' => 'Laporan Rekap', 'route' => 'admin.laporan.index', 'aktif' => 'admin.laporan.*', 'ikon' => 'fa-file-lines'],
        ['nama' => 'Direktori Pengguna', 'route' => 'admin.users.index', 'aktif' => 'admin.users.*', 'ikon' => 'fa-users'],
    ];

    // Periksa apakah submenu master data sedang aktif
    $masterAktif = false;

    foreach ($masterData as $item) {
        if (request()->routeIs($item['aktif'])) {
            $masterAktif = true;
            break;
        }
    }
@endphp

<aside class="w-64 bg-white border-r border-slate-200 flex flex-col h-screen shrink-0 sticky top-0 z-20">

    {{-- HEADER --}}
    <div class="h-16 px-5 flex items-center border-b border-slate-100 shrink-0">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-indigo-600 to-violet-500 flex items-center justify-center text-white shadow-md">
                <i class="fa-solid fa-boxes-packing text-lg"></i>
            </div>

            <div>
                <div class="flex items-center gap-2">
                    <span class="font-extrabold text-slate-900">SMAKNIS</span>
                    <span class="text-[10px] px-1.5 py-0.5 rounded bg-indigo-50 text-indigo-600 font-bold">INV</span>
                </div>
                <p class="text-[10px] uppercase tracking-wider text-slate-400">
                    Sistem Inventaris
                </p>
            </div>
        </a>
    </div>

    {{-- MENU --}}
    <nav class="flex-1 overflow-y-auto px-3 py-5 space-y-5">

        {{-- DASHBOARD --}}
        <div>
            <p class="px-3 mb-2 text-[10px] font-bold tracking-widest text-slate-400">
                MENU UTAMA
            </p>

            @foreach ($menuUtama as $item)
                @php $aktif = request()->routeIs($item['aktif']); @endphp

                <a href="{{ route($item['route']) }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition
                   {{ $aktif ? 'bg-indigo-600 text-white shadow-md shadow-indigo-200' : 'text-slate-600 hover:bg-slate-100' }}">

                    <i class="fa-solid {{ $item['ikon'] }} w-5 text-center"></i>
                    <span>{{ $item['nama'] }}</span>

                    @if ($aktif)
                        <span class="ml-auto w-1.5 h-1.5 rounded-full bg-white"></span>
                    @endif
                </a>
            @endforeach
        </div>

        {{-- MASTER DATA --}}
        <div x-data="{ open: {{ $masterAktif ? 'true' : 'false' }} }">

            <button type="button"
                    @click="open = !open"
                    class="w-full flex items-center justify-between px-3 mb-2 text-[10px] font-bold tracking-widest text-slate-400">

                <span>MASTER DATA</span>

                <i class="fa-solid fa-chevron-down transition-transform"
                   :class="open ? 'rotate-180' : ''"></i>
            </button>

            <div x-show="open"
                 x-transition
                 class="ml-3 pl-2 border-l-2 border-slate-100 space-y-1">

                @foreach ($masterData as $item)
                    @php $aktif = request()->routeIs($item['aktif']); @endphp

                    <a href="{{ \Illuminate\Support\Facades\Route::has($item['route']) ? route($item['route']) : '#' }}"
                       class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm transition
                       {{ $aktif ? 'bg-indigo-50 text-indigo-600 font-bold' : 'text-slate-600 hover:bg-slate-50' }}">

                        <i class="fa-solid {{ $item['ikon'] }} w-4 text-center"></i>
                        <span>{{ $item['nama'] }}</span>
                    </a>
                @endforeach

            </div>
        </div>

        {{-- TRANSAKSI --}}
        <div>
            <p class="px-3 mb-2 text-[10px] font-bold tracking-widest text-slate-400">
                TRANSAKSI
            </p>

            <div class="space-y-1">
                @foreach ($transaksi as $item)
                    @php $aktif = request()->routeIs($item['aktif']); @endphp

                    <a href="{{ \Illuminate\Support\Facades\Route::has($item['route']) ? route($item['route']) : '#' }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition
                       {{ $aktif ? 'bg-indigo-600 text-white shadow-md shadow-indigo-200' : 'text-slate-600 hover:bg-slate-100' }}">

                        <i class="fa-solid {{ $item['ikon'] }} w-5 text-center"></i>
                        <span>{{ $item['nama'] }}</span>
                    </a>
                @endforeach
            </div>
        </div>

        {{-- LAPORAN & AKUN --}}
        <div>
            <p class="px-3 mb-2 text-[10px] font-bold tracking-widest text-slate-400">
                LAPORAN & AKUN
            </p>

            <div class="space-y-1">
                @foreach ($menuLain as $item)
                    @php $aktif = request()->routeIs($item['aktif']); @endphp

                    <a href="{{ \Illuminate\Support\Facades\Route::has($item['route']) ? route($item['route']) : '#' }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition
                       {{ $aktif ? 'bg-indigo-600 text-white shadow-md shadow-indigo-200' : 'text-slate-600 hover:bg-slate-100' }}">

                        <i class="fa-solid {{ $item['ikon'] }} w-5 text-center"></i>
                        <span>{{ $item['nama'] }}</span>
                    </a>
                @endforeach
            </div>
        </div>

    </nav>

    {{-- PANDUAN --}}
    <div class="p-3 border-t border-slate-100 shrink-0">
        <a href="{{ asset('docs/panduan-inventaris.docx') }}"
           target="_blank"
           rel="noopener noreferrer"
           class="flex items-center justify-between gap-2 p-3 rounded-xl bg-indigo-50 text-indigo-600 hover:bg-indigo-100 transition">

            <span class="flex items-center gap-2 text-xs font-bold">
                <i class="fa-solid fa-book-open"></i>
                Panduan Penggunaan
            </span>

            <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i>
        </a>
    </div>

</aside>