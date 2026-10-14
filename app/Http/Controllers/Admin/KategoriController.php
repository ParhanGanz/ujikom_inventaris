<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    // Menampilkan semua kategori
    public function index()
    {
        $kategori = Kategori::all();

        return view('admin.kategori.index', compact('kategori'));
    }

    // Menampilkan form tambah kategori
    public function create()
    {
        return view('admin.kategori.create');
    }

    // Menyimpan kategori baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        Kategori::create($request->only([
            'nama',
            'keterangan',
        ]));

        return redirect()
            ->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    // Menampilkan detail kategori
    public function show(Kategori $kategori)
    {
        return view('admin.kategori.show', compact('kategori'));
    }

    // Menampilkan form edit kategori
    public function edit(Kategori $kategori)
    {
        return view('admin.kategori.edit', compact('kategori'));
    }

    // Memperbarui kategori
    public function update(Request $request, Kategori $kategori)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $kategori->update($request->only([
            'nama',
            'keterangan',
        ]));

        return redirect()
            ->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    // Menghapus kategori
    public function destroy(Kategori $kategori)
    {
        $kategori->delete();

        return redirect()
            ->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}