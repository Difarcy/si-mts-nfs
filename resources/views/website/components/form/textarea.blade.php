@props([
    'label' => null,
    'name' => null,
    'id' => null,
    'wrapperClass' => '',
    'placeholder' => '',
    'required' => false,
    'rows' => 4,
    'value' => '',
])

@php
    $textareaId = $id ?: $name;
@endphp

<div class="{{ $wrapperClass }}">
    @if($label)
        <label for="{{ $textareaId }}" class="block text-gray-700 text-xs sm:text-sm mb-1 sm:mb-2 font-medium">
            {{ $label }}
        </label>
    @endif
    <textarea 
        id="{{ $textareaId }}"
        name="{{ $name }}"
        rows="{{ $rows }}"
        placeholder="{{ $placeholder }}"
        {{ $required ? 'required' : '' }}
        {{ $attributes->merge(['class' => 'w-full px-4 py-1.5 sm:py-2 bg-gray-50 border border-black rounded-lg focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 focus:outline-none transition-all placeholder:text-gray-400 placeholder:font-normal text-gray-700 text-xs sm:text-sm resize-none']) }}
    >{{ old($name, $value) }}</textarea>
</div>
