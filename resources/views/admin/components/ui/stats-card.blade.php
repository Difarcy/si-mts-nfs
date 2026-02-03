@props([
    'label',
    'value',
    'icon' => null,
    'color' => 'blue',
    'footer' => null,
    'href' => null
])
@php
    $colorClasses = [
        'blue' => ['bg' => 'bg-blue-100', 'text' => 'text-blue-600', 'border' => 'hover:border-blue-600'],
        'green' => ['bg' => 'bg-green-100', 'text' => 'text-green-600', 'border' => 'hover:border-green-600'],
        'purple' => ['bg' => 'bg-purple-100', 'text' => 'text-purple-600', 'border' => 'hover:border-purple-600'],
        'pink' => ['bg' => 'bg-pink-100', 'text' => 'text-pink-600', 'border' => 'hover:border-pink-600'],
        'yellow' => ['bg' => 'bg-yellow-100', 'text' => 'text-yellow-600', 'border' => 'hover:border-yellow-600'],
        'red' => ['bg' => 'bg-red-100', 'text' => 'text-red-600', 'border' => 'hover:border-red-600'],
    ];

    $style = $colorClasses[$color] ?? $colorClasses['blue'];
@endphp

@if ($href)
    <a href="{{ $href }}"
        class="bg-white border border-gray-200 {{ $style['border'] }} hover:shadow-md transition-all p-3 sm:p-4 rounded-xl shadow-sm block cursor-pointer">
    @else
        <div class="bg-white border border-gray-200 {{ $style['border'] }} transition-all p-3 sm:p-4 rounded-xl shadow-sm">
@endif

<div class="flex items-center justify-between">
    <div>
        <p class="text-xs sm:text-sm font-semibold text-black">{{ $label }}</p>
        <p class="text-xl sm:text-3xl font-bold text-black mt-1 sm:mt-2">{{ $value }}</p>
    </div>
    @if ($icon)
        <div class="p-2 sm:p-3 {{ $style['bg'] }} rounded-xl {{ $style['text'] }}">
            {{ $icon }}
        </div>
    @endif
</div>
@if ($footer)
    <div class="mt-3 sm:mt-4 flex items-center gap-3 text-xs sm:text-sm text-black">
        {{ $footer }}
    </div>
@endif

@if ($href)
    </a>
@else
    </div>
@endif
