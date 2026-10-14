<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lokasi;
use Illuminate\Http\Request;

class LokasiController extends Controller
{
    public function index()
    {
        $lokasi = Lokasi::all();
        return view('admin.lokasi.index', compact('lokasi'));
    }

    public function create()
    {
        return view('admin.lokasi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|unique:lokasi,kode',
            'ruangan' => 'required',
            'penanggung_jawab' => 'required',
        ]);

        Lokasi::create($request->all());

        return redirect()->route('admin.lokasi.index')->with('success', 'Data lokasi berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $lokasi = Lokasi::findOrFail($id);
        return view('admin.lokasi.edit', compact('lokasi'));
    }

    public function update(Request $request, string $id)
    {
        $lokasi = Lokasi::findOrFail($id);

        $request->validate([
            'kode' => 'required|unique:lokasi,kode,' . $id,
            'ruangan' => 'required',
            'penanggung_jawab' => 'required',
        ]);

        $lokasi->update($request->all());

        return redirect()->route('admin.lokasi.index')->with('success', 'Data lokasi berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $lokasi = Lokasi::findOrFail($id);
        $lokasi->delete();

        return redirect()->route('admin.lokasi.index')->with('success', 'Data lokasi berhasil dihapus.');
    }
}