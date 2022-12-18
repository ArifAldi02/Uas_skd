<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Buku>
 */
class BukuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id_rak' => fake()->numberBetween(1, 5),
            'id_kategori' => fake()->numberBetween(1, 3),
            'judul' => fake()->sentence(mt_rand(2, 5)),
            'cover' => 'fake.jpeg',
            'kode' => fake()->bothify('???-###'),
            'penerbit' => fake()->sentence(1, 3),
            'sinopsis' => fake()->paragraph(2),
            'stok' => fake()->numberBetween(20, 50),
        ];
    }
}