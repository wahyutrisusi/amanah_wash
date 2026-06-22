<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CreateAdminUserSeeder extends Seeder
{
    public function run()
    {
        // Hapus user admin yang mungkin sudah ada
        User::where('email', 'admin@amanahwash.com')->delete();

        // Buat user admin baru
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@amanahwash.com',
            'password' => Hash::make('admin123'),
            'is_admin' => true,
            'email_verified_at' => now(),
        ]);
    }
} 