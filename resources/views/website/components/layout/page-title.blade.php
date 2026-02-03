@props([
    'title' => null,
    'tag' => 'h2',
    'margin' => 'mb-6'
])

<div class="flex items-center gap-3 {{ $margin }}">
    <span class="w-px h-6 sm:h-8 bg-green-700"></span>
    <{{ $tag }} {{ $attributes->merge(['class' => 'text-sm sm:text-xl font-bold text-black tracking-tight leading-none font-roboto-slab']) }}>
        {{ $title ?? $slot }}
    </{{ $tag }}>
</div>
