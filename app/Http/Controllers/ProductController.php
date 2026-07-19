<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    protected ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }
    public function index(Request $request)
    {
        $search = $request->input('search');
        $categoryId = $request->input('category_id');

        $query = Product::query()->with('category');


        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', '%' . $search . '%')
                    ->orWhere('description', 'LIKE', '%' . $search . '%');
            });
        }

        $products = $query->latest()->paginate(15);

        return view('products.index', compact('products'));
    }


    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('products.create', compact('categories'));
    }


    public function store(ProductRequest $request)
    {
        // Product::create($request->validated());
        $this->productService->createProduct($request->validated());

        return redirect()->route('products.index')->with('success', __('app.success_added'));
    }
    public function edit(Product $product)
    {
        $categories = Category::orderBy('name')->get();
        return view('app.edit', compact('product', 'categories'));
    }


    public function update(ProductRequest $request, Product $product)
    {
        $this->productService->updateProduct($product, $request->validated());

        return redirect()
            ->route('products.index')
            ->with('success', __('app.success_updated'));
    }

    public function destroy(Product $product)
    {
        $this->productService->deleteProduct($product);
        return redirect()->route('products.index')->with('success', __('app.success_deleted'));
    }

}
