<aside class="w-64 bg-slate-900 text-white">

    <div class="p-6 text-2xl font-bold">
        <h2>LUVBAG.</h2>
    </div>
    <nav>
        <a href="{{ route('dashboard') }}" class="block px-6 py-3 hover:bg-slate-700">
            @lang('dashboard.title')
        </a>
        <a href="{{ route('products') }}" class="block px-6 py-3 hover:bg-slate-700">
            @lang('dashboard.products')
        </a>
        <a href="{{ route('categories') }}" class="block px-6 py-3 hover:bg-slate-700">
            @lang('dashboard.categories')
        </a>
        <a href="{{ route('orders') }}" class="block px-6 py-3 hover:bg-slate-700">
            @lang('dashboard.orders')
        </a>
        <a href="{{ route('settings') }}" class="block px-6 py-3 hover:bg-slate-700">
            @lang('dashboard.settings')
        </a>
    </nav>
</aside>
