<?php

namespace App\Services;

use App\Http\Requests\OrderRequest;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Request;

class OrderService
{
    public function createOrder(array $data): Order
    {
        return DB::transaction(function () use ($data) {
            $customerData = $this->handleCustomer($data);
            $total = $this->calculateTotal($data['products']);
            $discount = $data['discount'] ?? 0;
            if ($discount > $total) {
                $discount = $total;
            }
            $order = Order::create([
                'order_code' => $this->generateOrderCode(),
                'customer_id' => $customerData['id'] ?? null,
                'customer_name' => $customerData['name'],
                'phone' => $customerData['phone'],
                'city' => $customerData['city'],
                'address' => $customerData['address'],
                'payment_method' => $data['payment_method'],
                'notes' => $data['notes'] ?? null,
                'discount' => $discount,
                'total_price' => $total - $discount,
                'status' => 'pending',
            ]);

            $this->addOrderItems($order, $data['products']);
            $this->updateStock($data['products']);

            return $order;

        });

    }

    private function handleCustomer(array $data)
    {
        if ($data['customer_type'] === 'existing' && $data['customer_id']) {
            return Customer::findOrFail($data['customer_id']);
        }

        return Customer::create([
            'name' => $data['customer_name'],
            'phone' => $data['phone'],
            'city' => $data['city'],
            'address' => $data['address'],
        ]);
    }

    private function calculateTotal(array $products)
    {
        $total = 0;
        foreach ($products as $item) {
            $product = Product::findOrFail($item['product_id']);
            $total += $product->price * $item['quantity'];
        }
        return $total;
    }

    private function generateOrderCode()
    {
        $prefix = 'ORD-' . date('Ymd');
        $lastOrder = Order::where('order_code', 'like', $prefix . '%')
            ->orderBy('order_code', 'desc')
            ->first();

        if ($lastOrder) {
            $lastNumber = intval(substr($lastOrder->order_code, -4));
            $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '0001';
        }

        return $prefix . '-' . $newNumber;
    }

    private function addOrderItems(Order $order, array $products)
    {
        foreach ($products as $item) {
            $price = $item['price'];
            $quantity = $item['quantity'];
            $order->items()->create([
                'product_id' => $item['product_id'],
                'quantity' => $quantity,
                'price' => $price,
                'total' => $price * $quantity,
            ]);
        }
    }

    private function updateStock(array $products)
    {
        foreach ($products as $item) {
            $product = Product::find($item['product_id']);

            if ($product->quantity < $item['quantity']) {
                throw new \Exception("الكمية غير متوفرة للمنتج: {$product->name}");
            }

            $product->decrement('quantity', $item['quantity']);
        }
    }

    public function getAllOrders($perPage = 15, $search = null)
    {
        $query = Order::with(['customer', 'items.product'])
            ->orderBy('created_at', 'desc');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('order_code', 'like', "%{$search}%")
                    ->orWhere('customer_name', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        return $query->paginate($perPage);
    }

    public function getOrderStats()
    {
        return [
            'total_orders' => Order::count(),
            'pending' => Order::where('status', 'pending')->count(),
            'processing' => Order::where('status', 'processing')->count(),
            'shipped' => Order::where('status', 'shipped')->count(),
            'delivered' => Order::where('status', 'delivered')->count(),
            'cancelled' => Order::where('status', 'cancelled')->count(),
            'total_revenue' => Order::where('status', 'delivered')->sum('total_price'),
            'total_discount' => Order::sum('discount'),
        ];
    }
    
    public function getCustomerOrders($customerId, $perPage = 15)
    {
        return Order::with(['items.product'])
            ->where('customer_id', $customerId)
            ->orWhere('phone', Customer::find($customerId)->phone)
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }
}