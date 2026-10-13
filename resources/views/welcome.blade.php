<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Inventaris SMAKNIS</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- CDN Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- CDN Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
</head>

<body class="font-sans antialiased bg-slate-50 text-slate-800 dark:bg-slate-900 dark:text-slate-100 flex flex-col min-h-screen">

    <!-- Header & Navigation -->
    <header class="sticky top-0 z-50 bg-white/80 dark:bg-slate-900/80 backdrop-blur-md border-b border-slate-200 dark:border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <!-- Brand Logo -->
            <a href="{{ url('/') }}" class="flex items-center gap-3 group">
                <div class="w-11 h-11 bg-indigo-600 rounded-xl flex items-center justify-center text-white shadow-md shadow-indigo-500/20 group-hover:scale-105 transition-transform">
                    <i class="fa-solid fa-boxes-stacked text-xl"></i>
                </div>
                <div>
                    <span class="font-extrabold text-lg text-slate-900 dark:text-white tracking-tight block">INVENTARIS</span>
                    <span class="text-xs font-semibold text-indigo-600 dark:text-indigo-400 tracking-wider uppercase block">SMAKNIS</span>
                </div>
            </a>

            <!-- Action Buttons -->
            <div class="flex items-center gap-3">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/admin/dashboard') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-sm shadow-md shadow-indigo-500/20 transition-all">
                            <i class="fa-solid fa-gauge-high"></i> Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-800 font-semibold text-sm transition">
                            <i class="fa-solid fa-right-to-bracket text-indigo-600 dark:text-indigo-400"></i> Masuk
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-sm shadow-md shadow-indigo-500/20 transition-all">
                                <i class="fa-solid fa-user-plus"></i> Daftar
                            </a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow">
        <!-- Hero Section -->
        <section class="relative overflow-hidden py-16 lg:py-24 bg-gradient-to-b from-indigo-50/50 via-slate-50 to-slate-50 dark:from-indigo-950/20 dark:via-slate-900 dark:to-slate-900">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-8 items-center">
                    
                    <!-- Left Column Text -->
                    <div class="text-center lg:text-left space-y-6">
                        <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-bold bg-indigo-100 dark:bg-indigo-900/50 text-indigo-700 dark:text-indigo-300 border border-indigo-200 dark:border-indigo-800">
                            <i class="fa-solid fa-school"></i> Portal Sarana & Prasarana Sekolah
                        </span>

                        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-slate-900 dark:text-white tracking-tight leading-tight">
                            Manajemen Aset & Barang <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-blue-500">SMAKNIS</span>
                        </h1>

                        <p class="text-lg text-slate-600 dark:text-slate-300 max-w-2xl leading-relaxed">
                            Sistem terintegrasi untuk pendataan, peminjaman, serta pemantauan kondisi sarana dan prasarana di lingkungan SMAKNIS secara efisien, transparan, dan akurat.
                        </p>

                        <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-7 py-3.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-base shadow-lg shadow-indigo-500/25 transition">
                                    <i class="fa-solid fa-arrow-right"></i> Buka Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-7 py-3.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-base shadow-lg shadow-indigo-500/25 transition">
                                    <i class="fa-solid fa-right-to-bracket"></i> Masuk ke Sistem
                                </a>
                            @endauth
                        </div>
                    </div>

                    <!-- Right Column Visual Card -->
                    <div class="relative flex justify-center">
                        <div class="w-full max-w-md bg-white dark:bg-slate-800 p-6 rounded-2xl shadow-xl border border-slate-100 dark:border-slate-700/80 space-y-4">
                            <div class="flex items-center justify-between pb-4 border-b border-slate-100 dark:border-slate-700">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-lg bg-indigo-100 dark:bg-indigo-900/40 text-indigo-600 dark:text-indigo-400 flex items-center justify-center text-lg font-bold">
                                        <i class="fa-solid fa-chart-pie"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-slate-800 dark:text-white text-sm">Ringkasan Aset</h3>
                                        <p class="text-xs text-slate-500 dark:text-slate-400">Update Realtime</p>
                                    </div>
                                </div>
                                <span class="text-xs font-semibold text-emerald-600 bg-emerald-50 dark:bg-emerald-900/30 px-2.5 py-1 rounded-full">
                                    <i class="fa-solid fa-circle text-[8px] mr-1"></i> Sistem Aktif
                                </span>
                            </div>

                            <!-- Feature Items Mini -->
                            <div class="space-y-3">
                                <div class="p-3 bg-slate-50 dark:bg-slate-900/50 rounded-xl flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <i class="fa-solid fa-laptop text-indigo-500 text-lg"></i>
                                        <span class="text-xs font-medium text-slate-700 dark:text-slate-300">Peralatan Lab & IT</span>
                                    </div>
                                    <span class="text-xs font-bold text-slate-800 dark:text-white">Terdata</span>
                                </div>

                                <div class="p-3 bg-slate-50 dark:bg-slate-900/50 rounded-xl flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <i class="fa-solid fa-hand-holding-hand text-amber-500 text-lg"></i>
                                        <span class="text-xs font-medium text-slate-700 dark:text-slate-300">Alur Peminjaman</span>
                                    </div>
                                    <span class="text-xs font-bold text-slate-800 dark:text-white">Otomatis</span>
                                </div>

                                <div class="p-3 bg-slate-50 dark:bg-slate-900/50 rounded-xl flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <i class="fa-solid fa-user-shield text-blue-500 text-lg"></i>
                                        <span class="text-xs font-medium text-slate-700 dark:text-slate-300">Akses Berbasis Role</span>
                                    </div>
                                    <span class="text-xs font-bold text-slate-800 dark:text-white">Aman</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- Features Grid Section -->
        <section class="py-16 bg-white dark:bg-slate-900/50 border-t border-slate-200/60 dark:border-slate-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-2xl mx-auto mb-12">
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white">Fitur Layanan Inventaris</h2>
                    <p class="text-sm text-slate-500 dark:text-slate-400 mt-2">Dirancang khusus untuk memenuhi kebutuhan pengelolaan barang dan aset sekolah secara terstruktur.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Feature 1 -->
                    <div class="p-6 bg-slate-50 dark:bg-slate-800/60 rounded-2xl border border-slate-100 dark:border-slate-700 space-y-3">
                        <div class="w-12 h-12 bg-indigo-100 dark:bg-indigo-900/40 text-indigo-600 dark:text-indigo-400 rounded-xl flex items-center justify-center text-xl">
                            <i class="fa-solid fa-box-archive"></i>
                        </div>
                        <h3 class="text-lg font-bold text-slate-800 dark:text-white">Pendataan Barang</h3>
                        <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed">
                            Mencatat seluruh detail barang mulai dari kode inventaris, kondisi, jumlah, hingga lokasi ketersediaan di sekolah.
                        </p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="p-6 bg-slate-50 dark:bg-slate-800/60 rounded-2xl border border-slate-100 dark:border-slate-700 space-y-3">
                        <div class="w-12 h-12 bg-amber-100 dark:bg-amber-900/40 text-amber-600 dark:text-amber-400 rounded-xl flex items-center justify-center text-xl">
                            <i class="fa-solid fa-file-signature"></i>
                        </div>
                        <h3 class="text-lg font-bold text-slate-800 dark:text-white">Manajemen Peminjaman</h3>
                        <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed">
                            Proses permohonan peminjaman alat serta konfirmasi pengembalian barang secara tertib dan tercatat log-nya.
                        </p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="p-6 bg-slate-50 dark:bg-slate-800/60 rounded-2xl border border-slate-100 dark:border-slate-700 space-y-3">
                        <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/40 text-blue-600 dark:text-blue-400 rounded-xl flex items-center justify-center text-xl">
                            <i class="fa-solid fa-users-gear"></i>
                        </div>
                        <h3 class="text-lg font-bold text-slate-800 dark:text-white">Hak Akses Pengguna</h3>
                        <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed">
                            Pembagian peran sistem yang jelas untuk Admin, Petugas, Kepala Sekolah, serta Wakil Sarpras.
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-white dark:bg-slate-900 border-t border-slate-200 dark:border-slate-800 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center sm:text-left flex flex-col sm:flex-row items-center justify-between gap-4">
            <p class="text-xs text-slate-500 dark:text-slate-400">
                &copy; {{ date('Y') }} <span class="font-semibold text-slate-700 dark:text-slate-300">Inventaris SMAKNIS</span>. Seluruh Hak Cipta Dilindungi.
            </p>
            <div class="flex items-center gap-4 text-xs text-slate-500 dark:text-slate-400">
                <span>Tim Sarpras SMAKNIS</span>
            </div>
        </div>
    </footer>

</body>

</html>