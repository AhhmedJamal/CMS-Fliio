@extends('layouts.admin')

@section('title', __('customers.add_customer'))

@section('content')
    <div class="flex justify-between items-center gap-6 mb-4">
        <div>
            <h1 class="text-2xl font-bold text-neutral-900">{{ __('customers.add_customer') }}</h1>
        </div>

        <a href="{{ route('customers.index') }}"
            class="flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 text-gray-700 rounded-xl hover:bg-gray-50 transition">
            <i class="fas fa-arrow-left"></i>
            <span>{{ __('app.back') }}</span>
        </a>
    </div>
    <div class="card p-6">
        <form action="{{ route('customers.store') }}" method="POST" class="space-y-5">
            @csrf
            @if ($errors->any())
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @include('customers._form')
        </form>
    </div>
@endsection
