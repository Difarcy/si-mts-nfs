@props([
    'header' => null,
    'footer' => null,
    'bodyClass' => '',
])

<div {{ $attributes->merge(['class' => 'bg-white border border-gray-200 rounded shadow-sm overflow-hidden']) }}>
    {{-- Optional Header Section --}}
    @if($header)
        <div class="p-3 sm:p-4 border-b border-gray-100 bg-gray-50">
            {{ $header }}
        </div>
    @endif

    {{-- Main Body Section --}}
    <div class="{{ $bodyClass }}">
        {{ $slot }}
    </div>

    {{-- Optional Footer Section --}}
    @if($footer)
        <div class="px-4 py-3 sm:px-6 sm:py-4 bg-gray-50 border-t border-gray-200">
            {{ $footer }}
        </div>
    @endif
</div>
