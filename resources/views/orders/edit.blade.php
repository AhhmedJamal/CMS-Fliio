<div>
@extends('layouts.app')
@section('content')
    <section class="flex h-full w-full gap-4 p-4">

        {{-- main area --}}
        <div class="flex-1 bg-white rounded-md p-3 shadow-md dark:bg-slate-800 dark:text-white">
            {{-- header --}}
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800 ">
                        @lang('dashboard.edit_order')
                    </h2>
                    <p class="mt-1 text-sm text-gray-500">
                        @lang('dashboard.edit_order_desc')
                    </p>
                </div>
                <div class="flex items-center gap-2">
                    <button class="btn btn-secondary" onclick="window.location.href='{{ route('orders') }}'">
                        @lang('dashboard.back')
                    </button>
                </div>
            </div>
            <hr class="my-3">
            {{-- form --}}
            <form action="{{ route('orders.update', $order->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-2 gap-4">
                    {{-- Customer Info --}}
                    <div class="col-span-2">
                        <h3 class="text-xl font-bold mb-3">@lang('dashboard.customer_info')</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="">
                                <label for="customer_name" class="form-label">@lang('dashboard.customer_name')</label>
                                <input type="text" name="customer_name" id="customer_name" class="form-input" value="{{ $order->customer_name }}" required>
                            </div>
                            <div>
                                <label for="phone" class="form-label">@lang('dashboard.phone')</label>
                                <input type="text" name="phone" id="phone" class="form-input" value="{{ $order->phone }}" required>
                            </div>
                            <div>
                                <label for="city" class="form-label">@lang('dashboard.city')</label>
                                <input type="text" name="city" id="city" class="form-input" value="{{ $order->city }}" required>
                            </div>
                            <div>
                                <label for="address" class="form-label">@lang('dashboard.address')</label>
                                <input type="text" name="address" id="address" class="form-input" value="{{ $order->address }}" required>
                            </div>
                        </div>
                    </div>

                    {{-- Order Items --}}
                    <div class="col-span-2">
                        <h3 class="text-xl font-bold mb-3">@lang('dashboard.order_items')</h3>
                        <div id="order-items">
                            @foreach($order->items as $item)
                            <div class="grid grid-cols-5 gap-3 mb-3 bg-slate-100 p-2 rounded-md">
                                <div>
                                    <label class="form-label">@lang('dashboard.product')</label>
                                    <select class="product-select form-select" onchange="updateItemTotals(this)">
                                        <option value="">@lang('dashboard.select_product')</option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}" data-price="{{ $product->sale_price }}" {{ $item->product_id == $product->id ? 'selected' : '' }}>
                                                {{ $product->name }} ({{ $product->sale_price }} EGP)
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="form-label">@lang('dashboard.quantity')</label>
                                    <input type="number" class="quantity-input form-input" value="{{ $item->quantity }}" min="1" oninput="updateItemTotals(this)">
                                </div>
                                <div>
                                    <label class="form-label">@lang('dashboard.price')</label>
                                    <input type="number" class="price-input form-input" value="{{ $item->price }}" step="0.01" readonly>
                                </div>
                                <div>
                                    <label class="form-label">@lang('dashboard.total_price')</label>
                                    <input type="number" class="total-price-input form-input" value="{{ $item->total_price }}" step="0.01" readonly>
                                </div>
                                <div class="flex items-center justify-center">
                                    <button type="button" class="text-red-500 hover:text-red-700" onclick="removeItem(this)">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <button type="button" class="btn btn-primary bg-green-500 text-white" onclick="addItem()">
                            <i class="fa-solid fa-plus"></i> @lang('dashboard.add_product')
                        </button>
                    </div>
                </div>

                {{-- Payment --}}
                <div class="col-span-2 mt-4">
                    <h3 class="text-xl font-bold mb-3">@lang('dashboard.payment_info')</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="payment_method" class="form-label">@lang('dashboard.payment_method')</label>
                            <select name="payment_method" id="payment_method" class="form-select">
                                <option value="cash_on_delivery" {{ $order->payment_method == 'cash_on_delivery' ? 'selected' : '' }}>@lang('dashboard.cash_on_delivery')</option>
                                <option value="card" {{ $order->payment_method == 'card' ? 'selected' : '' }}>@lang('dashboard.card')</option>
                                <option value="wallet" {{ $order->payment_method == 'wallet' ? 'selected' : '' }}>@lang('dashboard.wallet')</option>
                            </select>
                        </div>
                        <div>
                            <label for="discount" class="form-label">@lang('dashboard.discount')</label>
                            <input type="number" name="discount" id="discount" class="form-input" value="{{ $order->discount }}" step="0.01" oninput="calculateTotal()">
                        </div>
                    </div>
                </div>

                {{-- Notes --}}
                <div class="col-span-2 mt-4">
                    <label for="notes" class="form-label">@lang('dashboard.notes')</label>
                    <textarea name="notes" id="notes" class="form-textarea">{{ $order->notes }}</textarea>
                </div>

                {{-- Summary --}}
                <div class="col-span-2 mt-6">
                    <div class="text-right">
                        <div class="flex justify-end gap-4 mb-2">
                            <span class="font-bold">@lang('dashboard.subtotal'):</span>
                            <span id="subtotal">0.00</span>
                        </div>
                        <div class="flex justify-end gap-4 mb-2">
                            <span class="font-bold">@lang('dashboard.discount'):</span>
                            <span id="discount_amount">0.00</span>
                        </div>
                        <div class="flex justify-end gap-4 mb-2">
                            <span class="text-2xl font-bold">@lang('dashboard.total_price'):</span>
                            <span id="final_total" class="text-2xl font-bold text-blue-600">0.00</span>
                        </div>
                        <input type="hidden" name="total_price" id="total_price">
                    </div>
                </div>

                {{-- Submit --}}
                <div class="col-span-2 mt-6 text-right">
                    <button type="submit" class="btn btn-primary bg-blue-600 text-white">
                        <i class="fa-solid fa-
