@extends('layouts.admin')
@section('content')
    <div class="p-6">
        {{-- Page Header --}}
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold">
                    @lang('orders.create_order')
                </h1>
            </div>
            <a href="{{ route('orders.index') }}"
               class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                @lang('app.back')
            </a>
        </div>

        {{-- Validation Errors Summary --}}
        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-600 p-4 rounded-lg mb-6">
                <ul class="list-disc list-inside space-y-1 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form --}}
        <form action="{{ route('orders.store') }}" method="POST">
            @csrf

            {{-- Customer Information --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-6">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        @lang('orders.customer_info')
                    </h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-sm font-medium mb-2">
                                @lang('orders.customer_name') <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="customer_name" id="customer_name"
                                   class="w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-lg @error('name') border-red-500 @enderror"
                                   value="{{ old('customer_name') }}"
                                   placeholder="@lang('orders.enter_customer_name')"
                                   required>
                            @error('name')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-medium mb-2">
                                @lang('orders.phone') <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="phone" id="phone"
                                   class="w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-lg @error('phone') border-red-500 @enderror"
                                   value="{{ old('phone') }}"
                                   placeholder="@lang('orders.enter_phone')"
                                   required>
                            @error('phone')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="city" class="block text-sm font-medium mb-2">
                                @lang('orders.city') <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="city" id="city"
                                   class="w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-lg @error('city') border-red-500 @enderror"
                                   value="{{ old('city') }}"
                                   placeholder="@lang('orders.enter_city')"
                                   required>
                            @error('city')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="address" class="block text-sm font-medium mb-2">
                                @lang('orders.address') <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="address" id="address"
                                   class="w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-lg @error('address') border-red-500 @enderror"
                                   value="{{ old('address') }}"
                                   placeholder="@lang('orders.enter_address')"
                                   required>
                            @error('address')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- Order Items --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-6">
                <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                    <h3 class="text-lg font-semibold flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                        @lang('orders.order_items')
                    </h3>
                    <button type="button" id="add-item-btn"
                            class="inline-flex items-center px-3 py-1.5 bg-gray-800 hover:bg-gray-900 text-white text-sm rounded-lg">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        @lang('orders.add_product')
                    </button>
                </div>
                <div class="p-6">
                    @error('products')
                        <p class="mb-3 text-sm text-red-500">{{ $message }}</p>
                    @enderror

                    <div id="order-items">
                        @php
                            $oldProducts = old('products', [['product_id' => '', 'quantity' => 1]]);
                        @endphp

                        @foreach ($oldProducts as $i => $item)
                        <div class="order-item grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 bg-gray-50 p-4 rounded-lg border border-gray-200 mb-4">
                            <div class="sm:col-span-2 lg:col-span-1">
                                <label class="block text-xs font-medium mb-1">
                                    @lang('orders.product')
                                </label>
                                <select name="products[{{ $i }}][product_id]"
                                        class="product-select w-full px-3 py-2 bg-white border border-gray-300 rounded-lg text-sm">
                                    <option value="">@lang('orders.select_product')</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}"
                                                data-price="{{ $product->sale_price }}"
                                                {{ ($item['product_id'] ?? '') == $product->id ? 'selected' : '' }}>
                                            {{ $product->name }} ({{ number_format($product->sale_price, 2) }} EGP)
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-xs font-medium mb-1">
                                    @lang('orders.quantity')
                                </label>
                                <input type="number" name="products[{{ $i }}][quantity]"
                                       class="item-quantity w-full px-3 py-2 bg-white border border-gray-300 rounded-lg text-sm"
                                       value="{{ $item['quantity'] ?? 1 }}" min="1">
                            </div>

                            <div>
                                <label class="block text-xs font-medium mb-1">
                                    @lang('orders.price')
                                </label>
                                <input type="number" class="item-price w-full px-3 py-2 bg-gray-100 border border-gray-300 rounded-lg text-sm"
                                       value="0" step="0.01" readonly>
                            </div>

                            <div>
                                <label class="block text-xs font-medium mb-1">
                                    @lang('orders.total_price')
                                </label>
                                <input type="number" class="item-total w-full px-3 py-2 bg-gray-100 border border-gray-300 rounded-lg font-medium text-sm"
                                       value="0" step="0.01" readonly>
                            </div>

                            <div class="flex items-end justify-center">
                                <button type="button"
                                        class="remove-item-btn text-red-500 hover:text-red-700 p-2 hover:bg-red-50 rounded-lg {{ $i === 0 && count($oldProducts) === 1 ? 'hidden' : '' }}">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    {{-- Order Summary --}}
                    <div class="flex justify-end mt-2">
                        <div class="w-full sm:w-72 bg-gray-50 border border-gray-200 rounded-lg p-4 space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-600">@lang('orders.subtotal')</span>
                                <span id="summary-subtotal" class="font-medium">0.00 EGP</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">@lang('orders.discount')</span>
                                <span id="summary-discount" class="font-medium text-red-500">- 0.00 EGP</span>
                            </div>
                            <div class="flex justify-between border-t border-gray-200 pt-2 text-base">
                                <span class="font-semibold">@lang('orders.total')</span>
                                <span id="summary-total" class="font-bold">0.00 EGP</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Payment & Additional Info --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                            </svg>
                            @lang('orders.payment_info')
                        </h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div>
                            <label for="payment_method" class="block text-sm font-medium mb-2">
                                @lang('orders.payment_method')
                            </label>
                            <select name="payment_method" id="payment_method"
                                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-lg @error('payment_method') border-red-500 @enderror">
                                <option value="cash_on_delivery" {{ old('payment_method') == 'cash_on_delivery' ? 'selected' : '' }}>
                                    @lang('orders.cash_on_delivery')
                                </option>
                                <option value="card" {{ old('payment_method') == 'card' ? 'selected' : '' }}>
                                    @lang('orders.card')
                                </option>
                                <option value="wallet" {{ old('payment_method') == 'wallet' ? 'selected' : '' }}>
                                    @lang('orders.wallet')
                                </option>
                            </select>
                            @error('payment_method')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="discount" class="block text-sm font-medium mb-2">
                                @lang('orders.discount')
                            </label>
                            <div class="relative">
                                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm">EGP</span>
                                <input type="number" name="discount" id="discount"
                                       class="w-full pl-12 pr-4 py-2.5 bg-gray-50 border border-gray-300 rounded-lg @error('discount') border-red-500 @enderror"
                                       value="{{ old('discount', 0) }}" step="0.01" min="0">
                            </div>
                            @error('discount')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            @lang('orders.notes')
                        </h3>
                    </div>
                    <div class="p-6">
                        <textarea name="notes" id="notes"
                                  class="w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-lg resize-none"
                                  rows="6" placeholder="@lang('orders.enter_notes_optional')">{{ old('notes') }}</textarea>
                    </div>
                </div>
            </div>

            {{-- Submit Button --}}
            <div class="flex items-center justify-end gap-4">
                <a href="{{ route('orders.index') }}"
                   class="px-6 py-2.5 bg-gray-100 hover:bg-gray-200 rounded-lg font-medium inline-flex items-center">
                    @lang('app.cancel')
                </a>
                <button type="submit" class="px-8 py-2.5 bg-gray-800 hover:bg-gray-900 text-white rounded-lg font-medium inline-flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                    </svg>
                    @lang('orders.save_order')
                </button>
            </div>
        </form>
    </div>

    {{-- Row template used by JS when adding a new product row --}}
    <template id="order-item-template">
        <div class="order-item grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 bg-gray-50 p-4 rounded-lg border border-gray-200 mb-4">
            <div class="sm:col-span-2 lg:col-span-1">
                <label class="block text-xs font-medium mb-1">
                    @lang('orders.product')
                </label>
                <select name="products[__INDEX__][product_id]"
                        class="product-select w-full px-3 py-2 bg-white border border-gray-300 rounded-lg text-sm">
                    <option value="">@lang('orders.select_product')</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}" data-price="{{ $product->sale_price }}">
                            {{ $product->name }} ({{ number_format($product->sale_price, 2) }} EGP)
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-xs font-medium mb-1">
                    @lang('orders.quantity')
                </label>
                <input type="number" name="products[__INDEX__][quantity]"
                       class="item-quantity w-full px-3 py-2 bg-white border border-gray-300 rounded-lg text-sm"
                       value="1" min="1">
            </div>

            <div>
                <label class="block text-xs font-medium mb-1">
                    @lang('orders.price')
                </label>
                <input type="number" class="item-price w-full px-3 py-2 bg-gray-100 border border-gray-300 rounded-lg text-sm"
                       value="0" step="0.01" readonly>
            </div>

            <div>
                <label class="block text-xs font-medium mb-1">
                    @lang('orders.total_price')
                </label>
                <input type="number" class="item-total w-full px-3 py-2 bg-gray-100 border border-gray-300 rounded-lg font-medium text-sm"
                       value="0" step="0.01" readonly>
            </div>

            <div class="flex items-end justify-center">
                <button type="button"
                        class="remove-item-btn text-red-500 hover:text-red-700 p-2 hover:bg-red-50 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </template>

    <script>
        (function () {
            var itemsContainer = document.getElementById('order-items');
            var addBtn = document.getElementById('add-item-btn');
            var template = document.getElementById('order-item-template');
            var discountInput = document.getElementById('discount');
            var itemIndex = itemsContainer.querySelectorAll('.order-item').length;

            function formatMoney(value) {
                return value.toFixed(2) + ' EGP';
            }

            function recalcRow(row) {
                var select = row.querySelector('.product-select');
                var qtyInput = row.querySelector('.item-quantity');
                var priceInput = row.querySelector('.item-price');
                var totalInput = row.querySelector('.item-total');

                var option = select.options[select.selectedIndex];
                var price = option && option.dataset.price ? parseFloat(option.dataset.price) : 0;
                var qty = parseInt(qtyInput.value, 10) || 0;

                priceInput.value = price.toFixed(2);
                totalInput.value = (price * qty).toFixed(2);
            }

            function recalcSummary() {
                var subtotal = 0;
                itemsContainer.querySelectorAll('.order-item').forEach(function (row) {
                    subtotal += parseFloat(row.querySelector('.item-total').value) || 0;
                });

                var discount = parseFloat(discountInput.value) || 0;
                if (discount > subtotal) discount = subtotal;

                document.getElementById('summary-subtotal').textContent = formatMoney(subtotal);
                document.getElementById('summary-discount').textContent = '- ' + formatMoney(discount);
                document.getElementById('summary-total').textContent = formatMoney(subtotal - discount);
            }

            function recalcAll() {
                itemsContainer.querySelectorAll('.order-item').forEach(recalcRow);
                recalcSummary();
            }

            function updateRemoveButtons() {
                var rows = itemsContainer.querySelectorAll('.order-item');
                rows.forEach(function (row) {
                    var btn = row.querySelector('.remove-item-btn');
                    if (rows.length === 1) {
                        btn.classList.add('hidden');
                    } else {
                        btn.classList.remove('hidden');
                    }
                });
            }

            addBtn.addEventListener('click', function () {
                var html = template.innerHTML.replace(/__INDEX__/g, itemIndex++);
                var wrapper = document.createElement('div');
                wrapper.innerHTML = html.trim();
                itemsContainer.appendChild(wrapper.firstElementChild);
                updateRemoveButtons();
                recalcSummary();
            });

            itemsContainer.addEventListener('click', function (e) {
                var btn = e.target.closest('.remove-item-btn');
                if (!btn) return;
                btn.closest('.order-item').remove();
                updateRemoveButtons();
                recalcSummary();
            });

            itemsContainer.addEventListener('change', function (e) {
                if (e.target.classList.contains('product-select') || e.target.classList.contains('item-quantity')) {
                    recalcRow(e.target.closest('.order-item'));
                    recalcSummary();
                }
            });

            itemsContainer.addEventListener('input', function (e) {
                if (e.target.classList.contains('item-quantity')) {
                    recalcRow(e.target.closest('.order-item'));
                    recalcSummary();
                }
            });

            discountInput.addEventListener('input', recalcSummary);

            updateRemoveButtons();
            recalcAll();
        })();
    </script>
@endsection