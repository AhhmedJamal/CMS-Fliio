<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\orderRequest;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }
    public function index(Request $request)
    {
        $search = $request->get('search');
        $orders = $this->orderService->getAllOrders(15, $search);
        $stats = $this->orderService->getOrderStats();
        return view('orders.index', compact('orders', 'stats'));
    }
    public function create()
    {
        $customers = Customer::orderBy('name')->get();
        $products = Product::where('is_active', 1)->get();
        return view('orders.create', compact('customers', 'products'));
    }

    public function store(orderRequest $request)
    {
        try {
            $order = $this->orderService->createOrder($request->validated());

            return redirect()
                ->route('orders.show', $order->id)
                ->with('success', ' تم إنشاء الطلب ' . $order->order_code . ' بنجاح');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', ' حدث خطأ: ' . $e->getMessage());
        }
    }
    public function edit($id)
    {
        $order = Order::findOrFail($id);
        return view('orders.edit', compact('order'));
    }

}
