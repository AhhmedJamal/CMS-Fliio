<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'customer_name' => 'required|string|min:3|max:255',
            'phone'         => 'required|string|min:9|max:15',
            'city'          => 'required|string|min:2|max:100',
            'address'       => 'required|string|min:5|max:255',

            'products'               => 'required|array|min:1',
            'products.*.product_id'  => 'required|exists:products,id',
            'products.*.quantity'    => 'required|integer|min:1',

            'payment_method' => 'required|in:cash_on_delivery,card,wallet',
            'discount'       => 'nullable|numeric|min:0',
            'notes'          => 'nullable|string|max:1000',
        ];
    }

    public function messages(): array
    {
        return [
            'customer_name.required' => __('orders.name_required'),
            'customer_name.min'      => __('orders.name_min'),
            'customer_name.max'      => __('orders.name_max'),

            'phone.required' => __('orders.phone_required'),
            'phone.min'      => __('orders.phone_min'),
            'phone.max'      => __('orders.phone_max'),

            'city.required' => __('orders.city_required'),

            'address.required' => __('orders.address_required'),
            'address.min'      => __('orders.address_min'),
            'address.max'      => __('orders.address_max'),

            'products.required' => __('orders.products_required'),
            'products.min'      => __('orders.products_min'),

            'products.*.product_id.required' => __('orders.product_id_required'),
            'products.*.product_id.exists'   => __('orders.product_id_exists'),
            'products.*.quantity.required'   => __('orders.quantity_required'),
            'products.*.quantity.min'        => __('orders.quantity_min'),
        ];
    }
}