@php
    // Use widget data from View Composer or fallback to manually passed variable
    $infoTerkiniData = $infoTerkiniWidget ?? ($infoTerkini ?? collect());
@endphp

<!-- Pengumuman Widget -->
<div class="animate-on-scroll">
    <x-website.components.layout.page-title title="Pengumuman" tag="h3" margin="mb-4" />

    <div class="space-y-4">
        @forelse($infoTerkiniData as $item)
            <div class="pb-3 border-b border-gray-100 last:border-0 last:pb-0">
                <a href="{{ route('web.announcement.detail', $item->id) }}" class="block group">
                    <h4
                        class="text-base sm:text-lg font-bold text-black mb-1 line-clamp-2 group-hover:text-green-700 transition-colors font-roboto-slab leading-snug">
                        {{ $item->judul }}
                    </h4>
                    <p
                        class="text-sm sm:text-base text-slate-900 line-clamp-2 mb-2 text-justify font-lato leading-relaxed">
                        {{ \Illuminate\Support\Str::limit(strip_tags($item->deskripsi), 100, '...') }}
                    </p>
                    <p class="text-xs sm:text-sm text-slate-900 font-lato">
                        @php
                            $dateObj = $item->tanggal_publikasi ?? $item->created_at ?? now();
                            $date = \Carbon\Carbon::parse($dateObj)->translatedFormat('d F Y');
                            $time = \Carbon\Carbon::parse($dateObj)->format('H:i');
                        @endphp
                        <span class="inline-flex items-center gap-1.5">
                            <span>{{ $date }}</span>
                            <span aria-hidden="true"
                                style="display:inline-block;width:1px;height:10px;background:rgba(0,0,0,1);vertical-align:middle;"></span>
                            <span>{{ $time }} WIB</span>
                        </span>
                    </p>
                </a>
            </div>
        @empty
            <div class="flex items-center justify-center py-8">
                <p class="text-[11px] sm:text-base font-semibold text-slate-900 text-center tracking-wider">
                    Belum Ada Pengumuman
                </p>
            </div>
        @endforelse
    </div>

    <div class="mt-4 text-center">
        <a href="{{ route('web.announcement') }}"
            class="inline-flex items-center gap-1 text-green-700 hover:text-green-800 font-semibold text-[10px] sm:text-sm transition-colors duration-300 group">
            Selengkapnya
            <svg xmlns="http://www.w3.org/2000/svg"
                class="h-3 w-3 sm:h-4 sm:w-4 group-hover:translate-x-1 transition-transform duration-300" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </a>
    </div>
</div>