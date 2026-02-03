<div>
    @if(isset($promosiBannerPath) && $promosiBannerPath)
        <div class="bg-gray-100 overflow-hidden hover:shadow-md transition-all duration-300 aspect-1920/600">
            <img src="{{ asset('storage/' . $promosiBannerPath) }}" alt="Banner Promosi"
                class="w-full h-full object-cover hover:opacity-90 transition-opacity">
        </div>
    @else
        <div class="bg-gray-100 overflow-hidden aspect-21/9 sm:aspect-1920/600 flex items-center justify-center">
            <p class="text-[11px] sm:text-base font-semibold text-slate-900 text-center tracking-wider">
                Belum Ada Banner Promosi
            </p>
        </div>
    @endif
</div>
