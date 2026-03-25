<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Buat Akun Admin
        User::create([
            'name'     => 'Lundor Admin',
            'email'    => 'admin@lundor.com',
            'password' => Hash::make('password123'), // Ganti dengan password yang aman
            'role'     => 'admin',
        ]);

        // 2. Buat Akun Client (Partner)
        User::create([
            'name'     => 'Geely Indonesia',
            'email'    => 'client@geely.com',
            'password' => Hash::make('password123'),
            'role'     => 'client',
        ]);

        // 3. Buat Akun Artist / Editor
        User::create([
            'name'     => 'Lead 3D Artist',
            'email'    => 'artist@lundor.com',
            'password' => Hash::make('password123'),
            'role'     => 'artist',
        ]);
    }
}