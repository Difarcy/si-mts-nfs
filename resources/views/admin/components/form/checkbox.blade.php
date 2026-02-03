@props([
    'label' => '',
    'name' => '',
    'checked' => false,
    'value' => '1',
])

<div class="flex items-start">
    <div class="flex items-center h-5">
        <input 
            id="{{ $name }}" 
            name="{{ $name }}" 
            type="checkbox" 
            value="{{ $value }}"
            {{ $checked ? 'checked' : '' }}
            {{ $attributes->merge(['class' => 'w-3.5 h-3.5 sm:w-4 sm:h-4 border border-black rounded bg-gray-50 text-green-700 transition-all cursor-pointer focus:ring-0 focus:ring-offset-0']) }}
        >
    </div>
    <div class="ml-2 text-[11px] sm:text-sm">
        <label for="{{ $name }}" class="font-normal text-gray-700 select-none cursor-pointer">{{ $label }}</label>
    </div>
</div>
