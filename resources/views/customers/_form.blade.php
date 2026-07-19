<div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-0">
    {{-- Name --}}
    <div>
        <label class="block mb-2 text-sm font-medium text-gray-700">
            {{ __('app.name') }}
        </label>

        <input type="text" name="name" required value="{{ $customer->name ?? '' }}"
            class="w-full rounded-lg border border-gray-300 px-4 py-2.5 shadow-sm focus:border-primary focus:ring-2 focus:ring-primary/20 focus:outline-none"
            placeholder="{{ __('app.name') }}">
    </div>

    {{-- Email --}}
    <div>
        <label class="block mb-2 text-sm font-medium text-gray-700">
            {{ __('app.email') }}
        </label>

        <input type="email" name="email" value="{{ $customer->email ?? '' }}"
            class="w-full rounded-lg border border-gray-300 px-4 py-2.5 shadow-sm focus:border-primary focus:ring-2 focus:ring-primary/20 focus:outline-none"
            placeholder="example@gmail.com">
    </div>

    {{-- Phone --}}
    <div class="flex flex-col gap-5">
        <div>
            <label class="block mb-2 text-sm font-medium text-gray-700">
                {{ __('app.phone') }}
            </label>

            <input type="text" name="phone" value="{{ $customer->phone ?? '' }}"
                class="w-full rounded-lg border border-gray-300 px-4 py-2.5 shadow-sm focus:border-primary focus:ring-2 focus:ring-primary/20 focus:outline-none"
                placeholder="+20 100 000 0000">
        </div>
        {{-- Country --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-0">
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-700">
                    {{ __('app.city') }}
                </label>

                <input type="text" name="city" required value="{{ $customer->city ?? '' }}"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 shadow-sm focus:border-primary focus:ring-2 focus:ring-primary/20 focus:outline-none"
                    placeholder="{{ __('app.city') }}">
            </div>

            {{-- Address --}}
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-700">
                    {{ __('app.address') }}
                </label>

                <input type="text" name="address" value="{{ $customer->address ?? '' }}"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 shadow-sm focus:border-primary focus:ring-2 focus:ring-primary/20 focus:outline-none"
                    placeholder="{{ __('app.address') }}">
            </div>
        </div>
    </div>
    {{-- Notes --}}
    <div class="md:col-span-1">
        <label class="block mb-2 text-sm font-medium text-gray-700">
            {{ __('app.notes') }}
        </label>

        <textarea name="notes" rows="5"
            class="w-full rounded-lg border border-gray-300 px-4 py-2.5 shadow-sm focus:border-primary focus:ring-2 focus:ring-primary/20 focus:outline-none"
            placeholder="{{ __('app.notes') }}">{{ $customer->notes ?? '' }}</textarea>
    </div>
</div>

<div class="flex justify-end gap-3 mt-3 mb-8">
    <a href="{{ route('customers.index') }}"
        class="px-5 py-2.5 rounded-lg border border-gray-300 hover:bg-gray-100 transition">
        {{ __('app.close') }}
    </a>

    <button type="submit" class="px-5 py-2.5 rounded-lg bg-primary text-white hover:bg-primary-dark transition">
        <i class="fas fa-save mr-2"></i>
        {{ __('app.save') }}
    </button>
</div>
