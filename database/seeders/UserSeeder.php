<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        User::updateOrCreate(
            ['email' => 'admin@umkm.test'],
            [
                'name' => 'Admin UMKM',
                'password' => Hash::make('password'),
                'avatar' => 'default.png',
                'occupation' => 'Administrator',
                'role' => 'admin'
            ]
        );

        // Pelaku UMKM user
        User::updateOrCreate(
            ['email' => 'umkm@test.com'],
            [
                'name' => 'Pelaku UMKM',
                'password' => Hash::make('password'),
                'avatar' => 'default.png',
                'occupation' => 'Pelaku UMKM',
                'role' => 'pelaku_umkm'
            ]
        );

        // Pembeli user
        User::updateOrCreate(
            ['email' => 'pembeli@test.com'],
            [
                'name' => 'Pembeli',
                'password' => Hash::make('password'),
                'avatar' => 'default.png',
                'occupation' => 'Pembeli',
                'role' => 'pembeli'
            ]
        );
    }
}
