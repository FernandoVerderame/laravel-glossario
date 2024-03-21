<?php

namespace Database\Factories;

use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Word>
 */
class WordFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $term = fake()->text(20);

        return [
            'term' => $term,
            'slug' => Str::slug($term),
            'definition' => fake()->paragraphs(10, true),
            'technology' => fake()->text(30),
            'is_published' => fake()->boolean()
        ];
    }
}
