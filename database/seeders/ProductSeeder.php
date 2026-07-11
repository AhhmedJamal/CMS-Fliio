<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [

            ['name' => 'Bag 1', 'description' => 'Description 1', 'price' => 100, 'compare_price' => 150, 'quantity' => 10, 'image' => 'https://res.cloudinary.com/dtrrqx2i0/image/upload/v1776171195/cld-sample-5.jpg', 'is_active' => true],
            ['name' => 'Bag 2', 'description' => 'Description 2', 'price' => 200, 'compare_price' => 250, 'quantity' => 20, 'image' => 'https://res.cloudinary.com/dtrrqx2i0/image/upload/v1776171188/samples/chair-and-coffee-table.jpg', 'is_active' => true],
            ['name' => 'Bag 3', 'description' => 'Description 3', 'price' => 300, 'compare_price' => 350, 'quantity' => 30, 'image' => 'https://res.cloudinary.com/dtrrqx2i0/image/upload/v1776171182/samples/shoe.jpg', 'is_active' => true],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
