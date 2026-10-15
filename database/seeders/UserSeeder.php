<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Admin
        User::updateOrCreate(
            ['username' => 'admin'],
            [
                'nama_lengkap' => 'Administrator Utama',
                'email'        => 'admin@smaknis.sch.id',
                'no_whatsapp'  => '081234567890',
                'password'     => Hash::make('password123'),
                'role_id'      => 1, // Admin
                'status'       => 'aktif',
            ]
        );

        // 2. Akun Petugas Sarpras
        User::updateOrCreate(
            ['username' => 'petugas'],
            [
                'nama_lengkap' => 'Petugas Sarpras',
                'email'        => 'petugas@smaknis.sch.id',
                'no_whatsapp'  => '081234567891',
                'password'     => Hash::make('password123'),
                'role_id'      => 2, // Petugas
                'status'       => 'aktif',
            ]
        );
    }
}