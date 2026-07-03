<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index()
    {
        return view('dashboard.products');
    }
}
