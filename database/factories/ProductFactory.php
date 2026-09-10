<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = ['Elektronik', 'Pakaian', 'Makanan & Minuman', 'Kesehatan & Kecantikan', 'Alat Tulis', 'Otomotif'];

        return [
            'name' => fake()->words(3, true),
            'code' => 'PRD-' . strtoupper(fake()->unique()->bothify('??###')),
            'category' => fake()->randomElement($categories),
            'price' => fake()->numberBetween(10000, 2500000),
            'stock' => fake()->numberBetween(0, 200),
            'description' => fake()->paragraph(),
            'is_active' => fake()->boolean(85),
        ];
    }
}
