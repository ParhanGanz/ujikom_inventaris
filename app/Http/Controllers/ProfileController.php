<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Menampilkan form edit profil.
     */
    public function edit(): View
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    /**
     * Memperbarui informasi profil pengguna.
     */
    public function update(Request $request): RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();

        // Validasi Input
        $validated = $request->validate([
            'username'     => 'required|string|max:50|alpha_dash|unique:users,username,' . $user->id,
            'nama_lengkap' => 'required|string|max:255',
            'email'        => 'required|email|max:255|unique:users,email,' . $user->id,
            'no_whatsapp'  => 'nullable|string|max:20',
            'foto'         => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // Maksimal 2MB
        ]);

        // Penanganan Upload Foto Profil
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($user->foto && Storage::disk('public')->exists($user->foto)) {
                Storage::disk('public')->delete($user->foto);
            }

            // Simpan foto baru ke folder 'storage/app/public/profile-photos'
            $path = $request->file('foto')->store('profile-photos', 'public');
            $validated['foto'] = $path;
        }

        // Jika email diubah, atur ulang verifikasi email (Opsional)
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // Update data user
        $user->update($validated);

        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }

    /**
     * Menghapus foto profil saja (Opsional).
     */
    public function deletePhoto(): RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();

        if ($user->foto && Storage::disk('public')->exists($user->foto)) {
            Storage::disk('public')->delete($user->foto);
            $user->update(['foto' => null]);
        }

        return redirect()->back()->with('success', 'Foto profil berhasil dihapus.');
    }
}