@props([
    'name',
    'title' => '',
    'maxWidth' => '2xl'
])

@php
$maxWidthClass = [
    'sm' => 'sm:max-w-sm',
    'md' => 'sm:max-w-md',
    'lg' => 'sm:max-w-lg',
    'xl' => 'sm:max-w-xl',
    '2xl' => 'sm:max-w-2xl',
    '3xl' => 'sm:max-w-3xl',
    '4xl' => 'sm:max-w-4xl',
    '5xl' => 'sm:max-w-5xl',
    '6xl' => 'sm:max-w-6xl',
    '7xl' => 'sm:max-w-7xl',
][$maxWidth] ?? 'sm:max-w-2xl';
@endphp

<div
    x-data="{ show: false }"
    x-show="show"
    x-on:open-modal.window="if ($event.detail.name === '{{ $name }}') show = true"
    x-on:close-modal.window="if ($event.detail.name === '{{ $name }}') show = false"
    x-on:keydown.escape.window="show = false"
    x-cloak
    class="absolute inset-0 z-[100] overflow-y-auto"
    style="display: none"
>
    {{-- Backdrop --}}
    <div 
        x-show="show" 
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        x-on:click="show = false"
        class="absolute inset-0 bg-transparent transition-opacity"
    ></div>

    {{-- Modal Content Container --}}
    <div class="flex min-h-full items-center justify-center p-2 sm:p-4 text-center">
        <div
            x-show="show"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            class="relative transform overflow-hidden rounded-lg bg-white border border-black text-left shadow-xl transition-all my-8 w-[95%] sm:w-full {{ $maxWidthClass }}"
        >
            {{-- Header --}}
            <div class="px-4 py-3 sm:px-6 sm:py-4 border-b border-black flex items-center justify-between bg-gray-50 tracking-wider">
                <h3 class="text-sm sm:text-base font-bold text-black">{{ $title }}</h3>
                <button x-on:click="show = false" class="text-black hover:text-red-600 transition-colors bg-white border border-black p-1 rounded">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <div class="p-4 sm:p-6">
                {{ $slot }}
            </div>

            @if(isset($footer))
                <div class="px-4 py-3 sm:px-6 sm:py-4 border-t border-black bg-gray-50 flex justify-end gap-3">
                    {{ $footer }}
                </div>
            @endif
        </div>
    </div>
</div>
