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
        // BIDAN
        User::create([
            'name' => 'Bidan Posyandu',
            'email' => 'bidan@posyandu.test',
            'password' => Hash::make('password'),
            'role' => 'bidan',
        ]);

        // PETUGAS DESA
        User::create([
            'name' => 'Petugas Desa',
            'email' => 'desa@posyandu.test',
            'password' => Hash::make('password'),
            'role' => 'petugas_desa',
        ]);

        // USER / WARGA
        User::create([
            'name' => 'User Warga',
            'email' => 'user@posyandu.test',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);
    }
}
