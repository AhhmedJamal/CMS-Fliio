@extends('layouts.admin')

@section('title', __('products.create_product'))

@section('content')

    <div class="mx-auto p-6">
        <!-- عنوان الصفحة -->
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-bold" style="color: {{ $settings->get('text_color', '#1F2937') }}">
                {{ __('products.create_product') }}
            </h1>
            <a href="{{ route('products.index') }}" class="text-sm font-medium px-4 py-2 rounded-lg transition hover:scale-95"
                style="color: {{ $settings->get('text_color', '#1F2937') }}; border: 1px solid {{ $settings->get('text_color', '#1F2937') }}30">
                <i class="fa-solid fa-arrow-left"></i> {{ __('products.back_to_list') }}
            </a>
        </div>

        <!-- الفورم -->
        <div class="rounded-xl shadow-lg p-8 border"
            style="background-color: {{ $settings->get('background_color', '#FFFFFF') }}; border-color: {{ $settings->get('text_color', '#1F2937') }}10">

            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- اسم المنتج -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium mb-2"
                            style="color: {{ $settings->get('text_color', '#1F2937') }}">
                            {{ __('products.name') }} <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="name" value="{{ old('name') }}"
                            class="w-full rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 transition"
                            style="border: 1px solid {{ $settings->get('text_color', '#1F2937') }}30; 
                                  background-color: {{ $settings->get('background_color', '#FFFFFF') }};
                                  color: {{ $settings->get('text_color', '#1F2937') }};
                                  focus:ring-color: {{ $settings->get('primary_color', '#073D42') }}"
                            placeholder="{{ __('products.name') }}">
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- الوصف -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium mb-2"
                            style="color: {{ $settings->get('text_color', '#1F2937') }}">
                            {{ __('products.description') }}
                        </label>
                        <textarea name="description" rows="4"
                            class="w-full rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 transition"
                            style="border: 1px solid {{ $settings->get('text_color', '#1F2937') }}30; 
                                     background-color: {{ $settings->get('background_color', '#FFFFFF') }};
                                     color: {{ $settings->get('text_color', '#1F2937') }};
                                     focus:ring-color: {{ $settings->get('primary_color', '#073D42') }}"
                            placeholder="{{ __('products.description') }}">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- السعر -->
                    <div>
                        <label class="block text-sm font-medium mb-2"
                            style="color: {{ $settings->get('text_color', '#1F2937') }}">
                            {{ __('products.price') }} <span class="text-red-500">*</span>
                        </label>
                        <input type="number" step="0.01" name="price" value="{{ old('price') }}"
                            class="w-full rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 transition"
                            style="border: 1px solid {{ $settings->get('text_color', '#1F2937') }}30; 
                                  background-color: {{ $settings->get('background_color', '#FFFFFF') }};
                                  color: {{ $settings->get('text_color', '#1F2937') }};
                                  focus:ring-color: {{ $settings->get('primary_color', '#073D42') }}"
                            placeholder="0.00">
                        @error('price')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- سعر المقارنة -->
                    <div>
                        <label class="block text-sm font-medium mb-2"
                            style="color: {{ $settings->get('text_color', '#1F2937') }}">
                            {{ __('products.compare_price') }}
                        </label>
                        <input type="number" step="0.01" name="compare_price" value="{{ old('compare_price') }}"
                            class="w-full rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 transition"
                            style="border: 1px solid {{ $settings->get('text_color', '#1F2937') }}30; 
                                  background-color: {{ $settings->get('background_color', '#FFFFFF') }};
                                  color: {{ $settings->get('text_color', '#1F2937') }};
                                  focus:ring-color: {{ $settings->get('primary_color', '#073D42') }}"
                            placeholder="0.00">
                        @error('compare_price')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- الكمية -->
                    <div>
                        <label class="block text-sm font-medium mb-2"
                            style="color: {{ $settings->get('text_color', '#1F2937') }}">
                            {{ __('products.quantity') }} <span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="quantity" value="{{ old('quantity') }}"
                            class="w-full rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 transition"
                            style="border: 1px solid {{ $settings->get('text_color', '#1F2937') }}30; 
                                  background-color: {{ $settings->get('background_color', '#FFFFFF') }};
                                  color: {{ $settings->get('text_color', '#1F2937') }};
                                  focus:ring-color: {{ $settings->get('primary_color', '#073D42') }}"
                            placeholder="0">
                        @error('quantity')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('products.category') }}</label>
                        <select name="category_id"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-primary focus:border-transparent @error('category_id') border-red-500 @enderror">
                            <option value="">{{ __('products.no_category') }}</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- الصورة -->
                    <div>
                        <label class="block text-sm font-medium mb-2"
                            style="color: {{ $settings->get('text_color', '#1F2937') }}">
                            {{ __('products.image') }}
                        </label>
                        <input type="file" name="image"
                            class="w-full rounded-lg px-3 py-2 focus:outline-none focus:ring-2 transition"
                            style="border: 1px solid {{ $settings->get('text_color', '#1F2937') }}30; 
                                  background-color: {{ $settings->get('background_color', '#FFFFFF') }};
                                  color: {{ $settings->get('text_color', '#1F2937') }};
                                  focus:ring-color: {{ $settings->get('primary_color', '#073D42') }}">
                        @error('image')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- الحالة -->
                    <div class="flex items-center gap-3 pt-6">
                        @include('partials.toggle-switch', [
                            'name' => 'is_active',
                            'label' => 'تفعيل المنتج',
                            'checked' => true, // افتراضي نشط
                        ])
                    </div>
                </div>

                <!-- الأزرار -->
                <div class="flex items-center gap-4 mt-8 pt-6"
                    style="border-top: 1px solid {{ $settings->get('text_color', '#1F2937') }}10">
                    <button type="submit" class="text-white font-semibold px-8 py-2.5 rounded-lg transition hover:scale-95"
                        style="background-color: {{ $settings->get('primary_color', '#073D42') }}">
                        {{ __('products.submit') }}
                    </button>
                    <a href="{{ route('products.index') }}" class="font-medium px-6 py-2.5 rounded-lg border transition"
                        style="color: {{ $settings->get('text_color', '#1F2937') }};
                          border-color: {{ $settings->get('text_color', '#1F2937') }}30;
                          hover:background-color: {{ $settings->get('primary_color', '#073D42') }}10">
                        {{ __('products.cancel') }}
                    </a>
                </div>
            </form>
        </div>
    </div>

@endsection
