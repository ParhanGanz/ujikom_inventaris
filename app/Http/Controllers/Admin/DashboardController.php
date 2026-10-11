<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Tampilkan halaman utama dashboard admin.
     */
    public function index(): View
    {
        // Contoh penyiapan data statistik untuk dashboard (opsional)
        $stats = [
            'total_barang' => 0, // Nanti diisi: Barang::count()
            'peminjaman'   => 0, // Nanti diisi: Peminjaman::where('status', 'dipinjam')->count()
        ];

        return view('admin.dashboard', compact('stats'));
    }
}