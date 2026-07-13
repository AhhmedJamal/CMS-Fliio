<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_code' => $this->faker->unique()->randomNumber(8),
            'customer_id' => Customer::inRandomOrder()->value('id'),
            'customer_name' => $this->faker->name,
            'phone' => $this->faker->phoneNumber,   
            'city' => $this->faker->city,
            'address' => $this->faker->address,
            'payment_method' => $this->faker->randomElement(['cash_on_delivery', 'card', 'wallet']),
            'notes' => $this->faker->optional()->text,
            'discount' => $this->faker->optional()->numberBetween(0, 100),
            'total_price' => $this->faker->numberBetween(100, 1000),
            'status' => $this->faker->randomElement(['pending', 'processing', 'shipped', 'delivered', 'cancelled']),
        ];
    }
}
