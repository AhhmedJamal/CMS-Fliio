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

        $monthlyRevenue = Order::selectRaw('MONTH(created_at) as month, SUM(total_price) as revenue')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->pluck('revenue', 'month')
            ->toArray();

        $monthlyData = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthlyData[] = $monthlyRevenue[$i] ?? 0;
        }
        
        return view('dashboard.index', compact(
            'averageOrderValue', 
            'customers', 
            'totalRevenue', 
            'totalOrders', 
            'monthlyData', 
            'monthlyRevenue'
        ));
    }
}