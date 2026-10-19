<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lokasi;
use App\Models\PenanggungJawab;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PenanggungJawabController extends Controller
{
    /**
     * Menampilkan daftar penanggung jawab.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $penanggungJawabs = PenanggungJawab::with('lokasi')
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama_lengkap', 'like', "%{$search}%")
                        ->orWhere('nip_nutpk', 'like', "%{$search}%")
                        ->orWhere('jabatan', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view(
            'admin.penanggung_jawab.index',
            compact('penanggungJawabs', 'search')
        );
    }

    /**
     * Menampilkan form tambah.
     */
    public function create()
    {
        $lokasis = Lokasi::orderBy('ruangan')->get();

        return view('admin.penanggung_jawab.create', compact('lokasis'));
    }

    /**
     * Menyimpan penanggung jawab baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nip_nutpk' => [
                'nullable',
                'string',
                'max:50',
                'unique:penanggung_jawab,nip_nutpk',
            ],
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'jabatan' => ['required', 'string', 'max:100'],
            'id_lokasi' => [
                'required',
                'integer',
                'exists:lokasi,id',
                'unique:penanggung_jawab,id_lokasi',
            ],
            'no_telepon' => ['nullable', 'string', 'max:20'],
            'email' => ['nullable', 'email', 'max:255'],
            'status' => ['required', Rule::in(['aktif', 'tidak'])],
        ]);

        PenanggungJawab::create($validated);

        return redirect()
            ->route('admin.penanggung_jawab.index')
            ->with('success', 'Penanggung jawab berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail penanggung jawab.
     */
    public function show(PenanggungJawab $penanggung_jawab)
    {
        $penanggung_jawab->load('lokasi');

        return view(
            'admin.penanggung_jawab.show',
            compact('penanggung_jawab')
        );
    }

    /**
     * Menampilkan form edit.
     */
    public function edit(PenanggungJawab $penanggung_jawab)
    {
        $lokasis = Lokasi::orderBy('ruangan')->get();

        return view(
            'admin.penanggung_jawab.edit',
            compact('penanggung_jawab', 'lokasis')
        );
    }

    /**
     * Memperbarui data penanggung jawab.
     */
    public function update(
        Request $request,
        PenanggungJawab $penanggung_jawab
    ) {
        $validated = $request->validate([
            'nip_nutpk' => [
                'nullable',
                'string',
                'max:50',
                Rule::unique('penanggung_jawab', 'nip_nutpk')
                    ->ignore($penanggung_jawab->id),
            ],
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'jabatan' => ['required', 'string', 'max:100'],
            'id_lokasi' => [
                'required',
                'integer',
                'exists:lokasi,id',
                Rule::unique('penanggung_jawab', 'id_lokasi')
                    ->ignore($penanggung_jawab->id),
            ],
            'no_telepon' => ['nullable', 'string', 'max:20'],
            'email' => ['nullable', 'email', 'max:255'],
            'status' => ['required', Rule::in(['aktif', 'tidak'])],
        ]);

        $penanggung_jawab->update($validated);

        return redirect()
            ->route('admin.penanggung_jawab.index')
            ->with('success', 'Data penanggung jawab berhasil diperbarui.');
    }

    /**
     * Menghapus data penanggung jawab.
     */
    public function destroy(PenanggungJawab $penanggung_jawab)
    {
        $penanggung_jawab->delete();

        return redirect()
            ->route('admin.penanggung_jawab.index')
            ->with('success', 'Data penanggung jawab berhasil dihapus.');
    }
}