<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Tampilkan daftar seluruh pengguna.
     */
    public function index(Request $request): View
    {
        $query = User::with('role')
            ->leftJoin('roles', 'users.role_id', '=', 'roles.id')
            ->select('users.*')
            ->orderByRaw("
            CASE LOWER(roles.nama)
                WHEN 'admin' THEN 1
                WHEN 'petugas' THEN 2
                ELSE 3
            END
        ")
            ->latest('users.created_at');

        // Pencarian nama, username, atau email
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('users.nama_lengkap', 'like', "%{$search}%")
                    ->orWhere('users.username', 'like', "%{$search}%")
                    ->orWhere('users.email', 'like', "%{$search}%");
            });
        }

        // Filter berdasarkan role
        if ($request->filled('role_id')) {
            $query->where('users.role_id', $request->role_id);
        }

        // Pagination tetap 10 pengguna per halaman
        $users = $query->paginate(10)->withQueryString();

        $roles = Role::all();

        return view('admin.users.index', compact('users', 'roles'));
    }

    /**
     * Tampilkan form tambah pengguna baru.
     */
    public function create(): View
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Simpan pengguna baru ke database.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'username'     => 'required|string|max:50|alpha_dash|unique:users,username',
            'email'        => 'required|email|max:255|unique:users,email',
            'no_whatsapp'  => 'nullable|string|max:20',
            'password'     => 'required|string|min:8',
            'role_id'      => 'required|exists:roles,id',
            'status'       => 'required|in:aktif,nonaktif',
            'foto'         => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Upload foto jika ada
        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('profile-photos', 'public');
        }

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('admin.users.index')->with('success', 'Pengguna baru berhasil ditambahkan!');
    }

    /**
     * Tampilkan detail pengguna.
     */
    public function show() {}

    /** 
     * Tampilkan form edit pengguna.
     */
    public function edit(User $user): View
    {
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Perbarui data pengguna di database.
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'username'     => 'required|string|max:50|alpha_dash|unique:users,username,' . $user->id,
            'email'        => 'required|email|max:255|unique:users,email,' . $user->id,
            'no_whatsapp'  => 'nullable|string|max:20',
            'password'     => 'nullable|string|min:8',
            'role_id'      => 'required|exists:roles,id',
            'status'       => 'required|in:aktif,nonaktif',
            'foto'         => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Penanganan upload foto baru
        if ($request->hasFile('foto')) {
            if ($user->foto && Storage::disk('public')->exists($user->foto)) {
                Storage::disk('public')->delete($user->foto);
            }
            $validated['foto'] = $request->file('foto')->store('profile-photos', 'public');
        }

        // Update password hanya jika diisi
        if ($request->filled('password')) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('admin.users.index')->with('success', 'Data pengguna berhasil diperbarui!');
    }

    /**
     * Hapus pengguna dari database.
     */
    public function destroy(User $user): RedirectResponse
    {
        // Mencegah hapus akun sendiri
        if (auth()->id() === $user->id) {
            return redirect()->back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri!');
        }

        if ($user->foto && Storage::disk('public')->exists($user->foto)) {
            Storage::disk('public')->delete($user->foto);
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil dihapus!');
    }
}