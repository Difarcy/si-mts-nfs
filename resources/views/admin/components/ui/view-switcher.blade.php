@props([
    'activeView' => 'view' // Nama variabel Alpine.js yang digunakan
])

<div {{ $attributes->merge(['class' => 'flex items-center bg-white p-0.5 rounded-lg border border-black gap-0.5 h-[34px] sm:h-[34px]']) }}>
    {{-- Button Tabel --}}
    <button type="button" @click="{{ $activeView }} = 'table'"
        :class="{{ $activeView }} === 'table' 
            ? 'bg-green-600 text-white shadow-sm' 
            : 'text-gray-400 hover:bg-gray-50 hover:text-green-700'"
        class="h-full px-2 sm:px-2.5 rounded-md transition-all duration-200 flex items-center justify-center group cursor-pointer"
        title="Tampilan Tabel">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
            <rect x="3" y="4" width="18" height="16" rx="2" />
            <line x1="3" y1="10" x2="21" y2="10" />
            <line x1="3" y1="15" x2="21" y2="15" />
            <line x1="10" y1="4" x2="10" y2="20" />
        </svg>
    </button>

    {{-- Button Grid --}}
    <button type="button" @click="{{ $activeView }} = 'grid'"
        :class="{{ $activeView }} === 'grid' 
            ? 'bg-blue-600 text-white shadow-sm' 
            : 'text-gray-400 hover:bg-gray-100 hover:text-blue-700'"
        class="h-full px-2 sm:px-2.5 rounded-md transition-all duration-200 flex items-center justify-center group cursor-pointer"
        title="Tampilan Grid">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
            <rect x="3" y="3" width="7" height="7" rx="1" />
            <rect x="14" y="3" width="7" height="7" rx="1" />
            <rect x="14" y="14" width="7" height="7" rx="1" />
            <rect x="3" y="14" width="7" height="7" rx="1" />
        </svg>
    </button>
</div>
