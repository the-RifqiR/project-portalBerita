<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class BeritaFactory extends Factory
{
    /**
     * Define the model's   default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence();

        return [
            'id_kat' => \App\Models\Kategori::factory(),
            'judul' => $title,
            'slug_berita' => Str::slug($title) . '-' . $this->faker->unique()->numberBetween(1, 1000), 
            'deskripsi' => $this->faker->paragraphs(3, true),
            'id_usr' => \App\Models\User::factory(), 
            'image' => $this->faker->imageUrl(640, 480, 'news', true),
        ];
    }
}
