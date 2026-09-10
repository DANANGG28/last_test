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
        $categories = ['Elektronik', 'Aksesoris', 'Komponen', 'Penyimpanan', 'Jaringan', 'Periferal'];

        return [
            'name'        => fake()->words(rand(2, 4), true),
            'code'        => 'PRD-' . fake()->unique()->numerify('###'),
            'category'    => fake()->randomElement($categories),
            'price'       => fake()->numberBetween(50000, 15000000),
            'stock'       => fake()->numberBetween(0, 200),
            'description' => fake()->sentence(rand(8, 20)),
            'is_active'   => fake()->boolean(85),
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

    /**
     * Indicate that the product is out of stock.
     */
    public function outOfStock(): static
    {
        return $this->state(fn (array $attributes) => [
            'stock' => 0,
        ]);
    }
}
