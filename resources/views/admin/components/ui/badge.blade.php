@props([
    'variant' => 'default',
])
@php
    $baseClasses = 'px-2.5 py-0.5 rounded-full text-[11px] font-bold inline-flex items-center justify-center';

    $variants = [
        'default' => 'bg-slate-100 text-slate-700',

        // Status Variants
        'publish' => 'bg-green-100 text-green-700',
        'draft' => 'bg-slate-200 text-slate-600',
        'nonaktif' => 'bg-red-100 text-red-700',

        // Content & Utility Variants
        'highlight' => 'bg-yellow-100 text-yellow-700',
        'berita' => 'bg-blue-100 text-blue-700',
        'artikel' => 'bg-purple-100 text-purple-700',

        // Extra Variants (Requested)
        'pengumuman' => 'bg-orange-100 text-orange-700',
        'agenda' => 'bg-indigo-100 text-indigo-700',
        'prestasi' => 'bg-teal-100 text-teal-700',

        // Rank Variants
        'juara 1' => 'bg-yellow-100 text-yellow-700 border border-yellow-200',
        'juara 2' => 'bg-gray-100 text-gray-600 border border-gray-200',
        'juara 3' => 'bg-orange-100 text-orange-700 border border-orange-200',
    ];

    $classes = $baseClasses . ' ' . ($variants[$variant] ?? $variants['default']);
@endphp

<span {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</span>
