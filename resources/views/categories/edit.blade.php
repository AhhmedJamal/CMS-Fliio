@extends('layouts.admin')

@section('title', __('app.edit', ['name' => $category->name]))

@section('content')
    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">
                <i class="fas fa-edit text-primary"></i> {{ __('app.edit', ['name' => $category->name]) }}
            </h1>
            <p class="text-sm text-gray-500 mt-1">{{ __('categories.edit_description', ['name' => $category->name]) }}</p>
        </div>
        <a href="{{ route('categories.index') }}"
            class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition duration-200 flex items-center gap-2">
            <i class="fas fa-arrow-right"></i>
            {{ __('app.back_to_list') }}
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Category Form (66% width on large screens) --}}
        <div class="lg:col-span-2 bg-white rounded-lg p-6 shadow-sm border border-gray-200">
            <form action="{{ route('categories.update', $category) }}" method="POST" enctype="multipart/form-data"
                class="space-y-6" id="categoryForm">
                @csrf
                @method('PUT')

                {{-- Name --}}
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                        {{ __('app.name') }}
                    </label>
                    <input type="text" id="name" name="name" value="{{ old('name', $category->name) }}" required
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Description --}}
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                        {{ __('app.description') }}
                    </label>
                    <textarea id="description" name="description" rows="4"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">{{ old('description', $category->description) }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Image Upload --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        {{ __('app.image') }}
                    </label>
                    <div class="flex items-center gap-4">
                        @if ($category->image)
                            <div class="relative">
                                <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}"
                                    class="w-24 h-24 object-cover rounded-lg border border-gray-200">
                                <div class="absolute -top-2 -right-2">
                                    <span
                                        class="inline-flex items-center justify-center size-6 rounded-full bg-red-500 text-white text-xs">
                                        <i class="fas fa-trash"></i>
                                    </span>
                                </div>
                            </div>
                        @endif
                        <div class="flex-1">
                            <input type="file" name="image" id="image" accept="image/*"
                                class="block w-full text-sm text-gray-500
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-lg file:border-0
                                file:text-sm file:font-medium
                                file:bg-primary file:text-white
                                hover:file:bg-primary-dark
                                transition">
                            <p class="text-xs text-gray-500 mt-1">
                                {{ __('categories.image_hint', ['max_size' => '2MB']) }}
                            </p>
                        </div>
                    </div>
                    @error('image')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Status Toggle --}}
                <div>
                    <div class="flex items-center gap-3">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" name="is_active" id="is_active" value="1"
                            {{ old('is_active', $category->is_active) ? 'checked' : '' }}
                            class="w-5 h-5 rounded border-gray-300 text-primary focus:ring-primary">
                        <label for="is_active" class="text-sm font-medium text-gray-700">
                            {{ __('categories.is_active') }}
                            @if ($category->is_active)
                                <span class="text-green-600">({{ __('app.active') }})</span>
                            @else
                                <span class="text-red-600">({{ __('app.inactive') }})</span>
                            @endif
                        </label>
                    </div>
                    @error('is_active')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Action Buttons --}}
                <div class="flex items-center gap-3">
                    <button type="submit"
                        class="bg-primary hover:bg-primary-dark text-white px-6 py-2 rounded-lg transition duration-200 flex items-center gap-2">
                        <i class="fas fa-save"></i>
                        {{ __('categories.save_changes') }}
                    </button>
                    <button type="reset"
                        class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg transition">
                        <i class="fas fa-undo"></i>
                        {{ __('app.reset') }}
                    </button>
                </div>
            </form>
        </div>

        {{-- Category Preview (33% width on large screens) --}}
        <div class="lg:col-span-1">
            <div class="sticky top-6">
                <div class="bg-white rounded-lg p-6 shadow-sm border border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 border-b border-gray-100 pb-2">
                        <i class="fas fa-eye mr-2"></i> {{ __('categories.preview') }}
                    </h3>

                    {{-- Preview Image --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            {{ __('categories.preview_image') }}
                        </label>
                        <div id="image-preview" class="relative group">
                            @if ($category->image)
                                <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}"
                                    class="w-full h-48 object-cover rounded-lg border border-gray-200">
                            @else
                                <div class="w-full h-48 bg-gray-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-tags text-4xl text-gray-300"></i>
                                </div>
                            @endif
                            <div
                                class="absolute inset-0 bg-black/30 flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
                                <span class="text-white text-sm font-medium bg-black/50 px-4 py-2 rounded-lg">
                                    <i class="fas fa-camera mr-2"></i> {{ __('categories.change_image') }}
                                </span>
                            </div>
                        </div>
                    </div>

                    {{-- Preview Info --}}
                    <div class="space-y-3">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">{{ __('app.name') }}</label>
                            <p class="text-gray-800 font-semibold" id="preview-name">{{ $category->name }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">{{ __('categories.slug') }}</label>
                            <p class="text-gray-600 text-sm" id="preview-slug">{{ $category->slug }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">{{ __('categories.status') }}</label>
                            <p class="text-sm" id="preview-status">
                                @if ($category->is_active)
                                    <span class="text-green-600 font-medium">{{ __('app.active') }}</span>
                                @else
                                    <span class="text-red-600 font-medium">{{ __('app.inactive') }}</span>
                                @endif
                            </p>
                        </div>
                        <div>
                            <label
                                class="block text-sm font-medium text-gray-700">{{ __('categories.products_count') }}</label>
                            <p class="text-gray-800 font-semibold">
                                {{ $category->products_count ?? $category->products->count() }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        (function() {
            'use strict';

            // ✅ 1. Preview Image on File Select
            const imageInput = document.getElementById('image');
            const imagePreview = document.getElementById('image-preview');

            if (imageInput && imagePreview) {
                imageInput.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            imagePreview.innerHTML = `
                            <img src="${e.target.result}" alt="Preview" class="w-full h-48 object-cover rounded-lg border border-gray-200">
                            <div class="absolute inset-0 bg-black/30 flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
                                <span class="text-white text-sm font-medium bg-black/50 px-4 py-2 rounded-lg">
                                    <i class="fas fa-camera mr-2"></i> {{ __('categories.change_image') }}
                                </span>
                            </div>
                        `;
                        };
                        reader.readAsDataURL(file);
                    } else {
                        // إذا تم إلغاء الاختيار، أرجع الصورة الأصلية
                        @if ($category->image)
                            imagePreview.innerHTML = `
                            <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}"
                                class="w-full h-48 object-cover rounded-lg border border-gray-200">
                            <div class="absolute inset-0 bg-black/30 flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
                                <span class="text-white text-sm font-medium bg-black/50 px-4 py-2 rounded-lg">
                                    <i class="fas fa-camera mr-2"></i> {{ __('categories.change_image') }}
                                </span>
                            </div>
                        `;
                        @else
                            imagePreview.innerHTML = `
                            <div class="w-full h-48 bg-gray-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-tags text-4xl text-gray-300"></i>
                            </div>
                            <div class="absolute inset-0 bg-black/30 flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
                                <span class="text-white text-sm font-medium bg-black/50 px-4 py-2 rounded-lg">
                                    <i class="fas fa-camera mr-2"></i> {{ __('categories.change_image') }}
                                </span>
                            </div>
                        `;
                        @endif
                    }
                });
            }

            // ✅ 2. Preview Name on Input
            const nameInput = document.getElementById('name');
            const previewName = document.getElementById('preview-name');

            if (nameInput && previewName) {
                nameInput.addEventListener('input', function(e) {
                    const value = e.target.value.trim();
                    previewName.textContent = value || '{{ $category->name }}';
                });
            }

            // ✅ 3. Preview Slug on Input (تحويل تلقائي إلى slug)
            if (nameInput && document.getElementById('preview-slug')) {
                nameInput.addEventListener('input', function(e) {
                    const value = e.target.value.trim();
                    const slug = value.toLowerCase()
                        .replace(/[^a-z0-9\s-]/g, '')
                        .replace(/\s+/g, '-')
                        .replace(/-+/g, '-');
                    document.getElementById('preview-slug').textContent = slug || '{{ $category->slug }}';
                });
            }

            // ✅ 4. Preview Status on Checkbox Change
            const statusCheckbox = document.getElementById('is_active');
            const previewStatus = document.getElementById('preview-status');

            if (statusCheckbox && previewStatus) {
                statusCheckbox.addEventListener('change', function(e) {
                    if (e.target.checked) {
                        previewStatus.innerHTML =
                            `<span class="text-green-600 font-medium">{{ __('app.active') }}</span>`;
                    } else {
                        previewStatus.innerHTML =
                            `<span class="text-red-600 font-medium">{{ __('app.inactive') }}</span>`;
                    }
                });
            }

        })();
    </script>
@endpush
