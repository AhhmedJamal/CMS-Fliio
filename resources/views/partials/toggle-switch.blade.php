{{-- resources/views/partials/toggle-switch.blade.php --}}

@php
    $name = $name ?? 'is_active';
    $label = $label ?? __('products.is_active');
    $checked = old($name) !== null ? old($name) : ($checked ?? false);
    $checked = filter_var($checked, FILTER_VALIDATE_BOOLEAN);
@endphp

<div class="flex items-center gap-3 pt-6">
    <input type="hidden" name="{{ $name }}" value="0">
    <input type="checkbox" 
           name="{{ $name }}" 
           value="1" 
           {{ $checked ? 'checked' : '' }}
           class="toggle-switch w-4 h-4 rounded transition accent-primary" 
           id="{{ $name }}">
    <label for="{{ $name }}" class="text-sm font-medium cursor-pointer">
        {{ $label }}
    </label>
</div>