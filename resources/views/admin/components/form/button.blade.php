@props([
    'variant' => 'primary',
    'href' => null,
    'type' => 'button',
    'icon' => null,
])

@php
    // Base classes common to all buttons
    $baseClasses = 'inline-flex items-center justify-center p-1.5 sm:px-4 sm:py-1.5 text-[11px] sm:text-sm font-semibold transition-colors rounded shadow-sm cursor-pointer';

    // Map variants to specific Tailwind color classes
    $variants = [
        'primary' => 'bg-green-700 hover:bg-green-800 text-white',
        'add'     => 'bg-green-700 hover:bg-green-800 text-white',
        'gray'    => 'bg-slate-600 hover:bg-slate-700 text-white',
        'back'    => 'bg-slate-600 hover:bg-slate-700 text-white',
        'danger'  => 'bg-red-600 hover:bg-red-700 text-white',
        'delete'  => 'bg-red-600 hover:bg-red-700 text-white',
        'cancel'  => 'bg-red-600 hover:bg-red-700 text-white',
        'warning' => 'bg-yellow-500 hover:bg-yellow-600 text-white',
        'edit'    => 'bg-yellow-500 hover:bg-yellow-600 text-white',
        'secondary' => 'bg-slate-600 hover:bg-slate-700 text-white',
        'info'      => 'bg-blue-600 hover:bg-blue-700 text-white',
    ];

    $classes = $baseClasses . ' ' . ($variants[$variant] ?? $variants['primary']);
@endphp

@if ($href)
    {{-- Render as Anchor Tag --}}
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        @if ($icon)
            <div class="{{ $slot->isEmpty() ? '' : 'sm:mr-1.5' }}">
                {{ $icon }}
            </div>
        @endif
        @if (!$slot->isEmpty())
            <span class="{{ $icon ? 'hidden sm:inline' : '' }}">
                {{ $slot }}
            </span>
        @endif
    </a>
@else
    {{-- Render as Button Tag --}}
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
        @if ($icon)
            <div class="{{ $slot->isEmpty() ? '' : 'sm:mr-1.5' }}">
                {{ $icon }}
            </div>
        @endif
        @if (!$slot->isEmpty())
            <span class="{{ $icon ? 'hidden sm:inline' : '' }}">
                {{ $slot }}
            </span>
        @endif
    </button>
@endif
