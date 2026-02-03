@props([
    'label' => null,
    'name' => '',
    'placeholder' => '',
    'rows' => 5,
    'required' => false,
])

<div class="space-y-0.5">
    @if($label)
        <label for="{{ $name }}" class="block text-[12px] sm:text-sm text-black">
            {{ $label }}
            @if($required)
                <span class="text-red-600" data-required-indicator="true">*</span>
            @endif
        </label>
    @endif
    <textarea 
        id="{{ $name }}" 
        name="{{ $name }}"
        rows="{{ $rows }}"
        placeholder="{{ $placeholder }}"
        {{ $required ? 'required' : '' }}
        {{ $attributes->merge(['class' => 'w-full px-3 py-2 sm:px-4 sm:py-3 border border-black rounded-lg focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400 focus:outline-none text-[12px] sm:text-sm transition-all resize-none cursor-text']) }}
    >{{ $slot }}</textarea>
</div>
