@props([
    'variant' => 'default',
])
@php
    $baseClasses = 'px-3 py-1 text-[10px] sm:text-xs font-bold uppercase tracking-wider rounded-md inline-flex items-center justify-center shadow-sm';

    $variants = [
        'default' => 'bg-gray-700 text-white',
        
        // Content Types
        'news' => 'bg-blue-600 text-white',
        'berita' => 'bg-blue-600 text-white',
        'article' => 'bg-purple-600 text-white',
        'artikel' => 'bg-purple-600 text-white',
        'announcement' => 'bg-orange-500 text-white',
        'pengumuman' => 'bg-orange-500 text-white',
        'agenda' => 'bg-green-600 text-white',
        
        // Ranks - Warna solid tanpa transparansi
        'juara 1' => '!bg-yellow-400 !text-black border border-yellow-500',
        'juara 2' => '!bg-gray-300 !text-black border border-gray-400',
        'juara 3' => '!bg-orange-500 !text-white border border-orange-600',
    ];

    $classes = $baseClasses . ' ' . ($variants[$variant] ?? $variants['default']);
@endphp

<span {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</span>