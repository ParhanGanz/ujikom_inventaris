<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['id' => 1, 'nama' => 'Admin', 'keterangan' => 'Administrator Sistem'],
            ['id' => 2, 'nama' => 'Petugas', 'keterangan' => 'Petugas Sarpras'],
            ['id' => 3, 'nama' => 'Kepala Sekolah', 'keterangan' => 'Kepala Sekolah'],
            ['id' => 4, 'nama' => 'Wakil Sarpras', 'keterangan' => 'Wakil Kepala Sekolah Bidang Sarpras'],
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate(['id' => $role['id']], $role);
        }
    }
}