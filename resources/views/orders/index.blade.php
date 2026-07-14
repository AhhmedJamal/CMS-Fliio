@extends('layouts.admin')

@section('title', __('dashboard.orders'))

@section('content')
    @php
        $statusColors = [
            'pending' => 'bg-yellow-100 text-yellow-700',
            'processing' => 'bg-blue-100 text-blue-700',
            'shipped' => 'bg-orange-100 text-orange-700',
            'delivered' => 'bg-green-100 text-green-700',
            'cancelled' => 'bg-red-100 text-red-700',
        ];
    @endphp


    <div class="space-y-6">

        {{-- Header --}}
        <div class="flex items-center justify-between">
            <div class="flex justify-between w-full items-center">
                <h2 class="text-3xl font-bold text-gray-800 ">
                    @lang('dashboard.welcome_orders')
                </h2>
                <a href="{{ route('orders.create') }}" class="py-2 px-4 rounded-lg bg-amber-500 text-white">@lang('orders.create_order')</a>
            </div>
        </div>

        {{-- Card --}}
        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

            <div class="overflow-x-auto">

                <table class="min-w-full divide-y divide-gray-200">

                    <thead class="bg-gray-50">
                        <tr class="text-left text-xs font-semibold uppercase tracking-wider text-gray-500">

                            <th class="px-6 py-4">#</th>
                            <th class="px-6 py-4">@lang('orders.order_code')</th>
                            <th class="px-6 py-4">@lang('orders.customer_name')</th>
                            <th class="px-6 py-4">@lang('orders.phone')</th>
                            <th class="px-6 py-4">@lang('orders.city')</th>
                            <th class="px-6 py-4">@lang('orders.address')</th>
                            <th class="px-6 py-4">@lang('orders.payment_method')</th>
                            <th class="px-6 py-4">@lang('orders.discount')</th>
                            <th class="px-6 py-4">@lang('orders.total_price')</th>
                            <th class="px-6 py-4">@lang('orders.status')</th>
                            <th class="px-6 py-4">@lang('orders.created_at')</th>

                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100 bg-white">

                        @foreach ($orders->sortByDesc('id') as $order )
                            <tr class="transition hover:bg-gray-50">

                                <td class="px-6 py-4 font-medium text-gray-700">
                                    {{ $order->id }}
                                </td>

                                <td class="px-6 py-4">
                                    #{{ $order->order_code }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $order->customer_name }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $order->phone }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $order->city }}
                                </td>

                                <td class="px-6 py-4 max-w-xs truncate">
                                    {{ $order->address }}
                                </td>

                                <td class="px-6 py-4">
                                    <span class="rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700">
                                        {{ ucfirst($order->payment_method) }}
                                    </span>
                                </td>

                                <td class="px-6 py-4">
                                    {{ $order->discount }}
                                </td>

                                <td class="px-6 py-4 font-semibold text-green-600">
                                    ${{ number_format($order->total_price, 2) }}
                                </td>

                                <td class="px-6 py-4">

                                    <span
                                        class="block rounded-full px-3 py-1 text-center text-xs font-semibold {{ $statusColors[$order->status] ?? 'bg-gray-100 text-gray-700' }}">
                                        {{ ucfirst($order->status) }}
                                    </span>

                                </td>

                                <td class="px-6 py-4 text-sm text-gray-500">
                                    {{ $order->created_at->format('d M Y') }}
                                </td>

                            </tr>
                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    </div>

@endsection
