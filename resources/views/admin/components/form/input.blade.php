@props([
    'label' => null,
    'name' => '',
    'type' => 'text',
    'placeholder' => '',
    'required' => false,
    'asterisk' => false,
])

<div class="space-y-0.5">
    @if($label)
        <label for="{{ $name }}" class="block text-[12px] sm:text-sm text-black">
            {{ $label }}
            @if($required || $asterisk)
                <span class="text-red-600" data-required-indicator="true">*</span>
            @endif
        </label>
    @endif
    <input 
        type="{{ $type }}" 
        id="{{ $name }}" 
        name="{{ $name }}"
        placeholder="{{ $placeholder }}"
        {{ $required ? 'required' : '' }}
        {{ $attributes->merge(['class' => 'w-full px-3 py-1 sm:px-4 sm:py-1.5 border border-black rounded-lg focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400 focus:outline-none text-[12px] sm:text-sm transition-all cursor-text']) }}
    >
</div>
