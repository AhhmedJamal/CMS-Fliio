<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'compare_price' => 'nullable|numeric|min:0',
            'quantity' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'اسم المنتج مطلوب',
            'name.max' => 'اسم المنتج لا يتجاوز 255 حرف',
            'price.required' => 'السعر مطلوب',
            'price.numeric' => 'السعر يجب أن يكون رقماً',
            'compare_price.numeric' => 'السعر قبل الخصم يجب أن يكون رقماً',
            'quantity.min' => 'الكمية لا يمكن أن تكون أقل من 0',
            'image.image' => 'الملف يجب أن يكون صورة',
            'image.max' => 'حجم الصورة لا يتجاوز 2 ميجابايت',
        ];
    }
}
