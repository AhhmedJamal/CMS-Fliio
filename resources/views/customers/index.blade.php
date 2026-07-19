@extends('layouts.admin')
@section('title', __('dashboard.orders'))
@section('content')
    <div class="flex justify-between items-center gap-6 mb-4">
        <div class="card">
            <div class="flex items-center gap-3 mb-4">
                <i
                    class="fa-solid fa-layer-group p-2 w-12! h-full flex items-center justify-center bg-primary/20 rounded-full text-primary text-xl"></i>
                <div>
                    <h1 class="text-2xl font-bold text-neutral-900">{{ __('dashboard.welcome_customers') }}</h1>
                </div>
            </div>
        </div>

        <a href="{{ route('customers.create') }}"
            class="flex items-center gap-2 px-4 py-2 bg-primary text-white rounded-xl hover:bg-primary-hover transition">
            <i class="fas fa-plus"></i>
            <span>{{ __('customers.add_customer') }}</span>
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            {{ __('app.name') }}
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            {{ __('app.email') }}
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            {{ __('app.phone') }}
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            {{ __('app.address') }}
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            {{ __('app.notes') }}
                        </th>

                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            {{ __('customers.actions') }}
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">
                    @forelse($customers as $customer)
                        <tr class="hover:bg-gray-50 transition">

                            <td class="px-6 py-4 font-medium text-gray-800">
                                {{ $customer->name }}
                            </td>

                            <td class="px-6 py-4 text-gray-600">
                                {{ $customer->email }}
                            </td>

                            <td class="px-6 py-4 text-gray-600">
                                {{ $customer->phone }}
                            </td>

                            <td class="px-6 py-4 text-gray-600">
                                {{ $customer->address }}
                            </td>

                            <td class="px-6 py-4 text-gray-600 max-w-xs truncate">
                                {{ $customer->notes ?: '-' }}
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex justify-center gap-2">

                                    <a href="{{ route('customers.edit', $customer) }}"
                                        class="px-3 py-2 rounded-lg bg-green-100 text-green-600 hover:bg-green-200 transition">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form action="{{ route('customers.destroy', $customer) }}" method="POST"
                                        onsubmit="return confirm('{{ __('app.confirm_delete') }}')">
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            class="px-3 py-2 rounded-lg bg-red-100 text-red-600 hover:bg-red-200 transition">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>

                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-10 text-gray-500">
                                <i class="fas fa-users text-4xl mb-3 text-gray-300"></i>

                                <p>{{ __('customers.no_customers') }}</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-3 text-red-500!">
        {{ $customers->links() }}
    </div>
@endsection
