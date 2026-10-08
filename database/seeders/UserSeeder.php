<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Akun Admin / User Utama
        User::create([
            'username'          => 'admin',
            'nama_lengkap'      => 'Administrator Utama',
            'email'             => 'admin@gmail.com',
            'no_whatsapp'       => '081234567890',
            'foto'              => null, // Bisa diisi path misal: 'profile-photos/default.png'
            'email_verified_at' => now(),
            'password'          => Hash::make('123'),
        ]);

        // 2. Akun User Regular 1
        User::create([
            'username'          => 'Parhan',
            'nama_lengkap'      => 'Parhanzz',
            'email'             => 'hanz@gmail.com',
            'no_whatsapp'       => '082198765432',
            'foto'              => null,
            'email_verified_at' => now(),
            'password'          => Hash::make('123'),
        ]);
    }
}