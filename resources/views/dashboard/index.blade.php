@extends('layouts.admin')

@section('title', __('dashboard.title'))

@section('content')

    <h2 class="text-3xl font-bold" style="color: {{ $settings->get('text_color', '#1F2937') }}">
        @lang('dashboard.welcome_admin')
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 my-6">

        {{-- Total Revenue --}}
        <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">
                        {{ __('dashboard.total_revenue') }}
                    </p>

                    <p class="mt-1 text-2xl font-bold text-gray-800">
                        {{ __('app.currency') }}
                        {{ number_format($totalRevenue, 2) }}
                    </p>
                </div>

                <div class="w-14 h-14 rounded-full bg-green-100 flex items-center justify-center">
                    <i class="fas fa-wallet text-green-600 text-xl"></i>
                </div>
            </div>
        </div>

        {{-- Total Orders --}}
        <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">
                        {{ __('dashboard.total_orders') }}
                    </p>

                    <p class="mt-1 text-2xl font-bold text-gray-800">
                        {{ number_format($totalOrders) }}
                    </p>
                </div>

                <div class="w-14 h-14 rounded-full bg-blue-100 flex items-center justify-center">
                    <i class="fas fa-shopping-cart text-blue-600 text-xl"></i>
                </div>
            </div>
        </div>

        {{-- Average Order Value --}}
        <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">
                        {{ __('dashboard.average_order_value') }}
                    </p>

                    <p class="mt-1 text-2xl font-bold text-gray-800">
                        {{ __('app.currency') }}
                        {{ number_format($averageOrderValue, 2) }}
                    </p>
                </div>

                <div class="w-14 h-14 rounded-full bg-orange-100 flex items-center justify-center">
                    <i class="fas fa-chart-line text-orange-600 text-xl"></i>
                </div>
            </div>
        </div>

        {{-- Total Customers --}}
        <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">
                        {{ __('customers.new_customers') }}
                    </p>

                    <p class="mt-1 text-2xl font-bold text-gray-800">
                        {{ number_format($customers) }}
                    </p>
                </div>

                <div class="w-14 h-14 rounded-full bg-purple-100 flex items-center justify-center">
                    <i class="fas fa-users text-purple-600 text-xl"></i>
                </div>
            </div>
        </div>

    </div>

@endsection