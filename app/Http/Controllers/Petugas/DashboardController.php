<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Data ringkasan (statistiks) untuk petugas
        $stats = [
            'total_barang'   => 120, // Contoh data dummy, ganti dengan Model::count()
            'total_pinjam'   => 15,
            'perlu_proses'   => 5,
            'selesai'        => 100,
        ];

        return view('petugas.dashboard', compact('stats'));
    }
}