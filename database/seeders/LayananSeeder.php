<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Layanan;

class LayananSeeder extends Seeder
{
    public function run()
    {
        $layanans = [
            [
                'nama' => 'Cuci Motor Standar',
                'deskripsi' => 'Layanan cuci motor dasar dengan pembersihan menyeluruh',
                'harga' => 25000,
                'kategori' => 'motor',
                'is_active' => true
            ],
            [
                'nama' => 'Cuci Motor Premium',
                'deskripsi' => 'Layanan cuci motor premium dengan wax dan poles',
                'harga' => 35000,
                'kategori' => 'motor',
                'is_active' => true
            ],
            [
                'nama' => 'Cuci Karpet Kecil',
                'deskripsi' => 'Layanan cuci karpet ukuran kecil (max 2x3 meter)',
                'harga' => 25000,
                'kategori' => 'karpet',
                'is_active' => true
            ],
            [
                'nama' => 'Cuci Karpet Besar',
                'deskripsi' => 'Layanan cuci karpet ukuran besar (max 4x6 meter)',
                'harga' => 40000,
                'kategori' => 'karpet',
                'is_active' => true
            ],
        ];

        foreach ($layanans as $layanan) {
            Layanan::create($layanan);
        }
    }
}