<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
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
        $categoryIds = Category::pluck('id')->toArray();
        return [
            'category_id' => $this->faker->randomElement($categoryIds),
            'name' => $this->faker->name,
            'description' => $this->faker->text,
            'price' => $this->faker->numberBetween(100, 1000),
            'compare_price' => $this->faker->numberBetween(100, 1000),
            'discount_percentage' => $this->faker->numberBetween(0, 100),
            'quantity' => $this->faker->numberBetween(1, 10),
            'image' => $this->faker->imageUrl,
            'is_active' => $this->faker->boolean,
        ];
    }
}
