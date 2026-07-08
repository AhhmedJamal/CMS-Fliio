@extends('layouts.admin')

@section('title', __('dashboard.settings'))

@section('content')

    <h2 class="text-3xl font-bold mb-6">@lang('dashboard.welcome_settings')</h2>

    <!-- عرض الأخطاء -->
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- عرض رسائل النجاح -->
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- الفورم -->
    <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="flex items-center justify-between  mb-6">
            <h3 class="text-2xl font-bold ">
                إعدادات المتجر
            </h3>
        </div>
        <!-- ========================================== -->
        <!-- زر الحفظ -->
        <!-- ========================================== -->
        <div class="flex justify-end items-center gap-4 sticky top-2">
            <button type="submit"
                class="bg-primary hover:bg-primary/90 hover:scale-95 text-white font-semibold px-8 py-3 rounded-lg transition duration-200 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                حفظ التغييرات
            </button>
        </div>
        <!-- ========================================== -->
        <!-- القسم 1: معلومات المتجر -->
        <!-- ========================================== -->
        <div class="mb-8">
            <h4 class="font-semibold text-lg  mb-4   pr-3">
                معلومات المتجر
            </h4>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- اسم المتجر -->
                <div>
                    <label class="block text-sm font-medium  mb-2">
                        اسم المتجر <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="store_name"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition"
                        value="{{ $settings->get('store_name') }}" placeholder="أدخل اسم المتجر">
                </div>

                <!-- الشعار -->
                <div>
                    <label class="block text-sm font-medium  mb-2">
                        الشعار الحالي
                    </label>
                    @if ($settings->get('store_logo'))
                        <div class="mb-3 p-2 border border-gray-200 rounded-lg inline-block">
                            <img src="{{ $settings->get('store_logo') }}" alt="Logo" class="size-24 object-contain">
                        </div>
                    @else
                        <p class="text-sm text-gray-400 mb-2">لا يوجد شعار</p>
                    @endif

                    <label class="block text-sm font-medium  mb-2">
                        تغيير الشعار
                    </label>
                    <input type="file" name="store_logo" accept="image/*"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    <p class="text-xs text-gray-500 mt-1">
                        الصيغ المدعومة: jpg, jpeg, png, gif, webp (الحد الأقصى: 2MB)
                    </p>
                </div>

                <!-- الفافيكون -->
                <div>
                    <label class="block text-sm font-medium  mb-2">
                        الفافيكون الحالي
                    </label>
                    @if ($settings->get('store_favicon'))
                        <div class="mb-3 p-2 border border-gray-200 rounded-lg inline-block">
                            <img src="{{ $settings->get('store_favicon') }}" alt="Favicon" class="size-24 object-contain">
                        </div>
                    @else
                        <p class="text-sm text-gray-400 mb-2">لا يوجد فافيكون</p>
                    @endif

                    <label class="block text-sm font-medium  mb-2">
                        تغيير الفافيكون
                    </label>
                    <input type="file" name="store_favicon" accept="image/*"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    <p class="text-xs text-gray-500 mt-1">
                        الصيغ المدعومة: jpg, jpeg, png, svg, ico (الحد الأقصى: 512KB)
                    </p>
                </div>
            </div>
        </div>

        <!-- ========================================== -->
        <!-- القسم 2: الألوان -->
        <!-- ========================================== -->
        <div class="mb-8">
            <h4 class="font-semibold text-lg  mb-4   pr-3">
                الألوان
            </h4>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                <!-- اللون الأساسي -->
                <div>
                    <label class="block text-sm font-medium  mb-2 text-center">
                        الأساسي
                    </label>
                    <input type="color" name="primary_color"
                        class="w-full h-14 border border-gray-300 rounded-lg cursor-pointer hover:scale-105 transition"
                        value="{{ $settings->get('primary_color', '#073D42') }}">
                    <p class="text-xs text-center text-gray-500 mt-1">
                        {{ $settings->get('primary_color', '#073D42') }}
                    </p>
                </div>

                <!-- اللون الثانوي -->
                <div>
                    <label class="block text-sm font-medium  mb-2 text-center">
                        الثانوي
                    </label>
                    <input type="color" name="secondary_color"
                        class="w-full h-14 border border-gray-300 rounded-lg cursor-pointer hover:scale-105 transition"
                        value="{{ $settings->get('secondary_color', '#10B981') }}">
                    <p class="text-xs text-center text-gray-500 mt-1">
                        {{ $settings->get('secondary_color', '#10B981') }}
                    </p>
                </div>

                <!-- لون الخلفية -->
                <div>
                    <label class="block text-sm font-medium  mb-2 text-center">
                        الخلفية
                    </label>
                    <input type="color" name="background_color"
                        class="w-full h-14 border border-gray-300 rounded-lg cursor-pointer hover:scale-105 transition"
                        value="{{ $settings->get('background_color', '#FFFFFF') }}">
                    <p class="text-xs text-center text-gray-500 mt-1">
                        {{ $settings->get('background_color', '#FFFFFF') }}
                    </p>
                </div>

                <!-- لون النص -->
                <div>
                    <label class="block text-sm font-medium  mb-2 text-center">
                        النص
                    </label>
                    <input type="color" name="text_color"
                        class="w-full h-14 border border-gray-300 rounded-lg cursor-pointer hover:scale-105 transition"
                        value="{{ $settings->get('text_color', '#1F2937') }}">
                    <p class="text-xs text-center text-gray-500 mt-1">
                        {{ $settings->get('text_color', '#1F2937') }}
                    </p>
                </div>
            </div>
        </div>

        <!-- ========================================== -->
        <!-- القسم 3: معلومات التواصل -->
        <!-- ========================================== -->
        <div class="mb-8">
            <h4 class="font-semibold text-lg  mb-4  border-blue-600 pr-3">
                معلومات التواصل
            </h4>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- الهاتف -->
                <div>
                    <label class="block text-sm font-medium  mb-2">
                        رقم الهاتف
                    </label>
                    <input type="text" name="phone"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition"
                        value="{{ $settings->get('phone') }}" placeholder="مثال: 0123456789">
                </div>

                <!-- البريد الإلكتروني -->
                <div>
                    <label class="block text-sm font-medium  mb-2">
                        البريد الإلكتروني
                    </label>
                    <input type="email" name="email"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition"
                        value="{{ $settings->get('email') }}" placeholder="info@store.com">
                </div>

                <!-- العنوان -->
                <div>
                    <label class="block text-sm font-medium  mb-2">
                        العنوان
                    </label>
                    <input type="text" name="address"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition"
                        value="{{ $settings->get('address') }}" placeholder="العنوان بالكامل">
                </div>

                <!-- فيسبوك -->
                <div>
                    <label class="block text-sm font-medium  mb-2">
                        فيسبوك
                    </label>
                    <input type="url" name="facebook"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition"
                        value="{{ $settings->get('facebook') }}" placeholder="https://facebook.com/store">
                </div>

                <!-- انستغرام -->
                <div>
                    <label class="block text-sm font-medium  mb-2">
                        انستغرام
                    </label>
                    <input type="url" name="instagram"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition"
                        value="{{ $settings->get('instagram') }}" placeholder="https://instagram.com/store">
                </div>
            </div>
        </div>
    </form>

@endsection
