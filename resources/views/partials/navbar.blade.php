<nav class="shadow px-6 py-4 flex justify-between items-center h-[8%]">

    <h1 class="text-xl font-semibold">
        @lang('dashboard.title')
    </h1>

    <div class="flex items-center gap-4">
        {{-- <span>{{ auth()->user()->name }}</span> --}}
        @if (app()->getLocale() == 'en')
            <a href="{{ route('language.switch', 'ar') }}">
                العربية
            </a>
        @else
            <a href="{{ route('language.switch', 'en') }}">
                English
            </a>
        @endif 
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="text-red-600 hover:underline">
                <i class="fa-solid fa-arrow-right-from-bracket"></i>
            </button>
        </form>
    </div>
    

</nav>
