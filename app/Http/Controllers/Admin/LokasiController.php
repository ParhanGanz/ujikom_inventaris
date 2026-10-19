<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lokasi;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LokasiController extends Controller
{
    /**
     * Menampilkan semua lokasi.
     */
    public function index()
    {
        $lokasi = Lokasi::latest('id')->get();

        return view('admin.lokasi.index', compact('lokasi'));
    }

    /**
     * Menampilkan form tambah lokasi.
     */
    public function create()
    {
        $kodeBaru = $this->generateKode();

        return view('admin.lokasi.create', compact('kodeBaru'));
    }

    /**
     * Menyimpan lokasi baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'ruangan' => ['required', 'string', 'max:255'],
            'keterangan' => ['nullable', 'string'],
        ], [
            'ruangan.required' => 'Nama ruangan wajib diisi.',
            'ruangan.max' => 'Nama ruangan maksimal 255 karakter.',
        ]);

        Lokasi::create([
            'kode' => $this->generateKode(),
            'ruangan' => $request->ruangan,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()
            ->route('admin.lokasi.index')
            ->with('success', 'Lokasi berhasil ditambahkan.');
    }

    /**
     * Route detail tetap tersedia sebagai bagian resource.
     * Halaman detail terpisah belum digunakan.
     */
    public function show(Lokasi $lokasi)
    {
        return redirect()->route('admin.lokasi.index');
    }

    /**
     * Edit dilakukan melalui modal di halaman index.
     */
    public function edit(Lokasi $lokasi)
    {
        return redirect()->route('admin.lokasi.index');
    }

    /**
     * Memperbarui lokasi.
     */
    public function update(Request $request, Lokasi $lokasi)
    {
        $request->validate([
            'ruangan' => [
                'required',
                'string',
                'max:255',
                Rule::unique('lokasi', 'ruangan')->ignore($lokasi->id),
            ],
            'keterangan' => ['nullable', 'string'],
        ], [
            'ruangan.required' => 'Nama ruangan wajib diisi.',
            'ruangan.max' => 'Nama ruangan maksimal 255 karakter.',
            'ruangan.unique' => 'Nama ruangan tersebut sudah digunakan.',
        ]);

        $lokasi->update([
            'ruangan' => $request->ruangan,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()
            ->route('admin.lokasi.index')
            ->with('success', 'Lokasi berhasil diperbarui.');
    }

    /**
     * Menghapus lokasi.
     */
    public function destroy(Lokasi $lokasi)
    {
        $namaRuangan = $lokasi->ruangan;

        $lokasi->delete();

        return redirect()
            ->route('admin.lokasi.index')
            ->with('success', "Lokasi {$namaRuangan} berhasil dihapus.");
    }

    /**
     * Membuat kode lokasi otomatis.
     */
    private function generateKode(): string
    {
        $nomor = (int) Lokasi::max('id') + 1;

        do {
            $kode = 'LOK-' . str_pad(
                (string) $nomor,
                3,
                '0',
                STR_PAD_LEFT
            );

            $nomor++;
        } while (Lokasi::where('kode', $kode)->exists());

        return $kode;
    }
}