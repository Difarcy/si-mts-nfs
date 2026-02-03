@props(['items' => []])
<nav aria-label="Breadcrumb" class="mb-2">
    <ol class="flex flex-wrap items-center gap-1 text-[9px] sm:text-[12px] text-black uppercase tracking-tight">
        {{-- Home link always present --}}
        <li>
            <a href="{{ route('web.home') }}" class="hover:text-green-700 transition-colors font-medium">BERANDA</a>
        </li>

        @if(count($items) > 0)
            <li>
                <svg class="w-1.5 h-1.5 sm:w-2.5 sm:h-2.5 text-black shrink-0" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                </svg>
            </li>
        @endif

        @foreach($items as $i => $item)
        @php($isLast = $i === count($items) - 1)
        @if(!empty($item['url']) && !$isLast)
            <li>
                <a href="{{ $item['url'] }}"
                    class="hover:text-green-700 transition-colors font-medium">{{ $item['label'] }}</a>
            </li>
        @else
            <li class="{{ $isLast ? 'font-bold' : 'font-medium' }} truncate max-w-[120px] sm:max-w-none">
                {{ $item['label'] }}
            </li>
        @endif
        @if(!$isLast)
            <li>
                <svg class="w-1.5 h-1.5 sm:w-2.5 sm:h-2.5 text-black shrink-0" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                </svg>
            </li>
        @endif
        @endforeach
    </ol>
</nav>