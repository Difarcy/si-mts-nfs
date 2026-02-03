@props([
    'items' => null,
])

@php
    $paginator = $items;
    $hasPaginator = $paginator instanceof \Illuminate\Pagination\LengthAwarePaginator || $paginator instanceof \Illuminate\Pagination\Paginator;

    $from = $hasPaginator && method_exists($paginator, 'firstItem') ? ($paginator->firstItem() ?? 0) : 0;
    $to = $hasPaginator && method_exists($paginator, 'lastItem') ? ($paginator->lastItem() ?? 0) : 0;
    $total = $hasPaginator && method_exists($paginator, 'total') ? ($paginator->total() ?? 0) : 0;
@endphp

@if($hasPaginator && $paginator->count() > 0)
    <div {{ $attributes->merge(['class' => 'flex items-center gap-4 text-xs font-medium text-gray-700']) }}>
        <span>{{ $from }}-{{ $to }} dari {{ $total }}</span>
        <div class="flex items-center gap-1">
            @if($paginator->onFirstPage())
                <button type="button" disabled class="p-2 text-gray-300 cursor-not-allowed rounded-full hover:bg-gray-50">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                </button>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="p-2 text-black hover:bg-gray-100 rounded-full transition-colors" title="Sebelumnya" aria-label="Sebelumnya">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                </a>
            @endif

            @if($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="p-2 text-black hover:bg-gray-100 rounded-full transition-colors" title="Selanjutnya" aria-label="Selanjutnya">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </a>
            @else
                <button type="button" disabled class="p-2 text-gray-300 cursor-not-allowed rounded-full hover:bg-gray-50">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </button>
            @endif
        </div>
    </div>
@endif

