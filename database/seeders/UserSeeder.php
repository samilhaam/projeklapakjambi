<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin UMKM',
            'email' => 'admin@umkm.test',
            'password' => Hash::make('password'),
            'avatar' => 'default.png',
            'occupation' => 'Administrator'  // Tambahkan data occupation
        ]);
    }
}
