<?php

namespace Database\Seeders;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Database\Seeder;

class DummyDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Buat 20 Kategori
        $categories = Kategori::factory()->count(20)->create();

        // 2. Buat 20 Buku dan hubungkan dengan kategori secara acak
        Buku::factory()
            ->count(20)
            ->create()
            ->each(function ($buku) use ($categories) {
                // Setiap buku akan memiliki 1-3 kategori acak
                $buku->kategori()->attach(
                    $categories->random(rand(1, 3))->pluck('id')->toArray()
                );
            });
    }
}
