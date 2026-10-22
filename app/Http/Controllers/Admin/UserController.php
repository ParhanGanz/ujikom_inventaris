<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Tampilkan daftar seluruh pengguna.
     */
    public function index(Request $request): View
    {
        $query = User::query()
            ->orderByRaw("
                CASE role
                    WHEN 'admin' THEN 1
                    WHEN 'petugas' THEN 2
                    ELSE 3
                END
            ")
            ->latest('created_at');

        // Pencarian nama, username, atau email.
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                    ->orWhere('username', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Filter berdasarkan role enum.
        if ($request->filled('role')) {
            $query->where(
                'role',
                $request->role
            );
        }

        // Filter berdasarkan status.
        if ($request->filled('status')) {
            $query->where(
                'status',
                $request->status
            );
        }

        // Pagination 10 pengguna per halaman.
        $users = $query
            ->paginate(10)
            ->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Tampilkan form tambah pengguna baru.
     */
    public function create(): View
    {
        return view('admin.users.create');
    }

    /**
     * Simpan pengguna baru ke database.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama_lengkap' => [
                'required',
                'string',
                'max:255',
            ],
            'username' => [
                'required',
                'string',
                'max:255',
                'alpha_dash',
                'unique:users,username',
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users,email',
            ],
            'no_whatsapp' => [
                'nullable',
                'string',
                'max:20',
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],
            'role' => [
                'required',
                Rule::in(['admin', 'petugas']),
            ],
            'status' => [
                'required',
                Rule::in(['aktif', 'nonaktif']),
            ],
            'foto' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,webp',
                'max:2048',
            ],
        ]);

        // Upload foto jika ada.
        if ($request->hasFile('foto')) {
            $validated['foto'] = $request
                ->file('foto')
                ->store('foto-pengguna', 'public');
        }

        // Hash password sebelum disimpan.
        $validated['password'] = Hash::make(
            $validated['password']
        );

        User::create($validated);

        return redirect()
            ->route('admin.users.index')
            ->with(
                'success',
                'Pengguna baru berhasil ditambahkan!'
            );
    }

    /**
     * Tampilkan form edit pengguna.
     */
    public function edit(User $user): View
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Perbarui data pengguna di database.
     */
    public function update(
        Request $request,
        User $user
    ): RedirectResponse {
        // Akun sendiri harus tetap menggunakan role dan status
        // yang sudah tersimpan karena kedua field pada form edit
        // dapat dinonaktifkan.
        if (Auth::id() === $user->id) {
            $request->merge([
                'role' => $user->role,
                'status' => $user->status,
            ]);
        }

        $validated = $request->validate([
            'nama_lengkap' => [
                'required',
                'string',
                'max:255',
            ],
            'username' => [
                'required',
                'string',
                'max:255',
                'alpha_dash',
                Rule::unique('users', 'username')
                    ->ignore($user->id),
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email')
                    ->ignore($user->id),
            ],
            'no_whatsapp' => [
                'nullable',
                'string',
                'max:20',
            ],
            'password' => [
                'nullable',
                'string',
                'min:8',
                'confirmed',
            ],
            'role' => [
                'required',
                Rule::in(['admin', 'petugas']),
            ],
            'status' => [
                'required',
                Rule::in(['aktif', 'nonaktif']),
            ],
            'foto' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,webp',
                'max:2048',
            ],
        ]);

        // Cegah perubahan role atau penonaktifan akun sendiri.
        if (Auth::id() === $user->id) {
            if (
                $validated['role'] !== $user->role ||
                $validated['status'] !== 'aktif'
            ) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'role' => 'Role akun sendiri tidak dapat diubah dan akun harus tetap aktif.',
                    ]);
            }
        }

        // Upload foto baru jika ada.
        if ($request->hasFile('foto')) {
            $fotoLama = $user->foto;

            $fotoBaru = $request
                ->file('foto')
                ->store('foto-pengguna', 'public');

            $validated['foto'] = $fotoBaru;

            // Hapus foto lama setelah upload foto baru berhasil.
            if ($fotoLama) {
                Storage::disk('public')->delete($fotoLama);
            }
        }

        // Ubah password hanya jika kolom diisi.
        if ($request->filled('password')) {
            $validated['password'] = Hash::make(
                $validated['password']
            );
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()
            ->route('admin.users.index')
            ->with(
                'success',
                'Data pengguna berhasil diperbarui!'
            );
    }

    /**
     * Hapus pengguna dari database.
     */
    public function destroy(User $user): RedirectResponse
    {
        // Mencegah penghapusan akun sendiri.
        if (Auth::id() === $user->id) {
            return redirect()
                ->route('admin.users.index')
                ->with(
                    'error',
                    'Anda tidak dapat menghapus akun Anda sendiri!'
                );
        }

        $foto = $user->foto;

        $user->delete();

        // Hapus foto profil setelah pengguna berhasil dihapus.
        if ($foto) {
            Storage::disk('public')->delete($foto);
        }

        return redirect()
            ->route('admin.users.index')
            ->with(
                'success',
                'Pengguna berhasil dihapus!'
            );
    }
}
