{{-- resources/views/dashboard/products/edit.blade.php --}}

@extends('layouts.admin')

@section('title', __('products.edit_product'))

@section('content')
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        {{-- Header --}}
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">
                    <i class="fas fa-edit text-primary"></i> {{ __('products.edit_product') }}
                </h1>
                <p class="text-sm text-gray-500 mt-1">{{ __('products.edit_desc') }} <strong>{{ $product->name }}</strong></p>
            </div>
            <a href="{{ route('products.index') }}"
                class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg transition flex items-center gap-2">
                <i class="fas fa-arrow-right"></i> {{ __('app.back_to_list') }}
            </a>
        </div>

        {{-- Form --}}
        <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- الاسم --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('app.name') }} *</label>
                    <input type="text" name="name" value="{{ old('name', $product->name) }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-primary focus:border-transparent @error('name') border-red-500 @enderror">
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- السعر --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('app.price') }} *</label>
                    <input type="number" name="price" step="0.01" value="{{ old('price', $product->price) }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-primary focus:border-transparent @error('price') border-red-500 @enderror">
                    @error('price')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- السعر قبل الخصم --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('products.compare_price') }}</label>
                    <input type="number" name="compare_price" step="0.01"
                        value="{{ old('compare_price', $product->compare_price) }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-primary focus:border-transparent @error('compare_price') border-red-500 @enderror">
                    @error('compare_price')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- الكمية --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('app.quantity') }} *</label>
                    <input type="number" name="quantity" value="{{ old('quantity', $product->quantity) }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-primary focus:border-transparent @error('quantity') border-red-500 @enderror">
                    @error('quantity')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('app.category') }}</label>
                    <select name="category_id"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-primary focus:border-transparent @error('category_id') border-red-500 @enderror">
                        <option value="">{{ __('products.no_category') }}</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                {{-- الوصف --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('app.description') }}</label>
                    <textarea name="description" rows="4"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-primary focus:border-transparent @error('description') border-red-500 @enderror">{{ old('description', $product->description) }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- الصورة الحالية --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('products.current_image') }}</label>
                    @if ($product->image)
                        <div class="relative w-32 h-32">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                class="w-full h-full object-cover rounded-lg border border-gray-200">
                        </div>
                    @else
                        <div class="w-32 h-32 bg-gray-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-image text-gray-300 text-2xl"></i>
                        </div>
                    @endif
                </div>

                {{-- تغيير الصورة --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('products.change_image') }}</label>
                    <input type="file" name="image" accept="image/*"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-primary focus:border-transparent @error('image') border-red-500 @enderror">
                    <p class="text-xs text-gray-500 mt-1">{{ __('products.keep_image') }}</p>
                    @error('image')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- الحالة (Toggle Switch) --}}
                <div class="md:col-span-2">
                    @include('partials.toggle-switch', [
                        'name' => 'is_active',
                        'label' => __('products.is_active'),
                        'checked' => old('is_active', $product->is_active),
                    ])
                </div>
            </div>

            {{-- Actions --}}
            <div class="flex items-center gap-4 mt-8 pt-6 border-t border-gray-200">
                <button type="submit"
                    class="bg-primary hover:bg-primary-dark text-white px-6 py-2.5 rounded-lg transition flex items-center gap-2">
                    <i class="fas fa-save"></i> {{ __('products.update') }}
                </button>
                <a href="{{ route('products.index') }}"
                    class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-2.5 rounded-lg transition">
                    {{ __('app.cancel') }}
                </a>
            </div>
        </form>
    </div>
@endsection
