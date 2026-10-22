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
        User::updateOrCreate(
            ['username' => 'admin'],
            [
                'nama_lengkap' => 'Administrator',
                'email' => 'admin@smaknis.sch.id',
                'password' => Hash::make('123'),
                'role' => 'admin',
                'status' => 'aktif',
            ]
        );
    }
}