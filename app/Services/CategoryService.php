<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CategoryService
{
    /**
     * جلب كل التصنيفات
     */
    public function getAll()
    {
        return Category::latest()->paginate(15);
    }

    /**
     * إنشاء تصنيف جديد
     */
    public function create(array $data)
    {
        $data['slug'] = Str::slug($data['name']);

        if (isset($data['image']) && $data['image']) {
            $data['image'] = $this->uploadImage($data['image']);
        }

        return Category::create($data);
    }

    /**
     * تحديث تصنيف
     */
    public function update(Category $category, array $data)
    {
        // تحديث Slug إذا تغير الاسم
        if ($data['name'] !== $category->name) {
            $data['slug'] = Str::slug($data['name']);
        }

        // تحديث الصورة
        if (isset($data['image']) && $data['image']) {
            if ($category->image) {
                $this->deleteImage($category->image);
            }
            $data['image'] = $this->uploadImage($data['image']);
        }

        $category->update($data);
        return $category;
    }

    /**
     * حذف تصنيف
     */
    public function delete(Category $category)
    {
        if ($category->image) {
            $this->deleteImage($category->image);
        }

        return $category->delete();
    }

    /**
     * رفع الصورة
     */
    private function uploadImage($image)
    {
        return $image->store('categories', 'public');
    }

    /**
     * حذف الصورة
     */
    private function deleteImage($path)
    {
        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}