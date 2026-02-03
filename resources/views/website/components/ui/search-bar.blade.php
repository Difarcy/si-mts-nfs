@props([
    'action' => '#',
    'placeholder' => 'Cari informasi...',
    'name' => 'q',
    'value' => request('q')
])

<form action="{{ $action }}" method="GET" class="relative group" @if($action === '#') data-website-search-form @endif>
    <div class="relative">
        <input type="text" name="{{ $name }}" value="{{ $value }}" placeholder="{{ $placeholder }}" autocomplete="off" @if($action === '#') data-website-search-input @endif
            class="w-full px-4 py-2.5 bg-gray-50 border border-black rounded-lg focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 focus:outline-none text-xs sm:text-sm transition-all placeholder-slate-500 text-black">
        <button type="submit"
            class="absolute right-3 inset-y-0 flex items-center p-2 text-slate-900 hover:text-yellow-400 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </button>
    </div>

    @if($action === '#')
        <div data-website-search-empty class="hidden mt-10 py-20 text-center space-y-5">
            <div class="flex justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 sm:h-12 sm:w-12 text-slate-900" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            <p class="text-[11px] sm:text-base font-semibold text-slate-900 tracking-wider">Hasil tidak ditemukan</p>
            <p class="text-[10px] sm:text-sm text-slate-900">Coba gunakan kata kunci yang berbeda.</p>
        </div>
    @endif
</form>
