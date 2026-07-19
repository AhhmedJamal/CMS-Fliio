<aside class="w-52 text-white px-1.5 flex flex-col justify-between py-4"
    style="background-color: {{ $settings->get('primary_color') }}">
    @php
        $currentRoute = Route::currentRouteName();
        $links = [
            'dashboard' => [
                'name' => __('dashboard.title'),
                'route' => route('dashboard'),
                'icon' => 'fa-solid fa-chart-area',
            ],
            'products' => [
                'name' => __('dashboard.products'),
                'route' => route('products.index'),
                'icon' => 'fa-solid fa-box',
            ],
            'categories' => [
                'name' => __('dashboard.categories'),
                'route' => route('categories.index'),
                'icon' => 'fa-solid fa-layer-group',
            ],
            'customers' => [
                'name' => __('dashboard.customers'),
                'route' => route('customers.index'),
                'icon' => 'fa-solid fa-user',
            ],
            'orders' => [
                'name' => __('dashboard.orders'),
                'route' => route('orders.index'),
                'icon' => 'fa-solid fa-cart-shopping',
            ],
            'customizations' => [
                'name' => __('dashboard.customizations'),
                'route' => route('customizations.index'),
                'icon' => 'fa-solid fa-pen-to-square',
            ],
            'settings' => [
                'name' => __('dashboard.settings'),
                'route' => route('settings'),
                'icon' => 'fa-solid fa-gear',
            ],
        ];
    @endphp
    <div>
        <a href="{{ route('dashboard') }}" class="p-2 text-2xl font-bold mb-6 block">
            <img src="{{ $settings->get('store_logo') }}" alt="{{ $settings->get('store_name') }}"
                class="w-full h-[60px] object-cover rounded-[6px]">
        </a>
        <nav>
            @foreach ($links as $key => $link)
                <a href="{{ $link['route'] }}"
                    class="block px-6 py-3 hover:translate-x-2 transition-all mb-2 rounded-full relative {{ str_starts_with($currentRoute, $key) ? 'bg-[#ffffff] text-primary ' : 'text-white hover:bg-[#ffffff6e] ' }}">
                    <i class="{{ $link['icon'] }}"></i> {{ $link['name'] }}
                </a>
            @endforeach
        </nav>
    </div>
    <div class="profile flex items-center gap-3 px-1.5">
        <div class="avatar">
            <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}" alt=""
                class="rounded-full size-12">
        </div>
        <div class="info">
            <h2 class="name text-white font-bold">{{ Auth::user()->name }}</h2>
            <h3 class="role capitalize text-[12px] text-neutral-400">{{ Auth::user()->role }}</h3>
        </div>
    </div>
</aside>
