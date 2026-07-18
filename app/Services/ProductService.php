<?php

namespace App\Services;

use App\Models\Product;
use Log;
use Storage;
use Str;

class ProductService
{
    public function createProduct(array $data)
    {
        if (isset($data['name'])) {
            $data['slug'] = $this->generateUniqueSlug($data['name']);
        }

        if (isset($data['compare_price']) && $data['compare_price'] > 0) {
            $data['discount_percentage'] = $this->calculateDiscount(
                $data['compare_price'],
                $data['price']
            );
        }

        if (isset($data['image']) && $data['image']) {
            $data['image'] = $this->uploadImage($data['image']);
        }
        return Product::create($data);
    }
    private function calculateDiscount($comparePrice, $price)
    {
        if ($comparePrice <= 0 || $price <= 0) {
            return 0;
        }
        return round((($comparePrice - $price) / $comparePrice) * 100, 2);
    }


    private function uploadImage($image)
    {
        return $image->store('products', 'public');
    }

    public function updateProduct(Product $product, array $data)
    {
        if (isset($data['name']) && $data['name'] !== $product->name) {
            $data['slug'] = $this->generateUniqueSlug($data['name']);
        }

        if (isset($data['compare_price']) && $data['compare_price'] > 0) {
            $data['discount_percentage'] = $this->calculateDiscount(
                $data['compare_price'],
                $data['price'] ?? $product->price
            );
        }

        if (isset($data['image']) && $data['image']) {
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $this->uploadImage($data['image']);
        }

        $product->update($data);

        Log::info('تم تحديث منتج', [
            'product_id' => $product->id,
            'product_name' => $product->name,
            'admin_id' => auth()->id(),
        ]);

        return $product;
    }


    private function generateUniqueSlug($name)
    {
        $slug = Str::slug($name);
        $count = Product::where('name', 'like', $slug . '%')->count();
        return $count > 0 ? $slug . '-' . ($count + 1) : $slug;
    }

    public function deleteProduct(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();
    }

     public function getAllProducts($search = null, $perPage = 12)
    {
        $query = Product::query();
        
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', '%' . $search . '%')
                  ->orWhere('description', 'LIKE', '%' . $search . '%');
            });
        }
        
        $query->orderBy('created_at', 'desc');
        
        return $query->paginate($perPage);
    }
}