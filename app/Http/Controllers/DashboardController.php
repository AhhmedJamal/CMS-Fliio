<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;


class DashboardController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $categories = Category::all();
        return view('dashboard.index', compact('products', 'categories'));
    }

}