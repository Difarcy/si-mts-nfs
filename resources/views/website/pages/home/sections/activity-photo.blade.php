<div class="animate-on-scroll">
    <x-website.components.layout.page-title title="Kegiatan Sekolah" margin="mb-6" />
    @if(isset($fotoKegiatan) && $fotoKegiatan->count() > 0)
        @php
            $topRow = $fotoKegiatan->shuffle()->values();
            $bottomRow = $fotoKegiatan->shuffle()->values();

            $topRowItems = $topRow->concat($topRow);
            $bottomRowItems = $bottomRow->concat($bottomRow);

            $durationTop = 38;
            $durationBottom = 42;
            $delayTop = -1 * (rand(0, $durationTop * 100) / 100);
            $delayBottom = -1 * (rand(0, $durationBottom * 100) / 100);
        @endphp
        <div class="space-y-3 overflow-hidden">
            <div class="relative w-full overflow-hidden">
                <div class="flex w-fit gap-3 animate-marquee" style="animation-duration: {{ $durationTop }}s; animation-delay: {{ $delayTop }}s;">
                    @foreach($topRowItems as $item)
                        <div class="w-75 h-50 shrink-0 overflow-hidden">
                            <img src="{{ $item->gambar ? asset('storage/' . $item->gambar) : asset('images/background/default-backgrounds.png') }}"
                                alt="{{ $item->judul ?? 'Foto Kegiatan' }}" class="w-full h-full object-cover">
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="relative w-full overflow-hidden">
                <div class="flex w-fit gap-3 animate-marquee-reverse" style="animation-duration: {{ $durationBottom }}s; animation-delay: {{ $delayBottom }}s;">
                    @foreach($bottomRowItems as $item)
                        <div class="w-75 h-50 shrink-0 overflow-hidden">
                            <img src="{{ $item->gambar ? asset('storage/' . $item->gambar) : asset('images/background/default-backgrounds.png') }}"
                                alt="{{ $item->judul ?? 'Foto Kegiatan' }}" class="w-full h-full object-cover">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @else
        <div class="flex items-center justify-center py-12 min-h-80">
            <p class="text-[11px] sm:text-base font-semibold text-slate-900 text-center tracking-wider">Belum Ada Foto
                Kegiatan</p>
        </div>
    @endif
    
    @if(isset($fotoKegiatan) && $fotoKegiatan->count() > 0)
    <div class="mt-4 text-center">
        <a href="/foto"
            class="inline-flex items-center gap-2 text-green-700 hover:text-green-800 font-semibold text-[10px] sm:text-sm transition-colors duration-300 group">
            Lihat Semua
            <svg xmlns="http://www.w3.org/2000/svg"
                class="h-4 w-4 group-hover:translate-x-1 transition-transform duration-300" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </a>
    </div>
    @endif
</div>
