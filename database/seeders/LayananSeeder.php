<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Layanan;

class LayananSeeder extends Seeder
{
    public function run(): void
    {
        $layanans = [
            [
                'nama'            => 'Cuci Karpet Reguler',
                'deskripsi'       => 'Cuci karpet standar dengan deterjen berkualitas, cocok untuk karpet tipis dan sedang.',
                'harga_per_karpet'=> 25000,
                'is_active'       => true,
            ],
            [
                'nama'            => 'Cuci Karpet Premium',
                'deskripsi'       => 'Cuci karpet premium dengan bahan khusus, cocok untuk karpet tebal dan berbulu.',
                'harga_per_karpet'=> 45000,
                'is_active'       => true,
            ],
            [
                'nama'            => 'Cuci Karpet Besar',
                'deskripsi'       => 'Layanan khusus untuk karpet ukuran besar (>3m²), termasuk pengeringan ekstra.',
                'harga_per_karpet'=> 75000,
                'is_active'       => true,
            ],
        ];

        foreach ($layanans as $layanan) {
            Layanan::create($layanan);
        }
    }
}
