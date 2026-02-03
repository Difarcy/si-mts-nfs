{{-- Artikel Terbaru Widget --}}
<div class="animate-on-scroll">
    <x-website.components.layout.page-title title="Artikel Terbaru" margin="mb-4" />

    @php
        $articleItems = $latestArticlesWidget ?? collect();
    @endphp

    <div class="space-y-4">
        @forelse($articleItems as $item)
            @php
                $dateObj = $item->tanggal_publikasi ?? $item->created_at ?? now();
                $date = \Carbon\Carbon::parse($dateObj)->translatedFormat('d F Y');
                $time = \Carbon\Carbon::parse($dateObj)->format('H:i');
            @endphp
            <div class="pb-3 border-b border-gray-100 last:border-0 last:pb-0">
                <a href="{{ route('web.article.detail', $item->id) }}" class="group block">
                    <h4
                        class="text-base sm:text-lg font-bold text-black group-hover:text-green-700 transition-colors line-clamp-2 font-roboto-slab leading-snug mb-1">
                        {{ $item->judul }}
                    </h4>
                    <p
                        class="text-sm sm:text-base text-slate-900 line-clamp-2 mb-2 text-justify font-lato leading-relaxed">
                        {{ \Illuminate\Support\Str::limit(strip_tags($item->deskripsi), 80, '...') }}
                    </p>
                    <p class="text-xs sm:text-sm text-slate-900 font-lato">
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
            <div class="py-6 flex items-center justify-center text-center">
                <p class="text-[11px] sm:text-base font-semibold text-slate-900 tracking-wider">
                    Belum Ada Artikel
                </p>
            </div>
        @endforelse
    </div>

    <div class="text-center mt-4">
        <a href="/article"
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