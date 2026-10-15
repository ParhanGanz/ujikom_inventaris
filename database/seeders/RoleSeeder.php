<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['id' => 1, 'nama' => 'Admin', 'keterangan' => 'Administrator penuh sistem dan manajemen pengguna'],
            ['id' => 2, 'nama' => 'Petugas', 'keterangan' => 'Petugas operasional inventaris dan peminjaman barang'],
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate(['id' => $role['id']], $role);
        }
    }
}