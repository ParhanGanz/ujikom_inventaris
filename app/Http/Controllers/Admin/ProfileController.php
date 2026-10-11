<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        /** @var User $user */
        $user = Auth::user();
        
        // Eager load relasi role untuk tampilan view
        $user->load('role');

        // PENTING: Arahkan ke 'profile.edit' karena file ada di resources/views/profile/edit.blade.php
        return view('profile.edit', compact('user'));
    }

    /**
     * Memperbarui informasi profil pengguna.
     */
    public function update(Request $request): RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();

        // 1. Validasi Input
        $validated = $request->validate([
            'username'     => 'required|string|max:50|alpha_dash|unique:users,username,' . $user->id,
            'nama_lengkap' => 'required|string|max:255',
            'email'        => 'required|email|max:255|unique:users,email,' . $user->id,
            'no_whatsapp'  => 'nullable|string|max:20',
            'foto'         => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // 2. Upload Foto Profil
        if ($request->hasFile('foto')) {
            if ($user->foto && Storage::disk('public')->exists($user->foto)) {
                Storage::disk('public')->delete($user->foto);
            }
            $validated['foto'] = $request->file('foto')->store('profile-photos', 'public');
        }

        // 3. Isi data ke instance model
        $user->fill($validated);

        // 4. Reset verifikasi jika email berubah
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // 5. Simpan perubahan
        $user->save();

        return redirect()->back()->with('status', 'profile-updated')->with('success', 'Profil berhasil diperbarui!');
    }

    /**
     * Menghapus foto profil saja.
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