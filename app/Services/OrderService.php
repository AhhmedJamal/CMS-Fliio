<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class OrderService
{
    public function createOrder(array $validated): Order
    {
        return DB::transaction(function () use ($validated) {

            $order = Order::create([
                'customer_name'  => $validated['customer_name'],
                'phone'          => $validated['phone'],
                'city'           => $validated['city'],
                'address'        => $validated['address'],
                'payment_method' => $validated['payment_method'],
                'discount'       => $validated['discount'] ?? 0,
                'notes'          => $validated['notes'] ?? null,
                'status'         => 'pending',
                'total_price'    => 0,
            ]);

            $subtotal = 0;

            foreach ($validated['products'] as $item) {
                // lockForUpdate يمنع سحب نفس المخزون من طلبين في نفس اللحظة
                $product = Product::lockForUpdate()->findOrFail($item['product_id']);

                if ($product->quantity < $item['quantity']) {
                    throw ValidationException::withMessages([
                        'products' => __('orders.insufficient_stock', ['product' => $product->name]),
                    ]);
                }

                $lineTotal = $product->price * $item['quantity'];
                $subtotal += $lineTotal;

                $order->items()->create([
                    'product_id'   => $product->id,
                    'product_name' => $product->name,
                    'quantity'     => $item['quantity'],
                    'price'        => $product->price,
                    'total_price'  => $lineTotal,
                ]);

                $product->decrement('quantity', $item['quantity']);
            }

            $order->update([
                'total_price' => max(0, $subtotal - ($validated['discount'] ?? 0)),
            ]);

            return $order;
        });
    }
}