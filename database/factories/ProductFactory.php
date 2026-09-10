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
        return [
            'name' => fake()->words(3, true),
            'code' => 'PRD-' . strtoupper(fake()->unique()->bothify('??####')),
            'category' => fake()->randomElement(['Elektronik', 'Pakaian', 'Makanan & Minuman', 'Perabotan', 'Kesehatan']),
            'price' => fake()->numberBetween(10000, 5000000),
            'stock' => fake()->numberBetween(0, 500),
            'description' => fake()->paragraph(),
            'is_active' => true,
        ];
    }

    /**
     * Indicate that the product is inactive.
     */
    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => false,
        ]);
    }
}
