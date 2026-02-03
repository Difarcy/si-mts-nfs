@props([
    'type' => 'button',
    'variant' => 'primary',
])

@php
    $baseClasses = 'py-1 px-3 sm:py-1.5 sm:px-4 font-bold rounded-lg shadow-md hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center gap-2 group cursor-pointer';

    $variants = [
        'primary' => 'bg-gradient-to-r from-green-700 to-green-600 hover:from-green-800 hover:to-green-700 text-white',
        'secondary' => 'bg-white border border-black text-black hover:bg-gray-50',
        'danger' => 'bg-red-600 hover:bg-red-700 text-white',
    ];

    $classes = $baseClasses . ' ' . ($variants[$variant] ?? $variants['primary']);
@endphp

<button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</button>
