<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->unique()->word(); // Generar un nombre único
        return [
            'name' => $this->faker->unique()->word(), // Asegúrate de usar `unique()`
            'description' => $this->faker->sentence(),
            'priority' => $this->faker->numberBetween(1, 10),
            'slug' => Str::slug($name), // Generar slug único
        ];
    }
}
