@extends('layouts.admin')

@section('title', __('dashboard.title'))

@section('content')

    <h2 class="text-3xl font-bold" style="color: {{ $settings->get('text_color', '#1F2937') }}">

        @lang('dashboard.welcome_admin')

    </h2>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 my-6">
        <div class="bg-white rounded-lg p-4 shadow-sm border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">{{ __('products.total') }}</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $products->count() }}</p>
                </div>
                <div class="bg-primary/10 p-3 rounded-full">
                    <i class="fas fa-box text-primary"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg p-4 shadow-sm border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">{{ __('categories.title') }}</p>
                    <p class="text-2xl font-bold text-gray-800"> {{ $categories->count() }}</p>
                </div>
                <div class="bg-green-100 p-3 rounded-full">
                    <i class="fas fa-check-circle text-green-600"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg p-4 shadow-sm border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">{{ __('products.out_of_stock') }}</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $products->where('quantity', 0)->count() }}</p>
                </div>
                <div class="bg-red-100 p-3 rounded-full">
                    <i class="fas fa-exclamation-triangle text-red-600"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg p-4 shadow-sm border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">{{ __('products.total_value') }}</p>
                    <p class="text-2xl font-bold text-gray-800">{{ number_format($products->sum('price'), 2) }} {{ __('products.currency') }}</p>
                </div>
                <div class="bg-yellow-100 p-3 rounded-full">
                    <i class="fas fa-coins text-yellow-600"></i>
                </div>
            </div>
        </div>
    </div>
@endsection
