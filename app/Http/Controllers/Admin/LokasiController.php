<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lokasi;
use App\Models\PenanggungJawab;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LokasiController extends Controller
{
    /**
     * Menampilkan semua lokasi.
     */

    public function index()
    {
        $lokasi = Lokasi::with('penanggungJawab')
            ->oldest('id')
            ->get();

        $kodeBaru = $this->generateKode();

        $penanggungJawabs = PenanggungJawab::where('status', 'aktif')
            ->orderBy('nama_lengkap')
            ->get();

        return view(
            'admin.lokasi.index',
            compact('lokasi', 'kodeBaru', 'penanggungJawabs')
        );
    }


    /**
     * Menampilkan form tambah lokasi.
     */
    public function create()
    {
        $kodeBaru = $this->generateKode();

        $penanggungJawabs = PenanggungJawab::where('status', 'aktif')
            ->orderBy('nama_lengkap')
            ->get();

        return view(
            'admin.lokasi.create',
            compact('kodeBaru', 'penanggungJawabs')
        );
    }

    /**
     * Menyimpan lokasi baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode' => [
                'required',
                'string',
                'max:255',
                'unique:lokasi,kode',
            ],
            'ruangan' => [
                'required',
                'string',
                'max:255',
                'unique:lokasi,ruangan',
            ],
            'id_penanggung_jawab' => [
                'required',
                'integer',
                'exists:penanggung_jawab,id',
            ],
            'keterangan' => ['nullable', 'string'],
        ], [
            'kode.required' => 'Kode lokasi wajib diisi.',
            'kode.unique' => 'Kode lokasi tersebut sudah digunakan.',
            'ruangan.required' => 'Nama ruangan wajib diisi.',
            'ruangan.unique' => 'Nama ruangan tersebut sudah digunakan.',
            'id_penanggung_jawab.required' =>
            'Penanggung jawab wajib dipilih.',
            'id_penanggung_jawab.exists' =>
            'Penanggung jawab yang dipilih tidak ditemukan.',
        ]);

        Lokasi::create($validated);

        return redirect()
            ->route('admin.lokasi.index')
            ->with('success', 'Lokasi berhasil ditambahkan.');
    }

    /**
     * Halaman detail belum digunakan.
     */
    public function show(Lokasi $lokasi)
    {
        return redirect()->route('admin.lokasi.index');
    }

    /**
     * Edit lokasi dilakukan melalui modal di halaman index.
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
        $validated = $request->validate([
            'kode' => [
                'required',
                'string',
                'max:255',
                Rule::unique('lokasi', 'kode')->ignore($lokasi->id),
            ],
            'ruangan' => [
                'required',
                'string',
                'max:255',
                Rule::unique('lokasi', 'ruangan')->ignore($lokasi->id),
            ],
            'id_penanggung_jawab' => [
                'required',
                'integer',
                'exists:penanggung_jawab,id',
            ],
            'keterangan' => ['nullable', 'string'],
        ], [
            'kode.required' => 'Kode lokasi wajib diisi.',
            'kode.unique' => 'Kode lokasi tersebut sudah digunakan.',
            'ruangan.required' => 'Nama ruangan wajib diisi.',
            'ruangan.unique' => 'Nama ruangan tersebut sudah digunakan.',
            'id_penanggung_jawab.required' =>
            'Penanggung jawab wajib dipilih.',
            'id_penanggung_jawab.exists' =>
            'Penanggung jawab yang dipilih tidak ditemukan.',
        ]);

        $lokasi->update($validated);

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
