@extends('layouts.admin')
@section('title', __('customizations.customizations'))
@section('content')
    <div class="flex justify-between items-center">
        <div class="flex items-center gap-2">
            <i class="fa-solid fa-pen-to-square text-2xl"></i>
            <h1 class="text-2xl font-bold">{{ __('customizations.customizations') }}</h1>

        </div>
        <div class="flex space-x-2">
            <a href="" class="btn bg-primary text-white rounded-lg px-4 py-2">
                {{ __('customizations.create_section') }}
            </a>
        </div>
    </div>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

@endsection
