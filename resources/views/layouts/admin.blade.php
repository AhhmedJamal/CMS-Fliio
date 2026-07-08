<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ $settings->get('store_favicon') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>@yield('title')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

    <div class="flex h-screen">

        @include('partials.sidebar')

        <div class="p-4 flex-1 scrollbar-thumb-primary  "
            style="background-color: {{ $settings->get('primary_color') }}; color:{{ $settings->get('text_color') }} ">
            <div class="flex-1 rounded-2xl overflow-y-auto h-full"
                style="background-color: {{ $settings->get('background_color') }}">

                @include('partials.navbar')

                <main class="p-6 min-h-[85%]">

                    @yield('content')

                </main>

                @include('partials.footer')

            </div>
        </div>

    </div>

</body>

</html>
<style>
    :root {
        --primary: {{ $settings->get('primary_color') }}
    }
</style>
