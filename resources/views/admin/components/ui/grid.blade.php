@props([
    'cols' => 'grid-cols-1 md:grid-cols-2 lg:grid-cols-3'
])

<div {{ $attributes->merge(['class' => "p-1 grid $cols gap-6"]) }}>
    {{ $slot }}
</div>
