@extends('layouts.admin')

@section('title', __('customers.edit_customer'))

@section('content')
    <div class="flex justify-between items-center gap-6 mb-4">
        <div>
            <h1 class="text-2xl font-bold text-neutral-900">{{ __('customers.edit_customer') }}</h1>
        </div>

        <a href="{{ route('customers.index') }}"
            class="flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 text-gray-700 rounded-xl hover:bg-gray-50 transition">
            <i class="fas fa-arrow-left"></i>
            <span>{{ __('app.back') }}</span>
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <form action="{{ route('customers.update', $customer) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            @include('customers._form', ['customer' => $customer])
        </form>
    </div>
@endsection