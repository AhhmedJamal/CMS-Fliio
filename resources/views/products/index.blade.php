@extends('layouts.admin')

@section('title', __('dashboard.products'))

@section('content')
    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">
                <i class="fas fa-box text-primary"></i> {{ __('products.title') }}
            </h1>
            <p class="text-sm text-gray-500 mt-1">{{ __('products.management') }}</p>
        </div>
        {{-- Search & Filter --}}
        <div class="bg-white rounded-lg p-1 border border-gray-200 w-1/2">
            <form method="GET" action="{{ route('products.index') }}" class="flex flex-wrap gap-3">
                <div class="flex-1 min-w-[200px]">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="{{ __('products.search_placeholder') }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                </div>
                <button type="submit" class="bg-primary hover:bg-primary-dark text-white px-4 py-2 rounded-lg transition">
                    <i class="fas fa-search"></i> {{ __('products.search') }}
                </button>
                <a href="{{ route('products.index') }}"
                    class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg transition">
                    <i class="fas fa-redo"></i> {{ __('products.reset') }}
                </a>
            </form>
        </div>
        <a href="{{ route('products.create') }}"
            class="bg-primary hover:bg-primary-dark text-white px-4 py-2 rounded-lg transition duration-200 flex items-center gap-2">
            <i class="fas fa-plus"></i>
            {{ __('products.create_product') }}
        </a>
    </div>
    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-lg p-4 shadow-sm border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">{{ __('products.total') }}</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $products->total() }}</p>
                </div>
                <div class="bg-primary/10 p-3 rounded-lg">
                    <i class="fas fa-box text-primary"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg p-4 shadow-sm border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">{{ __('products.active') }}</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $products->where('is_active', true)->count() }}</p>
                </div>
                <div class="bg-green-100 p-3 rounded-lg"">
                    <i class="fas fa-toggle-on text-green-600"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg p-4 shadow-sm border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">{{ __('products.disactive') }}</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $products->where('is_active', false)->count() }}</p>
                </div>
                <div class="bg-gray-100 p-3 rounded-lg">
                    <i class="fas fa-toggle-off text-gray-600"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg p-4 shadow-sm border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">{{ __('products.out_of_stock') }}</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $products->where('quantity', 0)->count() }}</p>
                </div>
                <div class="bg-red-100 p-3 rounded-lg">
                    <i class="fas fa-exclamation-triangle text-red-600"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Products Grid --}}
    @if ($products->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach ($products as $product)
                <div
                    class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition duration-300">
                    {{-- Product Image --}}
                    <div class="relative h-80 bg-gray-100">
                        @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <i class="fas fa-image text-4xl text-gray-300"></i>
                            </div>
                        @endif

                        {{-- Status Badge --}}
                        <div class="absolute top-2 left-2">
                            <span
                                class="flex items-center gap-2 px-2 py-1 text-xs font-medium rounded {{ $product->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-200 text-gray-600' }}">
                                @if ($product->is_active)
                                    <i class="fa-solid fa-circle text-[8px]"></i>
                                    <span>{{ __('products.status_active') }}</span>
                                @else
                                    <i class="fa-solid fa-circle text-[8px]"></i>
                                    <span>{{ __('products.status_inactive') }}</span>
                                @endif
                            </span>
                        </div>


                    </div>

                    {{-- Product Info --}}
                    <div class="p-4">

                        <div class="flex justify-between items-center pb-2 border-b border-gray-100">

                            <h3 class="text-gray-800 font-semibold text-lg mb-1 truncate">{{ $product->name }}</h3>
                            {{-- Stock Badge --}}
                            <span
                                class="px-2 py-1 text-xs font-medium rounded-full {{ $product->quantity > 0 ? 'bg-primary/10 text-primary' : 'bg-red-100 text-red-600' }}">
                                <i class="fas fa-boxes"></i> {{ $product->quantity }}
                            </span>
                        </div>

                        {{-- Price --}}
                        <div class="flex items-end gap-2 mt-2 mb-3 relative">
                            <span class="text-xl font-bold text-primary">{{ number_format($product->price, 2) }}
                                {{ __('products.currency') }}</span>
                            @if ($product->compare_price)
                                <span
                                    class="text-sm text-gray-400 line-through ">{{ number_format($product->compare_price, 2) }}
                                    {{ __('products.currency') }}</span>
                                <span
                                    class="absolute rtl:left-0 ltr:right-0 text-xs bg-green-100 text-green-600 px-2 py-0.5 rounded-full">-{{ $product->discount_percentage }}%</span>
                            @endif
                        </div>
                        {{-- Actions --}}
                        <div class="grid grid-cols-2 items-center gap-2 pt-3 border-t border-gray-100">
                            <a href="{{ route('products.edit', $product) }}"
                                class="flex-1 bg-gray-100 hover:bg-green-100 hover:text-green-500 text-primary text-center px-3 py-1.5 rounded-lg text-sm transition border border-gray-200">
                                <i class="fas fa-edit"></i> {{ __('products.edit') }}
                            </a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                onsubmit="return confirm('{{ __('products.confirm_delete') }}')" class="flex-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="w-full bg-gray-100 hover:bg-red-100 hover:text-red-500 text-primary text-center px-3 py-1.5 rounded-lg text-sm transition border border-gray-200">
                                    <i class="fas fa-trash"></i> {{ __('products.delete') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-6">
            {{ $products->links() }}
        </div>
    @else
        {{-- Empty State --}}
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-12 text-center">
            <i class="fas fa-box-open text-6xl text-gray-300 mb-4"></i>
            <h3 class="text-xl font-semibold text-gray-700 mb-2">{{ __('products.no_products') }}</h3>
            <p class="text-gray-500 mb-4">{{ __('products.no_products_desc') }}</p>
            <a href="{{ route('products.create') }}"
                class="bg-primary hover:bg-primary-dark text-white px-6 py-2 rounded-lg transition inline-flex items-center gap-2">
                <i class="fas fa-plus"></i> {{ __('products.add_first') }}
            </a>
        </div>
    @endif
@endsection
