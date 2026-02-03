@props([
    'items' => null,
    'paginationId' => null,
])

@php
    $paginator = $items;
    $hasPaginator = $paginator instanceof \Illuminate\Pagination\LengthAwarePaginator || $paginator instanceof \Illuminate\Pagination\Paginator;
    $from = $hasPaginator && method_exists($paginator, 'firstItem') ? ($paginator->firstItem() ?? 0) : 0;
    $to = $hasPaginator && method_exists($paginator, 'lastItem') ? ($paginator->lastItem() ?? 0) : 0;
    $total = $hasPaginator && method_exists($paginator, 'total') ? ($paginator->total() ?? 0) : 0;
@endphp

<div class="flex flex-wrap items-center justify-between gap-3 px-3 sm:px-4 py-2 border-b border-gray-200 bg-white sticky top-0 z-20">
    <div class="flex items-center">
        <div class="flex items-stretch h-8">
            <div class="master-checkbox px-2 rounded-l-sm cursor-pointer flex items-center justify-center relative hover:bg-gray-200 transition-colors" title="Pilih Semua">
                <div class="w-4 h-4 border-2 border-gray-500 rounded sm:w-4 sm:h-4 flex items-center justify-center bg-white relative">
                    <input type="checkbox" class="w-full h-full opacity-0 cursor-pointer absolute z-10">
                    <svg class="w-3 h-3 text-gray-600 hidden checked-icon pointer-events-none" fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/></svg>
                </div>
            </div>

            <div class="relative group h-full">
                <button type="button" id="master-dropdown-btn" class="px-1 h-full text-gray-600 rounded-r-sm hover:bg-gray-200 flex items-center justify-center transition-colors" title="Pilih Opsi">
                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                </button>

                <div id="master-dropdown-menu" class="hidden absolute left-0 top-full mt-1 w-40 bg-white border border-gray-200 shadow-lg rounded-md z-30 py-1">
                    {{ $dropdownItems ?? '' }}
                </div>
            </div>
        </div>

        <button type="button" onclick="window.location.reload()" class="p-2 text-gray-600 hover:bg-gray-100 rounded-full transition-colors" title="Refresh">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
        </button>

        {{ $defaultActions ?? '' }}

        <div class="toolbar-bulk-actions hidden items-center gap-1">
            {{ $bulkActions ?? '' }}
        </div>
    </div>

    <div id="{{ $paginationId }}">
        @if($hasPaginator && $paginator->count() > 0)
            <div class="flex items-center gap-4 text-xs font-medium text-gray-700">
                <span>{{ $from }}-{{ $to }} dari {{ $total }}</span>
                <div class="flex items-center gap-1">
                    @if($paginator->onFirstPage())
                        <button type="button" disabled class="p-2 text-gray-300 cursor-not-allowed rounded-full hover:bg-gray-50">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                        </button>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}" class="p-2 text-black hover:bg-gray-100 rounded-full transition-colors" title="Sebelumnya">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                        </a>
                    @endif

                    @if($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}" class="p-2 text-black hover:bg-gray-100 rounded-full transition-colors" title="Selanjutnya">
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
    </div>
</div>
