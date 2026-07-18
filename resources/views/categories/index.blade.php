{{-- resources/views/dashboard/categories/index.blade.php --}}

@extends('layouts.admin')

@section('title', __('categories.title'))

@section('content')
    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">
                <i class="fas fa-tags text-primary"></i> {{ __('categories.title') }}
            </h1>
            <p class="text-sm text-gray-500 mt-1">{{ __('categories.management') }}</p>
        </div>
        <a href="{{ route('categories.create') }}"
            class="bg-primary hover:bg-primary-dark text-white px-4 py-2 rounded-lg transition duration-200 flex items-center gap-2">
            <i class="fas fa-plus"></i>
            {{ __('categories.create') }}
        </a>
    </div>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-lg p-4 shadow-sm border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">{{ __('categories.total') }}</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $categories->total() }}</p>
                </div>
                <div class="bg-primary/10 p-3 rounded-full">
                    <i class="fas fa-tags text-primary"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg p-4 shadow-sm border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">{{ __('categories.active') }}</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $categories->where('is_active', true)->count() }}</p>
                </div>
                <div class="bg-green-100 p-3 rounded-full">
                    <i class="fas fa-check-circle text-green-600"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg p-4 shadow-sm border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">{{ __('categories.inactive') }}</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $categories->where('is_active', false)->count() }}</p>
                </div>
                <div class="bg-red-100 p-3 rounded-full">
                    <i class="fas fa-times-circle text-red-600"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg p-4 shadow-sm border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">{{ __('categories.products_count') }}</p>
                    <p class="text-2xl font-bold text-gray-800">
                        {{ $categories->sum(function ($c) {return $c->products->count();}) }}</p>
                </div>
                <div class="bg-yellow-100 p-3 rounded-full">
                    <i class="fas fa-box text-yellow-600"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Search & Filter --}}
    <div class="bg-white rounded-lg p-4 shadow-sm border border-gray-200 mb-6">
        <form method="GET" action="{{ route('categories.index') }}" class="flex flex-wrap gap-3">
            <div class="flex-1 min-w-[200px]">
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="{{ __('categories.search_placeholder') }}"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
            </div>
            <button type="submit" class="bg-primary hover:bg-primary-dark text-white px-4 py-2 rounded-lg transition">
                <i class="fas fa-search"></i> {{ __('categories.search') }}
            </button>
            <a href="{{ route('categories.index') }}"
                class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg transition">
                <i class="fas fa-redo"></i> {{ __('categories.reset') }}
            </a>
        </form>
    </div>

    {{-- Categories Grid --}}
    @if ($categories->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($categories as $category)
                <div
                    class="flex bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition duration-300">
                    {{-- Category Image --}}
                    <div class="relative size-40 bg-gray-100">
                        @if ($category->image)
                            <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}"
                                class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <i class="fas fa-tags text-4xl text-gray-300"></i>
                            </div>
                        @endif

                        {{-- Status Badge --}}
                        <div class="absolute top-2 left-2">
                            <span
                                class="px-2 py-1 text-xs font-medium rounded-full {{ $category->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-200 text-gray-600' }}">
                                {{ $category->is_active ? __('categories.status_active') : __('categories.status_inactive') }}
                            </span>
                        </div>

                        {{-- Products Count --}}
                        <div class="absolute bottom-2 left-2">
                            <span class="px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-700">
                                <i class="fas fa-box"></i> {{ $category->products->count() }}
                                {{ __('categories.product_count_label') }}
                            </span>
                        </div>
                    </div>

                    {{-- Category Info --}}
                    <div class="p-3 flex flex-col justify-between w-[60%]">
                        <div>
                            <div class="flex justify-between items-start pb-2">
                                <div >
                                    <h3 class="text-gray-800 font-semibold text-lg">{{ $category->name }}</h3>
                                </div>
                                <div class="flex items-center gap-1">
                                    @if ($category->is_active)
                                        <span class="text-xs text-green-600">● {{ __('categories.status_active') }}</span>
                                    @else
                                        <span class="text-xs text-red-600">● {{ __('categories.status_inactive') }}</span>
                                    @endif
                                </div>
                            </div>

                            @if ($category->description)
                                <p class="text-sm text-gray-500 line-clamp-2">{{ $category->description }}</p>
                            @endif
                        </div>

                        {{-- Actions --}}
                        <div class="grid grid-cols-2 items-center gap-2 pt-3">
                            <a href="{{ route('categories.edit', $category) }}"
                                class="flex-1 bg-gray-100 hover:bg-green-100 hover:text-green-500 text-primary text-center px-3 py-1.5 rounded-lg text-sm transition border border-gray-200">
                                <i class="fas fa-edit"></i> {{ __('categories.edit') }}
                            </a>
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="flex-1"
                                onsubmit="return confirm('{{ __('categories.confirm_delete') }}')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="w-full bg-gray-100 hover:bg-red-100 hover:text-red-500 text-primary text-center px-3 py-1.5 rounded-lg text-sm transition border border-gray-200">
                                    <i class="fas fa-trash"></i> {{ __('categories.delete') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-6">
            {{ $categories->appends(request()->query())->links() }}
        </div>
    @else
        {{-- Empty State --}}
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-12 text-center">
            <i class="fas fa-tags text-6xl text-gray-300 mb-4"></i>
            @if (request('search'))
                <h3 class="text-xl font-semibold text-gray-700 mb-2">{{ __('categories.no_results') }}</h3>
                <p class="text-gray-500 mb-4">{{ __('categories.no_results_desc') }}
                    "<strong>{{ request('search') }}</strong>"</p>
                <a href="{{ route('categories.index') }}"
                    class="bg-primary hover:bg-primary-dark text-white px-6 py-2 rounded-lg transition inline-flex items-center gap-2">
                    <i class="fas fa-redo"></i> {{ __('categories.show_all') }}
                </a>
            @else
                <h3 class="text-xl font-semibold text-gray-700 mb-2">{{ __('categories.no_categories') }}</h3>
                <p class="text-gray-500 mb-4">{{ __('categories.no_categories_desc') }}</p>
                <a href="{{ route('categories.create') }}"
                    class="bg-primary hover:bg-primary-dark text-white px-6 py-2 rounded-lg transition inline-flex items-center gap-2">
                    <i class="fas fa-plus"></i> {{ __('categories.add_first') }}
                </a>
            @endif
        </div>
    @endif
@endsection
