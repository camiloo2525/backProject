<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
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
            'name' => $name,
            'description' => $this->faker->paragraph(),
            'category_id' => Category::factory(),
            'slug' => Str::slug($name), // Generar el slug basado en el nombre
        ];
    }
}

