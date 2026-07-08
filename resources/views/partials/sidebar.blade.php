<aside class="w-48 text-white px-1.5 flex flex-col justify-between py-4"
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
                'route' => route('products'),
                'icon' => 'fa-solid fa-box',
            ],
            'categories' => [
                'name' => __('dashboard.categories'),
                'route' => route('categories'),
                'icon' => 'fa-solid fa-layer-group',
            ],
            'orders' => [
                'name' => __('dashboard.orders'),
                'route' => route('orders'),
                'icon' => 'fa-solid fa-cart-shopping',
            ],
            'settings' => [
                'name' => __('dashboard.settings'),
                'route' => route('settings'),
                'icon' => 'fa-solid fa-gear',
            ],
        ];
    @endphp
    <div>
        <div class="p-2 text-2xl font-bold mb-6">
            <img src="{{ $settings->get('store_logo') }}" alt="{{ $settings->get('store_name') }}"
                class="w-full h-auto object-contain rounded-[4px]">
        </div>
        <nav>
            @foreach ($links as $link)
                <a href="{{ $link['route'] }}"
                    class="block px-6 py-3 hover:translate-x-2 transition-all mb-2 rounded-full relative {{ $currentRoute === strtolower($link['name']) ? 'bg-[#ffffff] text-primary ' : 'text-white hover:bg-[#ffffff6e] ' }}">
                    <i class="{{ $link['icon'] }}"></i> {{ $link['name'] }}
                </a>

            @endforeach
        </nav>
    </div>
    <div class="profile flex items-center justify-between px-1.5">
        <div class="avatar">
            <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}" alt=""
                class="rounded-full size-12">
        </div>
        <div class="info">
            <h2 class="name text-white font-bold">{{ Auth::user()->name }}</h2>
            <h3 class="role capitalize text-[12px] text-neutral-400">{{ Auth::user()->role }}</h3>
        </div>
    </div>
    {{-- <a href="{{ route('logout') }}" class="logout">
        <i class="fa-solid fa-right-from-bracket"></i>
    </a> --}}
</aside>
<style>
    /* .active-link::before {
        content: '';
        position: absolute;
        right: -28px;
        top: 50%;
        transform: translateY(-50%);
        border-style: solid;
        border-width: 40px 60px 40px 0;
        border-color: transparent white transparent transparent;
    } */
</style>
