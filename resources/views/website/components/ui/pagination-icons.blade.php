@props([
    'items' => null,
    'showText' => true,
])

@php
    $paginator = $items;
    $hasPaginator = $paginator instanceof \Illuminate\Pagination\LengthAwarePaginator || $paginator instanceof \Illuminate\Pagination\Paginator;

    $currentPage = $hasPaginator ? $paginator->currentPage() : 1;
    $lastPage = $hasPaginator && $paginator instanceof \Illuminate\Pagination\LengthAwarePaginator ? $paginator->lastPage() : $currentPage;
@endphp

@if($hasPaginator && $paginator->count() > 0)
    <div {{ $attributes->merge(['class' => 'flex items-center gap-2']) }}>
        @if($showText)
            <div class="flex items-center gap-2 text-black whitespace-nowrap">
                <span class="text-[10px] sm:text-xs font-medium">Halaman</span>
                <span class="h-7 sm:h-8 px-2 border border-black rounded text-[10px] sm:text-xs font-medium bg-white flex items-center">{{ $currentPage }}</span>
                <span class="text-[10px] sm:text-xs font-medium">/</span>
                <span class="h-7 sm:h-8 px-2 border border-black rounded text-[10px] sm:text-xs font-medium bg-white flex items-center">{{ $lastPage }}</span>
            </div>
        @endif

        @if(!$paginator->onFirstPage())
            <a href="{{ $paginator->previousPageUrl() }}"
                class="w-7 h-7 sm:w-8 sm:h-8 rounded-full border border-black bg-white text-black hover:bg-gray-50 transition-colors flex items-center justify-center"
                aria-label="Previous page" title="Previous">
                <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
        @else
            <span
                class="w-7 h-7 sm:w-8 sm:h-8 rounded-full border border-black bg-gray-50 text-black/40 flex items-center justify-center cursor-not-allowed"
                aria-label="Previous page" title="Previous">
                <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </span>
        @endif

        @if($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}"
                class="w-7 h-7 sm:w-8 sm:h-8 rounded-full border border-black bg-white text-black hover:bg-gray-50 transition-colors flex items-center justify-center"
                aria-label="Next page" title="Next">
                <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        @else
            <span
                class="w-7 h-7 sm:w-8 sm:h-8 rounded-full border border-black bg-gray-50 text-black/40 flex items-center justify-center cursor-not-allowed"
                aria-label="Next page" title="Next">
                <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </span>
        @endif
    </div>
@endif
