<?php

namespace Database\Factories;

use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<OrderItem>
 */
class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'order_id' => $this->faker->numberBetween(1, 100),
            'product_id' => Product::inRandomOrder()->value('id'),
            'product_name' => $this->faker->name,
            'quantity' => $this->faker->numberBetween(1, 10),
            'price' => $this->faker->numberBetween(100, 1000),
            'total_price' => $this->faker->numberBetween(100, 1000),
        ];
    }
}
