<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\orderRequest;
use App\Models\Order;
use App\Models\Product;
use App\Services\OrderService;

class OrderController extends Controller
{
    protected OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }
    public function index()
    {
        $orders = Order::with('customer')->latest()->get();
        return view('orders.index', compact('orders'));
    }
    public function create()
    {
        $products = Product::all();
        return view('orders.create', compact('products'));
    }

    public function store(orderRequest $request)
    {
        $validated = $request->validated();
        $this->orderService->createOrder($validated);

        return redirect()->route('orders.index')->with('success', 'تم إنشاء الطلب بنجاح');
    }
    public function edit($id)
    {
        $order = Order::findOrFail($id);
        return view('orders.edit', compact('order'));
    }

}
