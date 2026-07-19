<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use Carbon\Carbon;


class DashboardController extends Controller
{
    public function index()
    {
        $totalRevenue = Order::sum('total_price');
        $totalOrders = Order::count();
        $averageOrderValue = $totalOrders > 0 ? $totalRevenue / $totalOrders : 0;
        $customers = Customer::whereBetween('created_at', [
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek(),
        ])->count();
        return view('dashboard.index', compact('averageOrderValue', 'customers', 'totalRevenue', 'totalOrders'));
    }

}