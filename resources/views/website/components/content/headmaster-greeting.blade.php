@php
    $profile = $kepalaMadrasah ?? null;
    $foto = $profile?->foto;
    $nama = $profile?->nama;
    $sambutan = $profile?->sambutan;
@endphp

<div class="bg-transparent animate-on-scroll">
    <div>
        <div class="mb-3">
            @if($foto)
                <div class="w-full aspect-3/4 bg-gray-200 overflow-hidden flex items-center justify-center mx-auto max-h-112">
                    <img src="{{ asset('storage/' . $foto) }}" alt="Kepala Madrasah" class="w-full h-full object-cover">
                </div>
            @else
                <div class="w-full aspect-3/4 bg-gray-200 flex items-center justify-center mx-auto max-h-112">
                    <span class="text-xs sm:text-base font-semibold text-slate-900 text-center px-4 tracking-wider">Belum ada
                        foto</span>
                </div>
            @endif
        </div>
        <div class="mb-3 text-center">
            <p class="text-xs sm:text-base text-black font-bold text-center font-roboto-slab">
                {{ $nama ?: 'Kepala Madrasah' }}
            </p>
            <p class="text-[10px] sm:text-xs text-slate-900 mt-1 text-center font-roboto-slab">
                - Kepala Madrasah -
            </p>
        </div>
        <div class="mb-0">
            <div
                class="prose prose-sm max-w-none text-xs sm:text-base text-black leading-relaxed text-justify line-clamp-5 [&>p]:mb-0 [&>p]:inline [&>p+p]:before:content-['_']">
                @if($sambutan)
                    <p>{{ \Illuminate\Support\Str::limit(trim(strip_tags($sambutan)), 180) }}</p>
                @else
                    <p class="text-[11px] sm:text-base font-semibold text-slate-900 text-center tracking-wider">Belum ada
                        sambutan kepala
                        madrasah.</p>
                @endif
            </div>
        </div>
        <div class="text-center mt-1">
            <a href="/greeting"
                class="inline-flex items-center gap-1 text-green-700 hover:text-green-800 font-semibold text-[10px] sm:text-sm transition-colors duration-300 group">
                Selengkapnya
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-3 w-3 sm:h-4 sm:w-4 group-hover:translate-x-1 transition-transform duration-300"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>
    </div>
</div>
