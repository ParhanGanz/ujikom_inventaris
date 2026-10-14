<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'nama_lengkap' => 'Administrator Sistem',
                'username'     => 'admin',
                'email'        => 'admin@school.id',
                'no_whatsapp'  => '081234567890',
                'password'     => Hash::make('123'),
                'role_id'      => 1, // Admin
                'status'       => 'aktif',
            ],
            [
                'nama_lengkap' => 'Petugas Sarpras',
                'username'     => 'petugas',
                'email'        => 'petugas@school.id',
                'no_whatsapp'  => '081234567891',
                'password'     => Hash::make('123'),
                'role_id'      => 2, // Petugas
                'status'       => 'aktif',
            ],
            [
                'nama_lengkap' => 'Kepala Sekolah',
                'username'     => 'kepala_sekolah',
                'email'        => 'kepala@school.id',
                'no_whatsapp'  => '081234567892',
                'password'     => Hash::make('123'),
                'role_id'      => 3, // Kepala Sekolah
                'status'       => 'aktif',
            ],
            [
                'nama_lengkap' => 'Wakil Sarpras',
                'username'     => 'wakil_sarpras',
                'email'        => 'wakilsarpras@school.id',
                'no_whatsapp'  => '081234567893',
                'password'     => Hash::make('123'),
                'role_id'      => 4, // Wakil Sarpras
                'status'       => 'aktif',
            ],
        ];

        foreach ($users as $user) {
            User::updateOrCreate(['username' => $user['username']], $user);
        }
    }
}