{{-- resources/views/categories/create.blade.php --}}

@extends('layouts.admin')

@section('title', __('categories.create'))

@section('content')
<div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">
            <i class="fas fa-tags text-primary"></i> {{ __('categories.create') }}
        </h1>
        <a href="{{ route('categories.index') }}" 
           class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg transition">
            <i class="fas fa-arrow-right"></i> {{ __('categories.back_to_list') }}
        </a>
    </div>

    <form action="{{ route('categories.store') }}" 
          method="POST" 
          enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- الاسم --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('categories.name') }} *</label>
                <input type="text" 
                       name="name" 
                       value="{{ old('name') }}"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-primary focus:border-transparent @error('name') border-red-500 @enderror">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- الصورة --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('categories.image') }}</label>
                <input type="file" 
                       name="image" 
                       accept="image/*"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-primary focus:border-transparent @error('image') border-red-500 @enderror">
                @error('image')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- الوصف --}}
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('categories.description') }}</label>
                <textarea name="description" 
                          rows="4"
                          class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-primary focus:border-transparent @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- الحالة --}}
            <div class="md:col-span-2">
                @include('partials.toggle-switch', [
                    'name' => 'is_active',
                    'label' => __('categories.is_active'),
                    'checked' => old('is_active', true)
                ])
            </div>
        </div>

        <div class="flex items-center gap-4 mt-8 pt-6 border-t border-gray-200">
            <button type="submit" 
                    class="bg-primary hover:bg-primary-dark text-white px-6 py-2.5 rounded-lg transition flex items-center gap-2">
                <i class="fas fa-save"></i> {{ __('categories.save') }}
            </button>
            <a href="{{ route('categories.index') }}" 
               class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-2.5 rounded-lg transition">
                {{ __('categories.cancel') }}
            </a>
        </div>
    </form>
</div>
@endsection