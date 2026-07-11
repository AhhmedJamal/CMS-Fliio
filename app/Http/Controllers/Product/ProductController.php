<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * عرض قائمة المنتجات
     */
    public function index()
    {
        $products = Product::latest()->paginate(15);

        return view('products.index', compact('products'));
    }

    /**
     * عرض صفحة إضافة منتج جديد
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * حفظ منتج جديد في قاعدة البيانات
     */
    public function store(ProductRequest $request)
    {
        Product::create($request->validated());

        return redirect()->route('products')->with('success', 'تم الإضافة');
    }

    
}
