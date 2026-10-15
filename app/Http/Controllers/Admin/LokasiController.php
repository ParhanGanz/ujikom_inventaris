<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lokasi;
use Illuminate\Http\Request;

class LokasiController extends Controller
{
    /**
     * Tampilkan daftar lokasi.
     */
    public function index()
    {
        $lokasi = Lokasi::latest()->get();
        return view('admin.lokasi.index', compact('lokasi'));
    }

    /**
     * Tampilkan formulir tambah lokasi baru dengan kode otomatis.
     */
    public function create()
    {
        // Mengambil data lokasi terakhir untuk menentukan nomor urut selanjutnya
        $lastLokasi = Lokasi::latest('id')->first();
        $nextNumber = $lastLokasi ? $lastLokasi->id + 1 : 1;
        
        // Format kode otomatis: LOK-001, LOK-002, dst.
        $kodeOtomatis = 'LOK-' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        return view('admin.lokasi.create', compact('kodeOtomatis'));
    }

    /**
     * Simpan lokasi baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode'             => 'required|string|max:50|unique:lokasi,kode',
            'ruangan'          => 'required|string|max:255',
            'penanggung_jawab' => 'required|string|max:255',
            'keterangan'       => 'nullable|string',
        ], [
            'kode.required'             => 'Kode ruangan wajib diisi.',
            'kode.unique'               => 'Kode ruangan sudah digunakan.',
            'ruangan.required'          => 'Nama ruangan wajib diisi.',
            'penanggung_jawab.required' => 'Penanggung jawab wajib diisi.',
        ]);

        Lokasi::create([
            'kode'             => $request->kode,
            'ruangan'          => $request->ruangan,
            'penanggung_jawab' => $request->penanggung_jawab,
            'keterangan'       => $request->keterangan,
        ]);

        return redirect()->route('admin.lokasi.index')
            ->with('success', 'Data lokasi berhasil ditambahkan!');
    }

    /**
     * Update data lokasi dari modal edit di halaman index.
     */
    public function update(Request $request, $id)
    {
        $lokasi = Lokasi::findOrFail($id);

        $request->validate([
            'kode'             => 'required|string|max:50|unique:lokasi,kode,' . $id,
            'ruangan'          => 'required|string|max:255',
            'penanggung_jawab' => 'required|string|max:255',
            'keterangan'       => 'nullable|string',
        ], [
            'kode.required'             => 'Kode ruangan wajib diisi.',
            'kode.unique'               => 'Kode ruangan sudah digunakan oleh lokasi lain.',
            'ruangan.required'          => 'Nama ruangan wajib diisi.',
            'penanggung_jawab.required' => 'Penanggung jawab wajib diisi.',
        ]);

        $lokasi->update([
            'kode'             => $request->kode,
            'ruangan'          => $request->ruangan,
            'penanggung_jawab' => $request->penanggung_jawab,
            'keterangan'       => $request->keterangan,
        ]);

        return redirect()->route('admin.lokasi.index')
            ->with('success', 'Data lokasi berhasil diperbarui!');
    }

    /**
     * Hapus data lokasi dari modal delete di halaman index.
     */
    public function destroy($id)
    {
        $lokasi = Lokasi::findOrFail($id);
        $lokasi->delete();

        return redirect()->route('admin.lokasi.index')
            ->with('success', 'Data lokasi berhasil dihapus!');
    }
}