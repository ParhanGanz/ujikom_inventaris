<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RoleController extends Controller
{
    /**
     * Tampilkan daftar role.
     */
    public function index(): View
    {
        $roles = Role::latest()->paginate(10);
        return view('admin.role.index', compact('roles'));
    }

    /**
     * Tampilkan form tambah role.
     */
    public function create(): View
    {
        return view('admin.role.create');
    }

    /**
     * Simpan role baru ke database.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama'       => 'required|string|max:50|unique:roles,nama',
            'keterangan' => 'nullable|string',
        ]);

        Role::create($validated);

        return redirect()->route('admin.role.index')->with('success', 'Role berhasil ditambahkan!');
    }

    /**
     * Tampilkan detail role spesifik.
     */
    public function show(Role $role): View
    {
        return view('admin.role.show', compact('role'));
    }

    /**
     * Tampilkan form edit role.
     */
    public function edit(Role $role): View
    {
        return view('admin.role.edit', compact('role'));
    }

    /**
     * Perbarui data role di database.
     */
    public function update(Request $request, Role $role): RedirectResponse
    {
        $validated = $request->validate([
            'nama'       => 'required|string|max:50|unique:roles,nama,' . $role->id,
            'keterangan' => 'nullable|string',
        ]);

        $role->update($validated);

        return redirect()->route('admin.role.index')->with('success', 'Role berhasil diperbarui!');
    }

    /**
     * Hapus role dari database.
     */
    public function destroy(Role $role): RedirectResponse
    {
        $role->delete();

        return redirect()->route('admin.role.index')->with('success', 'Role berhasil dihapus!');
    }
}