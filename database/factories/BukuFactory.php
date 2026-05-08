<?php

namespace Database\Factories;

use App\Models\Buku;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Buku>
 */
class BukuFactory extends Factory
{
    protected $model = Buku::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'judul' => fake()->sentence(3),
            'pengarang' => fake()->name(),
            'deskripsi' => fake()->text(200),
            'tahun_terbit' => fake()->year(),
            'stok' => fake()->numberBetween(1, 50),
            'cover' => null,
        ];
    }
}
