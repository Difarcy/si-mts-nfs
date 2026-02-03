@props([
    'variant' => 'primary', // primary, secondary, danger, success, warning, outline, ghost
    'size' => 'md', // sm, md, lg
    'type' => 'button',
    'fullWidth' => false,
    'class' => '',
    'disabled' => false,
    'href' => null
])

@php
    $baseClasses = 'inline-flex items-center justify-center font-bold rounded-xl transition-all focus:outline-none disabled:opacity-50 disabled:cursor-not-allowed uppercase tracking-wider';

    $variants = [
        'primary' => 'bg-green-700 text-white hover:bg-green-800 shadow-sm border border-green-800 focus:ring-2 focus:ring-green-500 focus:ring-offset-2',
        'secondary' => 'bg-gray-100 text-black hover:bg-gray-200 border border-gray-200',
        'danger' => 'bg-red-600 text-white hover:bg-red-700 border border-red-700',
        'success' => 'bg-green-600 text-white hover:bg-green-700',
        'warning' => 'bg-yellow-400 text-green-900 hover:bg-yellow-500 border border-yellow-500',
        'outline' => 'border border-gray-200 text-black hover:bg-gray-50',
        'ghost' => 'text-slate-900 hover:bg-gray-50',
    ];

    $sizes = [
        'xs' => 'px-2 py-1 text-[10px]',
        'sm' => 'px-4 py-2 text-xs',
        'md' => 'px-6 py-2.5 text-sm',
        'lg' => 'px-8 py-3.5 text-base',
    ];

    $classes = "{$baseClasses} {$variants[$variant]} {$sizes[$size]} " . ($fullWidth ? 'w-full ' : '') . $class;
@endphp
@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }} @disabled($disabled)>
        {{ $slot }}
    </button>
@endif
