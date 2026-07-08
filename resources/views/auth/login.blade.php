@extends('layouts.guest')

@section('title', __('auth.login_title'))

@section('content')

    <div class="min-h-screen flex items-center justify-center">

        <div class="w-full max-w-md bg-white rounded-xl shadow-lg p-8">

            <h1 class="text-3xl font-bold mb-6 text-center">
                @lang('auth.admin_login')
            </h1>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-4">
                    <label>@lang('auth.email')</label>

                    <input type="email" name="email" value="{{ old('email') }}" class="w-full border rounded-lg p-3 mt-2">

                    @error('email')
                        <p class="text-red-500 mt-2">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label>@lang('auth.password')</label>

                    <input type="password" name="password" class="w-full border rounded-lg p-3 mt-2">
                </div>

                <button class="w-full bg-blue-600 text-white p-3 rounded-lg">
                    @lang('auth.login_btn')
                </button>

            </form>

        </div>

    </div>

@endsection
