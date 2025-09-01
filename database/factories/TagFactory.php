<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Tag;
use Illuminate\Support\Str;


class TagFactory extends Factory
{
    protected $model = Tag::class;

    public function definition()
    {
          $title = $this->faker->words(3, true);

        return [
            'title_tag' => $title,
            'slug_tag' => Str::slug($title) . '-' . $this->faker->unique()->numberBetween(1, 1000),
          
        ];
    }
}
