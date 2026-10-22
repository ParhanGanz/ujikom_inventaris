<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PenanggungJawab;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PenanggungJawabController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $penanggungJawabs = PenanggungJawab::query()
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

    public function create()
    {
        return view('admin.penanggung_jawab.create');
    }

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
            'no_telepon' => ['nullable', 'string', 'max:20'],
            'email' => ['nullable', 'email', 'max:255'],
            'status' => ['required', Rule::in(['aktif', 'tidak'])],
        ]);

        // NIP/NUPTK kosong disimpan sebagai NULL.
        $validated['nip_nutpk'] = $validated['nip_nutpk'] ?: null;

        PenanggungJawab::create($validated);

        return redirect()
            ->route('admin.penanggung_jawab.index')
            ->with('success', 'Penanggung jawab berhasil ditambahkan.');
    }

    public function show(PenanggungJawab $penanggung_jawab)
    {
        return view(
            'admin.penanggung_jawab.show',
            compact('penanggung_jawab')
        );
    }

    public function edit(PenanggungJawab $penanggung_jawab)
    {
        return view(
            'admin.penanggung_jawab.edit',
            compact('penanggung_jawab')
        );
    }

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
            'no_telepon' => ['nullable', 'string', 'max:20'],
            'email' => ['nullable', 'email', 'max:255'],
            'status' => ['required', Rule::in(['aktif', 'tidak'])],
        ]);

        $validated['nip_nutpk'] = $validated['nip_nutpk'] ?: null;

        $penanggung_jawab->update($validated);

        return redirect()
            ->route('admin.penanggung_jawab.index')
            ->with('success', 'Data penanggung jawab berhasil diperbarui.');
    }

    public function destroy(PenanggungJawab $penanggung_jawab)
    {
        $penanggung_jawab->delete();

        return redirect()
            ->route('admin.penanggung_jawab.index')
            ->with('success', 'Data penanggung jawab berhasil dihapus.');
    }
}