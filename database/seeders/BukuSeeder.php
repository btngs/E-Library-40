<?php

namespace Database\Seeders;

use App\Models\Buku;
use Illuminate\Database\Seeder;

class BukuSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $buku = [
            [
                'judul' => 'Laskar Pelangi',
                'pengarang' => 'Andrea Hirata',
                'tahun_terbit' => 2005,
                'stok' => 12,
            ],
            [
                'judul' => 'Bumi Manusia',
                'pengarang' => 'Pramoedya Ananta Toer',
                'tahun_terbit' => 1980,
                'stok' => 7,
            ],
            [
                'judul' => 'Negeri 5 Menara',
                'pengarang' => 'Ahmad Fuadi',
                'tahun_terbit' => 2009,
                'stok' => 9,
            ],
            [
                'judul' => 'Ayat-Ayat Cinta',
                'pengarang' => 'Habiburrahman El Shirazy',
                'tahun_terbit' => 2004,
                'stok' => 5,
            ],
        ];

        foreach ($buku as $item) {
            Buku::query()->updateOrCreate(
                ['judul' => $item['judul']],
                $item,
            );
        }
    }
}
