@props([
    'items' => null, // The paginator object
    'total' => 0,    
    'current' => 1,  
])

@php
    $paginator = $items;
    $hasPaginator = $paginator instanceof \Illuminate\Pagination\LengthAwarePaginator || $paginator instanceof \Illuminate\Pagination\Paginator;
    $isLengthAware = $paginator instanceof \Illuminate\Pagination\LengthAwarePaginator;
    
    // Fallback data if no paginator provided
    $totalData = $hasPaginator && method_exists($paginator, 'total') ? $paginator->total() : $total;
    $currentPage = $hasPaginator ? $paginator->currentPage() : $current;
    $from = $hasPaginator && method_exists($paginator, 'firstItem') ? ($paginator->firstItem() ?? 0) : 0;
    $to = $hasPaginator && method_exists($paginator, 'lastItem') ? ($paginator->lastItem() ?? 0) : 0;

    $pageLinks = [];
    $lastPage = $isLengthAware ? $paginator->lastPage() : null;
    if ($isLengthAware && $lastPage > 1) {
        $window = 2;
        $left = max(1, $currentPage - $window);
        $right = min($lastPage, $currentPage + $window);

        $pageLinks[] = 1;

        if ($left > 2) {
            $pageLinks[] = '...';
        }

        for ($i = max(2, $left); $i <= min($lastPage - 1, $right); $i++) {
            $pageLinks[] = $i;
        }

        if ($right < $lastPage - 1) {
            $pageLinks[] = '...';
        }

        if ($lastPage > 1) {
            $pageLinks[] = $lastPage;
        }
    }
@endphp

<div {{ $attributes->merge(['class' => 'flex items-center justify-between gap-2']) }}>
    {{-- Info Text --}}
    <div>
        <p class="text-[10px] sm:text-xs text-black">
            Menampilkan {{ $from }}–{{ $to }} dari {{ $totalData }} data
        </p>
    </div>

    <div class="flex gap-1 text-black items-center">
        @if($hasPaginator && !$paginator->onFirstPage())
            <a href="{{ $paginator->previousPageUrl() }}"
                class="px-2 py-1 sm:px-3 sm:py-1 border border-black rounded text-[10px] sm:text-xs text-black hover:bg-gray-100 transition-colors flex items-center gap-1 cursor-pointer">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                <span class="hidden sm:inline">Previous</span>
            </a>
        @else
            <span class="px-2 py-1 sm:px-3 sm:py-1 border border-gray-300 rounded text-[10px] sm:text-xs text-gray-400 flex items-center gap-1 cursor-not-allowed">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                <span class="hidden sm:inline">Previous</span>
            </span>
        @endif

        @if($isLengthAware && count($pageLinks) > 0)
            <div class="hidden sm:flex items-center gap-1">
                @foreach($pageLinks as $page)
                    @if($page === '...')
                        <span class="px-2 py-1 sm:px-3 sm:py-1 border border-gray-300 rounded text-[10px] sm:text-xs text-gray-400 cursor-default">…</span>
                    @elseif((int) $page === (int) $currentPage)
                        <button type="button" class="px-2 py-1 sm:px-3 sm:py-1 border border-black rounded text-[10px] sm:text-xs bg-green-700 text-white font-bold cursor-default">
                            {{ $currentPage }}
                        </button>
                    @else
                        <a href="{{ $paginator->url($page) }}" class="px-2 py-1 sm:px-3 sm:py-1 border border-black rounded text-[10px] sm:text-xs text-black hover:bg-gray-100 transition-colors">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach
            </div>

            <button type="button" class="sm:hidden px-2 py-1 border border-black rounded text-[10px] bg-green-700 text-white font-bold cursor-default">
                {{ $currentPage }}
            </button>
        @else
            <button type="button" class="px-2 py-1 sm:px-3 sm:py-1 border border-black rounded text-[10px] sm:text-xs bg-green-700 text-white font-bold cursor-default">
                {{ $currentPage }}
            </button>
        @endif

        @if($hasPaginator && $paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}"
                class="px-2 py-1 sm:px-3 sm:py-1 border border-black rounded text-[10px] sm:text-xs text-black hover:bg-gray-100 transition-colors flex items-center gap-1 cursor-pointer">
                <span class="hidden sm:inline">Next</span>
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </a>
        @else
            <span class="px-2 py-1 sm:px-3 sm:py-1 border border-gray-300 rounded text-[10px] sm:text-xs text-gray-400 flex items-center gap-1 cursor-not-allowed">
                <span class="hidden sm:inline">Next</span>
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </span>
        @endif
    </div>
</div>
